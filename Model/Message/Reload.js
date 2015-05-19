var reloadMessage = function (data) {
    setTimeout(function () {
        document.location.reload(true);
    }, data.delay);
};
