<?php /** @var \Modules\Sales\Controller $this */
/** @noinspection PhpUndefinedMethodInspection */
\phpOMS\Module\ModuleFactory::$loaded['Navigation']->call([\Modules\Navigation\Models\NavigationType::CONTENT,
                                                           1001604001]);
\phpOMS\Model\Model::generate_table_filter_view(); ?>

<table class="t t-1 c1-2 c1" id="i1-2-1">
    <thead>
    <tr>
        <th colspan="8" class="lT">
            <i class="fa fa-filter p f dim"></i>

            <h1><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[16]['Invoices'] ?></h1>
        <th class="rT">
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
    <tr>
        <?php
        \phpOMS\Model\Model::generate_table_header_view(
            [
                ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['ID'], 'sort' => 1],
                ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang[16]['Date'], 'sort' => 0],
                ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang[16]['Type'], 'sort' => 0],
                ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang[16]['Status'], 'sort' => 0],
                ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang[16]['ClientID'], 'sort' => 0],
                ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang[16]['ClientName'], 'sort' => 0, 'full' => true],
                ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang[16]['Price'], 'sort' => 0],
                ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang[16]['Creator'], 'sort' => 0],
                ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang[16]['Created'], 'sort' => 0],
            ]
        );
        ?>
        <tbody>
        <?php
        /** @var \Modules\Sales\InvoiceList $invoiceList */
        $data           = $invoiceList->getList();
        $url['level']   = array_slice($request->getData(), 0, 4);
        $url['level'][] = 'single';
        $url['level'][] = 'front';
        $url['id']      = 'SalesInvoiceID';

        \phpOMS\Model\Model::generate_table_content_view(
            $data['list'],
            ['SalesInvoiceID', 'printed', 'type', 'status', 'client', 'client', 'price', 'creator', 'created'],
            $url
        );
        ?>
        <tfoot>
    <tr>
        <td colspan="9" class="cT">
            <?php /*\phpOMS\Model\Model::generate_table_pagination_view($data['count']);*/ ?>
</table>