<?php /** @var \Modules\Admin\Admin $this */
\Framework\Core\Model::generate_table_filter_view(); ?>

<table class="t t-1 c1-2 c1" id="i1-2-1">
    <thead>
    <tr>
        <th colspan="4" class="lT">
            <i class="fa fa-cogs p f dim"></i>

            <h1><?= \Framework\Localization\Localization::$lang[1]['Accounts'] ?></h1>
        </th>
        <th class="rT">
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </th>
    </tr>
    <tr>
        <?php
        \Framework\Core\Model::generate_table_header_view(
            [
                ['name' => \Framework\Localization\Localization::$lang[1]['Status'], 'sort' => 0],
                ['name' => \Framework\Localization\Localization::$lang[0]['ID'], 'sort' => 1],
                ['name' => \Framework\Localization\Localization::$lang[1]['Name'], 'sort' => 0, 'full' => true],
                ['name' => \Framework\Localization\Localization::$lang[1]['Activity'], 'sort' => 0],
                ['name' => \Framework\Localization\Localization::$lang[1]['Created'], 'sort' => 0]
            ]
        );
        ?>
    </tr>
    </thead>
    <tbody>
    <?php
    /** @var \Modules\Admin\Users $accounts */
    $data = $accounts->account_list_get();
    $url['level'] = array_slice($this->request->uri, 0, 3);
    $url['level'][] = 'single';
    $url['level'][] = 'front';
    $url['id'] = 'id';

    \Framework\Core\Model::generate_table_content_view(
        $data['list'],
        ['status', 'id', 'name1', 'lactive', 'created'],
        $url,
        ['status' => [
            0 => '<span class="green">' . \Framework\Localization\Localization::$lang[3]['OFF'] . '</span>',
            1 => '<span class="green">' . \Framework\Localization\Localization::$lang[3]['ON'] . '</span>',
        ]]
    );
    ?>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="5" class="cT">
            <?php \Framework\Core\Model::generate_table_pagination_view($data['count']); ?>
        </td>
    </tr>
    </tfoot>
</table>