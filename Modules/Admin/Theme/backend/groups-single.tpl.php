<?php
/**
 * @var \Modules\Admin\Controller     $this
 * @var \Framework\Modles\Group\Group $group
 */
/** @noinspection PhpUndefinedMethodInspection */
\Framework\Module\ModuleFactory::$loaded['Navigation']->call(\Framework\Module\CallType::WEB, [\Modules\Navigation\Models\NavigationType::CONTENT,
                                                                 1000103201]); ?>

<div class="b b-2 c1-5 c1" id="i1-5-1">
    <h1>
        <?= $this->app->user->getL11n()->lang[1]['Group']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <form class="f-1">
            <!-- @formatter:off -->
            <ul class="l-1">
                <li><label for="i-id"><?= $this->app->user->getL11n()->lang[0]['ID']; ?></label>
                <li><input name="id" class="i-1 t-i" id="i-id" type="text" value="<?= $group->id; ?>" disabled>
                <li><label for="i-name"><?= $this->app->user->getL11n()->lang[1]['Name']; ?></label>
                <li><input name="name" class="i-1 t-i" id="i-name" type="text" value="<?= $group->name; ?>">
                <li><label for="i-desc"><?= $this->app->user->getL11n()->lang[1]['Description']; ?></label>
                <li><textarea name="desc" id="i-desc"><?= $group->desc; ?></textarea>
                <li><input type="button" value="<?= $this->app->user->getL11n()->lang[0]['Edit']; ?>"> <input type="button" value="<?= $this->app->user->getL11n()->lang[0]['Delete']; ?>">
            </ul>
            <!-- @formatter:on -->
        </form>
    </div>
</div>

<div class="b b-2 c1-5 c1" id="i1-5-2">
    <h1>
        <?= $this->app->user->getL11n()->lang[1]['Member']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <form class="f-1">
            <!-- @formatter:off -->
            <ul class="l-1">
                <li><label for="i-idn"><?= $this->app->user->getL11n()->lang[0]['ID']; ?></label>
                <li><input name="idn" class="i-1 t-i" id="i-idn" type="text" value="">
                <li><label for="i-namen"><?= $this->app->user->getL11n()->lang[1]['Name']; ?></label>
                <li><input name="namen" class="i-1 t-i" id="i-namen" type="text" value="<?= ''; ?>">
                <li><input type="button" value="<?= $this->app->user->getL11n()->lang[0]['Add']; ?>">
            </ul>
            <!-- @formatter:on -->
        </form>
    </div>
</div>

<?php \Framework\Model\Model::generate_table_filter_view(); ?>

<table class="t t-1 c1-5 c1" id="i1-5-3">
    <thead>
    <tr>
        <th colspan="4" class="lT">
            <i class="fa fa-filter p f dim"></i>

            <h1><?= $this->app->user->getL11n()->lang[1]['Members'] ?></h1>
        <th class="rT">
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
    <tr>
        <?php
        \Framework\Model\Model::generate_table_header_view(
            [
                ['name' => $this->app->user->getL11n()->lang[1]['Status'], 'sort' => 0],
                ['name' => $this->app->user->getL11n()->lang[0]['ID'], 'sort' => 1],
                ['name' => $this->app->user->getL11n()->lang[1]['Name'], 'sort' => 0, 'full' => true],
                ['name' => $this->app->user->getL11n()->lang[1]['Activity'], 'sort' => 0],
                ['name' => $this->app->user->getL11n()->lang[1]['Created'], 'sort' => 0]
            ]
        );
        ?>
        <tbody>
        <?php
        /** @var \Modules\Admin\UserList $accounts */
        $data           = $accounts->getList();
        $url['level']   = array_slice($this->app->request->getData(), 0, 4);
        $url['level'][] = 'single';
        $url['id']      = 'id';

        \Framework\Model\Model::generate_table_content_view(
            $data['list'],
            ['status', 'id', 'name1', 'lactive', 'created'],
            $url
        );
        ?>
        <tfoot>
    <tr>
        <td colspan="5" class="cT">
            <?php \Framework\Model\Model::generate_table_pagination_view($data['count']); ?>
        </td>
</table>