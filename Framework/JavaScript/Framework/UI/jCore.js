/* 
 * Handle global min/max logic.
 * This switches min/max visibility on click.
 */
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

/* 
 * Handle global dim
 * This allows to activate and deactivate the background dim on certain elements/classes
 */
 /* Deactivate dim if click on class .close or .save */
var dim = document.getElementById('dim');
nodes = document.querySelectorAll('.close, .save');
oLib.each(nodes, function(ele) {
    oLib.listenEvent(ele, 'click', function(evt, e) {
        oLib.addClass(e.parentNode.parentNode.parentNode, 'vh');

        oLib.addClass(dim, 'vh')
    });
});

/* Activate dim if click on element with class dim */
nodes = document.getElementsByClassName('dim');
oLib.each(nodes, function(ele) {
    oLib.listenEvent(ele, 'click', function(evt, e) {
        oLib.removeClass(dim, 'vh')
    });
});