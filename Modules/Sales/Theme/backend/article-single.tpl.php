<?php /** @var \Modules\Sales\Controller $this */
/** @noinspection PhpUndefinedMethodInspection */
\Framework\Module\ModuleFactory::$loaded['Navigation']->callWeb([\Modules\Navigation\Models\NavigationType::CONTENT,
                                                                 1001605001]);
?>

<div class="tabview">
    <!-- @formatter:off -->
    <ul class="tab-links">
        <li class="active"><a href=".tab-1"><?= $this->app->user->getL11n()->lang[16]['CoreData'] ?></a>
        <li><a href=".tab-2"><?= $this->app->user->getL11n()->lang[16]['Localization'] ?></a>
        <li><a href=".tab-3"><?= $this->app->user->getL11n()->lang[16]['Price'] ?></a>
        <li><a href=".tab-4"><?= $this->app->user->getL11n()->lang[16]['Analysis'] ?></a>
    </ul>
    <!-- @formatter:on -->

    <div class="tab-content">
        <div class="tab tab-1 active">
            <div class="b b-1 c16-1 c16" id="i16-1-1">
                <h1>
                    <?= $this->app->user->getL11n()->lang[16]['Article']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <form class="f-1">
                        <!-- @formatter:off -->
                        <ul class="l-1">
                            <li><label for="i-status"><?= $this->app->user->getL11n()->lang[0]['ID']; ?></label>
                            <li><input name="active" class="i-1 t-i" id="i-active" type="text">
                            <li><label for="i-created"><?= $this->app->user->getL11n()->lang[16]['Class']; ?></label>
                            <li><input name="created" class="i-1 t-i" id="i-created" type="text">
                            <li><label for="i-created"><?= $this->app->user->getL11n()->lang[16]['Group']; ?></label>
                            <li><input name="created" class="i-1 t-i" id="i-created" type="text">
                            <li><label for="i-created"><?= $this->app->user->getL11n()->lang[16]['Subgroup']; ?></label>
                            <li><input name="created" class="i-1 t-i" id="i-created" type="text">
                            <li>
                        </ul>
                        <!-- @formatter:on -->
                    </form>
                </div>
            </div>
        </div>

        <div class="tab tab-2">
            <div class="b b-1 c16-1 c16" id="i16-1-1">
                <h1>
                    <?= $this->app->user->getL11n()->lang[16]['Localization']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <form class="f-1">
                        <!-- @formatter:off -->
                        <ul class="l-1">
                            <li><label for="i-status"><?= $this->app->user->getL11n()->lang[16]['Language']; ?></label>
                            <li>
                                <select>
                                    <?php require __DIR__ . '/../../Models/sales_price_names.php';
                                    foreach($SalesPriceNames as $key => $val) {
                                        echo '<option value="' . $key . '">' . $this->app->user->getL11n()->lang[16][$val];
                                    }
                                    ?>
                                </select>
                            <li><label for="i-type"><?= $this->app->user->getL11n()->lang[16]['Name']; ?></label>
                            <li><input name="active" class="i-1 t-i" id="i-active" type="text">
                            <li><label for="i-active"><?= $this->app->user->getL11n()->lang[16]['Description']; ?></label>
                            <li><textarea name="active" class="i-1 t-i" id="i-active"></textarea>
                            <li><button><?= $this->app->user->getL11n()->lang[0]['Add']; ?></button>
                        </ul>
                        <!-- @formatter:on -->
                    </form>
                </div>
            </div>

            <div class="lf b-3 c16-1 c16" id="i16-1-1">
                <table class="t t-1 c1-2 c1" id="i16-1-3">
                    <thead>
                    <tr>
                        <th colspan="2" class="lT">
                            <i class="fa fa-filter p f dim"></i>

                            <h1><?= $this->app->user->getL11n()->lang[16]['Localization'] ?></h1>
                        <th class="rT">
                            <i class="fa fa-minus min"></i>
                            <i class="fa fa-plus max vh"></i>
                    <tr>
                        <?php
                        \Framework\Model\Model::generate_table_header_view(
                            [
                                ['name' => $this->app->user->getL11n()->lang[16]['Language'], 'sort' => 0],
                                ['name' => $this->app->user->getL11n()->lang[16]['Name'], 'sort' => 0],
                                ['name' => $this->app->user->getL11n()->lang[16]['Description'],
                                 'sort' => 0,
                                 'full' => true],
                            ]
                        );
                        ?>
                </table>
            </div>
        </div>

        <div class="tab tab-3">
            <div class="b b-1 c16-1 c16" id="i16-1-2">
                <h1>
                    <?= $this->app->user->getL11n()->lang[16]['Price']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <form class="f-1">
                        <!-- @formatter:off -->
                        <ul class="l-1">
                            <li><label for="i-login"><?= $this->app->user->getL11n()->lang[16]['Name']; ?></label>
                            <li>
                                <select>
                                    <?php
                                    foreach($SalesPriceNames as $key => $val) {
                                        echo '<option value="' . $key . '">' . $this->app->user->getL11n()->lang[16][$val];
                                    }
                                    ?>
                                </select>
                            <li><label for="i-login"><?= $this->app->user->getL11n()->lang[16]['Priority']; ?></label>
                            <li>
                                <input type="checkbox" name="vehicle" value="Bike">
                                <label><?= $this->app->user->getL11n()->lang[16]['IsDefault']; ?></label>
                            <li><label for="i-login"><?= $this->app->user->getL11n()->lang[16]['Price']; ?></label>
                            <li><input name="login" class="i-1 t-i" id="i-login" type="text">
                            <li><label for="i-name1"><?= $this->app->user->getL11n()->lang[16]['DiscountP']; ?></label>
                            <li><input name="name1" class="i-1 t-i" id="i-name1" type="text">
                            <li><label for="i-name2"><?= $this->app->user->getL11n()->lang[16]['Discount']; ?></label>
                            <li><input name="name2" class="i-1 t-i" id="i-name2" type="text">
                            <li><label for="i-name3"><?= $this->app->user->getL11n()->lang[16]['MinPrice']; ?></label>
                            <li><input name="name3" class="i-1 t-i" id="i-name3" type="text">
                            <li><button><?= $this->app->user->getL11n()->lang[0]['Add']; ?></button>
                        </ul>
                        <!-- @formatter:on -->
                    </form>
                </div>
            </div>

            <div class="lf b-3 c16-1 c16" id="i16-1-1">
                <table class="t t-1 c1-2 c1" id="i16-1-3">
                    <thead>
                    <tr>
                        <th colspan="8" class="lT">
                            <i class="fa fa-filter p f dim"></i>

                            <h1><?= $this->app->user->getL11n()->lang[16]['Articles'] ?></h1>
                        <th class="rT">
                            <i class="fa fa-minus min"></i>
                            <i class="fa fa-plus max vh"></i>
                    <tr>
                        <?php
                        \Framework\Model\Model::generate_table_header_view(
                            [
                                ['name' => $this->app->user->getL11n()->lang[16]['Name'],
                                 'sort' => 1,
                                 'full' => true],
                                ['name' => $this->app->user->getL11n()->lang[16]['Priority'], 'sort' => 0],
                                ['name' => $this->app->user->getL11n()->lang[16]['Price'], 'sort' => 0],
                                ['name' => $this->app->user->getL11n()->lang[16]['DiscountP'], 'sort' => 0],
                                ['name' => $this->app->user->getL11n()->lang[16]['Discount'], 'sort' => 0],
                                ['name' => $this->app->user->getL11n()->lang[16]['MinPrice'], 'sort' => 0],
                            ]
                        );
                        ?>
                        <tbody>
                        <?php
                        /** @var \Modules\Sales\ArticleList $articles */ /*
                                $data = $articles->article_list_get();
                                $url['level'] = array_slice($this->app->request->data, 0, 4);
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
            </div>
        </div>
        <div class="tab tab-4">
        </div>
    </div>
</div>