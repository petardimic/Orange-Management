<?php /** @var \Modules\Admin\Controller $this */
\phpOMS\Module\ModuleFactory::$loaded['Navigation']->call([\Modules\Navigation\Models\NavigationType::CONTENT,
                                                           1000801001]);
\phpOMS\Model\Model::generate_table_filter_view(); ?>

<table class="t t-1 c1-2 c1" id="i1-2-1">
    <thead>
    <tr>
        <th colspan="3" class="lT">
            <i class="fa fa-filter p f dim"></i>

            <h1><?= $this->app->user->getL11n()->lang[8]['Surveys'] ?></h1>
        <th class="rT">
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
    <tr>
        <?php
        \phpOMS\Model\Model::generate_table_header_view(
            [
                ['name' => $this->app->user->getL11n()->lang[0]['ID'], 'sort' => 1],
                ['name' => $this->app->user->getL11n()->lang[8]['Title'], 'sort' => 0, 'full' => true],
                ['name' => $this->app->user->getL11n()->lang[8]['Start'], 'sort' => 0],
                ['name' => $this->app->user->getL11n()->lang[8]['End'], 'sort' => 0],
            ]
        );
        ?>
        <tbody>
        <?php
        /** @var \Modules\Sales\ArticleList $articles */ /*
                $data = $articles->article_list_get();
                $url['level'] = array_slice($request->getData(), 0, 4);
                $url['level'][] = 'single';
                $url['level'][] = 'front';
                $url['id'] = 'id';

                \phpOMS\Model\Model::generate_table_content_view(
                    $data['list'],
                    ['status', 'id', 'name1', 'lactive', 'created'],
                    $url
                );*/
        ?>
        <tfoot>
    <tr>
        <td colspan="4" class="cT">
            <?php /*\phpOMS\Model\Model::generate_table_pagination_view($data['count']); */ ?>
</table>