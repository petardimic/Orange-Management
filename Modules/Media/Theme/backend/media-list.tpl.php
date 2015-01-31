<?php /** @var \Modules\Media\Controller $this */
/** @noinspection PhpUndefinedMethodInspection */
\Framework\Module\ModuleFactory::$loaded['Navigation']->callWeb([\Modules\Navigation\Models\NavigationType::CONTENT,
                                                                 1000401001]);
\Framework\Model\Model::generate_table_filter_view(); ?>

<table class="t t-1 c4-1 c4" id="i4-1-1">
    <thead>
    <tr>
        <th colspan="4" class="lT">
            <i class="fa fa-filter p f dim"></i>

            <h1><?= $this->app->user->getL11n()->lang[4]['Media'] ?></h1>
        <th class="rT">
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
    <tr>
        <?php
        \Framework\Model\Model::generate_table_header_view(
            [
                ['name' => $this->app->user->getL11n()->lang[4]['Name'], 'sort' => 1, 'full' => true],
                ['name' => $this->app->user->getL11n()->lang[4]['Type'], 'sort' => 0],
                ['name' => $this->app->user->getL11n()->lang[4]['Size'], 'sort' => 0],
                ['name' => $this->app->user->getL11n()->lang[4]['Owner'], 'sort' => 0],
                ['name' => $this->app->user->getL11n()->lang[4]['Created'], 'sort' => 0],
            ]
        );
        ?>
        <tbody>
        <?php
        /** @var \Modules\Media\MediaList $mList */
        $data           = $mList->getList();
        $url['level']   = array_slice($this->app->request->data, 0, 3);
        $url['level'][] = 'single';
        $url['level'][] = 'front';
        $url['id']      = 'media_id';

        \Framework\Model\Model::generate_table_content_view(
            $data['list'],
            ['name', 'type', 'size', 'name3', 'created'],
            $url
        );
        ?>
        <tfoot>
    <tr>
        <td colspan="5" class="cT">
            <?php //\Framework\Model\Model::generate_table_pagination_view($data['count']); ?>
</table>

<?php
/**
 * @var \Framework\Views\ViewAbstract $this
 */
/*
$listView = new \Web\Views\Lists\ListView();
$listView->setTemplate('/Web/Theme/Templates/Lists/ListFull');

$listHeaderView = new \Web\Views\Lists\HeaderView();
$listHeaderView->setTemplate('/Web/Theme/Templates/Lists/Header/HeaderTable');

$listFooterView = new \Web\Views\Lists\PaginationView();
$listFooterView->setTemplate('/Web/Theme/Templates/Lists/Footer/PaginationBig');

$listView->addView('header', $listHeaderView);
$listView->addView('footer', $listFooterView);

$this->addView('list', $listView);

$listView = $this->getView('list');
echo $listView->getResponse();*/