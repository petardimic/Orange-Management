<?php /** @var \Modules\Purchase\Controller $this */
/** @noinspection PhpUndefinedMethodInspection */
\Framework\Module\ModuleFactory::$loaded['Navigation']->callWeb([\Modules\Navigation\Models\NavigationType::CONTENT,
                                                                 1002102001]);
\Framework\Model\Model::generate_table_filter_view(); ?>

<table class="t t-1 c1-2 c1" id="i1-2-1">
    <thead>
    <tr>
        <th colspan="8" class="lT">
            <i class="fa fa-filter p f dim"></i>

            <h1><?= $this->app->user->getL11n()->lang[21]['Suppliers'] ?></h1>
        <th class="rT">
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
            <tr>
                <?php
                \Framework\Model\Model::generate_table_header_view(
                    [
                        ['name' => $this->app->user->getL11n()->lang[0]['ID'], 'sort' => 1],
                        ['name' => $this->app->user->getL11n()->lang[21]['Matchcode'], 'sort' => 0],
                        ['name' => $this->app->user->getL11n()->lang[21]['Name'], 'sort' => 0, 'full' => true],
                        ['name' => $this->app->user->getL11n()->lang[21]['Street'], 'sort' => 0],
                        ['name' => $this->app->user->getL11n()->lang[21]['City'], 'sort' => 0],
                        ['name' => $this->app->user->getL11n()->lang[21]['ZipCode'], 'sort' => 0],
                        ['name' => $this->app->user->getL11n()->lang[21]['State'], 'sort' => 0],
                        ['name' => $this->app->user->getL11n()->lang[21]['Country'], 'sort' => 0],
                        ['name' => $this->app->user->getL11n()->lang[21]['Area'], 'sort' => 0]
                    ]
                );
                ?>
    <tbody>
    <?php
    /** @var \Modules\Purchase\SupplierList $supplierList */
    $data           = $supplierList->getList();
    $url['level']   = array_slice($this->app->request->getData(), 0, 4);
    $url['level'][] = 'single';
    $url['level'][] = 'front';
    $url['id']      = 'PurchaseSupplierID';

    \Framework\Model\Model::generate_table_content_view(
        $data['list'],
        ['PurchaseSupplierID',
         'matchcode',
         'name1',
         'PurchaseSupplierID',
         'PurchaseSupplierID',
         'PurchaseSupplierID',
         'PurchaseSupplierID',
         'PurchaseSupplierID',
         'PurchaseSupplierID'],
        $url
    );
    ?>
</table>