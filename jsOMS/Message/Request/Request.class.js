(function (jsOMS, undefined) {
    jsOMS.Request = function () {

    };

    jsOMS.Request.prototype.setType = function () {

    };

    jsOMS.Request.prototype.getType = function () {

    };

    jsOMS.Request.prototype.setHttpType = function () {

    };

    jsOMS.Request.prototype.getHttpType = function () {

    };

    jsOMS.Request.prototype.setUri = function () {

    };

    jsOMS.Request.prototype.getUri = function () {

    };

    jsOMS.Request.prototype.setData = function () {

    };

    jsOMS.Request.prototype.getData = function () {

    };

    jsOMS.Request.prototype.setAjax = function () {

    };

    jsOMS.Request.prototype.isAjax = function () {

    };

    jsOMS.Request.prototype.serializeData = function () {

    };

    jsOMS.Request.prototype.send = function () {
        var xhr = new XMLHttpRequest();
        xhr.open(this.type, this.url);
        xhr.responseType = this.responseType;
        xhr.setRequestHeader("Content-Type", this.requestHeader);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                this.success(xhr.responseText);
            }
        };

        if (this.type === jsOMS.EnumRequestType.GET) {
            xhr.send();
        } else {
            xhr.send(this.data);
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