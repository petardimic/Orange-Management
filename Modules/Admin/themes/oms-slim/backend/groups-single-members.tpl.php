<?php \Framework\Model\Model::generate_table_filter_view(); ?>

<table class="t t-1 c1-5 c1" id="i1-5-3">
    <thead>
    <tr>
        <th colspan="4" class="lT">
            <i class="fa fa-filter p f dim"></i>

            <h1><?= $this->app->user->localization->lang[1]['Members'] ?></h1>
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