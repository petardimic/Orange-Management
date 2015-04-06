<?php /** @var \Modules\Sales\Controller $this */
/** @noinspection PhpUndefinedMethodInspection */
\phpOMS\Module\ModuleFactory::$loaded['Navigation']->call([\Modules\Navigation\Models\NavigationType::CONTENT,
                                                                 1002102001]);
?>

<div class="tabview">
    <!-- @formatter:off -->
    <ul class="tab-links">
        <li class="active"><a href=".tab-1"><?= $this->app->user->getL11n()->lang[21]['CoreData'] ?></a>
        <li><a href=".tab-2"><?= $this->app->user->getL11n()->lang[21]['Address'] ?></a>
        <li><a href=".tab-3"><?= $this->app->user->getL11n()->lang[21]['Terms'] ?></a>
        <li><a href=".tab-4"><?= $this->app->user->getL11n()->lang[21]['Discount'] ?></a>
        <li><a href=".tab-5"><?= $this->app->user->getL11n()->lang[21]['Invoices'] ?></a>
        <li><a href=".tab-6"><?= $this->app->user->getL11n()->lang[21]['Articles'] ?></a>
        <li><a href=".tab-7"><?= $this->app->user->getL11n()->lang[21]['Analysis'] ?></a>
        <li><a href=".tab-7"><?= $this->app->user->getL11n()->lang[21]['Media'] ?></a>
        <li><a href=".tab-7"><?= $this->app->user->getL11n()->lang[21]['Documentation'] ?></a>
    </ul>
    <!-- @formatter:on -->

    <div class="tab-content">
        <div class="tab tab-1 active">
            <div class="b b-2 c1-8 c1" id="i1-8-2">
                <h1>
                    <?= $this->app->user->getL11n()->lang[21]['Account']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <form class="f-1">
                        <!-- @formatter:off -->
                        <ul class="l-1">
                            <li><label for="i-status"><?= $this->app->user->getL11n()->lang[21]['Reference']; ?></label>
                            <li><input type="text">
                                <button><?= $this->app->user->getL11n()->lang[0]['Find']; ?></button>
                            <li><label for="i-status"><?= $this->app->user->getL11n()->lang[21]['Status']; ?></label>
                            <li>
                                <select name="status" id="i-status">
                                    <option value="0">
                                        <?= $this->app->user->getL11n()->lang[21]['Active']; ?>
                                    <option value="1">
                                        <?= $this->app->user->getL11n()->lang[21]['Inactive']; ?>
                                </select>
                            <li><label for="i-type"><?= $this->app->user->getL11n()->lang[21]['Type']; ?></label>
                            <li>
                                <select name="type" id="i-type">
                                    <option value="0">
                                        <?= $this->app->user->getL11n()->lang[21]['Single']; ?>
                                    <option value="1">
                                        <?= $this->app->user->getL11n()->lang[21]['Group']; ?>
                                </select>
                            <li><label for="i-active"><?= $this->app->user->getL11n()->lang[21]['Activity']; ?></label>
                            <li><input name="active" class="i-1 t-i" id="i-active" type="text">
                            <li>
                        </ul>
                        <!-- @formatter:on -->
                    </form>
                </div>
            </div>

            <div class="b b-2 c1-8 c1" id="i1-8-3">
                <h1>
                    <?= $this->app->user->getL11n()->lang[21]['Account']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <form class="f-1">
                        <!-- @formatter:off -->
                        <ul class="l-1">
                            <li><label for="i-login"><?= $this->app->user->getL11n()->lang[21]['Loginname']; ?></label>
                            <li><input name="login" class="i-1 t-i" id="i-login" type="text">
                            <li><label for="i-name1"><?= $this->app->user->getL11n()->lang[21]['Name1']; ?></label>
                            <li><input name="name1" class="i-1 t-i" id="i-name1" type="text">
                            <li><label for="i-name2"><?= $this->app->user->getL11n()->lang[21]['Name2']; ?></label>
                            <li><input name="name2" class="i-1 t-i" id="i-name2" type="text">
                            <li><label for="i-name3"><?= $this->app->user->getL11n()->lang[21]['Name3']; ?></label>
                            <li><input name="name3" class="i-1 t-i" id="i-name3" type="text">
                            <li><label for="i-email"><?= $this->app->user->getL11n()->lang[0]['Email']; ?></label>
                            <li><input name="email" class="i-1 t-i" id="i-email" type="text">
                            <li><label for="i-pass"><?= $this->app->user->getL11n()->lang[0]['Password']; ?></label>
                            <li><input name="pass" class="i-1 t-i" id="i-pass" type="password">
                                <input type="button" value="<?= $this->app->user->getL11n()->lang[0]['Create']; ?>">
                            <li>
                        </ul>
                        <!-- @formatter:on -->
                    </form>
                </div>
            </div>
        </div>
        <div class="tab tab-2">
            <div class="b b-1 c21-1 c21" id="i21-1-1">
                <h1>
                    <?= $this->app->user->getL11n()->lang[21]['Address']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <form class="f-1">
                        <!-- @formatter:off -->
                        <ul class="l-1">
                            <li><label for="i-status"><?= $this->app->user->getL11n()->lang[21]['Name']; ?></label>
                            <li><select></select>
                            <li><label for="i-status"><?= $this->app->user->getL11n()->lang[21]['IsDefault']; ?></label>
                            <li><input type="checkbox"><label for="i-status"><?= $this->app->user->getL11n()->lang[21]['IsDefault']; ?></label>
                            <li><label for="i-status"><?= $this->app->user->getL11n()->lang[21]['FAO']; ?></label>
                            <li><input type="text">
                            <li><label for="i-status"><?= $this->app->user->getL11n()->lang[21]['Street']; ?></label>
                            <li><input type="text">
                            <li><label for="i-status"><?= $this->app->user->getL11n()->lang[21]['ZipCode']; ?></label>
                            <li><input type="text">
                            <li><label for="i-status"><?= $this->app->user->getL11n()->lang[21]['City']; ?></label>
                            <li><input type="text">
                            <li><label for="i-status"><?= $this->app->user->getL11n()->lang[21]['Country']; ?></label>
                            <li><input type="text">
                            <li><input type="button" value="<?= $this->app->user->getL11n()->lang[0]['Add']; ?>">
                        </ul>
                        <!-- @formatter:on -->
                    </form>
                </div>
            </div>

            <div class="b b-3 c21-1 c21" id="i21-1-1">
                <h1>
                    <?= $this->app->user->getL11n()->lang[21]['Address']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">

                </div>
            </div>
        </div>
        <div class="tab tab-3">

        </div>
        <div class="tab tab-4">
            <div class="b b-1 c21-1 c21" id="i21-1-1">
                <h1>
                    <?= $this->app->user->getL11n()->lang[21]['Discount']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <form class="f-1">
                        <!-- @formatter:off -->
                        <ul class="l-1">
                            <li><label for="i-status"><?= $this->app->user->getL11n()->lang[21]['Type']; ?></label>
                            <li><select></select>
                            <li><label for="i-status"><?= $this->app->user->getL11n()->lang[0]['ID']; ?></label>
                            <li><input type="text">
                            <li><label for="i-status"><?= $this->app->user->getL11n()->lang[21]['Discount']; ?></label>
                            <li><input type="text">
                            <li><label for="i-status"><?= $this->app->user->getL11n()->lang[21]['DiscountP']; ?></label>
                            <li><input type="text">
                            <li><input type="button" value="<?= $this->app->user->getL11n()->lang[0]['Add']; ?>">
                        </ul>
                        <!-- @formatter:on -->
                    </form>
                </div>
            </div>

            <div class="b b-3 c21-1 c21" id="i21-1-1">
                <h1>
                    <?= $this->app->user->getL11n()->lang[21]['Discount']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">

                </div>
            </div>
        </div>
        <div class="tab tab-5">
            <div class="b-7" id="i3-2-1">
                <div class="b b-5" id="i3-2-4">
                    <h1>
                        <?= $this->app->user->getL11n()->lang[21]['Settings']; ?>
                        <i class="fa fa-minus min"></i>
                        <i class="fa fa-plus max vh"></i>
                    </h1>

                    <div class="bc-1">
                        <ul class="l-1">
                            <li><label><?= $this->app->user->getL11n()->lang[21]['From']; ?></label>
                            <li><input type="text">
                            <li><label><?= $this->app->user->getL11n()->lang[21]['To']; ?></label>
                            <li><input type="text">
                            <li><label><?= $this->app->user->getL11n()->lang[21]['Type']; ?></label>
                            <li><select>
                                    <option><?= $this->app->user->getL11n()->lang[21]['All']; ?>
                                    <option><?= $this->app->user->getL11n()->lang[21]['Invoice']; ?>
                                    <option><?= $this->app->user->getL11n()->lang[21]['Offer']; ?>
                                    <option><?= $this->app->user->getL11n()->lang[21]['Confirmation']; ?>
                                    <option><?= $this->app->user->getL11n()->lang[21]['DeliveryNote']; ?>
                                    <option><?= $this->app->user->getL11n()->lang[21]['CreditNote']; ?>
                                </select>
                            <li>
                                <button><?= $this->app->user->getL11n()->lang[0]['Submit']; ?></button>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="b-6" id="i3-2-2">
                <table class="t t-1 c1-2 c1" id="i1-2-1">
                    <thead>
                    <tr>
                        <th colspan="7" class="lT">
                            <i class="fa fa-filter p f dim"></i>

                            <h1><?= $this->app->user->getL11n()->lang[21]['Invoices'] ?></h1>
                        <th class="rT">
                            <i class="fa fa-minus min"></i>
                            <i class="fa fa-plus max vh"></i>
                            <tr>
                                <?php
                                \phpOMS\Model\Model::generate_table_header_view(
                                    [
                                        ['name' => $this->app->user->getL11n()->lang[0]['ID'], 'sort' => 1],
                                        ['name' => $this->app->user->getL11n()->lang[21]['Date'], 'sort' => 0],
                                        ['name' => $this->app->user->getL11n()->lang[21]['Type'], 'sort' => 0],
                                        ['name' => $this->app->user->getL11n()->lang[21]['Status'], 'sort' => 0],
                                        ['name' => $this->app->user->getL11n()->lang[21]['Address'],
                                         'sort' => 0,
                                         'full' => true],
                                        ['name' => $this->app->user->getL11n()->lang[21]['Price'], 'sort' => 0],
                                        ['name' => $this->app->user->getL11n()->lang[21]['Creator'], 'sort' => 0],
                                        ['name' => $this->app->user->getL11n()->lang[21]['Created'], 'sort' => 0],
                                    ]
                                );
                                ?>
                    <tbody>
                    <?php
                    /** @var \Modules\Sales\ClientList $clientList */ /*
                        $data = $clientList->getList();
                        $url['level'] = array_slice($request->getData(), 0, 4);
                        $url['level'][] = 'single';
                        $url['level'][] = 'front';
                        $url['id'] = 'SalesClientID';

                        \phpOMS\Model\Model::generate_table_content_view(
                            $data['list'],
                            ['SalesClientID', 'matchcode', 'name1', 'SalesClientID', 'SalesClientID', 'SalesClientID', 'SalesClientID', 'SalesClientID', 'SalesClientID'],
                            $url
                        ); */
                    ?>
                </table>
            </div>
        </div>
        <div class="tab tab-6">
            <div class="b-7" id="i3-2-1">
                <div class="b b-5" id="i3-2-4">
                    <h1>
                        <?= $this->app->user->getL11n()->lang[21]['Settings']; ?>
                        <i class="fa fa-minus min"></i>
                        <i class="fa fa-plus max vh"></i>
                    </h1>

                    <div class="bc-1">
                        <ul class="l-1">
                            <li><label><?= $this->app->user->getL11n()->lang[21]['From']; ?></label>
                            <li><input type="text">
                            <li><label><?= $this->app->user->getL11n()->lang[21]['To']; ?></label>
                            <li><input type="text">
                            <li><label><?= $this->app->user->getL11n()->lang[21]['Type']; ?></label>
                            <li><select>
                                    <option><?= $this->app->user->getL11n()->lang[21]['All']; ?>
                                    <option><?= $this->app->user->getL11n()->lang[21]['Invoice']; ?>
                                    <option><?= $this->app->user->getL11n()->lang[21]['Offer']; ?>
                                    <option><?= $this->app->user->getL11n()->lang[21]['Confirmation']; ?>
                                    <option><?= $this->app->user->getL11n()->lang[21]['DeliveryNote']; ?>
                                    <option><?= $this->app->user->getL11n()->lang[21]['CreditNote']; ?>
                                </select>
                            <li>
                                <button><?= $this->app->user->getL11n()->lang[0]['Submit']; ?></button>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="b-6" id="i3-2-2">
                <table class="t t-1 c1-2 c1" id="i1-2-1">
                    <thead>
                    <tr>
                        <th colspan="5" class="lT">
                            <i class="fa fa-filter p f dim"></i>

                            <h1><?= $this->app->user->getL11n()->lang[21]['Articles'] ?></h1>
                        <th class="rT">
                            <i class="fa fa-minus min"></i>
                            <i class="fa fa-plus max vh"></i>
                            <tr>
                                <?php
                                \phpOMS\Model\Model::generate_table_header_view(
                                    [
                                        ['name' => $this->app->user->getL11n()->lang[0]['ID'], 'sort' => 1],
                                        ['name' => $this->app->user->getL11n()->lang[21]['Date'], 'sort' => 0],
                                        ['name' => $this->app->user->getL11n()->lang[21]['Invoice'], 'sort' => 0],
                                        ['name' => $this->app->user->getL11n()->lang[21]['Type'], 'sort' => 0],
                                        ['name' => $this->app->user->getL11n()->lang[21]['Name'],
                                         'sort' => 0,
                                         'full' => true],
                                        ['name' => $this->app->user->getL11n()->lang[21]['Price'], 'sort' => 0],
                                    ]
                                );
                                ?>
                    <tbody>
                    <?php
                    /** @var \Modules\Sales\ClientList $clientList */ /*
                        $data = $clientList->getList();
                        $url['level'] = array_slice($request->getData(), 0, 4);
                        $url['level'][] = 'single';
                        $url['level'][] = 'front';
                        $url['id'] = 'SalesClientID';

                        \phpOMS\Model\Model::generate_table_content_view(
                            $data['list'],
                            ['SalesClientID', 'matchcode', 'name1', 'SalesClientID', 'SalesClientID', 'SalesClientID', 'SalesClientID', 'SalesClientID', 'SalesClientID'],
                            $url
                        ); */
                    ?>
                </table>
            </div>
        </div>
        <div class="tab tab-7">
            <div class="b-7" id="i3-2-1">
                <div class="b b-5 c3-2 c3" id="i3-2-5">
                    <h1>
                        <?= $this->app->user->getL11n()->lang[21]['Interval']; ?>
                        <i class="fa fa-minus min"></i>
                        <i class="fa fa-plus max vh"></i>
                    </h1>

                    <div class="bc-1">
                        <ul class="l-1">
                            <li><label><?= $this->app->user->getL11n()->lang[21]['From']; ?></label>
                            <li><input type="text">
                            <li><label><?= $this->app->user->getL11n()->lang[21]['To']; ?></label>
                            <li><input type="text">
                        </ul>
                    </div>
                </div>

                <div class="b b-5 c30-1 c30" id="i30-1-4">
                    <h1>
                        <?= $this->app->user->getL11n()->lang[21]['Statistics']; ?>
                        <i class="fa fa-minus min"></i>
                        <i class="fa fa-plus max vh"></i>
                    </h1>

                    <div class="bc-1">
                        <!-- @formatter:off -->
                        <table class="tc-1">
                            <tr>
                                <th><label><?= $this->app->user->getL11n()->lang[21]['Turnover']; ?></label>
                                <td>asldkf
                            <tr>
                                <th><label><?= $this->app->user->getL11n()->lang[21]['Trend']; ?></label>
                                <td>asldkf
                            <tr>
                                <th><label><?= $this->app->user->getL11n()->lang[21]['Orders']; ?></label>
                                <td>asldkf
                            <tr>
                                <th><label><?= $this->app->user->getL11n()->lang[21]['Highest']; ?></label>
                                <td>asldkf
                            <tr>
                                <th><label><?= $this->app->user->getL11n()->lang[21]['Articles']; ?></label>
                                <td>asldkf
                            <tr>
                                <th><label><?= $this->app->user->getL11n()->lang[21]['Discount']; ?></label>
                                <td>asldkf
                            <tr>
                                <th><label><?= $this->app->user->getL11n()->lang[21]['DSO']; ?></label>
                                <td>asldkf
                        </table>
                        <!-- @formatter:on -->
                    </div>
                </div>
            </div>
            <div class="b-6">
                <div class="b b-2 c30-1 c30" id="i30-1-1">
                    <h1>
                        <?= $this->app->user->getL11n()->lang[21]['TopArticles']; ?>
                        <i class="fa fa-minus min"></i>
                        <i class="fa fa-plus max vh"></i>
                    </h1>

                    <div class="bc-1">
                        <!-- @formatter:off -->
                        <table class="tc-1">
                            <tr>
                                <td><strong><?= $this->app->user->getL11n()->lang[21]['Name']; ?></strong>
                                <td><strong><?= $this->app->user->getL11n()->lang[0]['ID']; ?></strong>
                                <td><strong><?= $this->app->user->getL11n()->lang[21]['Amount']; ?></strong>
                                <td><strong><?= $this->app->user->getL11n()->lang[21]['Turnover']; ?></strong>
                            <tr>
                                <td>Alphador
                                <td>1224658
                                <td>4
                                <td>$100.00
                            <tr>
                                <td>Alphador
                                <td>1224658
                                <td>4
                                <td>$100.00
                            <tr>
                                <td>Alphador
                                <td>1224658
                                <td>4
                                <td>$100.00
                            <tr>
                                <td>Alphador
                                <td>1224658
                                <td>4
                                <td>$100.00
                            <tr>
                                <td>Alphador
                                <td>1224658
                                <td>4
                                <td>$100.00
                        </table>
                        <!-- @formatter:on -->
                    </div>
                </div>

                <div class="b b-2 c30-1 c30" id="i30-1-1">
                    <h1>
                        <?= $this->app->user->getL11n()->lang[21]['Article']; ?>
                        <i class="fa fa-minus min"></i>
                        <i class="fa fa-plus max vh"></i>
                    </h1>

                    <div class="bc-1">
                        <ul class="l-1">
                            <li><label><?= $this->app->user->getL11n()->lang[0]['ID']; ?></label>
                            <li><input type="text">
                                <button><?= $this->app->user->getL11n()->lang[0]['Submit']; ?></button>
                        </ul>

                        <!-- @formatter:off -->
                        <table class="tc-1">
                            <tr>
                                <th><label><?= $this->app->user->getL11n()->lang[21]['Last']; ?></label>
                                <td>1224658
                            <tr>
                                <th><label><?= $this->app->user->getL11n()->lang[21]['Turnover']; ?></label>
                                <td>1224658
                            <tr>
                                <th><label><?= $this->app->user->getL11n()->lang[21]['Amount']; ?></label>
                                <td>1224658
                        </table>
                        <!-- @formatter:on -->
                    </div>
                </div>

                <div class="b b-5 c30-1 c30" id="i30-1-3">
                    <h1>
                        <?= $this->app->user->getL11n()->lang[21]['Turnover']; ?>
                        <i class="fa fa-minus min"></i>
                        <i class="fa fa-plus max vh"></i>
                    </h1>

                    <div class="bc-1">
                        <div class="chart" id="chart-2">
                            <style type="text/css" scoped>
                                .rule {
                                    fill: none;
                                    stroke: #cacaca;
                                    stroke-width: 1px;
                                }

                                .area {
                                    fill: steelblue;
                                }
                            </style>
                            <script>
                                function resize_chart2(data, chart) {
                                    d3.select('#' + chart + " svg").remove();

                                    var margin = {top: 10, right: 10, bottom: 20, left: 30},
                                        width = parseFloat(jsOMS.getPropertyValue(document.getElementById(chart), 'width'), 10) - margin.left - margin.right,
                                        height = 300 - margin.top - margin.bottom;

                                    var x = d3.time.scale()
                                        .range([0, width]);

                                    var y = d3.scale.linear()
                                        .range([height, 0]);

                                    var xAxis = d3.svg.axis()
                                        .scale(x)
                                        .orient("bottom");

                                    var yAxis = d3.svg.axis()
                                        .scale(y)
                                        .orient("left");

                                    var line = d3.svg.line()
                                        .x(function (d) {
                                            return x(d.date);
                                        })
                                        .y(function (d) {
                                            return y(d.close);
                                        });

                                    var area = d3.svg.area()
                                        .x(function (d) {
                                            return x(d.date);
                                        })
                                        .y0(height)
                                        .y1(function (d) {
                                            return y(d.close);
                                        });

                                    var svg = d3.select('#' + chart).append("svg")
                                        .attr("width", width + margin.left + margin.right)
                                        .attr("height", height + margin.top + margin.bottom)
                                        .append("g")
                                        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

                                    x.domain(d3.extent(data, function (d) {
                                        return d.date;
                                    }));
                                    y.domain([0, d3.max(data, function (d) {
                                        return d.close;
                                    })]);

                                    var maxVal = d3.max(data, function (d) {
                                        return d.close;
                                    });
                                    var minVal = 0;

                                    var rule1 = [
                                        {'x': 1, 'y': y(maxVal / 3 + minVal)},
                                        {'x': width, 'y': y(maxVal / 3 + minVal)}
                                    ];
                                    var rule2 = [
                                        {'x': 1, 'y': y(2 * maxVal / 3 + minVal)},
                                        {'x': width, 'y': y(2 * maxVal / 3 + minVal)}
                                    ];

                                    var lineFunction = d3.svg.line()
                                        .x(function (d) {
                                            return d.x;
                                        })
                                        .y(function (d) {
                                            return d.y;
                                        })
                                        .interpolate("linear");
                                    svg.append("path")
                                        .datum(data)
                                        .attr("class", "area")
                                        .attr("d", area);

                                    svg.append("path")
                                        .attr('class', 'rule')
                                        .attr('d', lineFunction(rule1));

                                    svg.append("path")
                                        .attr('class', 'rule')
                                        .attr('d', lineFunction(rule2));

                                    svg.append("g")
                                        .attr("class", "x axis")
                                        .attr("transform", "translate(0," + height + ")")
                                        .call(xAxis)
                                        .append("text")
                                        .attr("x", width - margin.right)
                                        .attr("dx", ".71em")
                                        .attr("y", -6)
                                        .style("text-anchor", "end")
                                        .text("Date");

                                    svg.append("g")
                                        .attr("class", "y axis")
                                        .call(yAxis)
                                        .append("text")
                                        .attr("transform", "rotate(-90)")
                                        .attr("y", 6)
                                        .attr("dy", ".71em")
                                        .style("text-anchor", "end")
                                        .text("Price ($)");
                                }

                                jsOMS.ready(function () {
                                    var parseDate = d3.time.format("%d-%b-%y").parse;

                                    d3.csv(URL + "/Modules/RiskManagement/data/cockpit/history.csv", function (error, data) {
                                        data.forEach(function (d) {
                                            d.date = parseDate(d.date);
                                            d.close = +d.close;
                                        });

                                        jsOMS.listenEvent(window, 'resize', function () {
                                            resize_chart2(data, "chart-2");
                                        });
                                        resize_chart2(data, "chart-2");
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>

                <div class="b b-2 c30-1 c30" id="i30-1-1">
                    <h1>
                        <?= $this->app->user->getL11n()->lang[21]['Groups']; ?>
                        <i class="fa fa-minus min"></i>
                        <i class="fa fa-plus max vh"></i>
                    </h1>

                    <div class="bc-1">
                        <div class="chart" id="chart-1">
                            <style type="text/css" scoped>
                                .bar {
                                    fill: steelblue;
                                }

                                .bar:hover {
                                    fill: brown;
                                }

                                .axis {
                                    font: 10px sans-serif;
                                }

                                .axis path,
                                .axis line {
                                    fill: none;
                                    stroke: #000;
                                    shape-rendering: crispEdges;
                                }

                            </style>
                            <script>
                                function type(d) {
                                    d.frequency = +d.frequency;
                                    return d;
                                }
                                function resize_chart1(data, chart) {
                                    d3.select('#' + chart + " svg").remove();

                                    var margin = {top: 10, right: 10, bottom: 20, left: 20},
                                        width = parseFloat(jsOMS.getPropertyValue(document.getElementById(chart), 'width'), 10) - margin.left - margin.right,
                                        height = 300 - margin.top - margin.bottom,
                                        percent = d3.format('%');

                                    var x = d3.scale.ordinal()
                                        .rangeRoundBands([0, width], .1);

                                    var y = d3.scale.linear()
                                        .range([height, 0]);

                                    var xAxis = d3.svg.axis()
                                        .scale(x)
                                        .orient("bottom");

                                    var yAxis = d3.svg.axis()
                                        .scale(y)
                                        .orient("left")
                                        .ticks(10, "");

                                    var svg = d3.select('#' + chart).append("svg")
                                        .attr("width", width + margin.left + margin.right)
                                        .attr("height", height + margin.top + margin.bottom)
                                        .append("g")
                                        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

                                    x.domain(data.map(function (d) {
                                        return d.letter;
                                    }));
                                    y.domain([0, d3.max(data, function (d) {
                                        return d.frequency;
                                    })]);

                                    svg.append("g")
                                        .attr("class", "x axis")
                                        .attr("transform", "translate(0," + height + ")")
                                        .call(xAxis);

                                    svg.append("g")
                                        .attr("class", "y axis")
                                        .call(yAxis)
                                        .append("text")
                                        .attr("transform", "rotate(-90)")
                                        .attr("y", 6)
                                        .attr("dy", ".71em")
                                        .style("text-anchor", "end")
                                        .text("Risk");

                                    svg.selectAll(".bar")
                                        .data(data)
                                        .enter().append("rect")
                                        .attr("class", "bar")
                                        .attr("x", function (d) {
                                            return x(d.letter);
                                        })
                                        .attr("width", x.rangeBand())
                                        .attr("y", function (d) {
                                            return y(d.frequency);
                                        })
                                        .attr("height", function (d) {
                                            return height - y(d.frequency);
                                        });
                                }

                                jsOMS.ready(function () {
                                    d3.csv(URL + "/Modules/RiskManagement/data/cockpit/top.csv", type, function (error, data) {
                                        jsOMS.listenEvent(window, 'resize', function () {
                                            resize_chart1(data, "chart-1");
                                        });
                                        resize_chart1(data, "chart-1");
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>

                <div class="b b-2 c30-1 c30" id="i30-1-6">
                    <h1>
                        <?= $this->app->user->getL11n()->lang[21]['Groups']; ?>
                        <i class="fa fa-minus min"></i>
                        <i class="fa fa-plus max vh"></i>
                    </h1>

                    <div class="bc-1">
                        <div class="chart" id="chart-3">
                            <style type="text/css" scoped>
                                .rule {
                                    fill: none;
                                    stroke: #cacaca;
                                    stroke-width: 1px;
                                }

                                .area {
                                    fill: steelblue;
                                }
                            </style>
                            <script>
                                function resize_chart3(data, chart) {
                                    d3.select('#' + chart + " svg").remove();

                                    var margin = {top: 10, right: 10, bottom: 20, left: 30},
                                        width = parseFloat(jsOMS.getPropertyValue(document.getElementById(chart), 'width'), 10) - margin.left - margin.right,
                                        height = 300 - margin.top - margin.bottom,
                                        radius = Math.min(width, height) / 2;

                                    var color = d3.scale.ordinal()
                                        .range(["#98abc5", "#8a89a6", "#7b6888", "#6b486b", "#a05d56", "#d0743c", "#ff8c00"]);

                                    var arc = d3.svg.arc()
                                        .outerRadius(radius - 10)
                                        .innerRadius(0);

                                    var pie = d3.layout.pie()
                                        .sort(null)
                                        .value(function (d) {
                                            return d.population;
                                        });

                                    var svg = d3.select('#' + chart).append("svg")
                                        .attr("width", width)
                                        .attr("height", height)
                                        .append("g")
                                        .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

                                    var g = svg.selectAll(".arc")
                                        .data(pie(data))
                                        .enter().append("g")
                                        .attr("class", "arc");

                                    g.append("path")
                                        .attr("d", arc)
                                        .style("fill", function (d) {
                                            return color(d.data.age);
                                        });

                                    g.append("text")
                                        .attr("transform", function (d) {
                                            return "translate(" + arc.centroid(d) + ")";
                                        })
                                        .attr("dy", ".35em")
                                        .style("text-anchor", "middle")
                                        .text(function (d) {
                                            return d.data.age;
                                        });
                                }

                                jsOMS.ready(function () {
                                    d3.csv(URL + "/Modules/RiskManagement/data/cockpit/departments.csv", function (error, data) {
                                        data.forEach(function (d) {
                                            d.population = +d.population;
                                        });

                                        jsOMS.listenEvent(window, 'resize', function () {
                                            resize_chart3(data, "chart-3");
                                        });
                                        resize_chart3(data, "chart-3");
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>