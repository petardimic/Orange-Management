<?php
$lang = $this->getData('lang');

$restricted = [

];

$areas = [
    '02',
    '03',
    '04',
    '05',
    '06',
    '07',
    '08',
    '09',
    '10',
    '11',
    '12',
    '13',
    '14',
    '15',
    '16',
    '17',
    '18',
    '19',
    '20',
    '21',
    '22',
    '32',
    '33',
    '44',
];

$types = [
    [
        'title'    => 'MetalGalvano',
        'elements' => [101, 102, 103]
    ],
    [
        'title'    => 'Misc',
        'elements' => [222, 224]
    ],
    [
        'title'    => 'Machines',
        'elements' => [171, 232, 233, 234, 241, 301, 311, 201]
    ],
    [
        'title'    => 'IMPLA',
        'elements' => [161, 162]
    ],
    [
        'title'    => 'Consumable',
        'elements' => [111, 121, 122, 123, 131, 141, 151, 181, 191, 211, 212, 213, 214, 231, 321, 322, 323, 331, 341]
    ],
];

function rotatingTrend($p)
{
    if($p < 0) {
        return log(-$p) * 19.543;
    } elseif($p > 0) {
        $deg = log($p) * 19.543;

        return $deg > 90 ? -90 : -$deg;
    } else {
        return 0;
    }
}

if(array_key_exists($this->request->getAccount()->getId(), $restricted) && in_array($this->request->getRequest('source'), $restricted[$this->request->getAccount()->getId()])) {
    $source = $this->request->getRequest('source');
} elseif(array_key_exists($this->request->getAccount()->getId(), $restricted)) {
    $source = $restricted[$this->request->getAccount()->getId()][0];
} elseif(!in_array($this->request->getRequest('source'), $areas)) {
    $source = '21';
} else {
    $source = $this->request->getRequest('source');
}

$now    = new \phpOMS\Datatypes\SmartDateTime();
$now1   = $now->createModify(-1);
$now2   = $now->createModify(-2);
$now1m  = $now->createModify(0, -1);
$now2m  = $now->createModify(0, -2);
$now11m = $now->createModify(-1, -1);
$nowm1m = $now->createModify(0, -1);
$nowm2m = $now->createModify(0, -2);

$diff1   = (int) $now->format('m') - (int) $nowm1m->format('m');
$diff2   = (int) $now->format('m') - (int) $nowm2m->format('m');
$nowm1ml = $diff1 < 1 ? 12 + (int) $nowm1m->format('m') : 24 + (int) $nowm1m->format('m');
$nowm2ml = $diff2 < 1 ? 12 + (int) $nowm2m->format('m') : 24 + (int) $nowm2m->format('m');

$sales = [];
foreach($types as $type) {
    foreach($type['elements'] as $element) {
        // monthly
        $sales['accumulated'][$element][1] = 0.0;
        $sales['accumulated'][$element][2] = 0.0;
        $sales['accumulated'][$element][3] = 0.0;

        // yearly
        $sales['accumulated'][$element][4] = 0.0;
        $sales['accumulated'][$element][5] = 0.0;
        $sales['accumulated'][$element][6] = 0.0;

        for($i = 1; $i < 37; $i++) {
            $sales[$element][$i] = 0.0;
        }
    }
}

$file = fopen(__DIR__ . '/NOGIT.csv', 'r');

static $length;
fgetcsv($file, 0, ';');
while(($line = fgetcsv($file, 0, ';')) !== false) {
    if($line[0] == $source && isset($sales[$line[1]])) {
        $length = count($line);

        for($i = 3; $i < $length; $i++) {
            $sales[$line[1]][$i - 2] += (float) str_replace(['.', ','], ['', '.'], $line[$i]);

            if(($i - 2) % 12 <= (int) $now->format('m') && ($i - 2) % 12 !== 0) {
                $sales['accumulated'][$line[1]][(int) ceil(($i - 2) / 12)] += $sales[$line[1]][$i - 2];
            }

            $sales['accumulated'][$line[1]][(int) ceil(($i - 2) / 12) + 3] += $sales[$line[1]][$i - 2];
        }
    }
}
fclose($file);

$file = fopen(__DIR__ . '/AreaManagerClientsNOGIT.csv', 'r');

