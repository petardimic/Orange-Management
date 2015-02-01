<?php /** @var \Modules\Production\Controller $this */
/** @noinspection PhpUndefinedMethodInspection */
\Framework\Module\ModuleFactory::$loaded['Navigation']->call(\Framework\Module\CallType::WEB, [\Modules\Navigation\Models\NavigationType::CONTENT,
                                                                 1000401001]);
\Framework\Model\Model::generate_table_filter_view(); ?>

<table class="t t-1 c4-1 c4" id="i4-1-1">
    <thead>
    <tr>
        <th colspan="7" class="lT">
            <i class="fa fa-filter p f dim"></i>

            <h1><?= $this->app->user->getL11n()->lang[20]['Process'] ?></h1>
        <th class="rT">
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
    <tr>
        <?php
        \Framework\Model\Model::generate_table_header_view(
            [
                ['name' => $this->app->user->getL11n()->lang[20]['Status'], 'sort' => 1],
                ['name' => $this->app->user->getL11n()->lang[20]['Product'], 'sort' => 0],
                ['name' => $this->app->user->getL11n()->lang[20]['Name'], 'sort' => 0, 'full' => true],
                ['name' => $this->app->user->getL11n()->lang[20]['Quantity'], 'sort' => 0],
                ['name' => $this->app->user->getL11n()->lang[20]['For'], 'sort' => 0],
                ['name' => $this->app->user->getL11n()->lang[20]['Orderer'], 'sort' => 0],
                ['name' => $this->app->user->getL11n()->lang[20]['Ordered'], 'sort' => 0],
                ['name' => $this->app->user->getL11n()->lang[20]['Due'], 'sort' => 0],
            ]
        );
        ?>
        <tbody>
        <?php
        /** @var \Modules\Production\ProductionList $pList */
        $data           = $pList->getList();
        $url['level']   = array_slice($this->app->request->getData(), 0, 4);
        $url['level'][] = 'single';
        $url['level'][] = 'front';
        $url['id']      = 'ProcessID';

        \Framework\Model\Model::generate_table_content_view(
            $data['list'],
            ['status', 'product', 'product', 'quantity', 'for', 'orderer', 'ordered', 'due'],
            $url
        );
        ?>
        <tfoot>
    <tr>
        <td colspan="8" class="cT">
            <?php //\Framework\Model\Model::generate_table_pagination_view($data['count']); ?>
</table>