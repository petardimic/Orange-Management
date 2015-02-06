<?php /** @var \Modules\Media\Controller $this */
/** @noinspection PhpUndefinedMethodInspection */
\Framework\Module\ModuleFactory::$loaded['Navigation']->call(\Framework\Module\CallType::WEB, [\Modules\Navigation\Models\NavigationType::CONTENT,
                                                                 1000701001]); ?>

<div class="b-2 c7-2 c7 lf" id="i7-2-1">
    <table class="t t-1 c4-1 c4" id="i4-1-1">
        <thead>
        <tr>
            <th colspan="3" class="lT">
                <h1><?= $this->app->user->getL11n()->lang[7]['News'] ?></h1>
            <th class="rT">
                <i class="fa fa-minus min"></i>
                <i class="fa fa-plus max vh"></i>
                <tr>
                    <?php
                    \Framework\Model\Model::generate_table_header_view([['name' => $this->app->user->getL11n()->lang[7]['Type'],
                                                                         'sort' => -1],
                                                                        ['name' => $this->app->user->getL11n()->lang[7]['Title'],
                                                                         'sort' => -1,
                                                                         'full' => true],
                                                                        ['name' => $this->app->user->getL11n()->lang[7]['Author'],
                                                                         'sort' => -1],
                                                                        ['name' => $this->app->user->getL11n()->lang[7]['Date'],
                                                                         'sort' => -1],]);
                    ?>
        <tbody>
        <?php
        /** @var \Modules\News\NewsList $newsList */
        $data           = $newsList->getList(null, 0, 10);
        $url['level']   = array_slice($request->getData(), 0, 3);
        $url['level'][] = 'single';
        $url['id']      = 'NewsID';

        \Framework\Model\Model::generate_table_content_view($data['list'], ['type', 'title', 'name1', 'created'], $url);
        ?>
    </table>
</div>

<div class="b-2 c7-2 c7 lf" id="i7-2-2">
    <table class="t t-1 c4-1 c4" id="i4-1-1">
        <thead>
        <tr>
            <th colspan="3" class="lT">
                <h1><?= $this->app->user->getL11n()->lang[7]['Headlines'] ?></h1>
            <th class="rT">
                <i class="fa fa-minus min"></i>
                <i class="fa fa-plus max vh"></i>
                <tr>
                    <?php
                    \Framework\Model\Model::generate_table_header_view([['name' => $this->app->user->getL11n()->lang[7]['Type'],
                                                                         'sort' => -1],
                                                                        ['name' => $this->app->user->getL11n()->lang[7]['Title'],
                                                                         'sort' => -1,
                                                                         'full' => true],
                                                                        ['name' => $this->app->user->getL11n()->lang[7]['Author'],
                                                                         'sort' => -1],
                                                                        ['name' => $this->app->user->getL11n()->lang[7]['Date'],
                                                                         'sort' => -1],]);
                    ?>
        <tbody>
        <?php
        /** @var \Modules\News\NewsList $newsList */
        $data           = $newsList->getList(null, 0, 10);
        $url['level']   = array_slice($request->getData(), 0, 3);
        $url['level'][] = 'single';
        $url['id']      = 'NewsID';

        \Framework\Model\Model::generate_table_content_view($data['list'], ['type', 'title', 'name1', 'created'], $url);
        ?>
    </table>
</div>