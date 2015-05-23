(function (jsOMS, undefined) {
    jsOMS.Chart = function() {
        this.title = null;
        this.subtitle = null;
        this.footer = null;
        this.legend = null;
        this.dataset = null;
    };

    jsOMS.Chart.prototype.setTitle = function(title) {
        this.title = title;
    };

    jsOMS.Chart.prototype.getTitle = function() {
        return this.title;
    };

    jsOMS.Chart.prototype.setSubtitle = function(subtitle) {
        this.subtitle = subtitle;
    };

    jsOMS.Chart.prototype.getSubtitle = function() {
        return this.subtitle;
    };

    jsOMS.Chart.prototype.setFooter = function(footer) {
        this.footer = footer;
    };

    jsOMS.Chart.prototype.getFooter = function() {
        return this.footer;
    };

    jsOMS.Chart.prototype.setLegend = function(legend) {
        this.legend = legend;
    };

    jsOMS.Chart.prototype.getLegend = function() {
        if(!this.legend) {
            this.legend = new jsOMS.ChartLegend();
        }

        return this.legend;
    };

    jsOMS.Chart.prototype.setDataset = function(dataset) {
        this.dataset = dataset;
    };

    jsOMS.Chart.prototype.getDataset = function() {
        return this.dataset;
    };
}(window.jsOMS = window.jsOMS || {}));