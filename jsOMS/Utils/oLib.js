/**
 * Core JS functionality
 *
 * This logic is supposed to minimize coding and support core javascript functionality.
 *
 * @category   App
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
var oLib = {
    /**
     * Loaded CSS or JS files
     *
     * @var string
     * @since 1.0.0
     */
    LoadedCSSJS: "",

    /**
     * AJAX
     *
     * @param Object obj AJAX variables
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
    ajax: function (obj) {
        var xhr = new XMLHttpRequest();
        xhr.open(obj.type, obj.url);
        xhr.responseType = obj.responseType;
        xhr.setRequestHeader("Content-Type", obj.requestHeader);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                obj.success(xhr.responseText);
            }
        };

        if (obj.type === 'GET') {
            xhr.send();
        } else {
            xhr.send(obj.data);
        }
    },

    /**
     * Event listener
     *
     * @param Element ele DOM Element
     * @param string listen Event identifier
     * @param ref func Callback function
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    listenEvent: function (ele, listen, func) {
        ele.addEventListener(listen, function (e) {
            func(e, ele)
        }, false);
    },

    /**
     * Property loader
     *
     * @param Element ele DOM Element
     * @param string value Property to get
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    getPropertyValue: function (ele, value) {
        return window.getComputedStyle(ele, null).getPropertyValue(value);
    },

    /**
     * Class finder
     *
     * Checking if a element has a class
     *
     * @param Element ele DOM Element
     * @param string cls Class to find
     *
     * @return boolean
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    hasClass: function (ele, cls) {
        return ele !== undefined && ele !== null && ele.className !== undefined && ele.className.match(new RegExp('(\\s|^)' + cls + '(\\s|$)'));
    },

    /**
     * Add class
     *
     * Adding a class to an element
     *
     * @param Element ele DOM Element
     * @param string cls Class to add
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    addClass: function (ele, cls) {
        if (!oLib.hasClass(ele, cls)) ele.className += " " + cls;
    },

    /**
     * Remove class
     *
     * Removing a class form an element
     *
     * @param Element ele DOM Element
     * @param string cls Class to remove
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    removeClass: function (ele, cls) {
        if (oLib.hasClass(ele, cls)) {
            var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
            ele.className = ele.className.replace(reg, '');
        }
    },

    /**
     * Ready invoke
     *
     * Invoking a function after page load
     *
     * @param ref func Callback function
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    ready: function (func) {
        document.addEventListener("DOMContentLoaded", function (event) {
            func();
        });
    },

    /**
     * Each loop
     *
     * Looping over a node array and performing a task with these nodes
     *
     * @param Node[] nodes DOM Nodes
     * @param ref func Callback function
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    each: function (nodes, func) {
        var length = nodes.length;

        for (var i = 0; i < length; i++) {
            func(nodes[i]);
        }
    },

    /**
     * Empty element
     *
     * Deleting content from element
     *
     * @param Element ele DOM Element
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    empty: function (ele) {
        while (ele.firstChild) {
            ele.removeChild(ele.firstChild);
        }
    },

    find: function (nodes, cls) {

    },

    getID: function (ele, cls) {

    },

    /**
     * Check node
     *
     * Checking if a selection is a node
     *
     * @param Node ele DOM Node
     *
     * @return boolean
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    isNode: function (ele) {
        return (
            typeof Node === "object" ? ele instanceof Node :
            ele && typeof ele === "object" && typeof ele.nodeType === "number" && typeof ele.nodeName === "string"
        );
    },

    /**
     * Check element
     *
     * Checking if a selection is a element
     *
     * @param Element o DOM Element
     *
     * @return boolean
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    isElement: function (o) {
        return (
            typeof HTMLElement === "object" ? o instanceof HTMLElement : o && typeof o === "object" && o !== null && o.nodeType === 1 && typeof o.nodeName === "string"
        );
    },

    /**
     * Getting element by class
     *
     * Getting a element by class in the first level
     *
     * @param Element ele DOM Element
     * @param string cls Class to find
     *
     * @return Element
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    getByClass: function (ele, cls) {
        var length = ele.childNodes.length;

        for (var i = 0; i < length; i++) {
            if (oLib.hasClass(ele.childNodes[i], cls)) {
                return ele.childNodes[i];
            }
        }

        return null;
    },

    /**
     * Getting element by tag
     *
     * Getting a element by tag in the first level
     *
     * @param Element ele DOM Element
     * @param string tag Tag to find
     *
     * @return Element
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    getByTag: function (ele, tag) {
        return ele.getElementsByTagName(tag);
    },

    /**
     * Merging two arrays recursively
     *
     * @param array target Target array
     * @param array source Source array
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    merge: function (target, source) {
        for (var p in source) {
            try {
                if (source[p].constructor == Object) {
                    target[p] = merge(target[p], source[p]);

                } else {
                    target[p] = source[p];
                }

            } catch (e) {
                target[p] = source[p];

            }
        }

        return target;
    },

    /**
     * Loading CSS or JS dynamically
     *
     * @param string path Path to the file
     * @param string filename Name of the file + filetype
     * @param string filetype Filetype
     * @param ref func Callback function
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    loadCSSJS: function (path, filename, filetype, func) {
        if (oLib.LoadedCSSJS.indexOf("[" + filename + "]") === -1) {
            var fileref = null;

            if (filetype === "js") {
                fileref = document.createElement('script');
                fileref.setAttribute("type", "text/javascript");
                fileref.setAttribute("src", path + filename);
            } else if (filetype === "css") {
                fileref = document.createElement("link");
                fileref.setAttribute("rel", "stylesheet");
                fileref.setAttribute("type", "text/css");
                fileref.setAttribute("href", path + filename);
            }

            if (typeof fileref !== "undefined")
                document.getElementsByTagName("head")[0].appendChild(fileref);
        }

        oLib.LoadedCSSJS += "[" + filename + "]";

        if (func !== undefined) {
            fileref.onreadystatechange = function () {
                if (this.readyState == 'complete') func();
            };

            fileref.onload = func();
        }
    },

    /**
     * Check if browser supports HTML5 storage
     *
     * @return boolean
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    supportsHTML5Storage: function () {
        try {
            return 'localStorage' in window && window.localStorage !== null;
        } catch (e) {
            return false;
        }
    },

    /**
     * Saving data to cookie
     *
     * @param string c_name Cookie name
     * @param string value Value to save
     * @param string exdays Lifetime for the cookie
     * @param string domain Domain for the cookie
     * @param string path Path for the cookie
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    setCookie: function (c_name, value, exdays, domain, path) {
        var exdate = new Date();
        exdate.setDate(exdate.getDate() + exdays);
        var c_value = encodeURI(value) + ((exdays === null) ? "" : "; expires=" + exdate.toUTCString()) + ";domain=" + domain + ";path=" + path;
        document.cookie = c_name + "=" + c_value;
    },

    /**
     * Loading cookie data
     *
     * @param string c_name Cookie name
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    getCookie: function (c_name) {
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
};