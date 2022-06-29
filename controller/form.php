<?php
use setasign\Fpdi\Fpdi;
require_once('../lib/fpdf/fpdf.php');
require_once('../lib/fpdi/src/autoload.php');


// initiate FPDI
$pdf = new Fpdi();

// get the page count
$pageCount = $pdf->setSourceFile('../doc/boranghostel.pdf');
// iterate through all pages
for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
    // import a page
    $templateId = $pdf->importPage($pageNo);

    $pdf->AddPage();
    // use the imported page and adjust the page size
    $pdf->useTemplate($templateId, ['adjustPageSize' => true]);

    $pdf->SetFont('Arial','',11);

    $pdf->SetXY(70, 71.3);
    $pdf->Write(8, 'A123');
    $pdf->SetXY(145, 71.3);
    $pdf->Write(8, '3131');

    $pdf->SetXY(70, 79);
    $pdf->Write(8, '29218160');

    $pdf->SetXY(70, 87);
    $pdf->Write(8, 'Izmeer Bin Strong');

    $pdf->SetXY(70, 94.5);
    $pdf->Write(8, '000820080131');

    $pdf->SetXY(70, 102.5);
    $pdf->Write(8, 'EG04');
    
    $pdf->SetXY(145, 102.5);
    $pdf->Write(8, '2/2019');
}

// Output the new PDF
$pdf->Output();