<?php /** @var \Modules\Warehousing\Controller $this */
\phpOMS\Model\Model::generate_table_filter_view(); ?>

<div class="b-7" id="i3-2-1">
</div>
<div class="b-6">
    <table class="t t-1 c27-1 c27" id="i27-1-1">
        <thead>
        <tr>
            <th colspan="6" class="lT">
                <i class="fa fa-filter p f dim"></i>

                <h1><?= $this->app->user->getL11n()->lang[27]['Articles']; ?></h1>
            <th class="rT">
                <i class="fa fa-minus min"></i>
                <i class="fa fa-plus max vh"></i>
                <tr>
                    <?php
                    \phpOMS\Model\Model::generate_table_header_view(
                        [
                            ['name' => $this->app->user->getL11n()->lang[0]['ID'], 'sort' => 1],
                            ['name' => $this->app->user->getL11n()->lang[27]['Matchcode'], 'sort' => 0],
                            ['name' => $this->app->user->getL11n()->lang[27]['Name'], 'sort' => 0],
                            ['name' => $this->app->user->getL11n()->lang[27]['Description'],
                             'sort' => 0,
                             'full' => true],
                            ['name' => $this->app->user->getL11n()->lang[27]['Amount'], 'sort' => 0],
                            ['name' => $this->app->user->getL11n()->lang[27]['Stock'], 'sort' => 0],
                            ['name' => $this->app->user->getL11n()->lang[27]['Location'], 'sort' => 0],
                        ]
                    );
                    ?>
        <tbody>
        <?php
        /** @var \phpOMS\Module\Modules $modules */ /*
        $modules_installed = $this->app->modules->module_list_installed_get();
        $url['level'] = array_slice($request->getData(), 0, 4);
        $url['level'][] = 'front';
        $url['id'] = 'class';

        \phpOMS\Model\Model::generate_table_content_view(
            $modules_installed['list'],
            ['id', 'name', 'theme', 'version'],
            $url
        );*/
        ?>
    </table>
</div>