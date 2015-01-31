<?php /** @var \Modules\RiskManagement\Controller $this */
\Framework\Model\Model::generate_table_filter_view();
\Framework\Module\ModuleFactory::$loaded['Navigation']->callWeb([\Modules\Navigation\Models\NavigationType::CONTENT,
                                                                 1003001001]);
?>

<table class="t t-1 c1-2 c1" id="i1-2-1">
    <thead>
    <tr>
        <th colspan="8" class="lT">
            <i class="fa fa-filter p f dim"></i>

            <h1><?= $this->app->user->getL11n()->lang[30]['Solutions'] ?></h1>
        <th class="rT">
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
    <tr>
        <?php
        \Framework\Model\Model::generate_table_header_view(
            [
                ['name' => '', 'sort' => 0],
                ['name' => $this->app->user->getL11n()->lang[0]['ID'], 'sort' => 1],
                ['name' => $this->app->user->getL11n()->lang[30]['Name'], 'sort' => 0, 'full' => true],
                ['name' => $this->app->user->getL11n()->lang[30]['Parent'], 'sort' => 0],
                ['name' => $this->app->user->getL11n()->lang[30]['Risk'], 'sort' => 0],
                ['name' => $this->app->user->getL11n()->lang[30]['Protection'], 'sort' => 0],
                ['name' => $this->app->user->getL11n()->lang[30]['Probability'], 'sort' => 0],
                ['name' => $this->app->user->getL11n()->lang[30]['Cost'], 'sort' => 0],
                ['name' => $this->app->user->getL11n()->lang[30]['Active'], 'sort' => 0],
            ]
        );
        ?>
        <tbody>
        <?php
        /** @var \Framework\Object\User\Users $accounts */ /*
                $data = $accounts->account_list_get();
                $url['level'] = array_slice($this->app->request->data, 0, 4);
                $url['level'][] = 'single';
                $url['level'][] = 'front';
                $url['id'] = 'id';

                \Framework\Model\Model::generate_table_content_view(
                    $data['list'],
                    ['status', 'id', 'name1', 'lactive', 'created'],
                    $url
                );*/
        ?>
        <tfoot>
    <tr>
        <td colspan="9" class="cT">
            <?php //\Framework\Model\Model::generate_table_pagination_view($data['count']); ?>
</table>