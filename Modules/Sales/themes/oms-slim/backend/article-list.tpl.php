<?php /** @var \Modules\Sales\Handler $this */
/** @noinspection PhpUndefinedMethodInspection */
\Framework\Module\ModuleFactory::$loaded['Navigation']->callWeb([\Modules\Navigation\NavigationType::CONTENT,
                                                                 1001605001]);
\Framework\Model\Model::generate_table_filter_view(); ?>

<table class="t t-1 c1-2 c1" id="i1-2-1">
    <thead>
    <tr>
        <th colspan="7" class="lT">
            <i class="fa fa-filter p f dim"></i>

            <h1><?= $this->app->user->localization->lang[16]['Articles'] ?></h1>
        <th class="rT">
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
            <tr>
                <?php
                \Framework\Model\Model::generate_table_header_view(
                    [
                        ['name' => $this->app->user->localization->lang[0]['ID'], 'sort' => 1],
                        ['name' => $this->app->user->localization->lang[16]['Matchcode'], 'sort' => 0],
                        ['name' => $this->app->user->localization->lang[16]['Name'], 'sort' => 0, 'full' => true],
                        ['name' => $this->app->user->localization->lang[16]['Available'], 'sort' => 0],
                        ['name' => $this->app->user->localization->lang[16]['Ordered'], 'sort' => 0],
                        ['name' => $this->app->user->localization->lang[16]['Class'], 'sort' => 0],
                        ['name' => $this->app->user->localization->lang[16]['Group'], 'sort' => 0],
                        ['name' => $this->app->user->localization->lang[16]['Subgroup'], 'sort' => 0],
                    ]
                );
                ?>
    <tbody>
    <?php
    /** @var \Modules\Sales\ArticleList $articleList */
    $data           = $articleList->getList();
    $url['level']   = array_slice($this->app->request->request, 0, 4);
    $url['level'][] = 'single';
    $url['level'][] = 'front';
    $url['id']      = 'SalesArticleID';

    \Framework\Model\Model::generate_table_content_view(
        $data['list'],
        ['SalesArticleID',
         'SalesArticleID',
         'SalesArticleID',
         'SalesArticleID',
         'SalesArticleID',
         'class',
         'group',
         'subgroup'],
        $url
    );
    ?>
</table>