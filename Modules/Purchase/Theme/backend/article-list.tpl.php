<?php /** @var \Modules\Purchase\Controller $this */
/** @noinspection PhpUndefinedMethodInspection */
\phpOMS\Module\ModuleFactory::$loaded['Navigation']->call([\Modules\Navigation\Models\NavigationType::CONTENT,
                                                           1002105001]);
\phpOMS\Model\Model::generate_table_filter_view(); ?>

<div class="b-7" id="i3-2-2">
    <?= /** @noinspection PhpUndefinedMethodInspection */
    \phpOMS\Module\ModuleFactory::$loaded['Navigation']->call([\Modules\Navigation\Models\NavigationType::CONTENT_SIDE,
                                                               1002105101]); ?>
</div>
<div class="b-6" id="i3-2-1">
    <table class="t t-1 c1-2 c1" id="i1-2-1">
        <thead>
        <tr>
            <th colspan="5" class="lT">
                <i class="fa fa-filter p f dim"></i>

                <h1><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[21]['Articles'] ?></h1>
            <th class="rT">
                <i class="fa fa-minus min"></i>
                <i class="fa fa-plus max vh"></i>
        <tr>
            <?php
            \phpOMS\Model\Model::generate_table_header_view(
                [
                    ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['ID'], 'sort' => 1],
                    ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang[21]['Matchcode'], 'sort' => 0],
                    ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang[21]['Name'], 'sort' => 0, 'full' => true],
                    ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang[21]['Available'], 'sort' => 0],
                    ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang[21]['Ordered'], 'sort' => 0],
                    ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang[21]['OrderedDate'], 'sort' => 0],
                ]
            );
            ?>
            <tbody>
            <?php
            /** @var \Modules\Purchase\ArticleList $articleList */
            $data           = $articleList->getList();
            $url['level']   = array_slice($request->getData(), 0, 4);
            $url['level'][] = 'single';
            $url['level'][] = 'front';
            $url['id']      = 'PurchaseArticleID';

            \phpOMS\Model\Model::generate_table_content_view(
                $data['list'],
                ['PurchaseArticleID',
                 'PurchaseArticleID',
                 'PurchaseArticleID',
                 'PurchaseArticleID',
                 'PurchaseArticleID'],
                $url
            );
            ?>
            <tfoot>
        <tr>
            <td colspan="6" class="cT">
                <?php /*\phpOMS\Model\Model::generate_table_pagination_view($data['count']); */ ?>
    </table>
</div>