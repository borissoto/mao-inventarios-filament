<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PdfController extends Controller
{
    //
    public function productPdf($id)
    {
        $record = Product::find($id);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.pdf_product', compact('record')); // Pass the variable $record to the blade file
        return $pdf->stream(); // renders the PDF in the browser
    }
}
