<?php

namespace App\Http\Controllers\DocumentTracker;

use Auth;
use App\User;
use App\Office;
use App\CodeTable;
use Carbon\Carbon;
use App\Helpers\LogActivity;
use App\Models\Settings\OfficeGroups;
use App\Models\DocumentTracker\DocumentTypes;
use App\Models\DocumentTracker\DocumentKeyword;
use App\Models\DocumentTracker\DocumentTracker;
use App\Models\DocumentTracker\DocumentTrackingLogs;
use App\Models\DocumentTracker\DocumentTrackerAttachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
/***** EXCEL *****/
use App\Exports\RoutingLogsExport;
use App\Exports\TrackingCodeLogsExport;
use Maatwebsite\Excel\Facades\Excel;

class DocumentTrackerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $documents = [];
        // return view('optima.index');
        return redirect()->route('optima.dashboard');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $documents = [];
        return view('optima.dashboard');
    }

    /**
     * Display the about page of the OPTIMA system.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        return view('optima.about');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function logs()
    {
        $documents = [];
        $trackingLogs = DocumentTrackingLogs::where('user_id', Auth::user()->id )->latest()->get();
        return view('optima.logs', compact('documents', 'trackingLogs'));
    }

    /**
     * Display a listing of the resources search by a user.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchJS(Request $request)
    {
        $logDetail = array();
        $log_id    = $request->code;
        $tracker  = DocumentTracker::where('code', 'LIKE', '%'.$log_id)
                                        ->orWhere('tracking_code', 'LIKE', '%'. $log_id)
                                        ->withTrashed()
                                        ->first();

        $documents = DocumentTrackingLogs::where('code', 'LIKE', '%'.$log_id)
                                            ->orWhere('tracking_code', 'LIKE', '%'. $log_id)
                                            ->latest()
                                            ->get();

        if($request->ajax())
        {
            $view = view('optima.logs', compact('tracker', 'documents'))->render();
            return response()->json([
                'html'     => $view,
                'title'    => $tracker->tracking_code,
                'subject'  => $tracker->subject,
                'docutype' => $tracker->other_document,
            ]);
        }
    }

    /**
     * Display a listing of the documents created by a specific user.
     *
     * @return \Illuminate\Http\Response
     */
    public function myDocuments()
    {
        $documentsCreated    = DocumentTracker::where('user_id', Auth::user()->id)->get();
        $documentsReceived   = DocumentTrackingLogs::where('user_id', Auth::user()->id)
                                                    ->where('action', "Receive")
                                                    ->latest()->get();
        $documentsReleased   = DocumentTrackingLogs::where('user_id', Auth::user()->id)
                                                    ->where('action', "Forward")
                                                    ->latest()->get();
        $myDocuments = DocumentTracker::with([
                                'trackLogs' => function($query) {
                                    $query->latest(); },
                                'documentKeywords'
                                ])->get();
        
        return view('optima.my-documents', compact('documentsCreated', 'documentsReceived', 'documentsReleased', 'myDocuments'));
        // return dd($myDocuments);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showMyDocument($code = null)
    {
        $myDocument = DocumentTracker::with([
                            'trackLogs' => function ($query) {
                                $query->latest();
                            }
                        ])->where('tracking_code', $code)->first();
        
        // return $myDocument->trackLogs[0]['action'];
        return view('optima.show-document', compact('myDocument'));
        // return $myDocument;
    }

    /**
     * Display the list of all routed documents.
     *
     * @return \Illuminate\Http\Response
     */
    public function routingDocuments()
    {
        $documentsCreated    = DocumentTracker::where('user_id', Auth::user()->id)->get();
        
        $documentsReceived   = DocumentTrackingLogs::where('user_id', Auth::user()->id)
                                                    ->where('action', "Receive")
                                                    ->latest()->get();

        $documentsReleased   = DocumentTrackingLogs::where('user_id', Auth::user()->id)
                                                    ->where('action', "Forward")
                                                    ->latest()->get();
        $documentsLog = DocumentTrackingLogs::with('documentCode.documentKeywords')->where('user_id', Auth::user()->id)->latest()->get();

        return view('optima.route-documents', compact('documentsCreated', 'documentsReceived', 'documentsReleased', 'documentsLog'));
        // return dd($documentsLog);
    }

    public function exportRoutedDocuments() 
    {
        $id = Auth::user()->id;
        return new RoutingLogsExport($id);
        // return new UsersExport;
    }

    public function exportRoutedCodeDocuments($code) 
    {
        return new TrackingCodeLogsExport($code);
        // return new UsersExport;
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchIncomingDocument(Request $request)
    {   
        $code     = $request->code;
        $tracker  = DocumentTracker::where('code', $code)
                                        ->orWhere('tracking_code', $code)
                                        ->first();

        if($request->ajax())
        {
            $view = view('optima.incoming-modal', compact('tracker'))->render();
            return response()->json([
                'success'   => !is_null($tracker), 
                'html'      => $view,
                'tracker'   => $tracker->tracking_code,
                'docutype'  => $tracker->other_document
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeIncomingDocument(Request $request)
    {   
        $result   = false;
        $code     = $request->code;
        $data     = array();

        $tracker = DocumentTracker::where('code', $code)
                                        ->orWhere('tracking_code', $code)
                                        ->first();

        $old_log  = DocumentTrackingLogs::where('code', $code)
                                        ->orWhere('tracking_code', $code)
                                        ->latest()
                                        ->first();
        if ( $tracker )
        {
            if ( $old_log->action != "Receive" )
            {
                $log                = new DocumentTrackingLogs;
                $log->code          = $tracker->code;
                $log->tracking_code = $tracker->tracking_code;
                $log->user_id       = Auth::user()->id;
                $log->action        = "Receive";
                $log->save();

                // LogActivity::addToLog('received an incoming document.'); // log

                $data = [
                    'result'            => true,
                    'tracking_id'          => $log->id,
                    'tracking_code'     => $tracker->tracking_code,
                    'subject'           => $tracker->subject,
                    'document_type'     => $tracker->other_document,
                    'created_by'        => $tracker->userEmployee->full_name,
                    'date_created'      => $tracker->tracking_date,
                    'note'              => $log->notes ?: '',
                    'keywords'          => $tracker->keywords,
                    'action'            => $log->action,
                    'date_action'       => $log->date_action
                ];
                
            } else {
                $data = [
                    'result'            => false,
                    'tracking_code'     => $tracker->tracking_code,
                    'status'            => "alreadyReceived",
                    'msg'               => " has already been received. Release the document first before receiving to proceed."
                ];
            }

            if($request->ajax())
            {
                return response()->json($data);
            }
        }
    }

    public function showRoutedDocument($code = null)
    {
        $offices  = Office::all();
        $users    = User::employee()->notSelf()->get();
        $userSelf = User::employee()->get();
        
        $myDocument = DocumentTracker::with([
                            'trackLogs' => function ($query) {
                                $query->latest();
                            }
                        ])->where('tracking_code', $code)->first();
        
        // return view('optima.incoming-show', compact('myDocument', 'trackLogs', 'offices', 'users', 'userSelf'));

        // return $myDocument->trackLogs;
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchOutgoingDocument(Request $request)
    {
        $code    = $request->code;
        $tracker = DocumentTracker::where('code', $code)
                                        ->orWhere('tracking_code', $code)
                                        ->first();
        
        $view = view('optima.outgoing-modal', compact('tracker'))->render();
        return response()->json([
            'success'   => !is_null($tracker), 
            'html'      => $view,
            'tracker'   => $tracker->tracking_code,
            'docutype'  => $tracker->other_document,
        ]);
    }

    public function storeOutgoingDocument(Request $request)
    {
        $tracker    = DocumentTracker::with(['trackLogs' => function($query) { $query->latest()->first(); }])
                                        ->where('code', $request->code)
                                        ->orWhere('tracking_code', $request->code)
                                        ->first();
        $id         = $request->has('recipients') ? $request->recipients : false;
        $indexes    = null;
        $recipients = null;

        if ( $id )
        {
            foreach ($id as $recipient) {
                $indexes[] = explode(',', $recipient);
            }
            foreach ($indexes as $index) {
                if ( $index[1] == 'group' )
                {
                    $type = OfficeGroups::where('id', '=', $index[0])->first();
                    $name = $type->acronym;
                } elseif ( $index[1] == 'individual' ) {
                    $type = User::where('id', '=', $index[0])->first();
                    $name = $type->full_name;
                }
                $recipients[] = [ 'id' => $type->id , 'type' => $index[1], 'name' => $name ];
            }
        }

        // ----------------- CREATE NEW LOG -------------------- //
        if ( $tracker )
        {
            $log                 = new DocumentTrackingLogs;
            $log->code           = $tracker->code;
            $log->tracking_code  = $tracker->tracking_code;
            $log->user_id        = Auth::user()->id;
            $log->action         = "Forward";
            $log->forSignature   = $request->has('forSignature') ?: false;
            $log->forCompliance  = $request->has('forCompliance') ?: false;
            $log->forInformation = $request->has('forInformation') ?: false;
            // $log->route_mode     = "Forward";
            $log->recipients     = $recipients;
            $log->notes          = $request->notes;
            $log->save();

            // LogActivity::addToLog('forwarded an outgoing document.'); // log
            // ----------------- END CREATE NEW LOG --------------- //

            $data = [
                'result'            => true,
                'tracking_id'       => $log->id,
                'tracking_code'     => $tracker->tracking_code,
                'subject'           => $tracker->subject,
                'document_type'     => $tracker->other_document,
                'created_by'        => $log->userEmployee->full_name,
                'date_created'      => $tracker->tracking_date,
                'note'              => $log->notes ?: '',
                'keywords'          => $tracker->documentKeywords,
                'action'            => $log->action,
                'recipients'        => $log->recipients,
                'date_action'       => $log->dateAction,
            ];
        } else {
            $data = [
                'result'            => false,
                'tracking_code'     => $request->code,
                'status'            => "No Data",
                'msg'               => "Tracking code undefined."
            ];
        }

        if($request->ajax())
        {
            return response()->json($data);
        }

        // return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $offices  = Office::all();
        $users    = User::employee()->notSelf()->get();
        $userSelf = User::employee()->get();
        $docTypes = DocumentTypes::orderBy('document_name', 'ASC')->get();

        return view('optima.create-documents', compact('docTypes', 'offices', 'users', 'userSelf'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = false;

        // Active User Routing Model
        $userFrom = Auth::user();

        // ------------ CREATE TRACKING CODE -------------------- //
        $office          = $userFrom->office->div_acronym;
        $seriesCode      = CodeTable::first()->doc_code;
        $year            = Carbon::now()->format('y');
        $code            = $year.'-'.$seriesCode;
        $tracking_code   = $office.'-'.$code;
        // ------------ END CREATE TRACKING CODE --------------- //

        // ------------ SAVE ROUTE INFORMATION --------------- //
        $document                 = new DocumentTracker;
        $document->code           = $code;
        $document->tracking_code  = $tracking_code;
        $document->user_id        = $userFrom->id;
        $document->doc_type_id    = $request->docType;
        $document->other_document = $request->otherDocument;
        $document->document_date  = $request->documentDate;
        $document->subject        = $request->subject;

        if ( $document->save() ) {

            // LogActivity::addToLog('created a document with tracking code.'); // log
            $result = true;

            // --------------- SAVE ALL KEYWORDS ------------------- //
            $keywords = explode(',', $request->keywords);
            foreach ($keywords as $keyword) {
                $keywordTable = DocumentKeyword::firstOrCreate([ 'document_id' => $document->id, 'keywords' => $keyword ]);
            }
            // --------------- END SAVE ALL KEYWORDS ------------------- //

            // --------------- UPDATE CODE TABLE ------------------- //
            $updateCode = CodeTable::where('doc_code', $seriesCode)->update([ 'doc_code' => sprintf("%05s", $seriesCode + 1) ]);
            // --------------- END UPDATE CODE TABLE --------------- //

            // --------------- FETCH ALL ACTIVE RECIPIENTS --------- //
            $id         = $request->recipients;
            $indexes    = [];
            $recipients = [];
            foreach ($id as $recipient) {
                $indexes[] = explode(',', $recipient);
            }
            foreach ($indexes as $index) {
                if ( $index[1] == 'group' )
                {
                    $type = OfficeGroups::where('id', '=', $index[0])->first();
                    $name = $type->acronym;
                } elseif ( $index[1] == 'individual' ) {
                    $type = User::where('id', '=', $index[0])->first();
                    $name = $type->full_name;
                }
                $recipients[] = [ 'id' => $type->id , 'type' => $index[1], 'name' => $name ];
            }
            // --------------- END FETCH ALL ACTIVE RECIPIENTS --------- //

            // ----------------- CREATE NEW LOG -------------------- //

            $log                 = new DocumentTrackingLogs;
            $log->code           = $document->code;
            $log->tracking_code  = $document->tracking_code;
            $log->user_id        = $userFrom->id;
            $log->action         = "Forward";
            $log->forSignature   = $request->has('forSignature') ?: false;
            $log->forCompliance  = $request->has('forCompliance') ?: false;
            $log->forInformation = $request->has('forInformation') ?: false;
            $log->recipients     = $recipients;
            $log->notes          = $request->note;
            $log->save();
            // ----------------- END CREATE NEW LOG --------------- //

        }

        if ( $request->ajax() ) {
            return response()->json([
                'result' => $result, 
                'url' => route('optima.route-documents', $document->tracking_code), 
                'tracker' => $document->tracking_code 
            ]);

        } else {
            return redirect()->route('optima.route-documents', $document->tracking_code);
        }


        // if ($document->save() )
        // {
        //     // SAVE ATTACHMENTS
        //     /*if ( $request->has('attachments'))
        //     {
        //         foreach ($request->attachments as $i => $file) {
        //             $doc_id      = $document->id;
        //             $foldercode  = $document->tracking_code;
        //             $code        = $document->code;
        //             $destination = 'upload/documenttracker/'.$foldercode.'/'; 
        //             $filename    = $doc_id .'-TR-'. $code .' '. $file->getClientOriginalName();
        //             $filesize    = $file->getClientSize();

        //             $docu                = new DocumentTrackerAttachment;
        //             $docu->doctracker_id = $doc_id;
        //             $docu->filename      = $file->getClientOriginalName();
        //             $docu->filepath      = $destination.$filename;
        //             $docu->filesize      = $filesize;

        //             $file->move($destination, $filename);
        //             $docu->save();
        //         }
        //     }*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $log = DocumentTracker::destroy($id);
            $msg = '';
        } catch (Exception $e) {
            $msg = 'Caught exception: '. $e->getMessage() ."\n";
        }

        return response()->json([ 'id'=>$id, 'result'=>$log, 'msg' => $msg ]); 
    }

    /*** JS ***/
    public function searchKeywords(Request $request)
    {   
        $term = $request->term;
        $terms = DocumentKeyword::groupBy('keywords')->where('keywords', 'LIKE', '%'.$term.'%')->get()->pluck('keywords');

        return response()->json($terms);
    }

    public function recipientsList(Request $request)
    {   
        $employees = User::employee()->notSelf()->get();
        $groups    = OfficeGroups::all();
        $data      = view('list.recipient-list', compact('employees', 'groups'))->render();

        if ( $request->ajax() )
        {
            return response()->json(['options' => $data]);
        } 
    }
}
