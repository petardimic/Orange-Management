<?php include __DIR__ . '/Worker.php'; ?>

<div class="b b-1">
    <h1><?= $lang['Company']; ?></h1>

    <div>
        <form method="post"
              action="<?= $this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost() . \phpOMS\Uri\UriFactory::build([$this->l11n->getLanguage(),
                                                                                                                                               'api',
                                                                                                                                               'reporter',
                                                                                                                                               'single'], ['id' => $this->request->getData('id')]) ?>">
            <ul class="l-1">
                <li><label for="i-areamanager"><?= $lang['Company']; ?></label>:
                    <select name="i-areamanager" id="i-areamanager">
                        <option value="-1" selected disabled><?= $lang['Select']; ?>
                            <?php foreach ($companies as $company): ?>
                        <option value="<?= $company; ?>"<?= $company === $source ? ' selected' : ''; ?>><?= $company; ?>
                            <?php endforeach; ?>
                    </select>
                <li><label
                        for="i-areamanager"><?= $lang['Status']; ?></label>: <?= abs($sum_countries - $sum_accounts) < 0.01 && abs($sum_unknown - $countries['???']) < 0.01 ? 'OK' : 'NOK'; ?>
            </ul>
        </form>
    </div>
</div>

<div class="b b-3">
    <h1><?= $lang['Unassigned']; ?></h1>

    <div class="bc-1">
        <table class="tc-1">
            <?php foreach($unknown as $key => $uk) : if($uk !== false) : ?>
                <tr>
                    <th><?= $uk[10]; ?>
                    <td><?= number_format((float) $uk[4] - (float) $uk[3], 2, ',', '.'); ?>
                    <td><?= $uk[11]; ?>
                    <td><?= $uk[0]; ?>
                </tr>
            <?php endif;
            endforeach; ?>
            <tr>
                <th><?= $lang['Sum']; ?>
                <td colspan="3"><strong><?= number_format($sum_unknown, 2, ',', '.'); ?></strong>
        </table>
    </div>
</div>

<div class="b b-2">
    <h1><?= $lang['SalesByCountry']; ?></h1>

    <div class="bc-1">
        <table class="tc-1">
            <?php foreach ($countries as $d2 => $sales) : if ($sales != 0.0) : ?>
            <tr>
                <th><?= array_search($d2, $cc); ?>
                    <td><?= number_format($sales, 2, ',', '.'); ?>
                        <th><?= $d2; ?>
                            <?php endif;
                            endforeach; ?>
            <tr>
                <th><?= $lang['Sum']; ?>
                <td colspan="2"><strong><?= number_format($sum_countries, 2, ',', '.'); ?></strong>
        </table>
    </div>
</div>

<div class="b b-2">
    <h1><?= $lang['SalesByAccount']; ?></h1>

    <div class="bc-1">
        <table class="tc-1">
            <?php foreach ($accounts as $d2 => $sales) : if ($sales != 0.0) : ?>
            <tr>
                <th><?= $d2; ?>
                    <td><?= number_format($sales, 2, ',', '.'); ?>
                        <?php endif;
                        endforeach; ?>
            <tr>
                <th><?= $lang['Sum']; ?>
                <td><strong><?= number_format($sum_accounts, 2, ',', '.'); ?></strong>
        </table>
    </div>
</div>