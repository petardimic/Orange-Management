<?php /** @var \Modules\Admin\Admin $this */
\Framework\Module\ModuleFactory::$initialized[1000500000]->show([3, 1000103201]); ?>

<div class="b b-2 c1-5 c1" id="i1-5-1">
    <h1>
        <?= \Framework\Localization\Localization::$lang[1]['Group']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <form class="f-1">
            <ul class="l-1">
                <li>
                    <label for="i-id"><?= \Framework\Localization\Localization::$lang[0]['ID']; ?></label>
                </li>
                <li>
                    <input name="id" class="i-1 t-i" id="i-id" type="text"
                           value="<?= /** @var \Framework\DataStorage\Database\Objects\Group\Group $group */
                           $group->id; ?>" disabled>
                </li>
                <li>
                    <label for="i-name"><?= \Framework\Localization\Localization::$lang[1]['Name']; ?></label>
                </li>
                <li>
                    <input name="name" class="i-1 t-i" id="i-name" type="text"
                           value="<?= $group->name; ?>">
                </li>
                <li>
                    <label for="i-desc"><?= \Framework\Localization\Localization::$lang[1]['Description']; ?></label>
                </li>
                <li>
                    <textarea name="desc" id="i-desc"><?= $group->desc; ?></textarea>
                </li>
                <li>
                    <input type="button" value="<?= \Framework\Localization\Localization::$lang[0]['Edit']; ?>">
                </li>
            </ul>
        </form>
    </div>
</div>

<div class="b b-2 c1-5 c1" id="i1-5-2">
    <h1>
        <?= \Framework\Localization\Localization::$lang[1]['Member']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <form class="f-1">
            <ul class="l-1">
                <li>
                    <label for="i-idn"><?= \Framework\Localization\Localization::$lang[0]['ID']; ?></label>
                </li>
                <li>
                    <input name="idn" class="i-1 t-i" id="i-idn" type="text"
                           value="">
                </li>
                <li>
                    <label for="i-namen"><?= \Framework\Localization\Localization::$lang[1]['Name']; ?></label>
                </li>
                <li>
                    <input name="namen" class="i-1 t-i" id="i-namen" type="text"
                           value="<?= ''; ?>">
                </li>
                <li>
                    <input type="button" value="<?= \Framework\Localization\Localization::$lang[0]['Add']; ?>">
                </li>
            </ul>
        </form>
    </div>
</div>

<?php \Framework\Model\Model::generate_table_filter_view(); ?>

<table class="t t-1 c1-5 c1" id="i1-5-3">
    <thead>
    <tr>
        <th colspan="4" class="lT">
            <i class="fa fa-cogs p f dim"></i>

            <h1><?= \Framework\Localization\Localization::$lang[1]['Members'] ?></h1>
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
    /** @var \Framework\DataStorage\Database\Objects\User\Users $accounts */
    $data = $accounts->account_list_get();
    $url['level'] = array_slice($this->app->request->uri, 0, 4);
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