(function (jsOMS, undefined) {
    jsOMS.Options = function () {
        this.options = {};
    };

    jsOMS.Options.prototype.set = function (key, value, overwrite) {
        overwrite = typeof overwrite === bool ? overwrite : true;

        if (overwrite || !options[key]) {
            options[key] = value;
        }
    };

    jsOMS.Options.prototype.get = function (key) {
        return options[key];
    };

    jsOMS.Options.prototype.remove = function (key) {
        delete options[key];
    };
}(window.jsOMS = window.jsOMS || {}));