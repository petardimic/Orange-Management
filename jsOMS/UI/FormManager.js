(function (jsOMS, undefined) {
    jsOMS.FormManager = function (responseManager) {
        this.responseManager = responseManager;
        this.ignore = [];
        this.success = [];
    };


    jsOMS.FormManager.prototype.ignore = function (id) {
        this.ignore.push(id);
    };

    jsOMS.FormManager.prototype.setSuccess = function (id, callback) {
        this.success[id] = callback;
    };

    jsOMS.FormManager.prototype.bind = function (id) {
        if (typeof id !== 'undefined' && this.ignore.indexOf(id) == -1) {
            this.bindElement(document.getElementById(id));
        } else {
            var forms = document.getElementsByTagName('form');

            for (var i = 0; i < forms.length; i++) {
                if (this.ignore.indexOf(forms[i].id == -1)) {
                    this.bindElement(forms[i]);
                }
            }
        }
    };

    jsOMS.FormManager.prototype.validateFormElement = function (e) {
        /** Validate on change */
        if (typeof e.dataset.validate !== 'undefined') {
            if (!(new RegExp(e.dataset.validate)).test(e.value)) {
                return false;
            }
        }

        return true;
    };

    jsOMS.FormManager.prototype.bindElement = function (e) {
        var input = e.getElementsByTagName('input'),
            select = e.getElementsByTagName('select'),
            textarea = e.getElementsByTagName('textarea'),
            datalist = e.getElementsByTagName('datalist'),
            buttons = e.getElementsByTagName('button'),
            submits = e.querySelectorAll('input[type=submit]'),
            formelements = Array.prototype.slice.call(input).concat(Array.prototype.slice.call(select), Array.prototype.slice.call(textarea), Array.prototype.slice.call(datalist)),
            submitdata = {},
            self = this;

        for (var j = 0; j < submits.length; j++) {
            submits[j].addEventListener('click', function (event) {
                var validForm = true;

                for (var k = 0; k < formelements.length; k++) {
                    if (!self.validateFormElement(e)) {
                        validForm = false;
                        // TODO: maybe jump out here since invalid and the elements get checked on changed by default
                        // will this change in the future? if yes then I need to check all and also add markup/styles here
                    }

                    submitdata[formelements[k].getAttribute('name')] = formelements[k].value;
                }

                if (validForm) {
                    var request = new jsOMS.Request();
                    request.setData(submitdata);
                    request.setType('ajax');
                    request.setUri(e.action);
                    request.setMethod(e.method);
                    request.setRequestHeader('Content-Type', 'application/json');
                    request.setSuccess(function (xhr) {
                        console.log(xhr); // TODO: remove this is for error checking
                        var o = JSON.parse(xhr.response),
                            response = Object.keys(o).map(function (k) {
                                return o[k]
                            });

                        for (var k = 0; k < response.length; k++) {
                            if (!self.success[e.id]) {
                                self.responseManager.execute(response[k].type, response[k]);
                            } else {
                                self.success[e.id](response[k].type, response[k]);
                            }
                        }
                    });
                    request.send();
                }

                jsOMS.preventAll(event);
            });
        }

        /** Handle input */
        for (var i = 0; i < input.length; i++) {
            /** Validate on change */
            if (typeof input[i].dataset.validate !== 'undefined') {
                var validator = new RegExp(input[i].dataset.validate);

                input[i].onkeyup = function (e) {
                    var self = this;
                    jsOMS.watcher(function (e) {
                        if (!validator.test(self.value)) {
                            jsOMS.addClass(self, 'invalid');
                            console.log('wrong input:' + i);
                        }
                    }, 500);
                };
            }

            /** Request on change */
            if (typeof input[i].dataset.request !== 'undefined') {
                // handle request during typing
            }
        }

        /** Handle select */
        for (var i = 0; i < select.length; i++) {
            /** Redirect on change */
            if (typeof select[i].dataset.redirect !== 'undefined') {
                select[i].onchange = function () {
                    // TODO: use URI factory (which i still have to create :))
                    window.document.href = e.action.replace('{' + select[i].dataset.redirect + '}', select[i].value);
                };
            }
        }
    }
}(window.jsOMS = window.jsOMS || {}));