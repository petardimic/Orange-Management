<?php /** @var \Modules\Admin\Handler $this */
\Framework\Model\Model::generate_table_filter_view(); ?>

<table class="t t-1 c1-6 c1" id="i1-6-1">
    <thead>
    <tr>
        <th colspan="4" class="lT">
            <i class="fa fa-filter p f dim"></i>

            <h1><?= $this->app->user->localization->lang[1]['Modules'] . ' - ' . $this->app->user->localization->lang[1]['Installed']; ?></h1>
        <th class="rT">
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
    <tr>
        <?php
        \Framework\Model\Model::generate_table_header_view(
            [
                ['name' => $this->app->user->localization->lang[0]['ID'], 'sort' => 1],
                ['name' => $this->app->user->localization->lang[1]['Name'], 'sort' => 0, 'full' => true],
                ['name' => $this->app->user->localization->lang[1]['Theme'], 'sort' => 0],
                ['name' => $this->app->user->localization->lang[1]['Version'], 'sort' => -1]
            ]
        );
        ?>
        <tbody>
        <?php
        /** @var \Framework\Module\Modules $modules */
        $modules_installed = $this->app->modules->getInstalledModules();
        $url['level'] = array_slice($this->app->request->request, 0, 4);
        $url['level'][] = 'front';
        $url['id'] = 'class';

        //var_dump($modules_installed);

        \Framework\Model\Model::generate_table_content_view(
            $modules_installed,
            ['id', 'name', 'theme', 'version'],
            $url
        );
        ?>
</table>

<table class="t t-1 c1-6 c1" id="i1-6-2">
    <thead>
    <tr>
        <th colspan="3" class="lT">
            <i class="fa fa-filter p f dim"></i>

            <h1><?= $this->app->user->localization->lang[1]['Modules'] . ' - ' . $this->app->user->localization->lang[1]['All']; ?></h1>
        <th class="rT">
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
    <tr>
        <?php
        \Framework\Model\Model::generate_table_header_view(
            [
                ['name' => $this->app->user->localization->lang[0]['ID'], 'sort' => 1],
                ['name' => $this->app->user->localization->lang[1]['Name'], 'sort' => 0, 'full' => true],
                ['name' => $this->app->user->localization->lang[1]['Theme'], 'sort' => 0],
                ['name' => $this->app->user->localization->lang[1]['Version'], 'sort' => -1]
            ]
        );
        ?>
        <tbody>
        <?php
        $modules_all = $this->app->modules->getAllModules();
        $url['level'] = array_slice($this->app->request->request, 0, 4);
        $url['level'][] = 'front';

        foreach ($modules_all as $ele) {
            $url_t = \Framework\Uri\UriFactory::build($url['level'], [['id', $ele['class']]]);

            if (!array_key_exists($ele['name']['internal'], $modules_installed)) {
                echo '<tr>'
                    . '<td><a href="' . $url_t . '">' . $ele['name']['internal'] . '</a>'
                    . '<td><a href="' . $url_t . '">' . $ele['name']['external'] . '</a>'
                    . '<td><a href="' . $url_t . '">' . $ele['theme']['name'] . '</a>'
                    . '<td><a href="' . $url_t . '">' . $ele['version'] . '</a>';
            }
        }
        ?>
</table>