<?php /** @var \Modules\Tasks\Controller $this */
/** @noinspection PhpUndefinedMethodInspection */
\Framework\Module\ModuleFactory::$loaded['Navigation']->callWeb([\Modules\Navigation\Models\NavigationType::CONTENT,
                                                                 1001101001]);
\Framework\Model\Model::generate_table_filter_view(); ?>

<div class="b-7" id="i3-2-1">
    <div class="b b-5 c3-2 c3" id="i3-2-5">
        <div class="bc-1">
            <button><?= $this->app->user->getL11n()->lang[11]['New']; ?></button>
        </div>
    </div>
    <div class="b b-5 c3-2 c3" id="i3-2-5">
        <div class="bc-1">
            <ul class="l-1">
                <li><?= $this->app->user->getL11n()->lang[11]['Interval']; ?>
                <li><select>
                        <option value="0" selected><?= $this->app->user->getL11n()->lang[11]['All']; ?>
                        <option value="1"><?= $this->app->user->getL11n()->lang[11]['Today']; ?>
                        <option value="2"><?= $this->app->user->getL11n()->lang[11]['Week']; ?>
                        <option value="3"><?= $this->app->user->getL11n()->lang[11]['Month']; ?>
                        <option value="4"><?= $this->app->user->getL11n()->lang[11]['Year']; ?>
                    </select>
            </ul>
        </div>
    </div>

    <div class="b b-5 c30-1 c30" id="i30-1-4">
        <h1>
            <?= $this->app->user->getL11n()->lang[11]['Statistics']; ?>
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </h1>

        <div class="bc-1">
            <!-- @formatter:off -->
            <table class="tc-1">
                <tr>
                    <th><label><?= $this->app->user->getL11n()->lang[11]['Received']; ?></label>
                    <td>0
                <tr>
                    <th><label><?= $this->app->user->getL11n()->lang[11]['Created']; ?></label>
                    <td>0
                <tr>
                    <th><label><?= $this->app->user->getL11n()->lang[11]['Forwarded']; ?></label>
                    <td>0
                <tr>
                    <th><label><?= $this->app->user->getL11n()->lang[11]['AverageAmount']; ?></label>
                    <td>0
                <tr>
                    <th><label><?= $this->app->user->getL11n()->lang[11]['AverageProcessTime']; ?></label>
                    <td>0 Min.
                <tr>
                    <th><label><?= $this->app->user->getL11n()->lang[11]['InTime']; ?></label>
                    <td>0.00%
            </table>
            <!-- @formatter:on -->
        </div>
    </div>
</div>
<div class="b-6">
    <table class="t t-1 c11-1 c11" id="i11-1-1">
        <thead>
        <tr>
            <th colspan="5" class="lT">
                <i class="fa fa-filter p f dim"></i>

                <h1><?= $this->app->user->getL11n()->lang[11]['Tasks']; ?></h1>
            <th class="rT">
                <i class="fa fa-minus min"></i>
                <i class="fa fa-plus max vh"></i>
                <tr>
                    <?php
                    \Framework\Model\Model::generate_table_header_view(
                        [
                            ['name' => $this->app->user->getL11n()->lang[0]['ID'], 'sort' => 1],
                            ['name' => $this->app->user->getL11n()->lang[11]['Priority'], 'sort' => 0],
                            ['name' => $this->app->user->getL11n()->lang[11]['Title'], 'sort' => 0, 'full' => true],
                            ['name' => $this->app->user->getL11n()->lang[11]['Status'], 'sort' => 0],
                            ['name' => $this->app->user->getL11n()->lang[11]['Creator'], 'sort' => 0],
                            ['name' => $this->app->user->getL11n()->lang[11]['Created'], 'sort' => 0],
                        ]
                    );
                    ?>
        <tbody>
        <?php
        /** @var \Modules\Tasks\TaskList $tasks */
        $data           = $tasks->getList();
        $url['level']   = array_slice($this->app->request->getData(), 0, 3);
        $url['level'][] = 'single';
        $url['id']      = 'TaskID';

        \Framework\Model\Model::generate_table_content_view(
            $data['list'],
            ['TaskID', 'due', 'title', 'status', 'creator', 'created'],
            $url
        );
        ?>
    </table>
</div>