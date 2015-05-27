<?php
include __DIR__ . '/Worker.php';
?>

<!--suppress ALL -->
<div class="areamanager-report">
    <!-- Client rating -->
    <div id="areamanager-report-select">
        <h1><?= $lang['AreaManager']; ?></h1>

        <div>
            <form method="post"
                  action="<?= $this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost() . \phpOMS\Uri\UriFactory::build([$this->l11n->getLanguage(),
                                                                                                                                                   'api',
                                                                                                                                                   'reporter',
                                                                                                                                                   'single'], ['id' => $this->request->getData('id')]) ?>">
                <ul>
                    <li class="rf"><?= $now->format('Y-m-d'); ?>
                    <li><label for="i-areamanager"><?= $lang['AreaManager']; ?></label>: <select name="i-areamanager"
                                                                                                 id="i-areamanager">
                            <option value="-1" selected disabled><?= $lang['Select']; ?>
                                <?php foreach ($areas as $area): ?>
                            <option value="<?= $area; ?>"<?= $area === $source ? ' selected' : ''; ?>><?= $area; ?>
                                <?php endforeach; ?>
                        </select>
                </ul>
            </form>
        </div>
    </div>

    <!-- Client rating -->
    <table id="areamanager-report-rating">
        <thead>
        <tr>
            <th colspan="4"><?= $lang['ClientRating']; ?>
                <tbody>
        <tr>
            <th><?= $lang['Rating']; ?>
            <th><?= $now2->format('Y'); ?>
            <th><?= $now1->format('Y'); ?>
            <th><?= $now->format('Y'); ?>
        <tr>
            <th>A: (&#8364; > <?= number_format(5000, 0, '.', ','); ?>)
            <td><?= number_format($rating['vvj']['A'], 0, '.', ','); ?>
            <td><?= number_format($rating['vj']['A'], 0, '.', ','); ?>
            <td><?= number_format($rating['aj']['A'], 0, '.', ','); ?>
        <tr>
            <th>B: (<?= number_format(2500, 0, '.', ','); ?> < &#8364; &#8804; <?= number_format(5000, 0, '.', ','); ?>)
            <td><?= number_format($rating['vvj']['B'], 0, '.', ','); ?>
            <td><?= number_format($rating['vj']['B'], 0, '.', ','); ?>
            <td><?= number_format($rating['aj']['B'], 0, '.', ','); ?>
        <tr>
            <th>C: (<?= number_format(250, 0, '.', ','); ?> < &#8364; &#8804; <?= number_format(2500, 0, '.', ','); ?>)
            <td><?= number_format($rating['vvj']['C'], 0, '.', ','); ?>
            <td><?= number_format($rating['vj']['C'], 0, '.', ','); ?>
            <td><?= number_format($rating['aj']['C'], 0, '.', ','); ?>
        <tr>
            <th>D: (<?= number_format(1, 0, '.', ','); ?> < &#8364; &#8804; <?= number_format(250, 0, '.', ','); ?>)
            <td><?= number_format($rating['vvj']['D'], 0, '.', ','); ?>
            <td><?= number_format($rating['vj']['D'], 0, '.', ','); ?>
            <td><?= number_format($rating['aj']['D'], 0, '.', ','); ?>
        <tr>
            <th>E: (&#8364; &#8804; <?= number_format(1, 0, '.', ','); ?>)
            <td><?= number_format($rating['vvj']['E'], 0, '.', ','); ?>
            <td><?= number_format($rating['vj']['E'], 0, '.', ','); ?>
            <td><?= number_format($rating['aj']['E'], 0, '.', ','); ?>
    </table>

    <!-- Client new/lost -->
    <table id="areamanager-report-clientmovement">
        <thead>
        <tr>
            <th colspan="3"><?= $lang['ClientMovement']; ?>
                <tbody>
        <tr>
            <th><?= $lang['Type']; ?>
            <th><?= $lang['Value']; ?>
            <th><?= $lang['Turnover']; ?>
        <tr>
            <th><?= $lang['NewClients']; ?>
            <td><?= $movement['new']['value']; ?>
            <td><?= number_format($movement['new']['sales'], 0, '.', ','); ?>
        <tr>
            <th><?= $lang['LostClients']; ?>
            <td><?= $movement['lost']['value']; ?>
            <td><?= number_format($movement['lost']['sales'], 0, '.', ','); ?>
        <tr>
            <th><?= $lang['NotVisited']; ?>
            <td><?= $movement['notvisited']['value']; ?>
            <td><?= number_format($movement['notvisited']['sales'], 0, '.', ','); ?>
        <tr>
            <th><?= $lang['Visited']; ?>
            <td><?= $movement['visited']['value']; ?>
            <td><?= number_format($movement['visited']['sales'], 0, '.', ','); ?>
        <tr>
            <th><?= $lang['VisitedLost']; ?>
            <td><?= $movement['visitedlost']['value']; ?>
            <td><?= number_format($movement['visitedlost']['sales'], 0, '.', ','); ?>
    </table>

    <!-- Turnover -->
    <div class="areamanger-box full">
        <h1><?= $lang['TurnoverOverview']; ?></h1>

        <div class="reporter-scroll-wrapper">
            <table id="areamanager-report-turnoveroverview">
                <tbody>
                <tr>
                    <th><?= $lang['Type']; ?>
                    <th><?= $now2m->format('m'); ?>
                    <th><?= $now11m->format('m'); ?>
                    <th><?= $now1->format('Y m'); ?>
                    <th><?= $now->format('m'); ?>
                    <th><?= $lang['Diff']; ?>
                    <th><?= $lang['DiffP']; ?>
                    <th><?= $now2->format('Y') . ' ' . $now2->format('m'); ?>
                    <th><?= $now1->format('Y') . ' ' . $now1->format('m'); ?>
                    <th><?= $now->format('Y') . ' ' . $now->format('m'); ?>
                    <th><?= $lang['Diff']; ?>
                    <th><?= $lang['DiffP']; ?>
                    <th><?= $now2->format('Y'); ?>
                    <th><?= $now1->format('Y'); ?>
                    <th><?= $now->format('Y'); ?>
                    <th><?= $lang['Trend']; ?>
                <tr class="reporter-subheadline">
                    <th><?= $lang['Total']; ?>
                    <th><?php $sum = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum += $sales[$id][$nowm2ml];
                            }
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum += $sales[$id][$nowm1ml];
                            }
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum1 = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum1 += $sales[$id][(int) $now->format('m') + 12];
                            }
                        }
                        echo number_format($sum1, 2, ',', '.'); ?>
                    <th><?php $sum2 = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum2 += $sales[$id][(int) $now->format('m') + 24];
                            }
                        }
                        echo number_format($sum2, 2, ',', '.'); ?>
                        <?php $diff = ($sum1 === 0.0 ? 0.0 : 100 * ($sum2 - $sum1) / abs($sum1)); ?>
                    <th><?= number_format($sum2 - $sum1, 2, ',', '.'); ?>
                    <th><?= number_format($diff, 2, ',', '.'); ?>%
                    <th><?php $sum = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum += $sales['accumulated'][$id][1];
                            }
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum1 = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum1 += $sales['accumulated'][$id][2];
                            }
                        }
                        echo number_format($sum1, 2, ',', '.'); ?>
                    <th><?php $sum2 = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum2 += $sales['accumulated'][$id][3];
                            }
                        }
                        echo number_format($sum2, 2, ',', '.'); ?>
                        <?php $diff = ($sum1 === 0.0 ? 0.0 : 100 * ($sum2 - $sum1) / abs($sum1)); ?>
                    <th><?= number_format($sum2 - $sum1, 2, ',', '.'); ?>
                    <th><?= number_format($diff, 2, ',', '.'); ?>%
                    <th><?php $sum = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum += $sales['accumulated'][$id][4];
                            }
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum += $sales['accumulated'][$id][5];
                            }
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum += $sales['accumulated'][$id][6];
                            }
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><i class="fa fa-arrow-circle-o-right"
                           style="transform: rotate(<?= (int) rotatingTrend((int) $diff) ?>deg)"></i>
                        <?php foreach ($types as $ids) : ?>
                <tr class="reporter-subheadline">
                    <th><i class="fa fa-tag"></i> <?= $lang[$ids['title']]; ?>
                    <th><?php $sum = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum += $sales[$id][$nowm2ml];
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum += $sales[$id][$nowm1ml];
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum1 = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum1 += $sales[$id][(int) $now->format('m') + 12];
                        }
                        echo number_format($sum1, 2, ',', '.'); ?>
                    <th><?php $sum2 = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum2 += $sales[$id][(int) $now->format('m') + 24];
                        }
                        echo number_format($sum2, 2, ',', '.'); ?>
                        <?php $diff = ($sum1 === 0.0 ? 0.0 : 100 * ($sum2 - $sum1) / abs($sum1)); ?>
                    <th><?= number_format($sum2 - $sum1, 2, ',', '.'); ?>
                    <th><?= number_format($diff, 2, ',', '.'); ?>%
                    <th><?php $sum = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum += $sales['accumulated'][$id][1];
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum1 = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum1 += $sales['accumulated'][$id][2];
                        }
                        echo number_format($sum1, 2, ',', '.'); ?>
                    <th><?php $sum2 = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum2 += $sales['accumulated'][$id][3];
                        }
                        echo number_format($sum2, 2, ',', '.'); ?>
                        <?php $diff = ($sum1 === 0.0 ? 0.0 : 100 * ($sum2 - $sum1) / abs($sum1)); ?>
                    <th><?= number_format($sum2 - $sum1, 2, ',', '.'); ?>
                    <th><?= number_format($diff, 2, ',', '.'); ?>%
                    <th><?php $sum = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum += $sales['accumulated'][$id][4];
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum += $sales['accumulated'][$id][5];
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum += $sales['accumulated'][$id][6];
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><i class="fa fa-arrow-circle-o-right"
                           style="transform: rotate(<?= (int) rotatingTrend((int) $diff) ?>deg)"></i>
                        <?php foreach ($ids['elements'] as $id) : ?>
                <tr>
                    <th><?= $id . ' ' . $lang[$id]; ?>
                    <td><?= number_format($sales[$id][$nowm2ml], 2, ',', '.'); ?>
                    <td><?= number_format($sales[$id][$nowm1ml], 2, ',', '.'); ?>
                    <td><?= number_format($sales[$id][(int) $now->format('m') + 12], 2, ',', '.'); ?>
                    <td><?= number_format($sales[$id][(int) $now->format('m') + 24], 2, ',', '.'); ?>
                        <?php $diff = ($sales[$id][(int) $now->format('m') + 12] === 0.0 ? 0.0 : (100 * ($sales[$id][(int) $now->format('m') + 24] - $sales[$id][(int) $now->format('m') + 12]) / abs($sales[$id][(int) $now->format('m') + 12]))); ?>
                    <td class="delim coloring-<?php if($diff > 1) {
                        echo 1;
                    } elseif($diff < -1) {
                        echo -1;
                    } else {
                        echo 0;
                    } ?>"><?= number_format($sales[$id][(int) $now->format('m') + 24] - $sales[$id][(int) $now->format('m') + 12], 2, ',', '.'); ?>
                    <td class="delim coloring-<?php if($diff > 1) {
                        echo 1;
                    } elseif($diff < -1) {
                        echo -1;
                    } else {
                        echo 0;
                    } ?>"><?= number_format($diff, 2, ',', '.'); ?>%
                    <td><?= number_format($sales['accumulated'][$id][1], 2, ',', '.'); ?>
                    <td><?= number_format($sales['accumulated'][$id][2], 2, ',', '.'); ?>
                    <td><?= number_format($sales['accumulated'][$id][3], 2, ',', '.'); ?>
                        <?php $diff2 = ($sales['accumulated'][$id][2] === 0.0 ? 0.0 : (100 * ($sales['accumulated'][$id][3] - $sales['accumulated'][$id][2]) / abs($sales['accumulated'][$id][2]))); ?>
                    <td class="delim coloring-<?php if($diff2 > 1) {
                        echo 1;
                    } elseif($diff2 < -1) {
                        echo -1;
                    } else {
                        echo 0;
                    } ?>"><?= number_format($sales['accumulated'][$id][3] - $sales['accumulated'][$id][2], 2, ',', '.'); ?>
                    <td class="delim coloring-<?php if($diff2 > 1) {
                        echo 1;
                    } elseif($diff2 < -1) {
                        echo -1;
                    } else {
                        echo 0;
                    } ?>"><?= number_format($diff2, 2, ',', '.'); ?>%
                    <td><?= number_format($sales['accumulated'][$id][4], 2, ',', '.'); ?>
                    <td><?= number_format($sales['accumulated'][$id][5], 2, ',', '.'); ?>
                    <td><?= number_format($sales['accumulated'][$id][6], 2, ',', '.'); ?>
                    <td class="coloring-<?php if($diff2 > 1) {
                        echo 1;
                    } elseif($diff2 < -1) {
                        echo -1;
                    } else {
                        echo 0;
                    } ?>">
                        <i class="fa fa-arrow-circle-o-right"
                           style="transform: rotate(<?= (int) rotatingTrend((int) $diff2) ?>deg)"></i>
                        <?php endforeach; ?>
                        <?php endforeach; ?>
            </table>
        </div>
    </div>

    <script>
        jsOMS.ready(function () {
            assetManager.load(Url + '/Modules/Reporter/Templates/AreaManager', 'AreaManager.css', 'css');

            var amSelect = document.getElementById('i-areamanager');
            amSelect.onchange = function () {
                window.location.href = '<?= $this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost() . '/' . $this->request->getUri()->getPath() ; ?>.php?id=AreaManager&source=' + amSelect.value;
            };
        });
    </script>

    <div class="areamanger-box half">
        <style scoped>
            .axis path, .axis line {
                fill: none;
                stroke: #777;
                shape-rendering: crispEdges;
            }

            .axis text {
                font-size: 13px;
            }

            .legend {
                font-size: 14px;
                font-weight: bold;
            }

            .tick text {
                font-size: 12px;
            }

            .tick line {
                opacity: 0.4;
            }
        </style>

        <svg id="visualisation" width="100%" height="300"></svg>
        <?php
        $chartData  = '';
        $chartData2 = '';
        $chartData3 = '';
        $chartData4 = '';
        $first      = true;

        foreach($types as $ids) {
            $sum  = 0.0;
            $sum2 = 0.0;
            foreach($ids['elements'] as $id) {
                $sum += $sales[$id][(int) $now->format('m') + 24];
                $sum2 += $sales['accumulated'][$id][3];
            }

            if($sum > 1000) {
                $chartData3 .= '{"label": "' . $lang[$ids['title']] . '", "value": "' . $sum . '"},';
            }

            if($sum2 > 3000) {
                $chartData4 .= '{"label": "' . $lang[$ids['title']] . '", "value": "' . $sum2 . '"},';
            }
        }

        $acc = 0.0;
        for($i = 1; $i < 37; $i++) {
            $sum = 0.0;
            foreach($types as $ids) {
                foreach($ids['elements'] as $id) {
                    $sum += $sales[$id][$i];
                }
            }

            $acc += $sum;

            if($sum > 0.0 || $first) {
                $first = true;

                if($i <= 12) {
                    $title = $now2->format('Y');
                } elseif($i <= 24) {
                    $title = $now1->format('Y');
                } else {
                    $title = $now->format('Y');
                }

                $chartData .= '{ "Year": "' . $title . '", "sale": "' . $sum . '", "month": "' . (((int) $i % 12 === 0 ? 12 : (int) $i % 12)) . '" },';

                if($sum == 0.0) {
                    $first = false;
                } else {
                    $chartData2 .= '{ "Year": "' . $title . '", "sale": "' . $acc . '", "month": "' . (((int) $i % 12 === 0 ? 12 : (int) $i % 12)) . '" },';
                }
            }

            if($i % 12 === 0) {
                $acc = 0.0;
            }
        }

        $chartData  = rtrim($chartData, ',');
        $chartData2 = rtrim($chartData2, ',');
        $chartData3 = rtrim($chartData3, ',');
        ?>

        <script>
            jsOMS.ready(function () {
                function InitChart() {
                    var color = ["#ff0000", "#00ff00", "#0000ff"];
                    var data = [<?= $chartData; ?>];
                    var dataGroup = d3.nest()
                        .key(function (d) {
                            return d.Year;
                        })
                        .entries(data);

                    var vis = d3.select("#visualisation"),
                        WIDTH = document.getElementById('visualisation').offsetWidth / 2,
                        HEIGHT = document.getElementById('visualisation').offsetHeight,
                        MARGINS = {
                            top: 50,
                            right: 20,
                            bottom: 50,
                            left: 70
                        },
                        lSpace = WIDTH / dataGroup.length;

                    xScale = d3.scale.linear().range([MARGINS.left, WIDTH - MARGINS.right]).domain([d3.min(data, function (d) {
                        return +d.month;
                    }), d3.max(data, function (d) {
                        return +d.month;
                    })]),
                        yScale = d3.scale.linear().range([HEIGHT - MARGINS.top, MARGINS.bottom]).domain([d3.min(data, function (d) {
                            return +d.sale;
                        }), d3.max(data, function (d) {
                            return +d.sale;
                        })]),
                        xAxis = d3.svg.axis()
                            .scale(xScale)
                            .orient("bottom");
                    yAxis = d3.svg.axis()
                        .scale(yScale)
                        .orient("left")
                        .innerTickSize(-WIDTH + MARGINS.right + MARGINS.left)
                        .outerTickSize(10)
                        .tickPadding(10);

                    vis.append("svg:g")
                        .attr("class", "x axis")
                        .attr("transform", "translate(0," + (HEIGHT - MARGINS.bottom) + ")")
                        .call(xAxis);
                    vis.append("svg:g")
                        .attr("class", "y axis")
                        .attr("transform", "translate(" + (MARGINS.left) + ",0)")
                        .call(yAxis);

                    var lineGen = d3.svg.line()
                        .x(function (d) {
                            return xScale(d.month);
                        })
                        .y(function (d) {
                            return yScale(d.sale);
                        });
                    dataGroup.forEach(function (d, i) {
                        vis.append('svg:path')
                            .attr('d', lineGen(d.values))
                            .attr('stroke', gcolor = function (d, j) {
                                return color[i];
                            })
                            .attr('stroke-width', 2)
                            .attr('id', 'line_' + d.key)
                            .attr('fill', 'none');
                        vis.append("text")
                            .attr("x", (lSpace / 2) + i * lSpace)
                            .attr("y", HEIGHT)
                            .style('fill', gcolor)
                            .attr("class", "legend")
                            .on('click', function () {
                                var active = d.active ? false : true;
                                var opacity = active ? 0 : 1;
                                d3.select("#line_" + d.key).style("opacity", opacity);
                                d.active = active;
                            })
                            .text(d.key);
                    });

                    vis.append("text")
                        .attr("x", (WIDTH / 2))
                        .attr("y", MARGINS.top / 2)
                        .attr("text-anchor", "middle")
                        .style("font-size", "16px")
                        .style("text-decoration", "underline")
                        .text("<?= $lang['Sales3Y']; ?>");

                }

                InitChart();
            });
        </script>
    </div>

    <div class="areamanger-box half">
        <style scoped>
            .axis path, .axis line {
                fill: none;
                stroke: #777;
                shape-rendering: crispEdges;
            }

            .axis text {
                font-size: 13px;
            }

            .legend {
                font-size: 14px;
                font-weight: bold;
            }

            .tick text {
                font-size: 12px;
            }

            .tick line {
                opacity: 0.4;
            }
        </style>

        <svg id="visualisation2" width="100%" height="300"></svg>

        <script>
            jsOMS.ready(function () {
                function InitChart() {
                    var color = ["#ff0000", "#00ff00", "#0000ff"];
                    var data = [<?= $chartData2; ?>];
                    var dataGroup = d3.nest()
                        .key(function (d) {
                            return d.Year;
                        })
                        .entries(data);

                    var vis = d3.select("#visualisation2"),
                        WIDTH = document.getElementById('visualisation2').offsetWidth / 2,
                        HEIGHT = document.getElementById('visualisation2').offsetHeight,
                        MARGINS = {
                            top: 50,
                            right: 20,
                            bottom: 50,
                            left: 70
                        },
                        lSpace = WIDTH / dataGroup.length;

                    xScale = d3.scale.linear().range([MARGINS.left, WIDTH - MARGINS.right]).domain([d3.min(data, function (d) {
                        return +d.month;
                    }), d3.max(data, function (d) {
                        return +d.month;
                    })]),
                        yScale = d3.scale.linear().range([HEIGHT - MARGINS.top, MARGINS.bottom]).domain([d3.min(data, function (d) {
                            return +d.sale;
                        }), d3.max(data, function (d) {
                            return +d.sale;
                        })]),
                        xAxis = d3.svg.axis()
                            .scale(xScale)
                            .orient("bottom");
                    yAxis = d3.svg.axis()
                        .scale(yScale)
                        .orient("left")
                        .innerTickSize(-WIDTH + MARGINS.right + MARGINS.left)
                        .outerTickSize(10)
                        .tickPadding(10);

                    vis.append("svg:g")
                        .attr("class", "x axis")
                        .attr("transform", "translate(0," + (HEIGHT - MARGINS.bottom) + ")")
                        .call(xAxis);
                    vis.append("svg:g")
                        .attr("class", "y axis")
                        .attr("transform", "translate(" + (MARGINS.left) + ",0)")
                        .call(yAxis);

                    var lineGen = d3.svg.line()
                        .x(function (d) {
                            return xScale(d.month);
                        })
                        .y(function (d) {
                            return yScale(d.sale);
                        });
                    dataGroup.forEach(function (d, i) {
                        vis.append('svg:path')
                            .attr('d', lineGen(d.values))
                            .attr('stroke', gcolor = function (d, j) {
                                return color[i];
                            })
                            .attr('stroke-width', 2)
                            .attr('id', 'line2_' + d.key)
                            .attr('fill', 'none');
                        vis.append("text")
                            .attr("x", (lSpace / 2) + i * lSpace)
                            .attr("y", HEIGHT)
                            .style('fill', gcolor)
                            .attr("class", "legend")
                            .on('click', function () {
                                var active = d.active ? false : true;
                                var opacity = active ? 0 : 1;
                                d3.select("#line2_" + d.key).style("opacity", opacity);
                                d.active = active;
                            })
                            .text(d.key);
                    });

                    vis.append("text")
                        .attr("x", (WIDTH / 2))
                        .attr("y", MARGINS.top / 2)
                        .attr("text-anchor", "middle")
                        .style("font-size", "16px")
                        .style("text-decoration", "underline")
                        .text("<?= $lang['Sales3YAcc']; ?>");

                }

                InitChart();
            });
        </script>
    </div>

    <div class="areamanger-box half cT">
        <style scoped>
            .arc path {
                stroke: #fff;
                stroke-width: 2;
            }
        </style>
        <svg id="visualisation3" width="600" height="250"></svg>

        <script>
            jsOMS.ready(function () {

                function InitChart() {
                    var color = d3.scale.category20c();
                    var data = [<?= $chartData3; ?>];
                    var w = document.getElementById('visualisation3').offsetWidth / 2,
                        h = document.getElementById('visualisation3').offsetHeight,
                        r = 290 / 2;


                    var vis = d3.select('#visualisation3').data([data]).attr("width", w).attr("height", h).append("svg:g").attr("transform", "translate(" + r + "," + r + ")");
                    var pie = d3.layout.pie().value(function (d) {
                        return d.value;
                    });

                    // declare an arc generator function
                    var arc = d3.svg.arc().outerRadius(100);

                    // select paths, use arc generator to draw
                    var arcs = vis.selectAll("g.slice").data(pie).enter().append("svg:g").attr("class", "slice").attr("class", "arc");
                    arcs.append("svg:path")
                        .attr("fill", function (d, i) {
                            return color(i);
                        })
                        .attr("d", function (d) {
                            return arc(d);
                        });

                    var g = vis.selectAll(".arc")
                        .data(pie(data))
                        .enter().append("g")
                        .attr("class", "arc");

                    g.append("path")
                        .attr("d", arcs)
                        .style("fill", function (d) {
                            return color(d.data.value);
                        });

                    g.append("text")
                        .attr("transform", function (d) {
                            return "translate(" + arcs.centroid(d) + ")";
                        })
                        .attr("dy", ".35em")
                        .style("text-anchor", "middle");

                    arcs.append("svg:text").attr("transform", function (d) {
                        d.innerRadius = r - 40;
                        d.outerRadius = r;
                        return "translate(" + arc.centroid(d) + ")";
                    }).attr("text-anchor", "middle").text(function (d, i) {
                            return data[i].label;
                        }
                    );

                    vis.append("text")
                        .attr("x", 0)
                        .attr("y", -r + 20)
                        .attr("text-anchor", "middle")
                        .style("font-size", "16px")
                        .style("text-decoration", "underline")
                        .text("<?= $lang['SalesRatio'] . ' ' . $now->format('Y-m'); ?>");
                };

                InitChart();
            });
        </script>
    </div>

    <div class="areamanger-box half cT">
        <style scoped>
            .arc path {
                stroke: #fff;
                stroke-width: 2;
            }
        </style>
        <svg id="visualisation4" width="600" height="250"></svg>

        <script>
            jsOMS.ready(function () {
                function InitChart() {
                    var color = d3.scale.category20c();

                    var data = [<?= $chartData4; ?>];

                    var w = document.getElementById('visualisation4').offsetWidth / 2,
                        h = document.getElementById('visualisation4').offsetHeight,
                        r = 290 / 2;


                    var vis = d3.select('#visualisation4').data([data]).attr("width", w).attr("height", h).append("svg:g").attr("transform", "translate(" + r + "," + r + ")");
                    var pie = d3.layout.pie().value(function (d) {
                        return d.value;
                    });

                    // declare an arc generator function
                    var arc = d3.svg.arc().outerRadius(100);

                    // select paths, use arc generator to draw
                    var arcs = vis.selectAll("g.slice").data(pie).enter().append("svg:g").attr("class", "slice").attr("class", "arc");
                    arcs.append("svg:path")
                        .attr("fill", function (d, i) {
                            return color(i);
                        })
                        .attr("d", function (d) {
                            return arc(d);
                        });

                    var g = vis.selectAll(".arc")
                        .data(pie(data))
                        .enter().append("g")
                        .attr("class", "arc");

                    g.append("path")
                        .attr("d", arcs)
                        .style("fill", function (d) {
                            return color(d.data.value);
                        });

                    g.append("text")
                        .attr("transform", function (d) {
                            return "translate(" + arcs.centroid(d) + ")";
                        })
                        .attr("dy", ".35em")
                        .style("text-anchor", "middle");

                    arcs.append("svg:text").attr("transform", function (d) {
                        d.innerRadius = r - 40;
                        d.outerRadius = r;
                        return "translate(" + arc.centroid(d) + ")";
                    }).attr("text-anchor", "middle").text(function (d, i) {
                            return data[i].label;
                        }
                    );

                    vis.append("text")
                        .attr("x", 0)
                        .attr("y", -r + 20)
                        .attr("text-anchor", "middle")
                        .style("font-size", "16px")
                        .style("text-decoration", "underline")
                        .text("<?= $lang['SalesRatioAcc'] . ' ' . $now->format('Y-m'); ?>");
                };

                InitChart();
            });
        </script>
    </div>
</div>
