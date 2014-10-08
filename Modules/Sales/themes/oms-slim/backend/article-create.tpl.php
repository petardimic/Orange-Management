<?php /** @var \Modules\Admin\Admin $this */
\Framework\Module\ModuleFactory::$initialized[1000500000]->show([\Modules\Navigation\NavigationType::CONTENT, 1001605001]);
\Framework\Model\Model::generate_table_filter_view(); ?>

<div class="tabview">
    <ul class="tab-links">
        <li class="active">
            <a href=".tab-1"><?= \Framework\Localization\Localization::$lang[16]['CoreData'] ?></a>
    </ul>

    <div class="tab-content">
        <div class="tab tab-1 active">
            <div class="b b-1 c16-1 c16" id="i16-1-1">
                <h1>
                    <?= \Framework\Localization\Localization::$lang[16]['Article']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <form class="f-1">
                        <ul class="l-1">
                            <li>
                                <label
                                    for="i-status"><?= \Framework\Localization\Localization::$lang[0]['ID']; ?></label>
                            <li>
                                <input name="active" class="i-1 t-i" id="i-active" type="text">
                            <li>
                                <label
                                    for="i-active"><?= \Framework\Localization\Localization::$lang[16]['Matchcode']; ?></label>
                            <li>
                                <input name="active" class="i-1 t-i" id="i-active" type="text">
                            <li>
                                <label
                                    for="i-created"><?= \Framework\Localization\Localization::$lang[16]['Class']; ?></label>
                            <li>
                                <input name="created" class="i-1 t-i" id="i-created" type="text">
                            <li>
                                <label
                                    for="i-created"><?= \Framework\Localization\Localization::$lang[16]['Group']; ?></label>
                            <li>
                                <input name="created" class="i-1 t-i" id="i-created" type="text">
                            <li>
                                <label
                                    for="i-created"><?= \Framework\Localization\Localization::$lang[16]['Subgroup']; ?></label>
                            <li>
                                <input name="created" class="i-1 t-i" id="i-created" type="text">
                            <li>
                        </ul>
                    </form>
                </div>
            </div>

            <div class="b b-1 c16-1 c16" id="i16-1-1">
                <h1>
                    <?= \Framework\Localization\Localization::$lang[16]['Localization']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <form class="f-1">
                        <ul class="l-1">
                            <li>
                                <label
                                    for="i-status"><?= \Framework\Localization\Localization::$lang[16]['Language']; ?></label>
                            <li>
                                <select>
                                    <?php require __DIR__ . '/../../../sales_price_names.php';
                                    foreach ($SalesPriceNames as $key => $val) {
                                        echo '<option value="' . $key . '">' . \Framework\Localization\Localization::$lang[16][$val];
                                    }
                                    ?>
                                </select>
                            <li>
                                <label
                                    for="i-type"><?= \Framework\Localization\Localization::$lang[16]['Name']; ?></label>
                            <li>
                                <input name="active" class="i-1 t-i" id="i-active" type="text">
                            <li>
                                <label
                                    for="i-active"><?= \Framework\Localization\Localization::$lang[16]['Description']; ?></label>
                            <li>
                                <textarea name="active" class="i-1 t-i" id="i-active"></textarea>
                            <li>
                                <button><?= \Framework\Localization\Localization::$lang[0]['Add']; ?></button>
                        </ul>
                    </form>
                </div>
            </div>

            <div class="b b-1 c16-1 c16" id="i16-1-2">
                <h1>
                    <?= \Framework\Localization\Localization::$lang[16]['Price']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <form class="f-1">
                        <ul class="l-1">
                            <li>
                                <label
                                    for="i-login"><?= \Framework\Localization\Localization::$lang[16]['Name']; ?></label>
                            <li>
                                <select>
                                    <?php require __DIR__ . '/../../../sales_price_names.php';
                                    foreach ($SalesPriceNames as $key => $val) {
                                        echo '<option value="' . $key . '">' . \Framework\Localization\Localization::$lang[16][$val];
                                    }
                                    ?>
                                </select>
                            <li>
                                <label
                                    for="i-login"><?= \Framework\Localization\Localization::$lang[16]['Priority']; ?></label>
                            <li>
                                <input type="checkbox" name="vehicle" value="Bike">
                                <label><?= \Framework\Localization\Localization::$lang[16]['IsDefault']; ?></label>
                            <li>
                                <label
                                    for="i-login"><?= \Framework\Localization\Localization::$lang[16]['Price']; ?></label>
                            <li>
                                <input name="login" class="i-1 t-i" id="i-login" type="text">
                            <li>
                                <label
                                    for="i-name1"><?= \Framework\Localization\Localization::$lang[16]['DiscountP']; ?></label>
                            <li>
                                <input name="name1" class="i-1 t-i" id="i-name1" type="text">
                            <li>
                                <label
                                    for="i-name2"><?= \Framework\Localization\Localization::$lang[16]['Discount']; ?></label>
                            <li>
                                <input name="name2" class="i-1 t-i" id="i-name2" type="text">
                            <li>
                                <label
                                    for="i-name3"><?= \Framework\Localization\Localization::$lang[16]['MinPrice']; ?></label>
                            <li>
                                <input name="name3" class="i-1 t-i" id="i-name3" type="text">
                            <li>
                                <button><?= \Framework\Localization\Localization::$lang[0]['Add']; ?></button>
                        </ul>
                    </form>
                </div>
            </div>

            <!-- TODO: make 50% -->
            <table class="t t-1 c1-2 c1" id="i16-1-3">
                <thead>
                <tr>
                    <th colspan="8" class="lT">
                        <i class="fa fa-filter p f dim"></i>

                        <h1><?= \Framework\Localization\Localization::$lang[16]['Articles'] ?></h1>
                    <th class="rT">
                        <i class="fa fa-minus min"></i>
                        <i class="fa fa-plus max vh"></i>
                        <tr>
                            <?php
                            \Framework\Model\Model::generate_table_header_view(
                                [
                                    ['name' => \Framework\Localization\Localization::$lang[16]['Name'], 'sort' => 1, 'full' => true],
                                    ['name' => \Framework\Localization\Localization::$lang[16]['Priority'], 'sort' => 0],
                                    ['name' => \Framework\Localization\Localization::$lang[16]['Price'], 'sort' => 0],
                                    ['name' => \Framework\Localization\Localization::$lang[16]['DiscountP'], 'sort' => 0],
                                    ['name' => \Framework\Localization\Localization::$lang[16]['Discount'], 'sort' => 0],
                                    ['name' => \Framework\Localization\Localization::$lang[16]['MinPrice'], 'sort' => 0],
                                ]
                            );
                            ?>
                            <tbody>
                            <?php
                            /** @var \Modules\Sales\ArticleList $articles */ /*
                                $data = $articles->article_list_get();
                                $url['level'] = array_slice($this->app->request->uri, 0, 4);
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
                    <td colspan="9" class="cT">
                        <?php /*\Framework\Model\Model::generate_table_pagination_view($data['count']); */ ?>
            </table>

            <div class="c-bar rT">
                <button><?= \Framework\Localization\Localization::$lang[0]['Create']; ?></button>
                <button><?= \Framework\Localization\Localization::$lang[0]['Cancel']; ?></button>
            </div>
        </div>
    </div>
</div>