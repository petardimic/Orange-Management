(function (jsOMS, undefined) {
    jsOMS.Auth = function() {
        this.account = null;
    };

    jsOMS.Auth.prototype.setAccount = function (account) {
        this.account = account;
    };

    jsOMS.Auth.prototype.getAccount = function () {
        return this.account;
    };

    jsOMS.Auth.prototype.login = function () {

    };

    jsOMS.Auth.prototype.logout = function () {

    };

    jsOMS.Auth.prototype.refresh = function () {

    };

    jsOMS.Auth.prototype.handshake = function () {

    };

    jsOMS.Auth.prototype.setAuthKey = function () {

    };

    jsOMS.Auth.prototype.getAuthKey = function () {

    };
}(window.jsOMS = window.jsOMS || {}));