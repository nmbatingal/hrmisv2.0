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

        return view('doctracker.index', compact('documents'));
    }

    public function search(Request $request)
    {
        $documents = DocumentTrackingLogs::where('code', 'LIKE', '%'.$request->code)
                                            ->orWhere('tracking_code', 'LIKE', '%'. $request->get('code'))
                                            ->orderBy('created_at', 'DESC')->get();
        
        return view('doctracker.index', compact('documents'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myDocuments()
    {
        $myDocuments = DocumentTracker::myDocuments()->orderBy('created_at', 'DESC')->get();
        return view('doctracker.myDocuments', compact('myDocuments'));
    }

    /**
     * Display a listing of the resource.
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function receivedDocuments()
    {
        $receivedDocuments = DocumentTrackingLogs::where('recipient_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        
        return view('doctracker.receivedDocuments', compact('receivedDocuments'));
        // return dd($receivedDocuments);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showReceivedDocument($tracking_code)
    {
        $myDocument = DocumentTracker::where('tracking_code', $tracking_code)->first();
        $trackLogs  = DocumentTrackingLogs::where('tracking_code', $tracking_code)->orderBy('created_at', 'DESC')->get();
        
        return view('doctracker.showReceivedDocument', compact('myDocument', 'trackLogs'));
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
        $office          = Office::find($request->routeDiv)->first()->div_acronym;
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
        // $tracker->attachments      = $request->attachments;

        if ($document->save() )
        {
            /**** UPDATE CODE TABLE ********/
            $updateCode = CodeTable::where('doc_code', $seriesCode)->first();
            $updateCode->doc_code = sprintf("%05s", $seriesCode + 1);
            $updateCode->save();
            /**** END UPDATE CODE TABLE ********/

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


        return dd($request);
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
    public function showEmployeeList(Request $request)
    {   
        $office    = $request->office_id;
        $employees = User::employee()->employeeOffice($office)->notSelf()->get();
        $data      = view('list.recipient-list', compact('employees'))->render();

        if($request->ajax())
        {
            return response()->json(['options' => $data]);
        } 
    }
}
