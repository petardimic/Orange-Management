(function (jsOMS, undefined) {
    jsOMS.Request = function () {
        this.uri = null;
        this.method = null;
        this.requestHeader = null;
        this.success = null;
        this.type = 'GET';
        this.data = [];

        this.xhr = new XMLHttpRequest();
    };

    jsOMS.Request.prototype.setMethod = function (method) {
        this.method = method;
    };

    jsOMS.Request.prototype.getMethod = function () {
        return this.method;
    };

    jsOMS.Request.prototype.setResponseType = function (type) {
        this.xhr.responseType = this.responseType;
    };

    jsOMS.Request.prototype.getResponseType = function () {
        return this.responseType;
    };

    jsOMS.Request.prototype.setRequestHeader = function (type, header) {
        this.xhr.setRequestHeader(type, header);
    };

    jsOMS.Request.prototype.getRequestHeader = function () {
        return this.requestHeader;
    };

    jsOMS.Request.prototype.setUri = function (uri) {
        this.uri = uri;
    };

    jsOMS.Request.prototype.getUri = function () {
        return this.uri;
    };

    jsOMS.Request.prototype.setSuccess = function (callback) {
        this.success = callback;
    };

    jsOMS.Request.prototype.setData = function () {

    };

    jsOMS.Request.prototype.getData = function () {

    };

    jsOMS.Request.prototype.setType = function (type) {
        this.type = type;
    };

    jsOMS.Request.prototype.getType = function () {

    };

    jsOMS.Request.prototype.serializeData = function () {

    };

    jsOMS.Request.prototype.send = function () {
        var self = this;

        self.xhr.open(this.method, this.uri);

        self.xhr.onreadystatechange = function () {
            if (self.xhr.readyState === 4 && self.xhr.status === 200) {
                self.success(self.xhr);
            }
        };

        if (this.type === 'ajax') {
            self.xhr.send(JSON.stringify(this.data));
        }
    };

    /**
     * AJAX
     *
     * @param obj AJAX variables
     *
     * The following obj variables are expected:
     * responseType - Type of the response
     * requestHeader - Header description for the request
     * success - Success callback function
     * error - Error callback function
     * type - GET, PUT, DELETE, POST type
     * url - Request url
     * data - Data to send
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
}(window.jsOMS = window.jsOMS || {}));