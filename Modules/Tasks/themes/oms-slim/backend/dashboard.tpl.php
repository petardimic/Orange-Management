<?php /** @var \Modules\Admin\Admin $this */
\Framework\Model\Model::generate_table_filter_view(); ?>

<div class="b-7" id="i3-2-1">
    <div class="b b-5 c3-2 c3" id="i3-2-5">
        <div class="bc-1">
            <ul class="l-1">
                <li><?= \Framework\Localization\Localization::$lang[11]['Interval']; ?>
                <li><select>
                        <option value="0" selected><?= \Framework\Localization\Localization::$lang[11]['All']; ?>
                        <option value="1"><?= \Framework\Localization\Localization::$lang[11]['Today']; ?>
                        <option value="2"><?= \Framework\Localization\Localization::$lang[11]['Week']; ?>
                        <option value="3"><?= \Framework\Localization\Localization::$lang[11]['Month']; ?>
                        <option value="4"><?= \Framework\Localization\Localization::$lang[11]['Year']; ?>
                    </select>
            </ul>
        </div>
    </div>

    <div class="b b-5 c30-1 c30" id="i30-1-4">
        <h1>
            <?= \Framework\Localization\Localization::$lang[11]['Statistics']; ?>
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </h1>

        <div class="bc-1">
            <!-- @formatter:off -->
            <table class="tc-1">
                <tr>
                    <th>
                        <label><?= \Framework\Localization\Localization::$lang[11]['Received']; ?></label>
                    <td>0
                <tr>
                    <th>
                        <label><?= \Framework\Localization\Localization::$lang[11]['Created']; ?></label>
                    <td>0
                <tr>
                    <th>
                        <label><?= \Framework\Localization\Localization::$lang[11]['Forwarded']; ?></label>
                    <td>0
                <tr>
                    <th>
                        <label><?= \Framework\Localization\Localization::$lang[11]['Redirected']; ?></label>
                    <td>0
                <tr>
                    <th>
                        <label><?= \Framework\Localization\Localization::$lang[11]['AverageAmount']; ?></label>
                    <td>0
                <tr>
                    <th>
                        <label><?= \Framework\Localization\Localization::$lang[11]['AverageProcessTime']; ?></label>
                    <td>0 Min.
            </table>
            <!-- @formatter:on -->
        </div>
    </div>
</div>
<div class="b-6">
    <table class="t t-1 c11-1 c11" id="i11-1-1">
        <thead>
        <tr>
            <th colspan="7" class="lT">
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
                    ['name' => \Framework\Localization\Localization::$lang[11]['Receiver'], 'sort' => 0],
                    ['name' => \Framework\Localization\Localization::$lang[11]['Group'], 'sort' => 0],
                    ['name' => \Framework\Localization\Localization::$lang[11]['Creator'], 'sort' => 0],
                    ['name' => \Framework\Localization\Localization::$lang[11]['Created'], 'sort' => 0],
                    ['name' => \Framework\Localization\Localization::$lang[11]['Due'], 'sort' => 0],
                ]
            );
            ?>
            <tbody>
            <?php
            /** @var \Framework\Module\Modules $modules */ /*
        $modules_installed = $this->app->modules->module_list_installed_get();
        $url['level'] = array_slice($this->app->request->uri, 0, 4);
        $url['level'][] = 'front';
        $url['id'] = 'class';

        \Framework\Model\Model::generate_table_content_view(
            $modules_installed['list'],
            ['id', 'name', 'theme', 'version'],
            $url
        );*/
            ?>
    </table>

    <table class="t t-1 c11-1 c11" id="i11-1-1">
        <thead>
        <tr>
            <th colspan="7" class="lT">
                <i class="fa fa-filter p f dim"></i>

                <h1><?= \Framework\Localization\Localization::$lang[11]['Tasks'] . ' - ' . \Framework\Localization\Localization::$lang[11]['All']; ?></h1>
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
                    ['name' => \Framework\Localization\Localization::$lang[11]['Receiver'], 'sort' => 0],
                    ['name' => \Framework\Localization\Localization::$lang[11]['Group'], 'sort' => 0],
                    ['name' => \Framework\Localization\Localization::$lang[11]['Creator'], 'sort' => 0],
                    ['name' => \Framework\Localization\Localization::$lang[11]['Created'], 'sort' => 0],
                    ['name' => \Framework\Localization\Localization::$lang[11]['Due'], 'sort' => 0],
                ]
            );
            ?>
            <tbody>
            <?php
            /** @var \Framework\Module\Modules $modules */ /*
        $modules_installed = $this->app->modules->module_list_installed_get();
        $url['level'] = array_slice($this->app->request->uri, 0, 4);
        $url['level'][] = 'front';
        $url['id'] = 'class';

        \Framework\Model\Model::generate_table_content_view(
            $modules_installed['list'],
            ['id', 'name', 'theme', 'version'],
            $url
        );*/
            ?>
    </table>
</div>