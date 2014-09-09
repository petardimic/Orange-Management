function oChart(dataset, chart, text, legend, axis) {
    this.dataset = null;
    this.chart = null;
    this.text = null;
    this.legend = null;
    this.axis = null;
}

function oLineChart(dataset, chart, text, legend, axis) {
    this.chart = {
        margin: {
            top: 0,
            right: 0,
            bottom: 0,
            left: 0
        },
        zoomable: false,
        rotatable: false,
        text: {
            title: {
                active: false,
                text: '',
                size: '16px',
                weight: 'bold',
                color: '#000',
                position: 'center'
            },
            subtitle: {
                active: false,
                text: '',
                size: '16px',
                weight: 'bold',
                color: '#000',
                position: 'center'
            },
            footer: {
                active: false,
                text: '',
                size: '16px',
                weight: 'bold',
                color: '#000',
                position: 'center'
            }
        },
        legend: {
            position: {
                horizontal: 'right', /* priority = 1 */
                vertical: 'center', /* priority = 2 */
                priority: 1
            },
            orientation: "vertical",
            title: {
                active: false,
                text: '',
                size: '16px',
                weight: 'bold',
                color: '#000',
                position: 'center'
            },
            hover: {
                active: true,
                action: [
                    'line'
                ]
            },
            select: [
                'hide'
            ]
        },
        axis: {
            x1: {
                active: true,
                color: '#000',
                size: '1px',
                label: {
                    active: false,
                    text: '',
                    size: '16px',
                    weight: 'bold',
                    color: '#000',
                    position: {
                        pos1: 'end',
                        pos2: 'top'
                    },
                    orientation: 'horizontal'
                },
                ticks: {
                    active: true,
                    color: '#000',
                    steps: 10,
                },
                subticks: {
                    active: true,
                    color: '#000',
                    steps: 1,
                },
                type: 'data'
            },
            y1: {
                active: true,
                color: '#000',
                size: '1px',
                label: {
                    active: false,
                    text: '',
                    size: '16px',
                    weight: 'bold',
                    color: '#000',
                    position: {
                        pos1: 'end',
                        pos2: 'top'
                    },
                    orientation: 'horizontal'
                },
                ticks: {
                    active: true,
                    color: '#000',
                    steps: 10,
                },
                subticks: {
                    active: true,
                    color: '#000',
                    steps: 1,
                },
                type: 'data'
            },
            z1: {
                active: false,
                color: '#000',
                size: '1px',
                label: {
                    active: false,
                    text: '',
                    size: '16px',
                    weight: 'bold',
                    color: '#000',
                    position: {
                        pos1: 'end',
                        pos2: 'top'
                    },
                    orientation: 'horizontal'
                },
                ticks: {
                    active: true,
                    color: '#000',
                    steps: 10,
                },
                subticks: {
                    active: true,
                    color: '#000',
                    steps: 1,
                },
                type: 'data'
            },
            x2: {
                active: false,
                color: '#000',
                size: '1px',
                label: {
                    active: false,
                    text: '',
                    size: '16px',
                    weight: 'bold',
                    color: '#000',
                    position: {
                        pos1: 'end',
                        pos2: 'top'
                    },
                    orientation: 'horizontal'
                },
                ticks: {
                    active: true,
                    color: '#000',
                    steps: 10,
                },
                subticks: {
                    active: true,
                    color: '#000',
                    steps: 1,
                },
                type: 'data'
            },
            y2: {
                active: false,
                color: '#000',
                size: '1px',
                label: {
                    active: false,
                    text: '',
                    size: '16px',
                    weight: 'bold',
                    color: '#000',
                    position: {
                        pos1: 'end',
                        pos2: 'top'
                    },
                    orientation: 'horizontal'
                },
                ticks: {
                    active: true,
                    color: '#000',
                    steps: 10,
                },
                subticks: {
                    active: true,
                    color: '#000',
                    steps: 1,
                },
                type: 'data'
            },
            z2: {
                active: false,
                color: '#000',
                size: '1px',
                label: {
                    active: false,
                    text: '',
                    size: '16px',
                    weight: 'bold',
                    color: '#000',
                    position: {
                        pos1: 'end',
                        pos2: 'top'
                    },
                    orientation: 'horizontal'
                },
                ticks: {
                    active: true,
                    color: '#000',
                    steps: 10,
                },
                subticks: {
                    active: true,
                    color: '#000',
                    steps: 1,
                },
                type: 'data'
            }
        }
    };

    oChart.call(this, dataset, chart, text, legend, axis);
}

oLineChart.prototype = Object.create(oChart.prototype);
oLineChart.prototype.constructor = oLineChart;

oLineChart.prototype.redraw(id)
{
    d3.select(id + " svg").remove();

    this.drawChart(id);
    this.drawAxis(id);
    this.drawLegend(id);
    this.drawText(id);
}

oLineChart.prototype.draw(id)
{
    this.redraw(id);
}

oLineChart.prototype.drawChart(id)
{
    var $$ = $(id),
        width = $$.innerWidth() - this.chart.margin.left - this.chart.margin.right,
        height = $$.innerHeight() - this.chart.margin.top - this.chart.margin.bottom;

    var x1 = d3.time.scale().range([0, width]),
        y1 = d3.time.scale().range([height, 0]);

    var lineFormula1 = d3.svg.line()
        .x1(function (d) {
            return x1(d.xVal1);
        })
        .y1(function (d) {
            return y1(d.yVal1);
        });

    var svg = d3.select(id).append("svg")
        .attr("width", width + this.chart.margin.left + this.chart.margin.right)
        .attr("height", height + this.chart.margin.top + this.chart.margin.bottom)
        .append("g")
        .attr("transform", "translate(" + this.chart.margin.left + "," + this.chart.margin.top + ")");

    x1.domain(d3.extent(this.data[0], function (d) {
        return d.xVal1;
    }));

    y1.domain(d3.extent(this.data[0], function (d) {
        return d.yVal1;
    }));
}

oLineChart.prototype.drawLine(line)
{
    svg.append("path")
        .datum(this.data[line])
        .attr("class", "line")
        .attr("d", lineFormula1);
}

oLineChart.prototype.drawAxis()
{
    var xAxis1 = d3.svg.axis()
        .scale(x1)
        .orient("bottom");

    var yAxis1 = d3.svg.axis()
        .scale(y1)
        .orient("left");
}

oLineChart.prototype.drawLegend()
{

}

oLineChart.prototype.drawText()
{

}

function oBarChart(dataset, chart, text, legend, axis) {
    oChart.call(this, dataset, chart, text, legend, axis);
}

function oAreaChart(dataset, chart, text, legend, axis) {
    oChart.call(this, dataset, chart, text, legend, axis);
}

function oDonutChart(dataset, chart, text, legend, axis) {
    oChart.call(this, dataset, chart, text, legend, axis);
}

function oSunburstChart(dataset, chart, text, legend, axis) {
    oChart.call(this, dataset, chart, text, legend, axis);
}

function oMatrixChart(dataset, chart, text, legend, axis) {
    oChart.call(this, dataset, chart, text, legend, axis);
}

function oBubbleChart(dataset, chart, text, legend, axis) {
    oChart.call(this, dataset, chart, text, legend, axis);
}

function oGraphChart(dataset, chart, text, legend, axis) {
    oChart.call(this, dataset, chart, text, legend, axis);
}

function oTreeChart(dataset, chart, text, legend, axis) {
    oGraphChart.call(this, dataset, chart, text, legend, axis);
}

function oMapChart(dataset, chart, text, legend, axis) {
    oChart.call(this, dataset, chart, text, legend, axis);
}

