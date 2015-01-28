<?php /** @var \Modules\Purchase\Controller $this */
/** @noinspection PhpUndefinedMethodInspection */
\Framework\Module\ModuleFactory::$loaded['Navigation']->callWeb([\Modules\Navigation\Models\NavigationType::CONTENT,
                                                                 1002104001]);
\Framework\Model\Model::generate_table_filter_view(); ?>

<table class="t t-1 c1-2 c1" id="i1-2-1">
    <thead>
    <tr>
        <th colspan="8" class="lT">
            <i class="fa fa-filter p f dim"></i>

            <h1><?= $this->app->user->localization->lang[21]['Invoices'] ?></h1>
        <th class="rT">
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
    <tr>
        <?php
        \Framework\Model\Model::generate_table_header_view(
            [
                ['name' => $this->app->user->localization->lang[0]['ID'], 'sort' => 1],
                ['name' => $this->app->user->localization->lang[21]['Date'], 'sort' => 0],
                ['name' => $this->app->user->localization->lang[21]['Type'], 'sort' => 0],
                ['name' => $this->app->user->localization->lang[21]['Status'], 'sort' => 0],
                ['name' => $this->app->user->localization->lang[21]['SupplierID'], 'sort' => 0],
                ['name' => $this->app->user->localization->lang[21]['SupplierName'], 'sort' => 0, 'full' => true],
                ['name' => $this->app->user->localization->lang[21]['Price'], 'sort' => 0],
                ['name' => $this->app->user->localization->lang[21]['Creator'], 'sort' => 0],
                ['name' => $this->app->user->localization->lang[21]['Created'], 'sort' => 0],
            ]
        );
        ?>
        <tbody>
        <?php
        /** @var \Modules\Purchase\InvoiceList $invoiceList */
        $data           = $invoiceList->getList();
        $url['level']   = array_slice($this->app->request->data, 0, 4);
        $url['level'][] = 'single';
        $url['level'][] = 'front';
        $url['id']      = 'PurchaseInvoiceID';

        \Framework\Model\Model::generate_table_content_view(
            $data['list'],
            ['PurchaseInvoiceID', 'printed', 'type', 'status', 'supplier', 'supplier', 'price', 'creator', 'created'],
            $url
        );
        ?>
        <tfoot>
    <tr>
        <td colspan="9" class="cT">
            <?php /*\Framework\Model\Model::generate_table_pagination_view($data['count']);*/ ?>
</table>