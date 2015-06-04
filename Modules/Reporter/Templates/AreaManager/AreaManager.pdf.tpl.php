<?php
include __DIR__ . '/Worker.php';

/**
 * {@inheritdoc}
 */
class AreaManagerPdf extends \phpOMS\Utils\Pdf\Pdf
{
    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
    public function Footer()
    {
        $cur_y = $this->y;
        $this->SetTextColorArray($this->footer_text_color);
        //set style for cell border
        $line_width = (0.85 / $this->k);
        $this->SetLineStyle(array('width' => $line_width, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0,
                                  'color' => $this->footer_line_color));

        $w_page = isset($this->l['w_page']) ? $this->l['w_page'] . ' ' : '';
        if(empty($this->pagegroups)) {
            $pagenumtxt = $w_page . $this->getAliasNumPage() . ' / ' . $this->getAliasNbPages();
        } else {
            $pagenumtxt = $w_page . $this->getPageNumGroupAlias() . ' / ' . $this->getPageGroupAlias();
        }
        $this->SetY($cur_y);
        //Print page number
        if($this->getRTL()) {
            $this->SetX($this->original_rMargin);
            $this->Cell(0, 0, $pagenumtxt, 'T', 0, 'L');
        } else {
            $this->SetX($this->original_lMargin);
            $this->Cell(0, 0, $this->getAliasRightShift() . $pagenumtxt, 'T', 0, 'R');
            $this->SetY($cur_y);
            $this->SetX($this->original_lMargin);
            $this->Cell(0, 0, (new \DateTime())->format('Y-m-d'), 'T', 0, 'L');
        }
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
$pdf->SetHeaderData(__DIR__ . '/logo_sd.png', 0, 'Area Manager Report '  . $source, 'by Schütz Dental GmbH');

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
$pdf->setImageScale(1.0);

// ---------------------------------------------------------

// add a page
$pdf->AddPage();
$pdf->setY(20);

// -----------------------------------------------------------------------------

$pdf->SetFont('helvetica', '', 8);

$y = $pdf->getY();

$css_table_basic = '
    <style>
        table {
            border: 1px solid #000;
        }

        th {
            font-weight: bold;
        }

        .first th {
            background-color: #d0d0d0;
            text-align: center;
        }

        .second th {
            background-color: #f0f0f0;
            text-align: center;
        }

        td {
            text-align: center;
        }

        .side {
            background-color: #f0f0f0;
        }
    </style>
';

$html = $css_table_basic . '
    <table cellpadding="1" cellspacing="1" width="48%">
        <thead>
        <tr class="first">
            <th colspan="4">' . $lang['ClientRating'] . '</th>
        </tr>
        </thead>
        <tbody>
        <tr class="second">
            <th width="46%">' . $lang['Rating'] . '</th>
            <th width="18%">' . $now2->format('Y') . '</th>
            <th width="18%">' . $now1->format('Y') . '</th>
            <th width="18%">' . $now->format('Y') . '</th>
        </tr>
        <tr>
            <th class="side">A: (&#8364; > ' . number_format(5000, 0, '.', ',') . ')</th>
            <td>' . number_format($rating['vvj']['A'], 0, '.', ',') . '</td>
            <td>' . number_format($rating['vj']['A'], 0, '.', ',') . '</td>
            <td>' . number_format($rating['aj']['A'], 0, '.', ',') . '</td>
        </tr>
        <tr>
            <th class="side">B: (' . number_format(2500, 0, '.', ',') . ' < &#8364; < ' . number_format(5000, 0, '.', ',') . ')</th>
            <td>' . number_format($rating['vvj']['B'], 0, '.', ',') . '</td>
            <td>' . number_format($rating['vj']['B'], 0, '.', ',') . '</td>
            <td>' . number_format($rating['aj']['B'], 0, '.', ',') . '</td>
        </tr>
        <tr>
            <th class="side">C: (' . number_format(250, 0, '.', ',') . ' < &#8364; < ' . number_format(2500, 0, '.', ',') . ')</th>
            <td>' . number_format($rating['vvj']['C'], 0, '.', ',') . '</td>
            <td>' . number_format($rating['vj']['C'], 0, '.', ',') . '</td>
            <td>' . number_format($rating['aj']['C'], 0, '.', ',') . '</td>
        </tr>
        <tr>
            <th class="side">D: (' . number_format(1, 0, '.', ',') . ' < &#8364; < ' . number_format(250, 0, '.', ',') . ')</th>
            <td>' . number_format($rating['vvj']['D'], 0, '.', ',') . '</td>
            <td>' . number_format($rating['vj']['D'], 0, '.', ',') . '</td>
            <td>' . number_format($rating['aj']['D'], 0, '.', ',') . '</td>
        </tr>
        <tr>
            <th class="side">E: (&#8364; < ' . number_format(1, 0, '.', ',') . ')</th>
            <td>' . number_format($rating['vvj']['E'], 0, '.', ',') . '</td>
            <td>' . number_format($rating['vj']['E'], 0, '.', ',') . '</td>
            <td>' . number_format($rating['aj']['E'], 0, '.', ',') . '</td>
        </tr>
        </tbody>
    </table>
';

$pdf->writeHTML($html, true, false, false, false, '');

$y2 = $pdf->getY();
$x2 = $pdf->getX();

$pdf->setY($y);
$pdf->setX($pdf->getPageWidth()*0.48+3);

$html = $css_table_basic . '
    <table cellpadding="1" cellspacing="1" width="100%">
        <thead>
        <tr class="first">
            <th colspan="3">' . $lang['ClientMovement'] . '</th>
        </tr>
        </thead>
        <tbody>
        <tr class="second">
            <th width="40%">' . $lang['Type'] . '</th>
            <th width="30%">' . $lang['Value'] . '</th>
            <th width="30%">' . $lang['Turnover'] . '</th>
        </tr>
        <tr>
            <th class="side">' . $lang['NewClients'] . '</th>
            <td>' . $movement['new']['value'] . '</td>
            <td>' . number_format($movement['new']['sales'], 2, ',', '.') . '</td>
        </tr>
        <tr>
            <th class="side">' . $lang['LostClients'] . '</th>
            <td>' . $movement['lost']['value'] . '</td>
            <td>' . number_format($movement['lost']['sales'], 2, ',', '.') . '</td>
        </tr>
        <tr>
            <th class="side">' . $lang['NotVisited'] . '</th>
            <td>' . $movement['notvisited']['value'] . '</td>
            <td>' . number_format($movement['notvisited']['sales'], 2, ',', '.') . '</td>
        </tr>
        <tr>
            <th class="side">' . $lang['Visited'] . '</th>
            <td>' . $movement['visited']['value'] . '</td>
            <td>' . number_format($movement['visited']['sales'], 2, ',', '.') . '</td>
        </tr>
        <tr>
            <th class="side">' . $lang['VisitedLost'] . '</th>
            <td>' . $movement['visitedlost']['value'] . '</td>
            <td>' . number_format($movement['visitedlost']['sales'], 2, ',', '.') . '</td>
        </tr>
        </tbody>
    </table>
';

$pdf->writeHTML($html, true, false, false, false, '');

$html = '
    <style>
        table {
            border: 1px solid #000;
        }

        .first th {
            background-color: #d0d0d0;
            text-align: center;
            font-weight: bold;
        }

        .reporter-subheadline th {
            background-color: #f0f0f0;
            text-align: center;
            font-weight: bold;
        }

        .second th {
            background-color: #f0f0f0;
            text-align: center;
            font-weight: bold;
        }

        .thrid th {
            background-color: #f0f0f0;
            text-align: center;
            font-weight: bold;
        }

        .side {
            background-color: #f0f0f0;
        }

        .coloring-0 {
            color: #9c6500;
            background-color: #ffeb9c;
        }
        .coloring-1 {
            color: #006100;
            background-color: #c6efce;
        }
        .coloring--1 {
            color: #9c0006;
            background-color: #ffc7ce;
        }
    </style>

    <table cellpadding="1" cellspacing="1" width="100%">
    <thead>
        <tr class="first">
            <th colspan="10">' . $lang['TurnoverOverview'] . '</th>
        </tr>
        </thead>
                <tr class="second">
                    <th>' . $lang['Type'] . '</th>
<th>' . $now11m->format('m') . '</th>
<th>' . $now1->format('Y m') . '</th>
<th>' . $now->format('m') . '</th>
<th>' . $lang['DiffP'] . '</th>
<th>' . $now1->format('Y') . ' ' . $now1->format('m') . '</th>
<th>' . $now->format('Y') . ' ' . $now->format('m') . '</th>
<th>' . $lang['DiffP'] . '</th>
<th>' . $now1->format('Y') . '</th>
<th>' . $now->format('Y') . '</th>
    </tr><tr class="thrid">
        <th>' . $lang['Total'] . '</th>
        <th>';

$sum = 0.0;
foreach($types as $ids) {
    foreach($ids['elements'] as $id) {
        $sum += $sales[$id][$nowm1ml];
    }
}
$html .= number_format($sum, 2, ',', '.') . '</th><th>';
$sum1 = 0.0;
foreach($types as $ids) {
    foreach($ids['elements'] as $id) {
        $sum1 += $sales[$id][(int) $now->format('m') + 12];
    }
}
$html .= number_format($sum1, 2, ',', '.') . '</th><th>';
$sum2 = 0.0;
foreach($types as $ids) {
    foreach($ids['elements'] as $id) {
        $sum2 += $sales[$id][(int) $now->format('m') + 24];
    }
}
$html .= number_format($sum2, 2, ',', '.');

$diff = ($sum1 === 0.0 ? 0.0 : 100 * ($sum2 - $sum1) / abs($sum1));

$html .= '</th><th>' . number_format($diff, 2, ',', '.') . '%</th><th>';
$sum1 = 0.0;
foreach($types as $ids) {
    foreach($ids['elements'] as $id) {
        $sum1 += $sales['accumulated'][$id][2];
    }
}
$html .= number_format($sum1, 2, ',', '.') . '</th><th>';
$sum2 = 0.0;
foreach($types as $ids) {
    foreach($ids['elements'] as $id) {
        $sum2 += $sales['accumulated'][$id][3];
    }
}
$html .= number_format($sum2, 2, ',', '.');
$diff = ($sum1 === 0.0 ? 0.0 : 100 * ($sum2 - $sum1) / abs($sum1));

$html .= '</th><th>' . number_format($diff, 2, ',', '.') . '%</th><th>';
$sum = 0.0;
foreach($types as $ids) {
    foreach($ids['elements'] as $id) {
        $sum += $sales['accumulated'][$id][5];
    }
}
$html .= number_format($sum, 2, ',', '.') . '</th><th>';
$sum = 0.0;
foreach($types as $ids) {
    foreach($ids['elements'] as $id) {
        $sum += $sales['accumulated'][$id][6];
    }
}
$html .= number_format($sum, 2, ',', '.') . '</th></tr>';

foreach($types as $ids) {
    $html .= '<tr class="reporter-subheadline"><th>' . substr($lang[$ids['title']], 0, 9) . (strlen($lang[$ids['title']]) > 9 ? '.' : '') . '</th><th>';

    $sum = 0.0;
    foreach($ids['elements'] as $id) {
        $sum += $sales[$id][$nowm1ml];
    }
    $html .= number_format($sum, 2, ',', '.') . '</th><th>';
    $sum1 = 0.0;
    foreach($ids['elements'] as $id) {
        $sum1 += $sales[$id][(int) $now->format('m') + 12];
    }
    $html .= number_format($sum1, 2, ',', '.') . '</th><th>';
    $sum2 = 0.0;
    foreach($ids['elements'] as $id) {
        $sum2 += $sales[$id][(int) $now->format('m') + 24];
    }
    $html .= number_format($sum2, 2, ',', '.');
    $diff = ($sum1 === 0.0 ? 0.0 : 100 * ($sum2 - $sum1) / abs($sum1));
    $html .= '</th><th>' . number_format($diff, 2, ',', '.') . '%</th><th>';
    $sum1 = 0.0;
    foreach($ids['elements'] as $id) {
        $sum1 += $sales['accumulated'][$id][2];
    }
    $html .= number_format($sum1, 2, ',', '.') . '</th><th>';
    $sum2 = 0.0;
    foreach($ids['elements'] as $id) {
        $sum2 += $sales['accumulated'][$id][3];
    }
    $html .= number_format($sum2, 2, ',', '.');
    $diff = ($sum1 === 0.0 ? 0.0 : 100 * ($sum2 - $sum1) / abs($sum1));
    $html .= '</th><th>' . number_format($diff, 2, ',', '.') . '%</th><th>';
    $sum = 0.0;
    foreach($ids['elements'] as $id) {
        $sum += $sales['accumulated'][$id][5];
    }
    $html .= number_format($sum, 2, ',', '.') . '</th><th>';
    $sum = 0.0;
    foreach($ids['elements'] as $id) {
        $sum += $sales['accumulated'][$id][6];
    }
    $html .= number_format($sum, 2, ',', '.') . '</th></tr>';
    foreach($ids['elements'] as $id) {
        $html .= '<tr>
            <th class="side">' . substr($lang[$id], 0, 9) . (strlen($lang[$id]) > 9 ? '.' : '') . '</th>
            <td>' . number_format($sales[$id][$nowm1ml], 2, ',', '.') . '</td>
            <td>' . number_format($sales[$id][(int) $now->format('m') + 12], 2, ',', '.') . '</td>
            <td>' . number_format($sales[$id][(int) $now->format('m') + 24], 2, ',', '.') . '</td>';
        $diff = ($sales[$id][(int) $now->format('m') + 12] === 0.0 ? 0.0 : (100 * ($sales[$id][(int) $now->format('m') + 24] - $sales[$id][(int) $now->format('m') + 12]) / abs($sales[$id][(int) $now->format('m') + 12])));
        $html .= '<td class="delim coloring-';

        if($diff > 1) {
            $color = 1;
        } elseif($diff < -1) {
            $color = -1;
        } else {
            $color = 0;
        }

        $html .= $color . '">' . number_format($diff, 2, ',', '.') . '%</td>
        <td>' . number_format($sales['accumulated'][$id][2], 2, ',', '.') . '</td>
        <td>' . number_format($sales['accumulated'][$id][3], 2, ',', '.') . '</td>';

        $diff2 = ($sales['accumulated'][$id][2] === 0.0 ? 0.0 : (100 * ($sales['accumulated'][$id][3] - $sales['accumulated'][$id][2]) / abs($sales['accumulated'][$id][2])));

        $html .= '<td class="delim coloring-';

        if($diff2 > 1) {
            $color = 1;
        } elseif($diff2 < -1) {
            $color = -1;
        } else {
            $color = 0;
        }

        $html .= $color . '"> ' . number_format($diff2, 2, ',', '.') . '%</td>
        <td>' . number_format($sales['accumulated'][$id][5], 2, ',', '.') . '</td>
        <td>' . number_format($sales['accumulated'][$id][6], 2, ',', '.') . '</td></tr>';
    }
}
$html .= '</table>';

$pdf->writeHTML($html, true, false, false, false, '');

echo $pdf->Output('AreaManagerReport.pdf', 'S');