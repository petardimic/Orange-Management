<?php
$restricted = [

];

$types = [
    [
        'title'    => 'IMPLA',
        'elements' => [161, 162]
    ],
];

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
        <th rowspan="3"><?= $lang['ClientRating']; ?>
            <tbody>
    <tr>
        <th><?= $lang['Rating']; ?>
        <th><?= $now2->format('Y'); ?>
        <th><?= $now1->format('Y'); ?>
        <th><?= $now->format('Y'); ?>
    <tr>
        <th>A<td>1<td>2<td>3
    <tr>
        <th>B<td>1<td>2<td>3
    <tr>
        <th>C<td>1<td>2<td>3
    <tr>
        <th>D<td>1<td>2<td>3
    <tr>
        <th>E<td>1<td>2<td>3
</table>

<!-- Client new/lost -->
<table>
    <thead>
    <tr>
        <th rowspan="2"><?= $lang['ClientMovement']; ?>
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
<table>
    <thead>
    <tr>
        <th rowspan="16"><?= ['TurnoverOverview']; ?>
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
        <th rowspan="16"><?= $lang[$ids['title']]; ?>
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
        <td><i class="fa-arrow-circle-o-right"></i>
            <?php endforeach; ?>
            <?php endforeach; ?>
    <tr>
</table>