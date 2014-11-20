<?php /** @var \Modules\EventManager\Handler $this */
\Framework\Module\ModuleFactory::$initialized[1000500000]->show([\Modules\Navigation\NavigationType::CONTENT, 1004201001]);
\Framework\Model\Model::generate_table_filter_view(); ?>

<table class="t t-1 c1-2 c1" id="i1-2-1">
    <thead>
    <tr>
        <th colspan="4" class="lT">
            <i class="fa fa-filter p f dim"></i>

            <h1><?= $this->app->user->localization->lang[42]['EventManagement'] ?></h1>
        <th class="rT">
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
            <tr>
                <?php
                \Framework\Model\Model::generate_table_header_view(
                    [
                        ['name' => $this->app->user->localization->lang[0]['ID'], 'sort' => 1],
                        ['name' => $this->app->user->localization->lang[42]['Title'], 'sort' => 0, 'full' => true],
                        ['name' => $this->app->user->localization->lang[42]['Status'], 'sort' => 0],
                        ['name' => $this->app->user->localization->lang[42]['Start'], 'sort' => 0],
                        ['name' => $this->app->user->localization->lang[42]['End'], 'sort' => 0],
                    ]
                );
                ?>
                <tbody>
                <?php
                /** @var \Modules\Sales\ArticleList $articles */ /*
                $data = $articles->article_list_get();
                $url['level'] = array_slice($this->app->request->uri, 0, 4);
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
        <td colspan="5" class="cT">
            <?php /*\Framework\Model\Model::generate_table_pagination_view($data['count']); */ ?>
</table>