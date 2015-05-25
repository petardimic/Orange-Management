(function (jsOMS, undefined) {
    jsOMS.Request = function () {
        this.uri = null;
        this.method = null;
        this.requestHeader = [];
        this.success = null;
        this.type = 'GET';
        this.data = {};

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
        this.requestHeader[type] = header;
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

    jsOMS.Request.prototype.setData = function (data) {
        this.data = data;
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

    jsOMS.Request.prototype.queryfy = function (obj) {
        var str = [];
        for (var p in obj) {
            if (obj.hasOwnProperty(p)) {
                str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
            }
        }
        return str.join("&");
    };

    jsOMS.Request.prototype.send = function () {
        var self = this;

        if(self.xhr.readyState !== 1) {
            self.xhr.open(this.method, this.uri);

            for (var p in this.requestHeader) {
                self.xhr.setRequestHeader(p, this.requestHeader[p]);
            }
        }

        self.xhr.onreadystatechange = function () {
            if (self.xhr.readyState === 4 && self.xhr.status === 200) {
                self.success(self.xhr);
            }
        };

        if(this.type === 'ajax') {
            if (typeof this.requestHeader !== 'undefined' && this.requestHeader['Content-Type'] === 'application/json') {
                console.log(JSON.stringify(this.data));
                self.xhr.send(JSON.stringify(this.data));
            } else {
                self.xhr.send(this.queryfy(this.data));
            }
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