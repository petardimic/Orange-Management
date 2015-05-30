<?php
include __DIR__ . '/Worker.php';

class AreaManagerPdf extends \phpOMS\Utils\Pdf\Pdf
{
    public function Header()
    {
        $headerdata = $this->getHeaderData();
        $headerfont = $this->getHeaderFont();

        $this->y = 5;
        $this->SetFont($headerfont[0], 'B', $headerfont[2] + 1);
        $this->SetX($this->original_lMargin);
        $this->Cell(0, 0, $headerdata['title'], 0, 1, '', 0, '', 0);
        $this->SetFont('helvetica', '', 8);
        $this->Cell(0, 0, $headerdata['string'], 0, 1, '', 0, '', 0);
        $this->Image($headerdata['logo'], 0, 5, 30, '', 'PNG', false, 'T', false, 300, 'R');
        $this->y = 15;
        $this->Line($this->lMargin, $this->y, $this->w - $this->rMargin, $this->y);
    }
}

$pdf = new AreaManagerPdf('P', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator('OMS');
$pdf->SetAuthor('Dennis Eichhorn');
$pdf->SetTitle('AreaManager Report');
$pdf->SetSubject('Area: ');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(__DIR__ . '/logo_sd.png', 0, 'Area Manager Report', 'by Schütz Dental GmbH');

// set header and footer fonts
$pdf->setHeaderFont(['helvetica', '', 10]);
$pdf->setFooterFont(['helvetica', '', 8]);

// set default monospaced font
$pdf->SetDefaultMonospacedFont('courier');

// set margins
$pdf->SetMargins(15, 10, 15);
$pdf->SetHeaderMargin(20);
$pdf->SetFooterMargin(10);

// set auto page breaks
$pdf->SetAutoPageBreak(true, 25);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage();
$pdf->setY(20);
$pdf->SetFont('helvetica', '', 8);

// -----------------------------------------------------------------------------

//$css = '<script>' . file_get_contents(__DIR__ . '/../../Web/Theme/backend/css/backend.css') . '</script>';

//$pdf->writeHTML($css, true, false, false, false, '');

$tbl = '
    <table>
        <thead>
        <tr>
            <th colspan="4">' . $lang['ClientRating'] . '</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th>' . $lang['Rating'] . '</th>
            <th>' . $now2->format('Y') . '</th>
            <th>' . $now1->format('Y') . '</th>
            <th>' . $now->format('Y') . '</th>
        </tr>
        <tr>
            <th>A: (&#8364; > ' . number_format(5000, 0, '.', ',') . ')</th>
            <td>' . number_format($rating['vvj']['A'], 0, '.', ',') . '</td>
            <td>' . number_format($rating['vj']['A'], 0, '.', ',') . '</td>
            <td>' . number_format($rating['aj']['A'], 0, '.', ',') . '</td>
        </tr>
        <tr>
            <th>B: (' . number_format(2500, 0, '.', ',') . ' < &#8364; &#8804; ' . number_format(5000, 0, '.', ',') . ')</th>
            <td>' . number_format($rating['vvj']['B'], 0, '.', ',') . '</td>
            <td>' . number_format($rating['vj']['B'], 0, '.', ',') . '</td>
            <td>' . number_format($rating['aj']['B'], 0, '.', ',') . '</td>
        </tr>
        <tr>
            <th>C: (' . number_format(250, 0, '.', ',') . ' < &#8364; &#8804; ' . number_format(2500, 0, '.', ',') . ')</th>
            <td>' . number_format($rating['vvj']['C'], 0, '.', ',') . '</td>
            <td>' . number_format($rating['vj']['C'], 0, '.', ',') . '</td>
            <td>' . number_format($rating['aj']['C'], 0, '.', ',') . '</td>
        </tr>
        <tr>
            <th>D: (' . number_format(1, 0, '.', ',') . ' < &#8364; &#8804; ' . number_format(250, 0, '.', ',') . ')</th>
            <td>' . number_format($rating['vvj']['D'], 0, '.', ',') . '</td>
            <td>' . number_format($rating['vj']['D'], 0, '.', ',') . '</td>
            <td>' . number_format($rating['aj']['D'], 0, '.', ',') . '</td>
        </tr>
        <tr>
            <th>E: (&#8364; &#8804; ' . number_format(1, 0, '.', ',') . ')</th>
            <td>' . number_format($rating['vvj']['E'], 0, '.', ',') . '</td>
            <td>' . number_format($rating['vj']['E'], 0, '.', ',') . '</td>
            <td>' . number_format($rating['aj']['E'], 0, '.', ',') . '</td>
        </tr>
        </tbody>
    </table>
';

$pdf->writeHTML($tbl, true, false, false, false, '');

echo $pdf->Output('AreaManagerReport.pdf', 'S');