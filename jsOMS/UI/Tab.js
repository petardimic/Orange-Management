/* TODO: css only?! http://codepen.io/wallaceerick/pen/ojtal http://codepen.io/Bucur/pen/ElzqB*/
/* Handle tab clicks */
var nodes = document.querySelectorAll('.tabview .tab-links a');
jsOMS.each(nodes, function (ele) {
    jsOMS.listenEvent(ele, 'click', function (evt, e) {
        var attr = e.getAttribute('href').substring(1),
            cont = e.parentNode.parentNode.parentNode.children[1];

        jsOMS.removeClass(jsOMS.getByClass(e.parentNode.parentNode, 'active'), 'active');
        jsOMS.addClass(e.parentNode, 'active');
        jsOMS.removeClass(jsOMS.getByClass(cont, 'active'), 'active');
        jsOMS.addClass(jsOMS.getByClass(cont, attr), 'active');

        evt.preventDefault();
    });
});