/* Handle tab clicks */
var nodes = document.querySelectorAll('.tabview .tab-links a');
oLib.each(nodes, function (ele) {
    oLib.listenEvent(ele, 'click', function (evt, e) {
        var attr = e.getAttribute('href').substring(1),
            cont = e.parentNode.parentNode.parentNode.children[1];

        oLib.removeClass(oLib.getByClass(e.parentNode.parentNode, 'active'), 'active');
        oLib.addClass(e.parentNode, 'active');
        oLib.removeClass(oLib.getByClass(cont, 'active'), 'active');
        oLib.addClass(oLib.getByClass(cont, attr), 'active');

        evt.preventDefault();
    });
});