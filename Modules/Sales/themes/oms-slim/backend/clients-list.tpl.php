<?php /** @var \Modules\Admin\Admin $this */
\Framework\Module\ModuleFactory::$initialized[1000500000]->show([\Modules\Navigation\NavigationType::CONTENT, 1001602001]);
\Framework\Model\Model::generate_table_filter_view(); ?>

<table class="t t-1 c1-2 c1" id="i1-2-1">
    <thead>
    <tr>
        <th colspan="7" class="lT">
            <i class="fa fa-filter p f dim"></i>

            <h1><?= \Framework\Localization\Localization::$lang[16]['Clients'] ?></h1>
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
                        ['name' => \Framework\Localization\Localization::$lang[16]['Street'], 'sort' => 0],
                        ['name' => \Framework\Localization\Localization::$lang[16]['City'], 'sort' => 0],
                        ['name' => \Framework\Localization\Localization::$lang[16]['ZipCode'], 'sort' => 0],
                        ['name' => \Framework\Localization\Localization::$lang[16]['State'], 'sort' => 0],
                        ['name' => \Framework\Localization\Localization::$lang[16]['Country'], 'sort' => 0]
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
                    ['id', 'name1', 'lactive', 'created', 'id', 'id', 'id', 'id'],
                    $url
                );*/
                ?>
                <tfoot>
    <tr>
        <td colspan="8" class="cT">
            <?php /*\Framework\Model\Model::generate_table_pagination_view($data['count']);*/ ?>
</table>