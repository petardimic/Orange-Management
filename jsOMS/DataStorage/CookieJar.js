(function (jsOMS, undefined) {
    jsOMS.CookieJar = function () {
    };

    /**
     * Saving data to cookie
     *
     * @param c_name Cookie name
     * @param value Value to save
     * @param exdays Lifetime for the cookie
     * @param domain Domain for the cookie
     * @param path Path for the cookie
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    jsOMS.CookieJar.prototype.setCookie = function (c_name, value, exdays, domain, path) {
        var exdate = new Date();
        exdate.setDate(exdate.getDate() + exdays);
        var c_value = encodeURI(value) + ((exdays === null) ? "" : "; expires=" + exdate.toUTCString()) + ";domain=" + domain + ";path=" + path;
        document.cookie = c_name + "=" + c_value;
    };

    /**
     * Loading cookie data
     *
     * @param c_name Cookie name
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    jsOMS.CookieJar.prototype.getCookie = function (c_name) {
        var c_value = document.cookie;
        var c_start = c_value.indexOf(" " + c_name + "=");

        if (c_start === -1) {
            c_start = c_value.indexOf(c_name + "=");
        }

        if (c_start === -1) {
            c_value = null;
        } else {
            c_start = c_value.indexOf("=", c_start) + 1;
            var c_end = c_value.indexOf(";", c_start);

            if (c_end === -1) {
                c_end = c_value.length;
            }

            c_value = decodeURI(c_value.substring(c_start, c_end));
        }
        return c_value;
    };
}(window.jsOMS = window.jsOMS || {}));