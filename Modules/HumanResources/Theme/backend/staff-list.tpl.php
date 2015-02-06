<?php /** @var \Modules\HumanResources\Controller $this */
/** @noinspection PhpUndefinedMethodInspection */
\Framework\Module\ModuleFactory::$loaded['Navigation']->call(\Framework\Module\CallType::WEB, [\Modules\Navigation\Models\NavigationType::CONTENT,
                                                                 1000401001]);
\Framework\Model\Model::generate_table_filter_view(); ?>

<table class="t t-1 c4-1 c4" id="i4-1-1">
    <thead>
    <tr>
        <th colspan="3" class="lT">
            <i class="fa fa-filter p f dim"></i>

            <h1><?= $this->app->user->getL11n()->lang[24]['Staff'] ?></h1>
        <th class="rT">
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
    <tr>
        <?php
        \Framework\Model\Model::generate_table_header_view(
            [
                ['name' => $this->app->user->getL11n()->lang[0]['ID'], 'sort' => 1],
                ['name' => $this->app->user->getL11n()->lang[24]['Name'], 'sort' => 1, 'full' => true],
                ['name' => $this->app->user->getL11n()->lang[24]['Employees'], 'sort' => 0],
                ['name' => $this->app->user->getL11n()->lang[24]['Parent'], 'sort' => 0],
            ]
        );
        ?>
        <tbody>
        <?php
        /** @var \Modules\HumanResources\StaffList $staff */
        $data           = $staff->getList();
        $url['level']   = array_slice($request->getData(), 0, 4);
        $url['level'][] = 'single';
        $url['level'][] = 'front';
        $url['id']      = 'HRStaffID';

        \Framework\Model\Model::generate_table_content_view(
            $data['list'],
            ['HRStaffID', 'HRStaffID', 'HRStaffID', 'HRStaffID'],
            $url
        );
        ?>
        <tfoot>
    <tr>
        <td colspan="4" class="cT">
            <?php //\Framework\Model\Model::generate_table_pagination_view($data['count']); ?>
</table>