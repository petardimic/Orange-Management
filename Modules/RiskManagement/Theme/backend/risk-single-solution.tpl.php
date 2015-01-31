<?php /** @var \Modules\RiskManagement\Controller $this */
\Framework\Module\ModuleFactory::$loaded['Navigation']->callWeb([\Modules\Navigation\Models\NavigationType::CONTENT,
                                                                 1003001001]);
?>

<div class="b b-1 c30-1 c30 lf" id="i30-1-1">
    <table class="t-1 c1-2 c1 full" id="i1-2-1">
        <thead>
        <tr>
            <th colspan="4" class="lT">
                <i class="fa fa-filter p f dim"></i>

                <h1><?= $this->app->user->getL11n()->lang[30]['Solutions'] ?></h1>
            <th class="rT">
                <i class="fa fa-minus min"></i>
                <i class="fa fa-plus max vh"></i>
                <tr>
                    <?php
                    \Framework\Model\Model::generate_table_header_view(
                        [
                            ['name' => $this->app->user->getL11n()->lang[1]['Status'], 'sort' => 0],
                            ['name' => $this->app->user->getL11n()->lang[0]['ID'], 'sort' => 1],
                            ['name' => $this->app->user->getL11n()->lang[1]['Name'], 'sort' => 0, 'full' => true],
                            ['name' => $this->app->user->getL11n()->lang[1]['Activity'], 'sort' => 0],
                            ['name' => $this->app->user->getL11n()->lang[1]['Created'], 'sort' => 0]
                        ]
                    );
                    ?>
        <tbody>
        <?php
        /** @var \Framework\Object\User\Users $accounts */ /*
                    $data = $accounts->account_list_get();
                    $url['level'] = array_slice($this->app->request->data, 0, 4);
                    $url['level'][] = 'single';
                    $url['level'][] = 'front';
                    $url['id'] = 'id';

                    \Framework\Model\Model::generate_table_content_view(
                        $data['list'],
                        ['status', 'id', 'name1', 'lactive', 'created'],
                        $url
                    );*/
        ?>
    </table>
    <div class="bc-1 rT">
        <button><?= $this->app->user->getL11n()->lang[0]['Add'] ?></button>
        <button><?= $this->app->user->getL11n()->lang[0]['Delete'] ?></button>
    </div>
</div>