$rating = [
    'aj'  => ['A' => 0, 'B' => 0, 'C' => 0, 'D' => 0, 'E' => 0],
    'vj'  => ['A' => 0, 'B' => 0, 'C' => 0, 'D' => 0, 'E' => 0],
    'vvj' => ['A' => 0, 'B' => 0, 'C' => 0, 'D' => 0, 'E' => 0],
];

$movement = [
    'new'         => ['value' => 0, 'sales' => 0.0],
    'lost'        => ['value' => 0, 'sales' => 0.0],
    'visited'     => ['value' => 0, 'sales' => 0.0],
    'notvisited'  => ['value' => 0, 'sales' => 0.0],
    'visitedlost' => ['value' => 0, 'sales' => 0.0],
];

unset($length);
$clients = [];
fgetcsv($file, 0, ';');
while(($line = fgetcsv($file, 0, ';')) !== false) {
    if((int) $line[6] == (int) $source) {
        $length = count($line);

        $id = (int) str_replace('.', '', $line[0]);
        if($id > 99999 && $id < 700000) {
            $clients[$id] = [
                'id'      => $id,
                'name'    => $line[1],
                'country' => $line[2],
                'zip'     => $line[3],
                'city'    => $line[4],
                'sales'   => [
                    'aj'  => (float) str_replace(['.', ','], ['', '.'], $line[10]),
                    'vj'  => (float) str_replace(['.', ','], ['', '.'], $line[11]),
                    'vvj' => (float) str_replace(['.', ','], ['', '.'], $line[12]),
                ],
                'visited' => new \DateTime($line[13])
            ];

            if($clients[$id]['sales']['aj'] > 0 && $clients[$id]['sales']['vj'] === 0.0 && $clients[$id]['sales']['vvj']) {
                $movement['new']['value']++;
                $movement['new']['sales'] += $clients[$id]['sales']['aj'];
            } elseif($clients[$id]['sales']['aj'] === 0.0 && $clients[$id]['sales']['vj'] > 0) {
                $movement['lost']['value']++;
                $movement['lost']['sales'] += $clients[$id]['sales']['vj'];
            }

            if($clients[$id]['visited'] > $now1) {
                $movement['visited']['value']++;
                $movement['visited']['sales'] += $clients[$id]['sales']['aj'];

                if($clients[$id]['sales']['aj'] <= 0.0 && $clients[$id]['sales']['vj'] > 0.0) {
                    $movement['visitedlost']['value']++;
                    $movement['visitedlost']['sales'] += $clients[$id]['sales']['vj'];
                }
            } else {
                $movement['notvisited']['value']++;
                $movement['notvisited']['sales'] += $clients[$id]['sales']['aj'];
            }

            foreach($clients[$id]['sales'] as $index => $value) {
                if($value <= 1) {
                    $rating[$index]['E']++;
                } elseif($value <= 250 && $value > 1) {
                    $rating[$index]['D']++;
                } elseif($value <= 2500 && $value > 250) {
                    $rating[$index]['C']++;
                } elseif($value <= 5000 && $value > 2500) {
                    $rating[$index]['B']++;
                } elseif($value > 5000) {
                    $rating[$index]['A']++;
                }
            }
        }
    }
}
fclose($file);

$file = fopen(__DIR__ . '/AreaManagerUG3YClientsNOGIT.csv', 'r');

unset($length);
fgetcsv($file, 0, ';');
while(($line = fgetcsv($file, 0, ';')) !== false) {
    if((int) $line[8] == (int) $source) {
        $length = count($line);

        $id = (int) str_replace('.', '', $line[1]);
        if($id > 99999 && $id < 700000) {
            $clients[$id]['ug'][$line[0]] = [
                'aj'  => (float) str_replace(['.', ','], ['', '.'], $line[7]),
                'vj'  => (float) str_replace(['.', ','], ['', '.'], $line[6]),
                'vvj' => (float) str_replace(['.', ','], ['', '.'], $line[5]),
            ];
        }
    }
}
fclose($file);
?>

