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

    // TODO move this to Uri model as static method
    jsOMS.parse_url = function(str, component) {
        var query, key = ['source', 'scheme', 'authority', 'userInfo', 'user', 'pass', 'host', 'port',
                'relative', 'path', 'directory', 'file', 'query', 'fragment'
            ],
            ini = (this.php_js && this.php_js.ini) || {},
            mode = (ini['phpjs.parse_url.mode'] &&
                ini['phpjs.parse_url.mode'].local_value) || 'php',
            parser = {
                php: /^(?:([^:\/?#]+):)?(?:\/\/()(?:(?:()(?:([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?))?()(?:(()(?:(?:[^?#\/]*\/)*)()(?:[^?#]*))(?:\?([^#]*))?(?:#(.*))?)/,
                strict: /^(?:([^:\/?#]+):)?(?:\/\/((?:(([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?))?((((?:[^?#\/]*\/)*)([^?#]*))(?:\?([^#]*))?(?:#(.*))?)/,
                loose: /^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/\/?)?((?:(([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/ // Added one optional slash to post-scheme to catch file:/// (should restrict this)
            };

        var m = parser[mode].exec(str),
            uri = {},
            i = 14;
        while (i--) {
            if (m[i]) {
                uri[key[i]] = m[i];
            }
        }

        if (component) {
            return uri[component.replace('PHP_URL_', '')
                .toLowerCase()];
        }
        if (mode !== 'php') {
            var name = (ini['phpjs.parse_url.queryKey'] &&
                ini['phpjs.parse_url.queryKey'].local_value) || 'queryKey';
            parser = /(?:^|&)([^&=]*)=?([^&]*)/g;
            uri[name] = {};
            query = uri[key[12]] || '';
            query.replace(parser, function($0, $1, $2) {
                if ($1) {
                    uri[name][$1] = $2;
                }
            });
        }
        delete uri.source;
        return uri;
    };

    // TODO move this to Uri model as static method
    jsOMS.getUriQueryParameter = function(query, name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]*" + name + "=([^&#]*)"),
            results = regex.exec(query);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
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

    jsOMS.addArray = function (path, data, value, delim) {
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
vagran     *
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
     * Delayed watcher
     *
     * Used to fire event after delay
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    jsOMS.watcher = function () {
        var timer = 0;
        return function (callback, ms) {
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    }();

    /**
     * Action prevent
     *
     * Preventing event from firering and passing through
     *
     * @param event Event Event to stop
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    jsOMS.preventAll = function(event) {
        if (event.stopPropagation) {
            event.stopPropagation();
        } else {
            event.cancelBubble = true;
        }

        event.preventDefault();
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
        // TODO: IE problems? + Maybe interactive + loaded can cause problems since elements might not be loaded yet?!!?!!?!
        if (document.readyState === 'complete' || document.readyState === 'loaded' || document.readyState === 'interactive') {
            func();
        } else {
            document.addEventListener("DOMContentLoaded", function (event) {
                func();
            });
        }
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

    jsOMS.hash = function (str) {
        var res = 0,
            len = str.length;
        for (var i = 0; i < len; i++) {
            res = res * 31 + str.charCodeAt(i);
        }
        return res;
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