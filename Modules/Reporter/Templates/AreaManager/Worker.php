<?php
$lang = $this->getData('lang');

$restricted = [

];

$areas = [
    '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13',
    '14', '15', '16', '17', '18', '19', '20', '21', '22', '32', '33', '44',
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

if(array_key_exists($this->request->getAccount()->getId(), $restricted) && in_array($this->request->getData('source'), $restricted[$this->request->getAccount()->getId()])) {
    $source = $this->request->getData('source');
} elseif(array_key_exists($this->request->getAccount()->getId(), $restricted)) {
    $source = $restricted[$this->request->getAccount()->getId()][0];
} elseif($this->request->getUri()->getQuery('source') === null || !in_array($this->request->getData('source'), $areas)) {
    $source = '21';
} else {
    $source = $this->request->getData('source');
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