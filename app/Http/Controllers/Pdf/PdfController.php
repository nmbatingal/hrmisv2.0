<?php

namespace App\Http\Controllers\Pdf;

use PDF;
use App\Models\DocumentTracker\DocumentTracker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PdfController extends Controller
{
    public function printBarcode(Request $request, $id)
    {
        $tracker = DocumentTracker::find($id);
        $view    = view('pdf.barcode.barcode', compact('tracker'));
        $pdf     = PDF::loadHTML($view);

        // return $pdf->download($tracker->tracking_code.'.pdf');
        return $pdf->stream();
    }
}
