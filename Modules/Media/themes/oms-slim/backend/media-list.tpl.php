<?php /** @var \Modules\Media\Handler $this */
\Framework\Module\ModuleFactory::$loaded['Navigation']->callWeb([\Modules\Navigation\NavigationType::CONTENT, 1000401001]);
\Framework\Model\Model::generate_table_filter_view(); ?>

<table class="t t-1 c4-1 c4" id="i4-1-1">
    <thead>
    <tr>
        <th colspan="4" class="lT">
            <i class="fa fa-filter p f dim"></i>

            <h1><?= $this->app->user->localization->lang[4]['Media'] ?></h1>
        <th class="rT">
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
    <tr>
        <?php
        \Framework\Model\Model::generate_table_header_view(
            [
                ['name' => $this->app->user->localization->lang[4]['Name'], 'sort' => 1, 'full' => true],
                ['name' => $this->app->user->localization->lang[4]['Type'], 'sort' => 0],
                ['name' => $this->app->user->localization->lang[4]['Size'], 'sort' => 0],
                ['name' => $this->app->user->localization->lang[4]['Created'], 'sort' => 0],
                ['name' => $this->app->user->localization->lang[4]['Owner'], 'sort' => 0],
            ]
        );
        ?>
        <tbody>
        <tfoot>
    <tr>
        <td colspan="5" class="cT">
            <?php //\Framework\Model\Model::generate_table_pagination_view($data['count']); ?>
</table>