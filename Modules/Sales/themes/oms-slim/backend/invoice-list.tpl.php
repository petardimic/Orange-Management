<?php /** @var \Modules\Sales\Handler $this */
/** @noinspection PhpUndefinedMethodInspection */
\Framework\Module\ModuleFactory::$loaded['Navigation']->callWeb([\Modules\Navigation\NavigationType::CONTENT,
                                                                 1001604001]);
\Framework\Model\Model::generate_table_filter_view(); ?>

<table class="t t-1 c1-2 c1" id="i1-2-1">
    <thead>
    <tr>
        <th colspan="8" class="lT">
            <i class="fa fa-filter p f dim"></i>

            <h1><?= $this->app->user->localization->lang[16]['Invoices'] ?></h1>
        <th class="rT">
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
    <tr>
        <?php
        \Framework\Model\Model::generate_table_header_view(
            [
                ['name' => $this->app->user->localization->lang[0]['ID'], 'sort' => 1],
                ['name' => $this->app->user->localization->lang[16]['Date'], 'sort' => 0],
                ['name' => $this->app->user->localization->lang[16]['Type'], 'sort' => 0],
                ['name' => $this->app->user->localization->lang[16]['Status'], 'sort' => 0],
                ['name' => $this->app->user->localization->lang[16]['ClientID'], 'sort' => 0],
                ['name' => $this->app->user->localization->lang[16]['ClientName'], 'sort' => 0, 'full' => true],
                ['name' => $this->app->user->localization->lang[16]['Price'], 'sort' => 0],
                ['name' => $this->app->user->localization->lang[16]['Creator'], 'sort' => 0],
                ['name' => $this->app->user->localization->lang[16]['Created'], 'sort' => 0],
            ]
        );
        ?>
        <tbody>
        <?php
        /** @var \Modules\Sales\InvoiceList $invoiceList */
        $data           = $invoiceList->getList();
        $url['level']   = array_slice($this->app->request->request, 0, 4);
        $url['level'][] = 'single';
        $url['level'][] = 'front';
        $url['id']      = 'SalesInvoiceID';

        \Framework\Model\Model::generate_table_content_view(
            $data['list'],
            ['SalesInvoiceID', 'printed', 'type', 'status', 'client', 'client', 'price', 'creator', 'created'],
            $url
        );
        ?>
        <tfoot>
    <tr>
        <td colspan="9" class="cT">
            <?php /*\Framework\Model\Model::generate_table_pagination_view($data['count']);*/ ?>
</table>