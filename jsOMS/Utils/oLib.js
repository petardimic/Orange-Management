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
(function (jsOMS, undefined) {
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
    jsOMS.ajax = function (obj) {
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
    };

    /**
     * Event listener
     *
     * @param ele DOM Element
     * @param listen Event identifier
     * @param func Callback function
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    jsOMS.listenEvent = function (ele, listen, func) {
        ele.addEventListener(listen, function (e) {
                func(e, ele)
            },
            false
        );
    };

    /**
     * Property loader
     *
     * @param ele DOM Element
     * @param value Property to get
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    jsOMS.getPropertyValue = function (ele, value) {
        return window.getComputedStyle(ele, null).getPropertyValue(value);
    };

    /**
     * Class finder
     *
     * Checking if a element has a class
     *
     * @param ele DOM Element
     * @param cls Class to find
     *
     * @return boolean
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    jsOMS.hasClass = function (ele, cls) {
        return ele !== undefined && ele !== null && ele.className !== undefined && ele.className.match(new RegExp('(\\s|^)' + cls + '(\\s|$)'));
    };

    /**
     * Add class
     *
     * Adding a class to an element
     *
     * @param ele DOM Element
     * @param cls Class to add
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    jsOMS.addClass = function (ele, cls) {
        if (!jsOMS.hasClass(ele, cls)) {
            ele.className += " " + cls;
        }
    };

    /**
     * Remove class
     *
     * Removing a class form an element
     *
     * @param ele DOM Element
     * @param cls Class to remove
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    jsOMS.removeClass = function (ele, cls) {
        if (jsOMS.hasClass(ele, cls)) {
            var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
            ele.className = ele.className.replace(reg, '');
        }
    };

    /**
     * Ready invoke
     *
     * Invoking a function after page load
     *
     * @param func Callback function
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    jsOMS.ready = function (func) {
        document.addEventListener("DOMContentLoaded", function (event) {
            func();
        });
    };

    /**
     * Each loop
     *
     * Looping over a node array and performing a task with these nodes
     *
     * @param nodes DOM Nodes
     * @param func Callback function
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    jsOMS.each = function (nodes, func) {
        var length = nodes.length;

        for (var i = 0; i < length; i++) {
            func(nodes[i]);
        }
    };

    /**
     * Empty element
     *
     * Deleting content from element
     *
     * @param ele DOM Element
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    jsOMS.empty = function (ele) {
        while (ele.firstChild) {
            ele.removeChild(ele.firstChild);
        }
    };

    jsOMS.find = function (nodes, cls) {

    };

    jsOMS.getID = function (ele, cls) {

    };

    /**
     * Check node
     *
     * Checking if a selection is a node
     *
     * @param ele DOM Node
     *
     * @return boolean
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    jsOMS.isNode = function (ele) {
        return (
            typeof Node === "object" ? ele instanceof Node :
            ele && typeof ele === "object" && typeof ele.nodeType === "number" && typeof ele.nodeName === "string"
        );
    };

    /**
     * Check element
     *
     * Checking if a selection is a element
     *
     * @param o DOM Element
     *
     * @return boolean
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    jsOMS.isElement = function (o) {
        return (
            typeof HTMLElement === "object" ? o instanceof HTMLElement : o && typeof o === "object" && o !== null && o.nodeType === 1 && typeof o.nodeName === "string"
        );
    };

    /**
     * Getting element by class
     *
     * Getting a element by class in the first level
     *
     * @param ele DOM Element
     * @param cls Class to find
     *
     * @return Element
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    jsOMS.getByClass = function (ele, cls) {
        var length = ele.childNodes.length;

        for (var i = 0; i < length; i++) {
            if (jsOMS.hasClass(ele.childNodes[i], cls)) {
                return ele.childNodes[i];
            }
        }

        return null;
    };

    /**
     * Getting element by tag
     *
     * Getting a element by tag in the first level
     *
     * @param ele DOM Element
     * @param tag Tag to find
     *
     * @return Element
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    jsOMS.getByTag = function (ele, tag) {
        return ele.getElementsByTagName(tag);
    };

    /**
     * Merging two arrays recursively
     *
     * @param target Target array
     * @param source Source array
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    jsOMS.merge = function (target, source) {
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
    };
}(window.jsOMS = window.jsOMS || {}));