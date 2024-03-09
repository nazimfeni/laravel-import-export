<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    public function document()
    {
        // Setup a filename 
        $documentFileName = "invoice.pdf";
 
        // Create the mPDF document
        $document = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_header' => '3',
            'margin_top' => '20',
            'margin_bottom' => '20',
            'margin_footer' => '2',
        ]);     
 
        // Write some simple Content
        $document->WriteHTML('<h1 style="color:blue">PDF Document</h1>');
        $document->WriteHTML(view('docs'));
         
        // Save PDF on your public storage 
        $document->Output(storage_path('app/public/' . $documentFileName), "F");
        
        // Generate URL for the saved PDF
        $url = Storage::url($documentFileName);

        return "File Downloaded successfully /storage/app/public/";
    }
}
