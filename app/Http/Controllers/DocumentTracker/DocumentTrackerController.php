<?php

namespace App\Http\Controllers\DocumentTracker;

use Auth;
use App\User;
use App\Office;
use App\CodeTable;
use Carbon\Carbon;
use App\Helpers\LogActivity;
use App\Models\DocumentTracker\DocumentTypes;
use App\Models\DocumentTracker\DocumentTracker;
use App\Models\DocumentTracker\DocumentTrackingLogs;
use App\Models\DocumentTracker\DocumentTrackerAttachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentTrackerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = [];
        return view('doctracker.dashboard');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        return view('doctracker.about');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function logs()
    {
        $documents = [];
        return view('doctracker.logs', compact('documents'));
    }

    /**
     * Display a listing of the resources search by a user.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $logDetail = array();
        $log_id    = $request->code;
        $code      = $request->code;
        $documents = DocumentTrackingLogs::where('code', 'LIKE', '%'.$log_id)
                                            ->orWhere('tracking_code', 'LIKE', '%'. $log_id)
                                            ->latest()->get();
        $recipients = "";

        foreach ($documents as $i => $value) {

            if ( $value->action == "Forward" ) {

                $li = "";

                if ( !is_null( $value->recipients ) )
                {
                    foreach ( $value->recipients as $recipient ) {
                        $li .= "<li>". $recipient['name'] ."</li>";
                    }
                } else {
                    $li = "<li>All</li>";
                }

                $recipients = '<ul class="p-l-20 m-b-0">'. $li .'</ul>';

            } else {
                $recipients = "<strong>". $value->userEmployee->full_name ."</strong><br>";
            }


            $code             = $value->tracking_code;

            $tracker          = [
                'tracking_code'   => $value->tracking_code,
                'date_created'    => $value->documentCode->tracking_date,
                'created_by'      => $value->userEmployee->full_name,
                'document_type'   => $value->documentCode->other_document,
                'subject'         => $value->documentCode->subject,
                'details'         => $value->documentCode->details,
                'keywords'        => $value->documentCode->keywords,
            ];

            $logDetail[$i]    = [
                'tracking_code'   => $value->tracking_code,
                'created_by'      => $value->userEmployee->full_name,
                'action'          => $value->action,
                'document_type'   => $value->documentCode->other_document,
                'recipients'      => $recipients,
                'date_created'    => $value->documentCode->tracking_date,
                'notes'           => $value->notes ?: '',
                'remarks'         => $value->remarks ?: '',
                'date_time'       => $value->date_action,
                'deleted'         => $value->deleted_at ? true : false,
            ];
        }
     
        if($request->ajax())
        {
            $view = view('doctracker.logs', compact('documents'));
            return response()->json(['tracker' => $tracker, 'results' => $logDetail, 'result' => count($documents), 'code' => $code, 'view' => $view]);

        } else {
            return view('doctracker.logs', compact('documents'));
        }
    }

    /**
     * Display a listing of the documents created by a specific user.
     *
     * @return \Illuminate\Http\Response
     */
    public function myDocuments()
    {
        $myDocuments = DocumentTracker::myDocuments()->get();
        
        return view('doctracker.my-documents', compact('myDocuments'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDocument($code = null)
    {
        $myDocument = DocumentTracker::with([
                            'trackLogs' => function ($query) {
                                $query->latest();
                            }
                        ])->where('tracking_code', $code)->first();
        
        // return $myDocument->trackLogs[0]['action'];
        return view('doctracker.show-document', compact('myDocument'));
        // return $myDocument;
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function incomingDocuments()
    {
        $incomingLogs = DocumentTrackingLogs::where('user_id', Auth::user()->id)->where('action', 'Receive')->latest()->get();
        return view('doctracker.incoming', compact('incomingLogs'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function receiveIncomingDocument(Request $request)
    {   
        $code     = $request->code;
        $tracker  = DocumentTracker::where('code', $code)
                                        ->orWhere('tracking_code', $code)
                                        ->first();

        if($request->ajax())
        {
            $view = view('doctracker.incoming-modal', compact('tracker'))->render();
            return response()->json(['success'=> !is_null($tracker), 'html' => $view]);
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

        $document = DocumentTracker::where('code', $code)
                                        ->orWhere('tracking_code', $code)
                                        ->first();

        $old_log  = DocumentTrackingLogs::where('code', $code)
                                        ->orWhere('tracking_code', $code)
                                        ->latest()
                                        ->first();
        if ( $document )
        {
            $logger                = new DocumentTrackingLogs;
            $logger->code          = $document->code;
            $logger->tracking_code = $document->tracking_code;
            $logger->user_id       = Auth::user()->id;
            $logger->action        = "Receive";
            $logger->notes         = $old_log->notes;
            $logger->remarks       = $request->remarks;
            
            if ( $logger->save() )
            {
                LogActivity::addToLog('received an incoming document.'); // log

                $data = [
                    'result'            => true,
                    'tracking_code'     => $document->tracking_code,
                    'subject'           => $document->subject,
                    'document_type'     => $document->other_document,
                    'created_by'        => $document->userEmployee->full_name,
                    'date_created'      => $document->tracking_date,
                    'note'              => $logger->notes ?: '',
                    'remarks'           => $logger->remarks ?: '',
                    'action'            => $logger->action,
                    'date_action'       => $logger->date_action,
                ];
            }
        }

        if($request->ajax())
        {
            return response()->json($data);
        }
    }

    public function showIncoming($code = null)
    {
        $offices  = Office::all();
        $users    = User::employee()->notSelf()->get();
        $userSelf = User::employee()->get();
        //$myDocument = DocumentTracker::where('tracking_code', $code)->first();
        
        $myDocument = DocumentTracker::with([
                            'trackLogs' => function ($query) {
                                $query->latest();
                            }
                        ])->where('tracking_code', $code)->first();
        
        // return view('doctracker.incoming-show', compact('myDocument', 'trackLogs', 'offices', 'users', 'userSelf'));

        // return $myDocument->trackLogs;
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function outgoingDocuments()
    {
        $incomingDocuments = [];
        $outgoingLogs = DocumentTrackingLogs::where('user_id', Auth::user()->id)->where('action', 'Forward')->latest()->get();
        
        return view('doctracker.outgoing', compact('incomingDocuments', 'outgoingLogs'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchOutgoing(Request $request)
    {
        $code    = $request->code;
        $tracker = DocumentTracker::where('code', $code)
                                        ->orWhere('tracking_code', $code)
                                        ->first();
        
        $view = view('doctracker.outgoing-modal', compact('tracker'))->render();
        return response()->json(['success'=> !is_null($tracker), 'html' => $view]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOutgoing(Request $request)
    {
        $tracker = DocumentTracker::find($request->tracker_id);
        $mode = $request->routeMode;
        $recipients = null;

        if ( $mode == "all" ) {

            $employees = User::employee()->notSelf()->get();

        } elseif ( $mode == "group" ) {

            $office_id  = $request->recipients;
            $employees  = User::employee()->notSelf()->whereIn('office_id', $office_id)->get();
            $offices    = Office::whereIn('id', $office_id)->get();
            
            foreach ($offices as $office) {
                $recipients[] = [ 'id' => $office->id , 'name' => $office->division_name ];
            }

        } elseif ( $mode == "individual" ) {

            $id            = $request->recipients;
            $employees     = User::employee()->notSelf()->whereIn('id', $id)->get();

            foreach ($employees as $employee) {
                $recipients[] = [ 'id' => $employee->id , 'name' => $employee->full_name ];
            }

        }

        // ----------------- CREATE NEW LOG -------------------- //
        $log                 = new DocumentTrackingLogs;
        $log->code           = $tracker->code;
        $log->tracking_code  = $tracker->tracking_code;
        $log->user_id        = Auth::user()->id;
        $log->action         = $request->action;
        $log->route_mode     = $mode;
        $log->recipients     = $recipients;
        $log->notes          = $request->note;
        $log->save();

        LogActivity::addToLog('forwarded an outgoing document.'); // log
        // ----------------- END CREATE NEW LOG --------------- //

        $data = [
            'id'                => $log->id,
            'tracking_code'     => $tracker->tracking_code,
            'subject'           => $tracker->subject,
            'document_type'     => $tracker->other_document,
            'created_by'        => $log->userEmployee->full_name,
            'date_created'      => $tracker->tracking_date,
            'note'              => $log->notes ?: '',
            'action'            => $log->action,
            'date_action'       => $log->dateAction,
        ];

        if($request->ajax())
        {
            return response()->json($data);
        }
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
        $docTypes = DocumentTypes::all();
        return view('doctracker.create', compact('docTypes', 'offices', 'users', 'userSelf'));
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

        // ------------ CREATE TRACKING CODE -------------------- //
        $office          = Office::find($request->routeDiv)->div_acronym;
        $seriesCode      = CodeTable::first()->doc_code;
        $year            = Carbon::now()->format('y');
        $code            = $year.'-'.$seriesCode;
        $fullDate        = Carbon::now()->toDateString();
        $tracking_code   = $office.'-'.$code;
        // ------------ END CREATE TRACKING CODE --------------- //

        $document                = new DocumentTracker;
        $document->code          = $code;
        $document->tracking_code = $tracking_code;
        $document->user_id       = $request->routedBy;
        $document->route_mode    = $request->routeMode;
        $document->doc_type_id   = $request->docType;
        $document->other_document = $request->otherDocument;
        $document->document_date = $request->documentDate;
        $document->subject       = $request->subject;
        $document->details       = $request->details;
        $document->keywords      = $request->keywords;

        if ( $document->save() ) {

            LogActivity::addToLog('created a document with tracking code.'); // log

            $result = true;
            // --------------- UPDATE CODE TABLE ------------------- //
            $updateCode           = CodeTable::where('doc_code', $seriesCode)->first();
            $updateCode->doc_code = sprintf("%05s", $seriesCode + 1);
            $updateCode->save();
            // --------------- END UPDATE CODE TABLE --------------- //

            // --------------- FETCH ALL ACTIVE RECIPIENTS --------- //
            $mode = $request->routeMode;
            $recipients = null;

            if ( $mode == "all" ) {

                $employees = User::employee()->notSelf()->get();

            } elseif ( $mode == "group" ) {

                $office_id  = $request->recipients;
                $employees  = User::employee()->notSelf()->whereIn('office_id', $office_id)->get();
                $offices    = Office::whereIn('id', $office_id)->get();
                
                foreach ($offices as $office) {
                    $recipients[] = [ 'id' => $office->id , 'name' => $office->division_name ];
                }

            } elseif ( $mode == "individual" ) {

                $id            = $request->recipients;
                $employees     = User::employee()->notSelf()->whereIn('id', $id)->get();

                foreach ($employees as $employee) {
                    $recipients[] = [ 'id' => $employee->id , 'name' => $employee->full_name ];
                }

            }

            // ----------------- CREATE NEW LOG -------------------- //
            $log                 = new DocumentTrackingLogs;
            $log->code           = $document->code;
            $log->tracking_code  = $document->tracking_code;
            $log->user_id        = $document->user_id;
            $log->action         = $request->action;
            $log->route_mode     = $mode;
            $log->recipients     = $recipients;
            $log->notes          = $request->note;
            $log->save();
            // ----------------- END CREATE NEW LOG --------------- //

        }

        if ( $request->ajax() ) {
            return response()->json(['result' => $result, 'url' => route('doctracker.showDocument', $document->tracking_code), 'tracker' => $document->tracking_code ]);
        } else {
            return redirect()->route('doctracker.showDocument', $document->tracking_code);
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
        //
    }

    /*** JS ***/
    public function recipientList(Request $request)
    {   
        $id = $request->office_id;
        $data = null;

        if ( $id == 'individual')
        {
            $employees = User::employee()->notSelf()->get();
            $data      = view('list.recipient-list', compact('employees'))->render();

        } else if ( $id == 'group' ) {

            $offices   = Office::all();
            $data      = view('list.office-list', compact('offices'))->render();

        }

        if ( $request->ajax() )
        {
            return response()->json(['options' => $data]);
        } 
    }
}
