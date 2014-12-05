<?php /** @var \Modules\RiskManagement\Handler $this */
\Framework\Module\ModuleFactory::$loaded['Navigation']->callWeb([\Modules\Navigation\NavigationType::CONTENT, 1003001001]);
\Framework\Model\Model::generate_table_filter_view(); ?>

<div class="b b-2 c30-1 c30 lf" id="i30-1-1">
    <table class="t-1 c1-2 c1 full" id="i1-2-1">
        <thead>
        <tr>
            <th colspan="3" class="lT">
                <i class="fa fa-filter p f dim"></i>

                <h1><?= $this->app->user->localization->lang[30]['Departments'] ?></h1>
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
    </table>

    <div class="bc-1 rT">
        <button><?= $this->app->user->localization->lang[0]['Add'] ?></button>
        <button><?= $this->app->user->localization->lang[0]['Delete'] ?></button>
    </div>
</div>

<div class="b b-2 c30-1 c30 lf" id="i30-1-1">
    <table class="t-1 c1-2 c1 full" id="i1-2-1">
        <thead>
        <tr>
            <th colspan="3" class="lT">
                <i class="fa fa-filter p f dim"></i>

                <h1><?= $this->app->user->localization->lang[30]['Categories'] ?></h1>
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
    </table>
    <div class="bc-1 rT">
        <button><?= $this->app->user->localization->lang[0]['Add'] ?></button>
        <button><?= $this->app->user->localization->lang[0]['Delete'] ?></button>
    </div>
</div>

<div class="b b-1 c30-1 c30 lf" id="i30-1-1">
    <table class="t-1 c1-2 c1 full" id="i1-2-1">
        <thead>
        <tr>
            <th colspan="3" class="lT">
                <i class="fa fa-filter p f dim"></i>

                <h1><?= $this->app->user->localization->lang[30]['Units'] ?></h1>
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
                            ['name' => '', 'sort' => 0],
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
    </table>
    <div class="bc-1 rT">
        <button><?= $this->app->user->localization->lang[0]['Add'] ?></button>
        <button><?= $this->app->user->localization->lang[0]['Delete'] ?></button>
    </div>
</div>

<div class="b b-1 c30-1 c30 lf" id="i30-1-1">
    <table class="t-1 c1-2 c1 full" id="i1-2-1">
        <thead>
        <tr>
            <th colspan="3" class="lT">
                <i class="fa fa-filter p f dim"></i>

                <h1><?= $this->app->user->localization->lang[30]['RiskLevels'] ?></h1>
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
                            ['name' => $this->app->user->localization->lang[30]['Severity'], 'sort' => 0],
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
    </table>
    <div class="bc-1 rT">
        <button><?= $this->app->user->localization->lang[0]['Add'] ?></button>
        <button><?= $this->app->user->localization->lang[0]['Delete'] ?></button>
    </div>
</div>

<div class="b b-1 c30-1 c30 lf" id="i30-1-1">
    <table class="t-1 c1-2 c1 full" id="i1-2-1">
        <thead>
        <tr>
            <th colspan="3" class="lT">
                <i class="fa fa-filter p f dim"></i>

                <h1><?= $this->app->user->localization->lang[30]['RiskProbabilities'] ?></h1>
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
                            ['name' => $this->app->user->localization->lang[30]['Probability'], 'sort' => 0],
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
    </table>
    <div class="bc-1 rT">
        <button><?= $this->app->user->localization->lang[0]['Add'] ?></button>
        <button><?= $this->app->user->localization->lang[0]['Delete'] ?></button>
    </div>
</div>