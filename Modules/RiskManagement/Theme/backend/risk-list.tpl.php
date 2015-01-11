<?php /** @var \Modules\RiskManagement\Controller $this */
\Framework\Model\Model::generate_table_filter_view();
\Framework\Module\ModuleFactory::$loaded['Navigation']->callWeb([\Modules\Navigation\Models\NavigationType::CONTENT,
                                                                 1003001001]);
?>

<div class="b-7" id="i3-2-1">
    <?php \Framework\Module\ModuleFactory::$loaded['Navigation']->callWeb([\Modules\Navigation\Models\NavigationType::CONTENT_SIDE,
                                                                           1003003001]); ?>
</div>
<div class="b-6">
    <table class="t t-1 c1-2 c1" id="i1-2-1">
        <thead>
        <tr>
            <th colspan="11" class="lT">
                <i class="fa fa-filter p f dim"></i>

                <h1><?= $this->app->user->localization->lang[30]['Risks'] ?></h1>
            <th class="rT">
                <i class="fa fa-minus min"></i>
                <i class="fa fa-plus max vh"></i>
        <tr>
            <?php
            \Framework\Model\Model::generate_table_header_view(
                [
                    ['name' => '', 'sort' => 0],
                    ['name' => $this->app->user->localization->lang[0]['ID'], 'sort' => 1],
                    ['name' => $this->app->user->localization->lang[30]['Name'], 'sort' => 0, 'full' => true],
                    ['name' => $this->app->user->localization->lang[30]['Parent'], 'sort' => 0],
                    ['name' => $this->app->user->localization->lang[30]['Severity'], 'sort' => 0],
                    ['name' => $this->app->user->localization->lang[30]['Probability'], 'sort' => 0],
                    ['name' => $this->app->user->localization->lang[30]['Department'], 'sort' => 0],
                    ['name' => $this->app->user->localization->lang[30]['Category'], 'sort' => 0],
                    ['name' => $this->app->user->localization->lang[30]['Project'], 'sort' => 0],
                    ['name' => $this->app->user->localization->lang[30]['Process'], 'sort' => 0],
                    ['name' => $this->app->user->localization->lang[30]['Manager'], 'sort' => 0],
                    ['name' => $this->app->user->localization->lang[30]['Due'], 'sort' => 0],
                ]
            );
            ?>
            <tbody>
            <?php
            /** @var \Framework\Object\User\Users $accounts */ /*
                    $data = $accounts->account_list_get();
                    $url['level'] = array_slice($this->app->request->request, 0, 4);
                    $url['level'][] = 'single';
                    $url['level'][] = 'front';
                    $url['id'] = 'id';

                    \Framework\Model\Model::generate_table_content_view(
                        $data['list'],
                        ['status', 'id', 'name1', 'lactive', 'created'],
                        $url
                    );*/
            ?>
            <tfoot>
        <tr>
            <td colspan="12" class="cT">
                <?php /* \Framework\Model\Model::generate_table_pagination_view($data['count']); */ ?>
    </table>
</div>