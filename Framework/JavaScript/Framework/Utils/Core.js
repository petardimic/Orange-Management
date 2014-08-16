function setCookie(c_name, value, exdays, domain, path) {
    "use strict";

    var exdate = new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value = encodeURI(value) + ((exdays === null) ? "" : "; expires=" + exdate.toUTCString()) + ";domain=" + domain + ";path=" + path;
    document.cookie = c_name + "=" + c_value;
}

function supports_html5_storage() {
    "use strict";

    try {
        return 'localStorage' in window && window.localStorage !== null;
    } catch (e) {
        return false;
    }
}

function getCookie(c_name) {
    "use strict";

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
}