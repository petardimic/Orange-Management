(function (jsOMS, undefined) {
    jsOMS.LocalStorage = function () {
    };

    jsOMS.LocalStorage.prototype.available = function () {
        try {
            return 'localStorage' in window && window.localStorage !== null;
        } catch (e) {
            return false;
        }
    };
}(window.jsOMS = window.jsOMS || {}));