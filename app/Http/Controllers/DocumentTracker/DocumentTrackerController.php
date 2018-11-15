<?php

namespace App\Http\Controllers\DocumentTracker;

use Auth;
use App\User;
use App\Office;
use Carbon\Carbon;
use App\Models\DocumentTracker\CodeTable;
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

        foreach ($documents as $i => $value) {
            $code             = $value->tracking_code;
            $logDetail[$i]    = [
                                    'tracking_code' => $value->tracking_code,
                                    'action' => $value->action,
                                    'received_by' => $value->recipient ? $value->recipient->fullName : '',
                                    'received_office' => $value->recipient ? $value->recipient->office->division_name : '',
                                    'from' => $value->userEmployee->fullName,
                                    'from_office' => $value->userEmployee->office->division_name,
                                    'dateTime' => $value->dateAction,
                                ];
        }
     
        if($request->ajax())
        {
            $view = view('doctracker.logs', compact('documents'));
            return response()->json(['results' => $logDetail, 'result' => count($documents), 'code' => $code, 'view' => $view]);
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
        return view('doctracker.myDocuments', compact('myDocuments'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDocument($tracking_code)
    {
        $myDocument = DocumentTracker::where('tracking_code', $tracking_code)->first();
        $trackLogs  = DocumentTrackingLogs::where('tracking_code', $tracking_code)->orderBy('created_at', 'DESC')->get();
        
        return view('doctracker.showDocument', compact('myDocument', 'trackLogs'));
    }

    /**
     * Display a listing of the documents forwarded by a user to a recipient.
     *
     * @return \Illuminate\Http\Response
     */
    public function receivedDocuments()
    {
        $receivedDocuments = DocumentTrackingLogs::where(function ($query) {
                                                        $query->where('action', "Forward")
                                                              ->where('recipient_id', true);
                                                    })
                                                    ->orWhere('recipient_id', Auth::user()->id)
                                                    ->orderBy('created_at', 'DESC')->get();
        
        return view('doctracker.receivedDocuments', compact('receivedDocuments'));
        // return dd($incomingDocuments);

    }

    /**
     * Display a specific received document.
     *
     * @return \Illuminate\Http\Response
     */
    public function showReceivedDocument($tracking_code)
    {
        $offices  = Office::all();
        $users    = User::employee()->notSelf()->get();
        $userSelf = User::employee()->get();
        $myDocument = DocumentTracker::where('tracking_code', $tracking_code)->first();
        $trackLogs  = DocumentTrackingLogs::where('tracking_code', $tracking_code)->orderBy('created_at', 'DESC')->get();
        
        return view('doctracker.showReceivedDocument', compact('myDocument', 'trackLogs', 'offices', 'users', 'userSelf'));
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
        /****** Create tracking code *******/
        $office          = Office::find($request->routeDiv)->div_acronym;
        $seriesCode      = CodeTable::first()->doc_code;
        $year            = Carbon::now()->format('Y');
        $code            = $year.$seriesCode;
        $fullDate        = Carbon::now()->toDateString();
        $tracking_code   = $office .'-'. $fullDate .'-'. $seriesCode;
        /****** End Create tracking code *******/

        $document                = new DocumentTracker;
        $document->code          = $code;
        $document->tracking_code = $tracking_code;
        $document->user_id       = $request->routedBy;
        $document->office_id     = $request->routeDiv;
        $document->doc_type_id   = $request->docType;
        $document->subject       = $request->subject;
        $document->details       = $request->details;
        $document->keywords      = $request->keywords;
        $document->document_date = $request->document_date;

        if ($document->save() )
        {
            // SAVE ATTACHMENTS
            foreach ($request->attachments as $i => $file) {
                $doc_id      = $document->id;
                $foldercode  = $document->tracking_code;
                $code        = $document->code;
                $destination = 'upload/documenttracker/'.$foldercode.'/'; 
                $filename    = $doc_id .'-TR-'. $code .' '. $file->getClientOriginalName();
                $filesize    = $file->getClientSize();

                $docu                = new DocumentTrackerAttachment;
                $docu->doctracker_id = $doc_id;
                $docu->filename      = $file->getClientOriginalName();
                $docu->filepath      = $destination.$filename;
                $docu->filesize      = $filesize;

                $file->move($destination, $filename);
                $docu->save();
            }


            /**** UPDATE CODE TABLE ********/
            $updateCode = CodeTable::where('doc_code', $seriesCode)->first();
            $updateCode->doc_code = sprintf("%05s", $seriesCode + 1);
            $updateCode->save();
            /**** END UPDATE CODE TABLE ********/

            if ( $request->has('recipient') )
            {
                $recipients = $request->recipient;
            }
            else {
                $recipients = [0=>null];
            }

            foreach ($request->recipient as $i => $recipient) 
            {
                $tracker                 = new DocumentTrackingLogs;
                $tracker->code           = $document->code;
                $tracker->tracking_code  = $document->tracking_code;
                $tracker->action         = $request->action;
                $tracker->sender_id      = $request->routedBy;
                $tracker->office_id      = $request->routeToOffice;
                $tracker->recipient_id   = $recipient;
                $tracker->notes          = $request->note;
                $tracker->save();
            }
        }

        return redirect()->route('doctracker.showDocument', $tracker->tracking_code);
    }

    public function forwardDocument(Request $request)
    {
        if ( $request->has('recipient') )
        {
            $recipients = $request->recipient;
        }
        else {
            $recipients = [0=>null];
        }

        foreach ($recipients as $i => $recipient) 
        {
            $tracker                 = new DocumentTrackingLogs;
            $tracker->code           = $request->code;
            $tracker->tracking_code  = $request->tracking_code;
            $tracker->action         = $request->action;
            $tracker->sender_id      = $request->routedBy;
            $tracker->office_id      = $request->routeToOffice;
            $tracker->recipient_id   = $recipient;
            $tracker->notes          = $request->note;
            
            if ( $tracker->save() )
            {
                // SAVE ATTACHMENTS
                foreach ($request->attachments as $i => $file) {
                    $doc_id      = $tracker->id;
                    $foldercode  = $tracker->tracking_code;
                    $code        = $tracker->code;
                    $destination = 'upload/documenttracker/'.$foldercode.'/'; 
                    $filename    = $doc_id .'-LOG-'. $code .' '. $file->getClientOriginalName();
                    $filesize    = $file->getClientSize();

                    $docu = new DocumentTrackerAttachment;
                    $docu->tracklog_id   = $doc_id;
                    $docu->filename      = $file->getClientOriginalName();
                    $docu->filepath      = $destination.$filename;
                    $docu->filesize      = $filesize;

                    $file->move($destination, $filename);
                    $docu->save();
                }
            }
        }

        return redirect()->route('doctracker.showReceivedDocument', $tracker->tracking_code);
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
        $office    = $request->office_id;
        $employees = User::employee()->employeeOffice($office)->notSelf()->get();
        $data      = view('list.recipient-list', compact('employees'))->render();

        if($request->ajax())
        {
            return response()->json(['options' => $data]);
        } 
    }

    /*** JS ***/
    public function recieveForwardedDocument(Request $request)
    {   
        $data   = false;
        $log_id = $request->log_id;
        $logDetail = array();

        // UPDATE TRACKER LOG TO RECEIVE FORWARED DOCUMENT
        $logger = DocumentTrackingLogs::where( function($query) use ($log_id) {
                                            $query->where('action', 'Forward')
                                                  ->where('recipient_received', false)
                                                  ->where(function ($query) use ($log_id) {
                                                        $query->where('id', '=', $log_id)
                                                              ->orWhere('code', '=', $log_id)
                                                              ->orWhere('tracking_code', '=', $log_id);
                                                  });
                                        })->orderBy('created_at', 'DESC')->first();

        // Update document tracking log to update received field
        $logger->recipient_received = true;
        $tracking_code = $logger->tracking_code;
        if ( is_null( $logger->recipient_id ) )
        {
            $logger->recipient_id = Auth::user()->id;
        }

        if ( $logger->save() )
        {
            $newLog = new DocumentTrackingLogs;
            $newLog->code          = $logger->code;
            $newLog->tracking_code = $tracking_code;
            $newLog->action        = "Receive";
            $newLog->sender_id     = Auth::user()->id;
            $newLog->office_id     = Auth::user()->office_id;
            
            if ( $newLog->save() )
            {
                // $logDetail = ['result' => $newLog, 'url' => route('doctracker.showReceivedDocument', $tracking_code)];
                $logDetail = [
                    'tracking_code'     => $logger->tracking_code,
                    'received_by'       => $logger->recipient->fullName,
                    'received_office'   => $logger->recipient->office->division_name,
                    'from'              => $logger->userEmployee->fullName,
                    'from_office'       => $logger->userEmployee->office->division_name,
                    'subject'           => $logger->documentCode->subject,
                    'datetime'          => $newLog->dateAction,
                ];
            }
        }

        if($request->ajax())
        {
            return response()->json($logDetail);
            // return response()->json($logDetail);
        } 
    }
}
