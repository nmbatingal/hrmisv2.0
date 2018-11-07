<?php

namespace App\Http\Controllers\DocumentTracker;

use Carbon\Carbon;
use App\User;
use App\Office;
use App\Models\DocumentTracker\CodeTable;
use App\Models\DocumentTracker\DocumentTypes;
use App\Models\DocumentTracker\DocumentTracker;
use App\Models\DocumentTracker\DocumentTrackingLogs;
use CodeItNow\BarcodeBundle\Utils\QrCode;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
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
        $barcode = new BarcodeGenerator();
        $barcode->setText('201800001');
        $barcode->setType(BarcodeGenerator::Code39);
        $barcode->setLabel('TSS-2018-10-31-00001');
        //$barcode->setScale(2);
        $barcode->setThickness(30);
        $barcode->setFontSize(8);
        $code = $barcode->generate();

        $img = '<img src="data:image/png;base64,'.$code.'" height="45px" />';


        $qrCode = new QrCode();
        $qrCode
            ->setText('TSS-2018-10-31-00001')
            ->setSize(50)
            ->setPadding(8)
            ->setErrorCorrection('high')
            //->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            //->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
            // ->setLabel('TSS-2018-10-31-00001')
            ->setLabelFontSize(5)
            ->setImageType(QrCode::IMAGE_TYPE_PNG);
        $qrimg = '<img src="data:'.$qrCode->getContentType().';base64,'.$qrCode->generate().'" />';

        return view('doctracker.index', compact('img', 'qrimg'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myDocuments()
    {
        $myDocuments = DocumentTracker::myDocuments()->orderBy('created_at', 'DESC')->get();
        return view('doctracker.mydocuments', compact('myDocuments'));
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
        
        return view('doctracker.showDocument', compact('trackLogs'));
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
                $tracker->remarks        = $request->note;
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
