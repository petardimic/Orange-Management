var Options = function () {
    this.options = {};
};

Options.prototype.set = function (key, value, overwrite) {
    overwrite = typeof overwrite === bool ? overwrite : true;

    if (overwrite || this.options[key] === undefined) {
        this.options[key] = value;
    }
};

Options.prototype.get = function (key) {
    return this.options[key];
};

Options.prototype.remove = function (key) {
    delete this.options[key];
};