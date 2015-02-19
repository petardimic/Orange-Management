(function (jsOMS, undefined) {
    jsOMS.AssetManager = function () {
        this.assets = {};
    };

    jsOMS.AssetManager.prototype.load = function (path, filename, filetype, callback) {
        if (!this.assets[filename]) {
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

            if (typeof fileref !== "undefined") {
                document.getElementsByTagName("head")[0].appendChild(fileref);
            }

            this.assets[filename] = path + filename;

            if (callback) {
                fileref.onreadystatechange = function () {
                    if (this.readyState == 'complete') {
                        callback();
                    }
                };

                fileref.onload = callback();
            }
        }
    };

    jsOMS.AssetManager.prototype.unload = function (key) {
        delete this.assets[key];
    };
}(window.jsOMS = window.jsOMS || {}));