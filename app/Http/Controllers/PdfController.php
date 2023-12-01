<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PdfController extends Controller
{
    //
    public function productPdf(Request $request)
    {
        // dd($request->id, $request->unit);
        $unit_price = $request->unit;
        $box_price = $request->box;
        $wholesome_price = $request->wholesome;
        $record = Product::find($request->id);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.pdf_product', compact('record', 'unit_price', 'box_price', 'wholesome_price')); // Pass the variable $record to the blade file
        return $pdf->stream(); // renders the PDF in the browser
    }
}
