(function (jsOMS, undefined) {
    jsOMS.Form = function () {
    };

    jsOMS.Form.prototype.bind = function (id) {
        if (typeof id !== 'undefined') {
            this.bindElement(document.getElementById(id));
        } else {
            var forms = document.getElementsByTagName('form');
            for (var i = 0; i < forms.length; i++) {
                this.bindElement(forms[i]);
            }
        }
    };

    jsOMS.Form.prototype.bindElement = function (e) {
        var input = e.getElementsByTagName('input');

        for (var i = 0; i < input.length; i++) {
            // TODO: bind submit buttons
            var buttons = input[i].getElementsByTagName('button'),
                submits = input[i].querySelectorAll('input[type=submit]');
            
            if (typeof input[i].dataset.validate !== 'undefined') {
                var valid = (new RegExp(input[i].dataset.validate)).test(input[i].value),
                    watcher = function (e) {
                    var timer = 0;
                    return function (callback, ms) {
                        clearTimeout(timer);
                        timer = setTimeout(callback, ms);
                    };
                }();

                input[i].keyup = watcher(function() {
                    if(!valid) {
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
        }

        if (typeof input[i].dataset.request !== 'undefined') {
            // handle request during typing
        }
    }
}(window.jsOMS = window.jsOMS || {}));