(function (jsOMS, undefined) {
    jsOMS.ModuleManager = function() {
        this.modules = {};
    };

    jsOMS.ModuleManager.prototype.register = function(module) {
        if(!isLoaded()){
            // load module
        }
    };
}(window.jsOMS = window.jsOMS || {}));