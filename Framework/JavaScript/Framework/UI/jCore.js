var nodes = document.getElementsByClassName('min');
oLib.each(nodes, function(ele) {
    oLib.listenEvent(ele, 'click', function(evt, e) {
        oLib.addClass(e, 'vh');
        oLib.removeClass(oLib.getByClass(e.parentNode, 'max'), 'vh');
    });
});

nodes = document.getElementsByClassName('max');
oLib.each(nodes, function(ele) {
    oLib.listenEvent(ele, 'click', function(evt, e) {
        oLib.addClass(e, 'vh');
        oLib.removeClass(oLib.getByClass(e.parentNode, 'min'), 'vh');
    });
});

var dim = document.getElementById('dim');
nodes = document.querySelectorAll('.close, .save');
oLib.each(nodes, function(ele) {
    oLib.listenEvent(ele, 'click', function(evt, e) {
        oLib.addClass(e.parentNode.parentNode.parentNode, 'vh');

        oLib.addClass(dim, 'vh')
    });
});

nodes = document.getElementsByClassName('dim');
oLib.each(nodes, function(ele) {
    oLib.listenEvent(ele, 'click', function(evt, e) {
        oLib.removeClass(dim, 'vh')
    });
});