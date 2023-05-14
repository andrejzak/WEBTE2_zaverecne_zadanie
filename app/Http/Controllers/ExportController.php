<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class ExportController extends Controller
{
    public function exportCsv(Request $request)
    {
    
        $textContent = __('messages.guide-text');

        // Vytvorenie CSV súboru
        $csvFileName = "exported_text.csv";
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('Text Content');

        $callback = function () use ($columns, $textContent) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            // Pridanie obsahu <p> elementu do CSV súboru
            fputcsv($file, array($textContent));

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request){
        $textContent = __('messages.guide-text');

        $pdf = PDF::loadView('pdf_export', compact('textContent'));

        // Nastavenie možností
        $dompdf = $pdf->getDomPDF();
        $dompdf->set_option('defaultFont', 'DejaVu Sans');
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->set_option('isRemoteEnabled', true);

        return $pdf->download('exported_text.pdf');
    }


}