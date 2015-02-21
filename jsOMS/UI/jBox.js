/* Handle minimize and maximize logic for boxes */
var nodes = document.querySelectorAll('.b > h1 .max, .b > h2 .max');
jsOMS.each(nodes, function (ele) {
    jsOMS.listenEvent(ele, 'click', function (evt, e) {
        var box = jsOMS.getByClass(e.parentNode.parentNode, 'bc-1');
        jsOMS.removeClass(box, 'vh');
    });
});

nodes = document.querySelectorAll('.b > h1 .min, .b > h2 .min');
jsOMS.each(nodes, function (ele) {
    jsOMS.listenEvent(ele, 'click', function (evt, e) {
        var box = jsOMS.getByClass(e.parentNode.parentNode, 'bc-1');
        jsOMS.addClass(box, 'vh');
    });
});