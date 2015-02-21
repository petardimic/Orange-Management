<?php /** @var \Modules\RiskManagement\Controller $this */
\phpOMS\Module\ModuleFactory::$loaded['Navigation']->call(\phpOMS\Module\CallType::WEB, null, [\Modules\Navigation\Models\NavigationType::CONTENT,
                                                                 1003001001]);
?>

<div class="tabview">
    <ul class="tab-links">
        <li class="active">
            <a href=".tab-1"><?= $this->app->user->getL11n()->lang[30]['Front'] ?></a>
        <li>
            <a href=".tab-2"><?= $this->app->user->getL11n()->lang[30]['Causes'] ?></a>
        <li>
            <a href=".tab-3"><?= $this->app->user->getL11n()->lang[30]['Solutions'] ?></a>
    </ul>

    <div class="tab-content">
        <div class="tab tab-1 active">
            <div class="b b-2 c30-1 c30" id="i30-1-1">
                <h1>
                    <?= $this->app->user->getL11n()->lang[30]['Risk']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <ul class="l-1">
                        <li><label><?= $this->app->user->getL11n()->lang[30]['Title']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->user->getL11n()->lang[30]['Description']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->user->getL11n()->lang[30]['Responsible']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->user->getL11n()->lang[30]['Unit']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->user->getL11n()->lang[30]['Probability']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->user->getL11n()->lang[30]['Damage']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->user->getL11n()->lang[30]['Parent']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->user->getL11n()->lang[30]['Department']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->user->getL11n()->lang[30]['Category']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->user->getL11n()->lang[30]['Process']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->user->getL11n()->lang[30]['Project']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->user->getL11n()->lang[30]['Limit']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->user->getL11n()->lang[30]['Interval']; ?></label>
                        <li><input type="text">
                    </ul>
                    <div class="rT">
                        <button><?= $this->app->user->getL11n()->lang[0]['Save'] ?></button>
                        <button><?= $this->app->user->getL11n()->lang[0]['Delete'] ?></button>
                    </div>
                </div>
            </div>

            <div class="b b-2 c30-1 c30" id="i30-1-1">
                <h1>
                    <?= $this->app->user->getL11n()->lang[30]['Evaluation']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <table class="tc-1">
                        <tr>
                            <th><label><?= $this->app->user->getL11n()->lang[30]['Severity']; ?></label>
                                <td>asdfsds
                        <tr>
                            <th><label><?= $this->app->user->getL11n()->lang[30]['Causes']; ?></label>
                                <td>asdfsds
                        <tr>
                            <th>
                                <label><?= $this->app->user->getL11n()->lang[30]['Solutions']; ?></label>
                                <td>asdfsds
                        <tr>
                            <th>
                                <label><?= $this->app->user->getL11n()->lang[30]['Reduction']; ?></label>
                                <td>asdfsds
                        <tr>
                            <th>
                                <label><?= $this->app->user->getL11n()->lang[30]['LastReevaluation']; ?></label>
                                <td>asdfsds
                        <tr>
                            <th><label><?= $this->app->user->getL11n()->lang[30]['NextReevaluation']; ?></label>
                            <td>asdfsds
                    </table>
                </div>
            </div>

            <div class="b b-2 c30-1 c30" id="i30-1-3">
                <h1>
                    <?= $this->app->user->getL11n()->lang[30]['History']; ?>
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
                                    width = parseFloat(jsOMS.getPropertyValue(document.getElementById(chart), 'width')) - margin.left - margin.right,
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
                                    .attr("x", width - margin.right - 6)
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

                                    d3.select(window).on('resize', function () {
                                        resize_chart2(data, "chart-2");
                                    });
                                    resize_chart2(data, "chart-2");
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab tab-2">
            <table class="t t-1 c1-2 c1" id="i1-2-1">
                <thead>
                <tr>
                    <th colspan="8" class="lT">
                        <i class="fa fa-filter p f dim"></i>

                        <h1><?= $this->app->user->getL11n()->lang[30]['Causes'] ?></h1>
                    <th class="rT">
                        <i class="fa fa-minus min"></i>
                        <i class="fa fa-plus max vh"></i>
                <tr>
                    <?php
                    \phpOMS\Model\Model::generate_table_header_view(
                        [
                            ['name' => $this->app->user->getL11n()->lang[0]['ID'], 'sort' => 1],
                            ['name' => $this->app->user->getL11n()->lang[30]['Name'], 'sort' => 0, 'full' => true],
                            ['name' => $this->app->user->getL11n()->lang[30]['Parent'], 'sort' => 0],
                            ['name' => $this->app->user->getL11n()->lang[30]['Risk'], 'sort' => 0],
                            ['name' => $this->app->user->getL11n()->lang[30]['Probability'], 'sort' => 0],
                            ['name' => $this->app->user->getL11n()->lang[30]['Ratio'], 'sort' => 0],
                            ['name' => $this->app->user->getL11n()->lang[30]['Department'], 'sort' => 0],
                            ['name' => $this->app->user->getL11n()->lang[30]['Category'], 'sort' => 0],
                            ['name' => $this->app->user->getL11n()->lang[30]['Active'], 'sort' => 0]
                        ]
                    );
                    ?>
                    <tbody>
                    <?php
                    /** @var \phpOMS\Models\User\Users $accounts */ /*
                            $data = $accounts->account_list_get();
                            $url['level'] = array_slice($request->getData(), 0, 4);
                            $url['level'][] = 'single';
                            $url['level'][] = 'front';
                            $url['id'] = 'id';

                            \phpOMS\Model\Model::generate_table_content_view(
                                $data['list'],
                                ['status', 'id', 'name1', 'lactive', 'created'],
                                $url
                            );*/
                    ?>
                    <tfoot>
                <tr>
                    <td colspan="9" class="cT">
                        <?php /* \phpOMS\Model\Model::generate_table_pagination_view($data['count']); */ ?>
            </table>
        </div>
        <div class="tab tab-3">
            <table class="t t-1 c1-2 c1" id="i1-2-1">
                <thead>
                <tr>
                    <th colspan="4" class="lT">
                        <i class="fa fa-filter p f dim"></i>

                        <h1><?= $this->app->user->getL11n()->lang[30]['Solutions'] ?></h1>
                    <th class="rT">
                        <i class="fa fa-minus min"></i>
                        <i class="fa fa-plus max vh"></i>
                <tr>
                    <?php
                    \phpOMS\Model\Model::generate_table_header_view(
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
                    /** @var \phpOMS\Models\User\Users $accounts */ /*
                                $data = $accounts->account_list_get();
                                $url['level'] = array_slice($request->getData(), 0, 4);
                                $url['level'][] = 'single';
                                $url['level'][] = 'front';
                                $url['id'] = 'id';

                                \phpOMS\Model\Model::generate_table_content_view(
                                    $data['list'],
                                    ['status', 'id', 'name1', 'lactive', 'created'],
                                    $url
                                );*/
                    ?>
                    <tfoot>
                <tr>
                    <td colspan="5" class="cT">
                        <?php //\phpOMS\Model\Model::generate_table_pagination_view($data['count']); ?>
            </table>
        </div>
    </div>
</div>