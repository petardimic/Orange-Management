<?php /** @var \Modules\Sales\Handler $this */
\Framework\Module\ModuleFactory::$initialized[1000500000]->show([\Modules\Navigation\NavigationType::CONTENT, 1001605001]);
\Framework\Model\Model::generate_table_filter_view(); ?>

<table class="t t-1 c1-2 c1" id="i1-2-1">
    <thead>
    <tr>
        <th colspan="8" class="lT">
            <i class="fa fa-filter p f dim"></i>

            <h1><?= \Framework\Localization\Localization::$lang[16]['Articles'] ?></h1>
        <th class="rT">
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
            <tr>
                <?php
                \Framework\Model\Model::generate_table_header_view(
                    [
                        ['name' => \Framework\Localization\Localization::$lang[0]['ID'], 'sort' => 1],
                        ['name' => \Framework\Localization\Localization::$lang[16]['Matchcode'], 'sort' => 0],
                        ['name' => \Framework\Localization\Localization::$lang[16]['Name'], 'sort' => 0, 'full' => true],
                        ['name' => \Framework\Localization\Localization::$lang[16]['Available'], 'sort' => 0],
                        ['name' => \Framework\Localization\Localization::$lang[16]['Ordered'], 'sort' => 0],
                        ['name' => \Framework\Localization\Localization::$lang[16]['Stock'], 'sort' => 0],
                        ['name' => \Framework\Localization\Localization::$lang[16]['Class'], 'sort' => 0],
                        ['name' => \Framework\Localization\Localization::$lang[16]['Group'], 'sort' => 0],
                        ['name' => \Framework\Localization\Localization::$lang[16]['Subgroup'], 'sort' => 0],
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
        <td colspan="9" class="cT">
            <?php /*\Framework\Model\Model::generate_table_pagination_view($data['count']); */ ?>
</table>