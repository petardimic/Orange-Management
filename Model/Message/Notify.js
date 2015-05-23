var notifyMessage = function (data) {
    setTimeout(function () {
        var notify = document.createElement('div'),
            h = document.createElement('h1'),
            inner = document.createElement('div'),
            title = document.createTextNode(data.title),
            content = document.createTextNode(data.content);

        notify.id = 'notify';
        notify.class = data.level;
        h.appendChild(title);
        inner.appendChild(content);
        notify.appendChild(h);
        notify.appendChild(inner);

        if (data.stay > 0) {
            setTimeout(function () {
                notify.parentElement.removeChild(notify);
            }, data.stay);
        }
    }, parseInt(data.delay));
};
