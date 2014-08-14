<?php /** @var \Modules\Admin\Admin $this */
\Framework\Model\Model::generate_table_filter_view(); ?>

<table class="t t-1 c1-6 c1" id="i1-6-1">
    <thead>
    <tr>
        <th colspan="4" class="lT">
            <i class="fa fa-cogs p f dim"></i>

            <h1><?= \Framework\Localization\Localization::$lang[1]['Modules'] . ' - ' . \Framework\Localization\Localization::$lang[1]['Installed']; ?></h1>
        </th>
        <th class="rT">
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </th>
    </tr>
    <tr>
        <?php
        \Framework\Model\Model::generate_table_header_view(
            [
                ['name' => \Framework\Localization\Localization::$lang[0]['ID'], 'sort' => 1],
                ['name' => \Framework\Localization\Localization::$lang[1]['Name'], 'sort' => 0, 'full' => true],
                ['name' => \Framework\Localization\Localization::$lang[1]['Theme'], 'sort' => 0],
                ['name' => \Framework\Localization\Localization::$lang[1]['Version'], 'sort' => -1]
            ]
        );
        ?>
    </tr>
    </thead>
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
    </tbody>
</table>

<table class="t t-1 c1-6 c1" id="i1-6-2">
    <thead>
    <tr>
        <th colspan="3" class="lT">
            <i class="fa fa-cogs p f dim"></i>

            <h1><?= \Framework\Localization\Localization::$lang[1]['Modules'] . ' - ' . \Framework\Localization\Localization::$lang[1]['All']; ?></h1>
        </th>
        <th class="rT">
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </th>
    </tr>
    <tr>
        <?php
        \Framework\Model\Model::generate_table_header_view(
            [
                ['name' => \Framework\Localization\Localization::$lang[0]['ID'], 'sort' => 1],
                ['name' => \Framework\Localization\Localization::$lang[1]['Name'], 'sort' => 0, 'full' => true],
                ['name' => \Framework\Localization\Localization::$lang[1]['Theme'], 'sort' => 0],
                ['name' => \Framework\Localization\Localization::$lang[1]['Version'], 'sort' => -1]
            ]
        );
        ?>
    </tr>
    </thead>
    <tbody>
    <?php
    $modules_all = $this->app->modules->module_list_all_get();
    $url['level'] = array_slice($this->app->request->uri, 0, 4);
    $url['level'][] = 'front';

    foreach ($modules_all as $ele) {
        $url_t = $this->app->request->generate_uri($url['level'], [['id', $ele['class']]]);

        if (!array_key_exists($ele['name']['internal'], $this->app->modules->modules_installed_get())) {
            echo '<tr>'
                . '<td><a href="' . $url_t . '">' . $ele['name']['internal'] . '</a></td>'
                . '<td><a href="' . $url_t . '">' . $ele['name']['external'] . '</a></td>'
                . '<td><a href="' . $url_t . '">' . $ele['theme']['name'] . '</a></td>'
                . '<td><a href="' . $url_t . '">' . $ele['version'] . '</a></td>'
                . '</tr>';
        }
    }
    ?>
    </tbody>
</table>