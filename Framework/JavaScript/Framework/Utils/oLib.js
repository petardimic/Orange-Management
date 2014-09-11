var oLib = {
    LoadedCSSJS: "",

    ajax: function(type, url, data, func) {
        var xhr = new XMLHttpRequest();
        xhr.open(type, url);

        xhr.onreadystatechange = function (data) {
            if (xhr.readyState === 4 && xhr.status === 200) {
                func.success();

                return xhr.responseText;
            } else {
                func.error();
            }
        }

        if (type === 'GET') {
            xhr.send();
        } else {
            xhr.send({data: data});
        }
    },

    listenEvent: function(ele, listen, func) {
        ele.addEventListener(listen, function(e) {func(e, ele)}, false);
    },

    getPropertyValue: function(ele, value) {
        return window.getComputedStyle(ele, null).getPropertyValue(value);
    },

    hasClass: function(ele, cls) {
        return ele !== undefined && ele.className !== undefined && ele.className.match(new RegExp('(\\s|^)' + cls + '(\\s|$)'));
    },

    addClass: function(ele, cls) {
        if (!oLib.hasClass(ele, cls)) ele.className += " " + cls;
    },

    removeClass: function(ele, cls) {
        if (oLib.hasClass(ele, cls)) {
            var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
            ele.className = ele.className.replace(reg, '');
        }
    },

    ready: function(func) {
        document.addEventListener("DOMContentLoaded", function(event) {
            func();
        });
    },

    each: function(nodes, func) {
        var length = nodes.length;

        for(var i = 0; i < length; i++) {
            func(nodes[i]);
        }
    },

    empty: function(ele) {
    	while(ele.firstChild) {
    		ele.removeChild(ele.firstChild);
    	}
    },

    find: function(nodes, cls) {
        
    },

    getID: function(ele, cls) {

    }, 

    isNode: function(ele){
      return (
        typeof Node === "object" ? ele instanceof Node : 
        ele && typeof ele === "object" && typeof ele.nodeType === "number" && typeof ele.nodeName==="string"
      );
    },

    isElement: function(o){
        return (
            typeof HTMLElement === "object" ? o instanceof HTMLElement : o && typeof o === "object" && o !== null && o.nodeType === 1 && typeof o.nodeName==="string"
        );
    },

    getByClass: function(ele, cls) {
        var length = ele.childNodes.length;

        for(var i = 0; i < length; i++) {
            if(oLib.hasClass(ele.childNodes[i], cls)) {
                return ele.childNodes[i];
            }
        }
    },

    getByTag: function(ele, tag) {
        return ele.getElementsByTagName(tag);
    },

    merge: function(target, source) {
        for (var p in source) {
        try {
          if ( source[p].constructor==Object ) {
            target[p] = merge(target[p], source[p]);

          } else {
            target[p] = source[p];
          }

        } catch(e) {
          target[p] = source[p];

        }
      }

      return target;
    },

    loadCSSJS: function(path, filename, filetype, func) {
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

        if(func !== undefined) {
            fileref.onreadystatechange = function() {
                if(this.readyState == 'complete') func();
            }

            fileref.onload = func();
        }
    },

    supportsHTML5Storage: function() {
        try {
            return 'localStorage' in window && window.localStorage !== null;
        } catch (e) {
            return false;
        }
    },

    setCookie: function(c_name, value, exdays, domain, path) {
        var exdate = new Date();
        exdate.setDate(exdate.getDate() + exdays);
        var c_value = encodeURI(value) + ((exdays === null) ? "" : "; expires=" + exdate.toUTCString()) + ";domain=" + domain + ";path=" + path;
        document.cookie = c_name + "=" + c_value;
    },

    getCookie: function(c_name) {
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
}