<?php \phpOMS\Model\Model::generate_table_filter_view(); ?>

<table class="t t-1 c1-5 c1" id="i1-5-3">
    <thead>
    <tr>
        <th colspan="4" class="lT">
            <i class="fa fa-filter p f dim"></i>

            <h1><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[1]['Members'] ?></h1>
        <th class="rT">
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
    <tr>
        <?php
        \phpOMS\Model\Model::generate_table_header_view(
            [
                ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang[1]['Status'], 'sort' => 0],
                ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['ID'], 'sort' => 1],
                ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang[1]['Name'], 'sort' => 0, 'full' => true],
                ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang[1]['Activity'], 'sort' => 0],
                ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang[1]['Created'], 'sort' => 0]
            ]
        );
        ?>
        <tbody>
        <?php
        /** @var \Modules\Admin\UserList $accounts */
        $data           = $accounts->getList();
        $url['level']   = array_slice($request->getData(), 0, 4);
        $url['level'][] = 'single';
        $url['id']      = 'id';

        \phpOMS\Model\Model::generate_table_content_view(
            $data['list'],
            ['status', 'id', 'name1', 'lactive', 'created'],
            $url
        );
        ?>
        <tfoot>
    <tr>
        <td colspan="5" class="cT">
            <?php \phpOMS\Model\Model::generate_table_pagination_view($data['count']); ?>
</table>