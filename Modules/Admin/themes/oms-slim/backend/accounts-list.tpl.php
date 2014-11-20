<?php /** @var \Modules\Admin\Handler $this */
\Framework\Module\ModuleFactory::$initialized[1000500000]->show([\Modules\Navigation\NavigationType::CONTENT, 1000104001]);
\Framework\Model\Model::generate_table_filter_view(); ?>

<table class="t t-1 c1-2 c1" id="i1-2-1">
    <thead>
    <tr>
        <th colspan="4" class="lT">
            <i class="fa fa-filter p f dim"></i>

            <h1><?= $this->app->user->localization->lang[1]['Accounts'] ?></h1>
        <th class="rT">
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
            <tr>
                <?php
                \Framework\Model\Model::generate_table_header_view(
                    [
                        ['name' => $this->app->user->localization->lang[1]['Status'], 'sort' => 0],
                        ['name' => $this->app->user->localization->lang[0]['ID'], 'sort' => 1],
                        ['name' => $this->app->user->localization->lang[1]['Name'], 'sort' => 0, 'full' => true],
                        ['name' => $this->app->user->localization->lang[1]['Activity'], 'sort' => 0],
                        ['name' => $this->app->user->localization->lang[1]['Created'], 'sort' => 0]
                    ]
                );
                ?>
                <tbody>
                <?php
                /** @var \Framework\DataStorage\Database\Objects\User\Users $accounts */
                $data = $accounts->account_list_get();
                $url['level'] = array_slice($this->app->request->uri, 0, 4);
                $url['level'][] = 'single';
                $url['level'][] = 'front';
                $url['id'] = 'id';

                \Framework\Model\Model::generate_table_content_view(
                    $data['list'],
                    ['status', 'id', 'name1', 'lactive', 'created'],
                    $url
                );
                ?>
                <tfoot>
    <tr>
        <td colspan="5" class="cT">
            <?php \Framework\Model\Model::generate_table_pagination_view($data['count']); ?>
</table>