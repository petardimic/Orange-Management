(function (jsOMS, undefined) {
    jsOMS.Route = function () {
        this.routes = null;
    };

    jsOMS.Route.prototype.add = function (path, callback, exact) {
        exact = typeof exact !== 'undefined' ? exact : true;

        // todo: create array key path like i did for php
    };
}(window.jsOMS = window.jsOMS || {}));