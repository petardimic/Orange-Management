var redirectMessage = function (data) {
    setTimeout(function () {
        document.location.href = data.url;
    }, parseInt(data.delay));
};
