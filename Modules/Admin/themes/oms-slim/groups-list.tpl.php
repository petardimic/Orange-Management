<?php /** @var \Modules\Admin\Admin $this */
\Framework\Module\ModuleFactory::$initialized[1000500000]->show([3, 1000103001]);
\Framework\Model\Model::generate_table_filter_view(); ?>

<table class="t t-1 c1-4 c1" id="i1-4-1">
    <thead>
    <tr>
        <th colspan="4" class="lT">
            <i class="fa fa-cogs p f dim"></i>

            <h1><?= \Framework\Localization\Localization::$lang[1]['Groups'] ?></h1>
        <th class="rT">
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
    <tr>
        <?php
        \Framework\Model\Model::generate_table_header_view(
            [
                ['name' => \Framework\Localization\Localization::$lang[0]['ID'], 'sort' => 1],
                ['name' => \Framework\Localization\Localization::$lang[1]['Name'], 'sort' => 0, 'full' => true],
                ['name' => \Framework\Localization\Localization::$lang[1]['Parents'], 'sort' => -1],
                ['name' => \Framework\Localization\Localization::$lang[1]['Children'], 'sort' => -1],
                ['name' => \Framework\Localization\Localization::$lang[1]['Members'], 'sort' => -1]
            ]
        );
        ?>
    <tbody>
    <?php
    /** @var \Framework\DataStorage\Database\Objects\Group\Groups $groups */
    $data = $groups->group_list_get();
    $url['level'] = array_slice($this->app->request->uri, 0, 4);
    $url['level'][] = 'single';
    $url['level'][] = 'front';
    $url['id'] = 'id';

    \Framework\Model\Model::generate_table_content_view(
        $data['list'],
        ['id', 'name', 'id', 'id', 'id'],
        $url
    );
    ?>
    <tfoot>
    <tr>
        <td colspan="5" class="cT">
            <?php \Framework\Model\Model::generate_table_pagination_view($data['count']); ?>
</table>