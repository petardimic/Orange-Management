<?php
$lang = $this->getData('lang');

$restricted = [

];

$types = [
    [
        'title'    => 'IMPLA',
        'elements' => [161, 162]
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
<!-- Client rating -->
<table>
    <thead>
    <tr>
        <th colspan="3"><?= $lang['ClientRating']; ?>
            <tbody>
    <tr>
        <th><?= $lang['Rating']; ?>
        <th><?= $now2->format('Y'); ?>
        <th><?= $now1->format('Y'); ?>
        <th><?= $now->format('Y'); ?>
    <tr>
        <th>A
        <td>1
        <td>2
        <td>3
    <tr>
        <th>B
        <td>1
        <td>2
        <td>3
    <tr>
        <th>C
        <td>1
        <td>2
        <td>3
    <tr>
        <th>D
        <td>1
        <td>2
        <td>3
    <tr>
        <th>E
        <td>1
        <td>2
        <td>3
</table>

<!-- Client new/lost -->
<table>
    <thead>
    <tr>
        <th colspan="2"><?= $lang['ClientMovement']; ?>
            <tbody>
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
<!--
-45 = -100%
+45 = > 100%
-->
<table>
    <thead>
    <tr>
        <th colspan="16"><?= $lang['TurnoverOverview']; ?>
            <tbody>
    <tr>
        <th><?= $lang['Type']; ?>
        <th><?= ($now2m->format('m')) ?>
        <th><?= ($now1m->format('m')) ?>
        <th><?= ($now11m->format('m')) ?>
        <th><?= ($now->format('m')) ?>
        <th><?= $lang['Diff']; ?>
        <th><?= $lang['DiffP']; ?>
        <th><?= ($now2->format('m')) ?>
        <th><?= ($now1->format('m')) ?>
        <th><?= ($now->format('m')) ?>
        <th><?= $lang['Diff']; ?>
        <th><?= $lang['DiffP']; ?>
        <th><?= ($now2->format('Y')) ?>
        <th><?= ($now1->format('Y')) ?>
        <th><?= ($now->format('Y')) ?>
        <th><?= $lang['Trend']; ?>
            <?php foreach ($types as $ids) : ?>
    <tr>
        <th colspan="16"><?= $lang[$ids['title']]; ?>
            <?php foreach ($ids['elements'] as $id) : ?>
    <tr>
        <th><?= $id . ' ' . $lang[$id]; ?>
        <td>
        <td>
        <td>
        <td>
        <td>
        <td>
        <td>
        <td>
        <td>
        <td>
        <td>
        <td>
        <td>
        <td>
        <td><i class="fa fa-arrow-circle-o-right"
               style="transform: rotate(<?= rotatingTrend((int) 1) ?>deg); color: #<?php $color = coloringTrend((int) 1);
               echo str_pad(dechex($color['r']), 2, '0', STR_PAD_LEFT) . str_pad(dechex($color['g']), 2, '0', STR_PAD_LEFT) ?>00"></i>
            <?php endforeach; ?>
            <?php endforeach; ?>
    <tr>
</table>