<?php
include __DIR__ . '/Worker.php';

// create new PDF document
$pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Dennis Eichhorn');
$pdf->SetTitle('AreaManaager Report');
$pdf->SetSubject('Area: ' . $area);
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage();

$pdf->Write(0, str_replace('{$}', $area, $lang['PdfTitle']), '', false, 'C', true, 0, false, false, 0);
$pdf->SetFont('helvetica', '', 8);

// -----------------------------------------------------------------------------

$tbl = '
<table id="areamanager-report-rating">
        <thead>
        <tr>
            <th colspan="4">' . $lang['ClientRating'] . '
                <tbody>
        <tr>
            <th>' . $lang['Rating'] . '
            <th>' . $now2->format('Y') . '
            <th>' . $now1->format('Y') . '
            <th>' . $now->format('Y') . '
        <tr>
            <th>A: (&#8364; > ' . number_format(5000, 0, '.', ',') . ')
            <td>' . number_format($rating['vvj']['A'], 0, '.', ',') . '
            <td>' . number_format($rating['vj']['A'], 0, '.', ',') . '
            <td>' . number_format($rating['aj']['A'], 0, '.', ',') . '
        <tr>
            <th>B: (' . number_format(2500, 0, '.', ',') . ' < &#8364; &#8804; ' . number_format(5000, 0, '.', ',') . ')
            <td>' . number_format($rating['vvj']['B'], 0, '.', ',') . '
            <td>' . number_format($rating['vj']['B'], 0, '.', ',') . '
            <td>' . number_format($rating['aj']['B'], 0, '.', ',') . '
        <tr>
            <th>C: (' . number_format(250, 0, '.', ',') . ' < &#8364; &#8804; ' . number_format(2500, 0, '.', ',') . ')
            <td>' . number_format($rating['vvj']['C'], 0, '.', ',') . '
            <td>' . number_format($rating['vj']['C'], 0, '.', ',') . '
            <td>' . number_format($rating['aj']['C'], 0, '.', ',') . '
        <tr>
            <th>D: (' . number_format(1, 0, '.', ',') . ' < &#8364; &#8804; ' . number_format(250, 0, '.', ',') . ')
            <td>' . number_format($rating['vvj']['D'], 0, '.', ',') . '
            <td>' . number_format($rating['vj']['D'], 0, '.', ',') . '
            <td>' . number_format($rating['aj']['D'], 0, '.', ',') . '
        <tr>
            <th>E: (&#8364; &#8804; ' . number_format(1, 0, '.', ',') . ')
            <td>' . number_format($rating['vvj']['E'], 0, '.', ',') . '
            <td>' . number_format($rating['vj']['E'], 0, '.', ',') . '
            <td>' . number_format($rating['aj']['E'], 0, '.', ',') . '
    </table>
';

//Close and output PDF document
$pdf->Output('AreaManagerReport.pdf', 'S');