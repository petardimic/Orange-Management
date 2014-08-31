<?php /** @var \Modules\Admin\Admin $this */
\Framework\Model\Model::generate_table_filter_view(); ?>

<table class="t t-1 c11-1 c11" id="i11-1-1">
    <thead>
    <tr>
        <th colspan="4" class="lT">
            <i class="fa fa-filter p f dim"></i>

            <h1><?= \Framework\Localization\Localization::$lang[11]['Tasks'] . ' - ' . \Framework\Localization\Localization::$lang[11]['Open']; ?></h1>
        <th class="rT">
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
    <tr>
        <?php
        \Framework\Model\Model::generate_table_header_view(
            [
                ['name' => \Framework\Localization\Localization::$lang[0]['ID'], 'sort' => 1],
                ['name' => \Framework\Localization\Localization::$lang[11]['Priority'], 'sort' => 0],
                ['name' => \Framework\Localization\Localization::$lang[11]['Title'], 'sort' => 0, 'full' => true],
                ['name' => \Framework\Localization\Localization::$lang[11]['Receiver'], 'sort' => 0]
                ['name' => \Framework\Localization\Localization::$lang[11]['Group'], 'sort' => 0]
                ['name' => \Framework\Localization\Localization::$lang[11]['Creator'], 'sort' => 0]
                ['name' => \Framework\Localization\Localization::$lang[11]['Created'], 'sort' => 0]
            ]
        );
        ?>
        <tbody>
        <?php
        /** @var \Framework\Module\Modules $modules */
        $modules_installed = $this->app->modules->module_list_installed_get();
        $url['level'] = array_slice($this->app->request->uri, 0, 4);
        $url['level'][] = 'front';
        $url['id'] = 'class';

        \Framework\Model\Model::generate_table_content_view(
            $modules_installed['list'],
            ['id', 'name', 'theme', 'version'],
            $url
        );
        ?>
</table>

<table class="t t-1 c11-1 c11" id="i11-1-2">
    <thead>
    <tr>
        <th colspan="3" class="lT">
            <i class="fa fa-filter p f dim"></i>

            <h1><?= \Framework\Localization\Localization::$lang[11]['Tasks'] . ' - ' . \Framework\Localization\Localization::$lang[11]['All']; ?></h1>
        <th class="rT">
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
    <tr>
</table>