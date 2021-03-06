<?php /** @var \Modules\Messages\Controller $this */ ?>
<div class="b-7" id="i3-2-1">
    <div class="b b-5 c3-2 c3" id="i3-2-5">
        <div class="bc-1">
            <button><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[12]['New']; ?></button>
        </div>
    </div>
    <div class="b b-5 c3-2 c3" id="i3-2-5">
        <div class="bc-1">
            <ul class="l-1">
                <li><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[12]['Interval']; ?>
                <li><select>
                        <option value="0" selected><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[12]['All']; ?>
                        <option value="1"><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[12]['Today']; ?>
                        <option value="2"><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[12]['Week']; ?>
                        <option value="3"><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[12]['Month']; ?>
                        <option value="4"><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[12]['Year']; ?>
                    </select>
            </ul>
        </div>
    </div>

    <div class="b b-5 c30-1 c30" id="i30-1-4">
        <h1>
            <?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[12]['Statistics']; ?>
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </h1>

        <div class="bc-1">
            <!-- @formatter:off -->
            <table class="tc-1">
                <tr>
                    <th>
                        <label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[12]['Received']; ?></label>
                    <td>0
                <tr>
                    <th>
                        <label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[12]['Sent']; ?></label>
                    <td>0
                <tr>
                    <th>
                        <label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[12]['AverageAmount']; ?></label>
                    <td>0
            </table>
            <!-- @formatter:on -->
        </div>
    </div>
</div>
<div class="b-6">
    <table class="t t-1 c12-1 c12" id="i12-1-1">
        <thead>
        <tr>
            <th colspan="3" class="lT">
                <i class="fa fa-filter p f dim"></i>

                <h1><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[12]['Messages']; ?></h1>
            <th class="rT">
                <i class="fa fa-minus min"></i>
                <i class="fa fa-plus max vh"></i>
                <tr>
                    <?php /*
                    \phpOMS\Model\Model::generate_table_header_view(
                        [
                            ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang[12]['From'], 'sort' => 0],
                            ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang[12]['Subject'],
                             'sort' => 0,
                             'full' => true],
                            ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang[12]['Status'], 'sort' => 0],
                            ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang[12]['Date'], 'sort' => 0],
                        ]
                    );*/
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