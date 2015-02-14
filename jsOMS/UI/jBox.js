/* Handle minimize and maximize logic for boxes */
var nodes = document.querySelectorAll('.b > h1 .max, .b > h2 .max');
oLib.each(nodes, function (ele) {
    oLib.listenEvent(ele, 'click', function (evt, e) {
        var box = oLib.getByClass(e.parentNode.parentNode, 'bc-1');
        oLib.removeClass(box, 'vh');
    });
});

nodes = document.querySelectorAll('.b > h1 .min, .b > h2 .min');
oLib.each(nodes, function (ele) {
    oLib.listenEvent(ele, 'click', function (evt, e) {
        var box = oLib.getByClass(e.parentNode.parentNode, 'bc-1');
        oLib.addClass(box, 'vh');
    });
});