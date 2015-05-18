(function (jsOMS, undefined) {
    jsOMS.Response = function () {
        this.messages = {};
    };

    jsOMS.Response.prototype.add = function(key, message, request) {
        request = typeof request !== 'undefined' ? request : 'any';
        this.messages[key][request] = message;

    };

    jsOMS.Response.prototype.execute = function(key, data, request) {
        if(typeof request !== 'undefined' && typeof this.messages[key][request] !== 'undefined') {
            this.messages[key][request](data);
        } else {
            this.messages[key]['any'](data);
        }
    }
}(window.jsOMS = window.jsOMS || {}));