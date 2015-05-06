(function (jsOMS, undefined) {
    jsOMS.Request = function () {
        this.uri = null;
        this.method = null;
        this.requestHeader = null;
        this.success = null;
        this.isAjax = true;

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

    jsOMS.Request.prototype.setAjax = function (isAjax) {
        this.isAjax = isAjax;
    };

    jsOMS.Request.prototype.isAjax = function () {

    };

    jsOMS.Request.prototype.serializeData = function () {

    };

    jsOMS.Request.prototype.send = function () {
        this.xhr.open(this.method, this.url);

        this.xhr.onreadystatechange = function (xhr) {
            if (xhr.readyState === 4 && xhr.status === 200) {
                this.success(xhr);
            }
        };

        if (this.type === jsOMS.EnumRequestType.GET) {
            this.xhr.send();
        } else {
            this.xhr.send(this.data);
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