var reloadMessage = function (data) {
    setTimeout(function () {
        document.location.reload(true);
    }, parseInt(data.delay));
};
