<?php /** @var \Modules\Accounting\Controller $this */
/** @noinspection PhpUndefinedMethodInspection */
\Framework\Module\ModuleFactory::$loaded['Navigation']->callWeb([\Modules\Navigation\Models\NavigationType::CONTENT,
                                                                 1002602001]);
\Framework\Model\Model::generate_table_filter_view(); ?>

<div class="b-7" id="i3-2-1">
    <?= /** @noinspection PhpUndefinedMethodInspection */
    \Framework\Module\ModuleFactory::$loaded['Navigation']->callWeb([\Modules\Navigation\Models\NavigationType::CONTENT_SIDE,
                                                                     1003003001]); ?>
</div>
<div class="b-6">
    <table class="t t-1 c1-2 c1" id="i1-2-1">
        <thead>
        <tr>
            <th colspan="8" class="lT">
                <i class="fa fa-filter p f dim"></i>

                <h1><?= $this->app->user->localization->lang[26]['Debitor'] ?></h1>
            <th class="rT">
                <i class="fa fa-minus min"></i>
                <i class="fa fa-plus max vh"></i>
        <tr>
            <?php
            \Framework\Model\Model::generate_table_header_view(
                [
                    ['name' => $this->app->user->localization->lang[0]['ID'], 'sort' => 1],
                    ['name' => $this->app->user->localization->lang[26]['Matchcode'], 'sort' => 0],
                    ['name' => $this->app->user->localization->lang[26]['Name'], 'sort' => 0, 'full' => true],
                    ['name' => $this->app->user->localization->lang[26]['Street'], 'sort' => 0],
                    ['name' => $this->app->user->localization->lang[26]['City'], 'sort' => 0],
                    ['name' => $this->app->user->localization->lang[26]['ZipCode'], 'sort' => 0],
                    ['name' => $this->app->user->localization->lang[26]['State'], 'sort' => 0],
                    ['name' => $this->app->user->localization->lang[26]['Country'], 'sort' => 0],
                    ['name' => $this->app->user->localization->lang[26]['Area'], 'sort' => 0]
                ]
            );
            ?>
            <tbody>
            <?php
            /** @var \Modules\Accounting\DebitorList $debitorList */
            $data           = $debitorList->getList();
            $url['level']   = array_slice($this->app->request->request, 0, 4);
            $url['level'][] = 'single';
            $url['level'][] = 'front';
            $url['id']      = 'AccountingDebitorID';

            \Framework\Model\Model::generate_table_content_view(
                $data['list'],
                ['AccountingDebitorID',
                 'AccountingDebitorID',
                 'AccountingDebitorID',
                 'AccountingDebitorID',
                 'AccountingDebitorID',
                 'AccountingDebitorID',
                 'AccountingDebitorID',
                 'AccountingDebitorID',
                 'AccountingDebitorID'],
                $url
            );
            ?>
            <tfoot>
        <tr>
            <td colspan="9" class="cT">
                <?php /*\Framework\Model\Model::generate_table_pagination_view($data['count']);*/ ?>
    </table>
</div>