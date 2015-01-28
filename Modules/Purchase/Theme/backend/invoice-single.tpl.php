<?php /** @var \Modules\Sales\Controller $this */
/** @noinspection PhpUndefinedMethodInspection */
\Framework\Module\ModuleFactory::$loaded['Navigation']->callWeb([\Modules\Navigation\Models\NavigationType::CONTENT,
                                                                 1002104001]);
\Framework\Model\Model::generate_table_filter_view(); ?>

<div class="tabview">
    <ul class="tab-links">
        <li class="active">
            <a href=".tab-1"><?= $this->app->user->localization->lang[21]['CoreData'] ?></a>
        <li>
            <a href=".tab-2"><?= $this->app->user->localization->lang[21]['Order'] ?></a>
    </ul>

    <div class="tab-content">
        <div class="tab tab-1 active">
            <div class="b b-1 c21-1 c21" id="i21-1-1">
                <h1>
                    <?= $this->app->user->localization->lang[21]['Supplier']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <form class="f-1">
                        <ul class="l-1">
                            <li>
                                <label
                                    for="i-status"><?= $this->app->user->localization->lang[0]['ID']; ?></label>
                            <li>
                                <input name="active" class="i-1 t-i" id="i-active" type="text">
                                <button>Find</button>
                            <li>
                        </ul>
                    </form>

                    <!-- @formatter:off -->
            <table class="tc-1">
                <tr>
                    <th><label><?= $this->app->user->localization->lang[21]['Name']; ?></label>
                        <td>Duck, Donald
                <tr>
                    <th><label><?= $this->app->user->localization->lang[21]['FAO']; ?></label>
                        <td>-
                <tr>
                    <th><label><?= $this->app->user->localization->lang[21]['Street']; ?></label>
                        <td>Gosling 12
                <tr>
                    <th><label><?= $this->app->user->localization->lang[21]['City']; ?></label>
                        <td>13468 Duckburg CA
                <tr>
                    <th><label><?= $this->app->user->localization->lang[21]['Country']; ?></label>
                    <td>USA
            </table>
            <!-- @formatter:on -->
                </div>
            </div>

            <div class="b b-1 c21-1 c21" id="i21-1-1">
                <h1>
                    <?= $this->app->user->localization->lang[21]['Terms']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <form class="f-1">
                        <ul class="l-1">
                            <li>
                                <label
                                    for="i-status"><?= $this->app->user->localization->lang[21]['Type']; ?></label>
                            <li>
                                <select></select>
                            <li>
                                <label
                                    for="i-status"><?= $this->app->user->localization->lang[21]['Ordered']; ?></label>
                            <li>
                                <input type="date">
                            <li>
                                <label
                                    for="i-status"><?= $this->app->user->localization->lang[21]['OrderedBy']; ?></label>
                            <li>
                                <input type="text">
                            <li>
                                <label
                                    for="i-status"><?= $this->app->user->localization->lang[21]['Receipt']; ?></label>
                            <li>
                                <input type="text">
                            <li>
                                <label
                                    for="i-status"><?= $this->app->user->localization->lang[21]['Reference']; ?></label>
                            <li>
                                <input type="text">
                            <li>
                        </ul>
                    </form>
                </div>
            </div>

            <div class="b b-1 c21-1 c21" id="i21-1-1">
                <h1>
                    <?= $this->app->user->localization->lang[21]['Address']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <form class="f-1">
                        <ul class="l-1">
                            <li>
                                <label
                                    for="i-status"><?= $this->app->user->localization->lang[21]['Name']; ?></label>
                            <li>
                                <select></select>
                            <li>
                                <label
                                    for="i-status"><?= $this->app->user->localization->lang[21]['FAO']; ?></label>
                            <li>
                                <input type="text">
                            <li>
                                <label
                                    for="i-status"><?= $this->app->user->localization->lang[21]['Street']; ?></label>
                            <li>
                                <input type="text">
                            <li>
                                <label
                                    for="i-status"><?= $this->app->user->localization->lang[21]['ZipCode']; ?></label>
                            <li>
                                <input type="text">
                            <li>
                                <label
                                    for="i-status"><?= $this->app->user->localization->lang[21]['City']; ?></label>
                            <li>
                                <input type="text">
                            <li>
                                <label
                                    for="i-status"><?= $this->app->user->localization->lang[21]['Country']; ?></label>
                            <li>
                                <input type="text">
                            <li>
                        </ul>
                    </form>
                </div>
            </div>

            <div class="b b-1 c21-1 c21" id="i21-1-1">
                <h1>
                    <?= $this->app->user->localization->lang[21]['Terms']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <form class="f-1">
                        <ul class="l-1">
                            <li>
                                <label
                                    for="i-status"><?= $this->app->user->localization->lang[21]['Payment']; ?></label>
                            <li>
                                <select></select>
                            <li>
                                <label
                                    for="i-status"><?= $this->app->user->localization->lang[21]['Delivery']; ?></label>
                            <li>
                                <select></select>
                            <li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab tab-2">
            <table class="t t-1 c1-2 c1" id="i1-2-1">
                <thead>
                <tr>
                    <th colspan="9" class="lT">
                        <i class="fa fa-filter p f dim"></i>

                        <h1><?= $this->app->user->localization->lang[21]['Invoice'] ?></h1>
                    <th class="rT">
                        <i class="fa fa-minus min"></i>
                        <i class="fa fa-plus max vh"></i>
                <tr>
                    <?php
                    \Framework\Model\Model::generate_table_header_view(
                        [
                            ['name' => $this->app->user->localization->lang[0]['ID'], 'sort' => 1],
                            ['name' => $this->app->user->localization->lang[21]['Name'], 'sort' => 0],
                            ['name' => $this->app->user->localization->lang[21]['Description'],
                             'sort' => 0,
                             'full' => true],
                            ['name' => $this->app->user->localization->lang[21]['Quantity'], 'sort' => 0],
                            ['name' => $this->app->user->localization->lang[21]['Price'], 'sort' => 0],
                            ['name' => $this->app->user->localization->lang[21]['Tax'], 'sort' => 0],
                            ['name' => $this->app->user->localization->lang[21]['DiscountP'], 'sort' => 0],
                            ['name' => $this->app->user->localization->lang[21]['Discount'], 'sort' => 0],
                            ['name' => $this->app->user->localization->lang[21]['Stock'], 'sort' => 0],
                            ['name' => '', 'sort' => 0],
                        ]
                    );
                    ?>
                    <tbody>
                <tr>
                    <td style="padding-left: 5px"><input type="text" style="min-width: 70px; width: 100%">
                    <td style="padding-left: 5px"><input type="text" style="min-width: 250px; width: 100%">
                    <td style="padding-left: 5px"><textarea class="full" rows="1" style="height: 17px"></textarea>
                    <td style="padding-left: 5px"><input type="text" style="min-width: 50px; width: 100%">
                    <td style="padding-left: 5px"><input type="text" style="min-width: 80px; width: 100%">
                    <td style="padding-left: 5px"><input type="text" style="min-width: 50px; width: 100%">
                    <td style="padding-left: 5px"><input type="text" style="min-width: 100px; width: 100%">
                    <td style="padding-left: 5px"><input type="text" style="min-width: 70px; width: 100%">
                    <td>
                    <td>
                        <button>Add</button>
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
                    <td colspan="10" class="cT">
                        <?php /*\Framework\Model\Model::generate_table_pagination_view($data['count']);*/ ?>
            </table>
        </div>
    </div>
</div>