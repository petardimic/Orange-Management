(function (jsOMS, undefined) {
    jsOMS.FormManager = function (responseManager) {
        this.responseManager = responseManager;
    };

    jsOMS.FormManager.prototype.bind = function (id) {
        if (typeof id !== 'undefined') {
            this.bindElement(document.getElementById(id));
        } else {
            var forms = document.getElementsByTagName('form');

            for (var i = 0; i < forms.length; i++) {
                this.bindElement(forms[i]);
            }
        }
    };

    jsOMS.FormManager.prototype.bindElement = function (e) {
        var input = e.getElementsByTagName('input'),
            buttons = e.getElementsByTagName('button'),
            submits = e.querySelectorAll('input[type=submit]'),
            self = this;

        for(var j = 0; j < submits.length; j++) {
            submits[j].addEventListener('click', function(event) {
                // TODO: write a wrapper for this in your library
                if (event.stopPropagation) {
                    event.stopPropagation();   // W3C model
                    event.preventDefault();
                } else {
                    event.cancelBubble = true; // IE model
                    event.preventDefault();
                }

                var request = new jsOMS.Request();

                request.setType('ajax');
                request.setUri(e.action);
                request.setMethod(e.method);
                request.setSuccess(function(xhr) {
                    var o = JSON.parse(xhr.response),
                        response = Object.keys(o).map(function(k) { return o[k] });

                    for(var k = 0; k < response.length; k++) {
                        console.log(response[k]);
                        self.responseManager.execute(response[k].type, response[k]);
                    }
                });
                request.send();
            });
        }

        for (var i = 0; i < input.length; i++) {
            if (typeof input[i].dataset.validate !== 'undefined') {
                var valid = (new RegExp(input[i].dataset.validate)).test(input[i].value),
                    watcher = function (e) {
                        var timer = 0;
                        return function (callback, ms) {
                            clearTimeout(timer);
                            timer = setTimeout(callback, ms);
                        };
                    }();

                input[i].keyup = watcher(function () {
                    if (!valid) {
                        console.log('wrong input');
                    }
                }, 1000);

                /** Maybe use this?
                 (function(){
                    var timer = 0;
                    return function(callback, ms){
                        clearTimeout (timer);
                        timer = setTimeout(callback, ms);
                    }
                }())(function(){alert('Time elapsed!');}, 1000 ); */
            }

            if (typeof input[i].dataset.request !== 'undefined') {
                // handle request during typing
            }
        }
    }
}(window.jsOMS = window.jsOMS || {}));