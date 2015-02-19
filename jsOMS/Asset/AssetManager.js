(function (jsOMS, undefined) {
    jsOMS.AssetManager = function() {
        this.assets = {};
    };

    jsOMS.AssetManager.prototype.load = function(key, uri, type) {
        if(this.assets[key] !== undefined) {
            return;
        }

        this.assets[key] = 0;
    };

    jsOMS.AssetManager.prototype.unload = function(key) {
        delete this.assets[key];
    };
}(window.jsOMS = window.jsOMS || {}));