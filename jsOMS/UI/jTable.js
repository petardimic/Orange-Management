/* Handling minimizing */
var nodes = document.querySelectorAll('thead .min');
jsOMS.each(nodes, function (ele) {
    jsOMS.listenEvent(ele, 'click', function (evt, e) {
        var body = jsOMS.getByTag(e.parentNode.parentNode.parentNode.parentNode, 'tbody');
        jsOMS.addClass(body[0], 'vh');
    });
});

/* Handling maximizing */
nodes = document.querySelectorAll('thead .max');
jsOMS.each(nodes, function (ele) {
    jsOMS.listenEvent(ele, 'click', function (evt, e) {
        var body = jsOMS.getByTag(e.parentNode.parentNode.parentNode.parentNode, 'tbody');
        jsOMS.removeClass(body[0], 'vh');
    });
});

/* Handling header element click */
nodes = document.querySelectorAll('thead span');
jsOMS.each(nodes, function (ele) {
    jsOMS.listenEvent(ele, 'click', function (evt, e) {
        var filter = e.parentNode.childNodes[4];

        if (jsOMS.hasClass(filter, 'vh')) {
            jsOMS.removeClass(filter, 'vh');
            jsOMS.removeClass(e.parentNode.childNodes[1], 'vh');
        }
    });
});

/* Handling sort click */
nodes = document.querySelectorAll('thead td :nth-child(2)');
jsOMS.each(nodes, function (ele) {
    jsOMS.listenEvent(ele, 'click', function (evt, e) {
        jsOMS.addClass(e, 'vh');
        jsOMS.removeClass(e.parentNode.childNodes[2], 'vh');
    });
});

/* Handling sort click */
nodes = document.querySelectorAll('thead td :nth-child(3)');
jsOMS.each(nodes, function (ele) {
    jsOMS.listenEvent(ele, 'click', function (evt, e) {
        jsOMS.addClass(e, 'vh');
        jsOMS.removeClass(e.parentNode.childNodes[3], 'vh');
    });
});

/* Handling sort click */
nodes = document.querySelectorAll('thead td :nth-child(4)');
jsOMS.each(nodes, function (ele) {
    jsOMS.listenEvent(ele, 'click', function (evt, e) {
        jsOMS.addClass(e, 'vh');
        jsOMS.removeClass(e.parentNode.childNodes[1], 'vh');
    });
});

/* Handling sort close click */
nodes = document.querySelectorAll('thead td :nth-child(5)');
jsOMS.each(nodes, function (ele) {
    jsOMS.listenEvent(ele, 'click', function (evt, e) {
        var iParent = e.parentNode;
        jsOMS.addClass(iParent.childNodes[1], 'vh');
        jsOMS.addClass(iParent.childNodes[2], 'vh');
        jsOMS.addClass(iParent.childNodes[3], 'vh');
        jsOMS.addClass(iParent.childNodes[4], 'vh');
    });
});

/* Handling filter view (creating and saving data) */
var list_filter_arr = [
    []
];

nodes = document.querySelectorAll('thead .f');
jsOMS.each(nodes, function (ele) {
    var c = 0;

    jsOMS.listenEvent(ele, 'click', function (evt, e) {
        var table = e.parentNode.parentNode.parentNode.childNodes[2],
            filter = document.getElementById('t-f'),
            flist = document.querySelectorAll('#tf ul');

        jsOMS.empty(flist);

        var titles = jsOMS.getByTag(table, 'td');

        jsOMS.each(titles, function (t) {
            c++;

            var val = '',
                tid = e.parentNode.parentNode.parentNode.parentNode.getAttribute('id');

            if ((tid in list_filter_arr) && ('i-' + c in list_filter_arr[tid])) {
                val = list_filter_arr[tid]['i-' + c];
            }

            /* Still not working */
            flist.innerHTML += '<li><label for="i-' + c + '">' + '</label>' + '<li><input name="i-' + c + '" id="i-' + c + '" type="text" value="' + val + '"><select><option>=<option>!=<option>><option><<option><></select>';
        });

        jsOMS.removeClass(filter, 'vh');
    });
});