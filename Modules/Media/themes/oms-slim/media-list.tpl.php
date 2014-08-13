<?php /** @var \Modules\Profile\Profile $this */
\Framework\Model\Model::generate_table_filter_view(); ?>

<table class="t t-1 c3-1 c3" id="i3-1-1">
    <thead>
    <tr>
        <th colspan="4" class="lT">
            <i class="fa fa-cogs p f dim"></i>

            <h1><?= \Framework\Localization\Localization::$lang[3]['Accounts'] ?></h1>
        </th>
        <th class="rT">
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </th>
    </tr>
    <tr>
        <?php
        \Framework\Model\Model::generate_table_header_view(
            [
                ['name' => \Framework\Localization\Localization::$lang[3]['Status'], 'sort' => 0],
                ['name' => \Framework\Localization\Localization::$lang[0]['ID'], 'sort' => 1],
                ['name' => \Framework\Localization\Localization::$lang[3]['Name'], 'sort' => 0, 'full' => true],
                ['name' => \Framework\Localization\Localization::$lang[3]['Activity'], 'sort' => 0],
                ['name' => \Framework\Localization\Localization::$lang[3]['Created'], 'sort' => 0]
            ]
        );
        ?>
    </tr>
    </thead>
    <tbody>
    <?php
    /** @var \Framework\DataStorage\Database\Objects\User\Users $accounts */
    $data = $accounts->account_list_get();
    $url['level'] = array_slice($this->request->uri, 0, 4);
    $url['level'][] = 'single';
    $url['id'] = 'id';

    \Framework\Model\Model::generate_table_content_view(
        $data['list'],
        ['status', 'id', 'name1', 'lactive', 'created'],
        $url
    );
    ?>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="5" class="cT">
            <?php \Framework\Model\Model::generate_table_pagination_view($data['count']); ?>
        </td>
    </tr>
    </tfoot>
</table>