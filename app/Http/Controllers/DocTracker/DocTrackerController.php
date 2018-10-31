<?php

namespace App\Http\Controllers\DocTracker;

use CodeItNow\BarcodeBundle\Utils\QrCode;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocTrackerController extends Controller
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
    public function dashboard()
    {
        return view('doctracker.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