<div class="areamanager-report">
    <!-- Client rating -->
    <div id="areamanager-report-select">
        <h1><?= $lang['AreaManager']; ?></h1>

        <div>
            <form method="post"
                  action="<?= $this->request->getScheme() . '://' . $this->request->getHost() . \phpOMS\Uri\UriFactory::build([$this->l11n->getLanguage(),
                                                                                                                               'api',
                                                                                                                               'reporter',
                                                                                                                               'single'], ['id' => $this->request->getRequest()['id']]) ?>">
                <ul>
                    <li class="rf"><?= $now->format('Y-m-d'); ?>
                    <li><label for="i-areamanager"><?= $lang['AreaManager']; ?></label>: <select name="i-areamanager"
                                                                                                 id="i-areamanager">
                            <option value="-1" selected disabled><?= $lang['Select']; ?>
                                <?php foreach ($areas as $area): ?>
                            <option value="<?= $area; ?>"<?= $area === $source ? ' selected' : ''; ?>><?= $area; ?>
                                <?php endforeach; ?>
                        </select>
                </ul>
            </form>
        </div>
    </div>

    <!-- Client rating -->
    <table id="areamanager-report-rating">
        <thead>
        <tr>
            <th colspan="4"><?= $lang['ClientRating']; ?>
                <tbody>
        <tr>
            <th><?= $lang['Rating']; ?>
            <th><?= $now2->format('Y'); ?>
            <th><?= $now1->format('Y'); ?>
            <th><?= $now->format('Y'); ?>
        <tr>
            <th>A: (&#8364; > <?= number_format(5000, 0, '.', ','); ?>)
            <td><?= number_format($rating['vvj']['A'], 0, '.', ','); ?>
            <td><?= number_format($rating['vj']['A'], 0, '.', ','); ?>
            <td><?= number_format($rating['aj']['A'], 0, '.', ','); ?>
        <tr>
            <th>B: (<?= number_format(2500, 0, '.', ','); ?> < &#8364; &#8804; <?= number_format(5000, 0, '.', ','); ?>)
            <td><?= number_format($rating['vvj']['B'], 0, '.', ','); ?>
            <td><?= number_format($rating['vj']['B'], 0, '.', ','); ?>
            <td><?= number_format($rating['aj']['B'], 0, '.', ','); ?>
        <tr>
            <th>C: (<?= number_format(250, 0, '.', ','); ?> < &#8364; &#8804; <?= number_format(2500, 0, '.', ','); ?>)
            <td><?= number_format($rating['vvj']['C'], 0, '.', ','); ?>
            <td><?= number_format($rating['vj']['C'], 0, '.', ','); ?>
            <td><?= number_format($rating['aj']['C'], 0, '.', ','); ?>
        <tr>
            <th>D: (<?= number_format(1, 0, '.', ','); ?> < &#8364; &#8804; <?= number_format(250, 0, '.', ','); ?>)
            <td><?= number_format($rating['vvj']['D'], 0, '.', ','); ?>
            <td><?= number_format($rating['vj']['D'], 0, '.', ','); ?>
            <td><?= number_format($rating['aj']['D'], 0, '.', ','); ?>
        <tr>
            <th>E: (&#8364; &#8804; <?= number_format(1, 0, '.', ','); ?>)
            <td><?= number_format($rating['vvj']['E'], 0, '.', ','); ?>
            <td><?= number_format($rating['vj']['E'], 0, '.', ','); ?>
            <td><?= number_format($rating['aj']['E'], 0, '.', ','); ?>
    </table>

    <!-- Client new/lost -->
    <table id="areamanager-report-clientmovement">
        <thead>
        <tr>
            <th colspan="3"><?= $lang['ClientMovement']; ?>
                <tbody>
        <tr>
            <th><?= $lang['Type']; ?>
            <th><?= $lang['Value']; ?>
            <th><?= $lang['Turnover']; ?>
        <tr>
            <th><?= $lang['NewClients']; ?>
            <td><?= $movement['new']['value']; ?>
            <td><?= number_format($movement['new']['sales'], 0, '.', ','); ?>
        <tr>
            <th><?= $lang['LostClients']; ?>
            <td><?= $movement['lost']['value']; ?>
            <td><?= number_format($movement['lost']['sales'], 0, '.', ','); ?>
        <tr>
            <th><?= $lang['NotVisited']; ?>
            <td><?= $movement['notvisited']['value']; ?>
            <td><?= number_format($movement['notvisited']['sales'], 0, '.', ','); ?>
        <tr>
            <th><?= $lang['Visited']; ?>
            <td><?= $movement['visited']['value']; ?>
            <td><?= number_format($movement['visited']['sales'], 0, '.', ','); ?>
        <tr>
            <th><?= $lang['VisitedLost']; ?>
            <td><?= $movement['visitedlost']['value']; ?>
            <td><?= number_format($movement['visitedlost']['sales'], 0, '.', ','); ?>
    </table>

    <!-- Turnover -->
    <div class="areamanger-box">
        <h1><?= $lang['TurnoverOverview']; ?></h1>

        <div class="reporter-scroll-wrapper">
            <table id="areamanager-report-turnoveroverview">
                <tbody>
                <tr>
                    <th><?= $lang['Type']; ?>
                    <th><?= $now2m->format('m'); ?>
                    <th><?= $now11m->format('m'); ?>
                    <th><?= $now1->format('Y m'); ?>
                    <th><?= $now->format('m'); ?>
                    <th><?= $lang['Diff']; ?>
                    <th><?= $lang['DiffP']; ?>
                    <th><?= $now2->format('Y') . ' ' . $now2->format('m'); ?>
                    <th><?= $now1->format('Y') . ' ' . $now1->format('m'); ?>
                    <th><?= $now->format('Y') . ' ' . $now->format('m'); ?>
                    <th><?= $lang['Diff']; ?>
                    <th><?= $lang['DiffP']; ?>
                    <th><?= $now2->format('Y'); ?>
                    <th><?= $now1->format('Y'); ?>
                    <th><?= $now->format('Y'); ?>
                    <th><?= $lang['Trend']; ?>
                <tr class="reporter-subheadline">
                    <th><?= $lang['Total']; ?>
                    <th><?php $sum = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum += $sales[$id][$nowm2ml];
                            }
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum += $sales[$id][$nowm1ml];
                            }
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum1 = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum1 += $sales[$id][(int) $now->format('m') + 12];
                            }
                        }
                        echo number_format($sum1, 2, ',', '.'); ?>
                    <th><?php $sum2 = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum2 += $sales[$id][(int) $now->format('m') + 24];
                            }
                        }
                        echo number_format($sum2, 2, ',', '.'); ?>
                        <?php $diff = ($sum1 === 0.0 ? 0.0 : 100 * ($sum2 - $sum1) / $sum1); ?>
                    <th><?= number_format($sum2 - $sum1, 2, ',', '.'); ?>
                    <th><?= number_format($diff, 2, ',', '.'); ?>%
                    <th><?php $sum = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum += $sales['accumulated'][$id][1];
                            }
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum1 = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum1 += $sales['accumulated'][$id][2];
                            }
                        }
                        echo number_format($sum1, 2, ',', '.'); ?>
                    <th><?php $sum2 = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum2 += $sales['accumulated'][$id][3];
                            }
                        }
                        echo number_format($sum2, 2, ',', '.'); ?>
                        <?php $diff = ($sum1 === 0.0 ? 0.0 : 100 * ($sum2 - $sum1) / $sum1); ?>
                    <th><?= number_format($sum2 - $sum1, 2, ',', '.'); ?>
                    <th><?= number_format($diff, 2, ',', '.'); ?>%
                    <th><?php $sum = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum += $sales['accumulated'][$id][4];
                            }
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum += $sales['accumulated'][$id][5];
                            }
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum += $sales['accumulated'][$id][6];
                            }
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><i class="fa fa-arrow-circle-o-right"
                           style="transform: rotate(<?= (int) rotatingTrend((int) $diff) ?>deg)"></i>
                        <?php foreach ($types as $ids) : ?>
                <tr class="reporter-subheadline">
                    <th><i class="fa fa-tag"></i> <?= $lang[$ids['title']]; ?>
                    <th><?php $sum = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum += $sales[$id][$nowm2ml];
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum += $sales[$id][$nowm1ml];
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum1 = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum1 += $sales[$id][(int) $now->format('m') + 12];
                        }
                        echo number_format($sum1, 2, ',', '.'); ?>
                    <th><?php $sum2 = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum2 += $sales[$id][(int) $now->format('m') + 24];
                        }
                        echo number_format($sum2, 2, ',', '.'); ?>
                        <?php $diff = ($sum1 === 0.0 ? 0.0 : 100 * ($sum2 - $sum1) / $sum1); ?>
                    <th><?= number_format($sum2 - $sum1, 2, ',', '.'); ?>
                    <th><?= number_format($diff, 2, ',', '.'); ?>%
                    <th><?php $sum = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum += $sales['accumulated'][$id][1];
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum1 = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum1 += $sales['accumulated'][$id][2];
                        }
                        echo number_format($sum1, 2, ',', '.'); ?>
                    <th><?php $sum2 = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum2 += $sales['accumulated'][$id][3];
                        }
                        echo number_format($sum2, 2, ',', '.'); ?>
                        <?php $diff = ($sum1 === 0.0 ? 0.0 : 100 * ($sum2 - $sum1) / $sum1); ?>
                    <th><?= number_format($sum2 - $sum1, 2, ',', '.'); ?>
                    <th><?= number_format($diff, 2, ',', '.'); ?>%
                    <th><?php $sum = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum += $sales['accumulated'][$id][4];
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum += $sales['accumulated'][$id][5];
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum += $sales['accumulated'][$id][6];
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><i class="fa fa-arrow-circle-o-right"
                           style="transform: rotate(<?= (int) rotatingTrend((int) $diff) ?>deg)"></i>
                        <?php foreach ($ids['elements'] as $id) : ?>
                <tr>
                    <th><?= $id . ' ' . $lang[$id]; ?>
                    <td><?= number_format($sales[$id][$nowm2ml], 2, ',', '.'); ?>
                    <td><?= number_format($sales[$id][$nowm1ml], 2, ',', '.'); ?>
                    <td><?= number_format($sales[$id][(int) $now->format('m') + 12], 2, ',', '.'); ?>
                    <td><?= number_format($sales[$id][(int) $now->format('m') + 24], 2, ',', '.'); ?>
                        <?php $diff = ($sales[$id][(int) $now->format('m') + 12] === 0.0 ? 0.0 : (100 * ($sales[$id][(int) $now->format('m') + 24] - $sales[$id][(int) $now->format('m') + 12]) / $sales[$id][(int) $now->format('m') + 12])); ?>
                    <td class="delim coloring-<?php if($diff > 1) {
                        echo 1;
                    } elseif($diff < -1) {
                        echo -1;
                    } else {
                        echo 0;
                    } ?>"><?= number_format($sales[$id][(int) $now->format('m') + 24] - $sales[$id][(int) $now->format('m') + 12], 2, ',', '.'); ?>
                    <td class="delim coloring-<?php if($diff > 1) {
                        echo 1;
                    } elseif($diff < -1) {
                        echo -1;
                    } else {
                        echo 0;
                    } ?>"><?= number_format($diff, 2, ',', '.'); ?>%
                    <td><?= number_format($sales['accumulated'][$id][1], 2, ',', '.'); ?>
                    <td><?= number_format($sales['accumulated'][$id][2], 2, ',', '.'); ?>
                    <td><?= number_format($sales['accumulated'][$id][3], 2, ',', '.'); ?>
                        <?php $diff2 = ($sales['accumulated'][$id][2] === 0.0 ? 0.0 : (100 * ($sales['accumulated'][$id][3] - $sales['accumulated'][$id][2]) / $sales['accumulated'][$id][2])); ?>
                    <td class="delim coloring-<?php if($diff2 > 1) {
                        echo 1;
                    } elseif($diff2 < -1) {
                        echo -1;
                    } else {
                        echo 0;
                    } ?>"><?= number_format($sales['accumulated'][$id][3] - $sales['accumulated'][$id][2], 2, ',', '.'); ?>
                    <td class="delim coloring-<?php if($diff2 > 1) {
                        echo 1;
                    } elseif($diff2 < -1) {
                        echo -1;
                    } else {
                        echo 0;
                    } ?>"><?= number_format($diff2, 2, ',', '.'); ?>%
                    <td><?= number_format($sales['accumulated'][$id][4], 2, ',', '.'); ?>
                    <td><?= number_format($sales['accumulated'][$id][5], 2, ',', '.'); ?>
                    <td><?= number_format($sales['accumulated'][$id][6], 2, ',', '.'); ?>
                    <td class="coloring-<?php if($diff2 > 1) {
                        echo 1;
                    } elseif($diff2 < -1) {
                        echo -1;
                    } else {
                        echo 0;
                    } ?>">
                        <i class="fa fa-arrow-circle-o-right"
                           style="transform: rotate(<?= (int) rotatingTrend((int) $diff2) ?>deg)"></i>
                        <?php endforeach; ?>
                        <?php endforeach; ?>
            </table>
        </div>
    </div>

    <script>
        jsOMS.ready(function () {
            assetManager.load(URL + '/Modules/Reporter/Templates/AreaManager', 'AreaManager.css', 'css');

            var amSelect = document.getElementById('i-areamanager');
            amSelect.onchange = function () {
                window.location.href = '<?= $this->request->getScheme() . '://' . $this->request->getHost() . $this->request->getPath() ; ?>' + '?id=AreaManager&source=' + amSelect.value;
            };
        });
    </script>
</div>
