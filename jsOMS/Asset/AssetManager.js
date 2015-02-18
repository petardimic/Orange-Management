var AssetManager = function() {
    this.assets = {};
};

AssetManager.prototype.load = function(key, uri, type) {
    if(this.assets[key] !== undefined) {
        return;
    }

    this.assets[key] = 0;
};

AssetManager.prototype.unload = function(key) {
    delete this.assets[key];
};

