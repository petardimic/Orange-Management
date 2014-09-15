/* Handling minimizing */
var nodes = document.querySelectorAll('thead .min');
oLib.each(nodes, function(ele) {
    oLib.listenEvent(ele, 'click', function(evt, e) {
        var body = oLib.getByTag(e.parentNode.parentNode.parentNode.parentNode, 'tbody');
        oLib.addClass(body[0], 'vh');
    });
});

/* Handling maximizing */
nodes = document.querySelectorAll('thead .max');
oLib.each(nodes, function(ele) {
    oLib.listenEvent(ele, 'click', function(evt, e) {
        var body = oLib.getByTag(e.parentNode.parentNode.parentNode.parentNode, 'tbody');
        oLib.removeClass(body[0], 'vh');
    });
});

/* Handling header element click */
nodes = document.querySelectorAll('thead span');
oLib.each(nodes, function(ele) {
    oLib.listenEvent(ele, 'click', function(evt, e) {
        var filter = e.parentNode.childNodes[4];

        if(oLib.hasClass(filter, 'vh')) {
            oLib.removeClass(filter, 'vh');
            oLib.removeClass(e.parentNode.childNodes[1], 'vh');
        }
    });
});

/* Handling sort click */
nodes = document.querySelectorAll('thead td :nth-child(2)');
oLib.each(nodes, function(ele) {
    oLib.listenEvent(ele, 'click', function(evt, e) {
        oLib.addClass(e, 'vh');
        oLib.removeClass(e.parentNode.childNodes[2], 'vh');
    });
});

/* Handling sort click */
nodes = document.querySelectorAll('thead td :nth-child(3)');
oLib.each(nodes, function(ele) {
    oLib.listenEvent(ele, 'click', function(evt, e) {
        oLib.addClass(e, 'vh');
        oLib.removeClass(e.parentNode.childNodes[3], 'vh');
    });
});

/* Handling sort click */
nodes = document.querySelectorAll('thead td :nth-child(4)');
oLib.each(nodes, function(ele) {
    oLib.listenEvent(ele, 'click', function(evt, e) {
        oLib.addClass(e, 'vh');
        oLib.removeClass(e.parentNode.childNodes[1], 'vh');
    });
});

/* Handling sort close click */
nodes = document.querySelectorAll('thead td :nth-child(5)');
oLib.each(nodes, function(ele) {
    oLib.listenEvent(ele, 'click', function(evt, e) {
        var iParent = e.parentNode;
        oLib.addClass(iParent.childNodes[1], 'vh');
        oLib.addClass(iParent.childNodes[2], 'vh');
        oLib.addClass(iParent.childNodes[3], 'vh');
        oLib.addClass(iParent.childNodes[4], 'vh');
    });
});

/* Handling filter view (creating and saving data) */
var list_filter_arr = [
    []
];

nodes = document.querySelectorAll('thead .f');
oLib.each(nodes, function(ele) {
    var c = 0;

    oLib.listenEvent(ele, 'click', function(evt, e) {
        var table = e.parentNode.parentNode.parentNode.childNodes[2],
            filter = document.getElementById('t-f'),
            flist = document.querySelectorAll('#tf ul');

        oLib.empty(flist);

        var titles = oLib.getByTag(table, 'td');

        oLib.each(titles, function(t) {
            c++;

            var val = '',
                tid = e.parentNode.parentNode.parentNode.parentNode.getAttribute('id');

            if ((tid in list_filter_arr) && ('i-' + c in list_filter_arr[tid])) {
                val = list_filter_arr[tid]['i-' + c];
            }

            /* Still not working */
            flist.innerHTML += '<li><label for="i-' + c + '">' + '</label>' + '<li><input name="i-' + c + '" id="i-' + c + '" type="text" value="' + val + '"><select><option>=<option>!=<option>><option><<option><></select>';
        });

        oLib.removeClass(filter, 'vh');
    });
});