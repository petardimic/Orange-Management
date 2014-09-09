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

function DataBinder(object_id) {
    "use strict";
    var pubSub = $({});

    var data_attr = "bind-" + object_id,
        message = object_id + ":change";

    $(document).on("change", "[data-" + data_attr + "]", function (evt) {
        var input = $(this);

        pubSub.trigger(message, [input.data(data_attr), input.val()]);
    });

    pubSub.on(message, function (evt, prop_name, new_val) {
        $("[data-" + data_attr + "=" + prop_name + "]").each(function () {
            var bound = $(this);

            if (bound.is("input, textarea, select")) {
                bound.val(new_val);
            } else {
                bound.html(new_val);
            }
        });
    });

    return pubSub;
}

var LoadedCSSJS = "";

function DynamicCSSJSLoad(path, filename, filetype) {
    "use strict";
    if (LoadedCSSJS.indexOf("[" + filename + "]") === -1) {
        if (filetype === "js") {
            var fileref = document.createElement('script');
            fileref.setAttribute("type", "text/javascript");
            fileref.setAttribute("src", path + filename);
        } else if (filetype === "css") {
            var fileref = document.createElement("link");
            fileref.setAttribute("rel", "stylesheet");
            fileref.setAttribute("type", "text/css");
            fileref.setAttribute("href", path + filename);
        }

        if (typeof fileref !== "undefined")
            document.getElementsByTagName("head")[0].appendChild(fileref);
    }

    LoadedCSSJS += "[" + filename + "]";
}