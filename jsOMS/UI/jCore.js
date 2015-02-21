/* 
 * Handle global min/max logic.
 * This switches min/max visibility on click.
 */
var nodes = document.getElementsByClassName('min');
jsOMS.each(nodes, function (ele) {
    jsOMS.listenEvent(ele, 'click', function (evt, e) {
        jsOMS.addClass(e, 'vh');
        jsOMS.removeClass(jsOMS.getByClass(e.parentNode, 'max'), 'vh');
    });
});

nodes = document.getElementsByClassName('max');
jsOMS.each(nodes, function (ele) {
    jsOMS.listenEvent(ele, 'click', function (evt, e) {
        jsOMS.addClass(e, 'vh');
        jsOMS.removeClass(jsOMS.getByClass(e.parentNode, 'min'), 'vh');
    });
});

/* 
 * Handle global dim
 * This allows to activate and deactivate the background dim on certain elements/classes
 */
/* Deactivate dim if click on class .close or .save */
var dim = document.getElementById('dim');
nodes = document.querySelectorAll('.close, .save');
jsOMS.each(nodes, function (ele) {
    jsOMS.listenEvent(ele, 'click', function (evt, e) {
        jsOMS.addClass(e.parentNode.parentNode.parentNode, 'vh');

        jsOMS.addClass(dim, 'vh')
    });
});

/* Activate dim if click on element with class dim */
nodes = document.getElementsByClassName('dim');
jsOMS.each(nodes, function (ele) {
    jsOMS.listenEvent(ele, 'click', function (evt, e) {
        jsOMS.removeClass(dim, 'vh')
    });
});