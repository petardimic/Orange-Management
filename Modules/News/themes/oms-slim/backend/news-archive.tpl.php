<?php /** @var \Modules\Media\Handler $this */
/** @noinspection PhpUndefinedMethodInspection */
\Framework\Module\ModuleFactory::$loaded['Navigation']->callWeb([\Modules\Navigation\NavigationType::CONTENT, 1000701001]);

\Framework\Model\Model::generate_table_filter_view(); ?>
<table class="t t-1 c4-1 c4" id="i4-1-1">
    <thead>
    <tr>
        <th colspan="3" class="lT">
            <i class="fa fa-filter p f dim"></i>

            <h1><?= $this->app->user->localization->lang[7]['Archive'] ?></h1>
        <th class="rT">
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
    <tr>
        <?php
        \Framework\Model\Model::generate_table_header_view([['name' => $this->app->user->localization->lang[7]['Type'], 'sort' => 1], ['name' => $this->app->user->localization->lang[7]['Title'], 'sort' => 1, 'full' => true], ['name' => $this->app->user->localization->lang[7]['Author'], 'sort' => 0], ['name' => $this->app->user->localization->lang[7]['Date'], 'sort' => 0],]);
        ?>
        <tbody>
        <?php
        /** @var \Modules\News\NewsList $newsList */
        $data           = $newsList->getList();
        $url['level']   = array_slice($this->app->request->request, 0, 3);
        $url['level'][] = 'single';
        $url['id']      = 'NewsID';

        \Framework\Model\Model::generate_table_content_view($data['list'], ['type', 'title', 'name1', 'created'], $url);
        ?>
        <tfoot>
    <tr>
        <td colspan="4" class="cT">
            <?php //\Framework\Model\Model::generate_table_pagination_view($data['count']); ?>
</table>