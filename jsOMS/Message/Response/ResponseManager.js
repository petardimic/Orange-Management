(function (jsOMS, undefined) {
    jsOMS.ResponseManager = function () {
        this.messages = {};
    };

    jsOMS.ResponseManager.prototype.add = function (key, message, request) {
        request = typeof request !== 'undefined' ? request : 'any';
        if (typeof this.messages[key] === 'undefined') {
            this.messages[key] = [];
        }

        this.messages[key][request] = message;
    };

    jsOMS.ResponseManager.prototype.execute = function (key, data, request) {
        console.log(data);
        if (typeof request !== 'undefined' && typeof this.messages[key][request] !== 'undefined') {
            this.messages[key][request](data);
        } else {
            this.messages[key]['any'](data);
        }
    }
}(window.jsOMS = window.jsOMS || {}));