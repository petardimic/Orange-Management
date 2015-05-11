<?php
$lang = $this->getData('lang');

$restricted = [

];

$types = [
    [
        'title'    => 'MetalGalvano',
        'elements' => [101, 102, 103, 104, 106]
    ],
    [
        'title'    => 'Misc',
        'elements' => [221, 222, 223, 224, 225, 351]
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

function coloringTrend($p)
{
    $b = 0;

    if($p <= 0) {
        $p = -$p;
        $r = 255;
        $g = 255 - log($p) * 60;

        if($g < 0) {
            $g = 0;
        }
    } else {
        $r = 255 - log($p) * 60;
        $g = 255;

        if($r < 0) {
            $r = 0;
        }
    }

    return ['r' => (int) $r, 'g' => (int) $g, 'b' => $b];
}

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

if(array_key_exists($this->request->getAccount()->getId(), $restricted) && in_array($this->request->getReqeust('source'), $restricted[$this->request->getAccount()->getId()])) {
    $source = $this->request->getReqeust('source');
} elseif(array_key_exists($this->request->getAccount()->getId(), $restricted)) {
    $source = $restricted[$this->request->getAccount()->getId()][0];
} else {
    $source = 21;
}

$now    = new \phpOMS\Datatypes\SmartDateTime();
$now1   = $now->createModify(-1);
$now2   = $now->createModify(-2);
$now1m  = $now->createModify(0, -1);
$now2m  = $now->createModify(0, -2);
$now11m = $now->createModify(-1, -1);

?>
<div class="areamanager-report">
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
            <th>A:
            <td>1
            <td>2
            <td>3
        <tr>
            <th>B:
            <td>1
            <td>2
            <td>3
        <tr>
            <th>C:
            <td>1
            <td>2
            <td>3
        <tr>
            <th>D:
            <td>1
            <td>2
            <td>3
        <tr>
            <th>E: (&#8364; &#8804; 1)
            <td>1
            <td>2
            <td>3
    </table>

    <!-- Client new/lost -->
    <table id="areamanager-report-clientmovement">
        <thead>
        <tr>
            <th colspan="2"><?= $lang['ClientMovement']; ?>
                <tbody>
        <tr>
            <th><?= $lang['Type']; ?>
            <th><?= $lang['Value']; ?>
        <tr>
            <th><?= $lang['NewClients']; ?>
                <td>1
        <tr>
            <th><?= $lang['TurnoverNewClients']; ?>
                <td>1.00
        <tr>
            <th><?= $lang['LostClients']; ?>
                <td>1
        <tr>
            <th><?= $lang['TurnoverLostClients']; ?>
            <td>1.00
    </table>

    <!-- Turnover -->
    <div class="reporter-scroll-wrapper">
        <table id="areamanager-report-turnoveroverview">
            <thead>
            <tr>
                <th colspan="16"><?= $lang['TurnoverOverview']; ?>
                    <tbody>
            <tr>
                <th><?= $lang['Type']; ?>
                <th><?= $now2m->format('m'); ?>
                <th><?= $now1->format('Y') . ' ' . $now1m->format('m'); ?>
                <th><?= $now11m->format('m'); ?>
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
                    <?php foreach ($types as $ids) : ?>
            <tr class="reporter-subheadline">
                <th><i class="fa fa-tag"></i> <?= $lang[$ids['title']]; ?>
                <th colspan="15">
                    <?php foreach ($ids['elements'] as $id) : ?>
            <tr>
                <th><?= $id . ' ' . $lang[$id]; ?>
                <td>10,000.00
                <td>10,000.00
                <td>10,000.00
                <td>10,000.00
                <td class="delim">100.00%
                <td class="delim">100.00%
                <td>1,000,000.00
                <td>1,000,000.00
                <td>1,000,000.00
                <td class="delim">100.00%
                <td class="delim">100.00%
                <td>1,000,000.00
                <td>1,000,000.00
                <td>1,000,000.00
                <td style="background: #<?php $color = coloringTrend((int) -1);
                echo str_pad(dechex($color['r']), 2, '0', STR_PAD_LEFT) . str_pad(dechex($color['g']), 2, '0', STR_PAD_LEFT) ?>00">
                    <i class="fa fa-arrow-circle-o-right"
                       style="transform: rotate(<?= (int) rotatingTrend((int) -1) ?>deg)"></i>
                    <?php endforeach; ?>
                    <?php endforeach; ?>
        </table>
    </div>

    <script>
        jsOMS.ready(function () {
            assetManager.load(URL + '/Modules/Reporter/Templates/AreaManager', 'AreaManager.css', 'css');
        });
    </script>
</div>
