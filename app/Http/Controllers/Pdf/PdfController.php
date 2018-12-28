<?php

namespace App\Http\Controllers\Pdf;

use PDF;
use App\Models\DocumentTracker\DocumentTracker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PdfController extends Controller
{
    public function printBarcode(Request $request, $code)
    {
        $tracker = DocumentTracker::where('tracking_code', $code)->first();
        $view    = view('pdf.barcode.barcode', compact('tracker'));
        $pdf     = PDF::loadHtml($view);

        // return $pdf->download($tracker->tracking_code.'.pdf');
        return $pdf->stream('barcode.pdf');
    }
}
