<?php /** @var \Modules\Profile\Controller $this */
\Framework\Model\Model::generate_table_filter_view(); ?>

<table class="t t-1 c1-2 c1" id="i1-2-1">
    <thead>
    <tr>
        <th colspan="4" class="lT">
            <i class="fa fa-filter p f dim"></i>

            <h1><?= $this->app->user->getL11n()->lang[1]['Accounts'] ?></h1>
        <th class="rT">
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
    <tr>
        <?php
        \Framework\Model\Model::generate_table_header_view(
            [
                ['name' => $this->app->user->getL11n()->lang[1]['Status'], 'sort' => 0],
                ['name' => $this->app->user->getL11n()->lang[0]['ID'], 'sort' => 1],
                ['name' => $this->app->user->getL11n()->lang[1]['Name'], 'sort' => 0, 'full' => true],
                ['name' => $this->app->user->getL11n()->lang[1]['Activity'], 'sort' => 0],
                ['name' => $this->app->user->getL11n()->lang[1]['Created'], 'sort' => 0]
            ]
        );
        ?>
        <tbody>
        <?php
        /** @var \Modules\Profile\ProfileList $accounts */
        $data           = $accounts->getList();
        $url['level']   = array_slice($request->getData(), 0, 3);
        $url['level'][] = 'single';
        $url['level'][] = 'front';
        $url['id']      = 'id';

        \Framework\Model\Model::generate_table_content_view(
            $data['list'],
            ['status', 'id', 'name1', 'lactive', 'created'],
            $url,
            ['status' => [
                0 => '<span class="green">' . $this->app->user->getL11n()->lang[3]['OFF'] . '</span>',
                1 => '<span class="green">' . $this->app->user->getL11n()->lang[3]['ON'] . '</span>',
            ]]
        );
        ?>
        <tfoot>
    <tr>
        <td colspan="5" class="cT">
            <?php \Framework\Model\Model::generate_table_pagination_view($data['count']); ?>
</table>