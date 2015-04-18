(function (jsOMS, undefined) {
    jsOMS.Auth = function(uri) {
        this.account = null;
        this.uri = uri;
    };

    jsOMS.Auth.prototype.setAccount = function (account) {
        this.account = account;
    };

    jsOMS.Auth.prototype.getAccount = function () {
        return this.account;
    };

    jsOMS.Auth.prototype.login = function () {
        var authRequest = new jsOMS.Request();
        authRequest.setUri(this.uri);
        authRequest.setMethod(jsOMS.EnumRequestMethod.POST);
        authRequest.setResponseType(jsOMS.EnumRequestType.JSON);
        authRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        authRequest.setSuccess(function(xhr) {
            this.loginResult(xhr);
        });

        authRequest.send();
    };

    jsOMS.Auth.prototype.logout = function () {
        this.refresh();
    };

    jsOMS.Auth.prototype.loginResult = function(xhr) {
        location.reload();
    };

    jsOMS.Auth.prototype.handshake = function () {

    };

    jsOMS.Auth.prototype.setAuthKey = function () {

    };

    jsOMS.Auth.prototype.getAuthKey = function () {

    };
}(window.jsOMS = window.jsOMS || {}));