/*
 * Handle special case link and button clicks. 
 * This is usefull in order to support ajax calls and dynamic page changes without reloads
 */
var nodes = document.querySelectorAll('a, button, input[type=submit]');
oLib.each(nodes, function(ele) {
    oLib.listenEvent(ele, 'click', function(evt, e) {
        if(!e.hasAttribute('data-request') || !e.hasAttribute('data-http')) {
            return true;
        } 

        var request_type = e.getAttribute('data-request'),
            http_type = e.getAttribute('data-http'),
            request_uri = '',
            request_data = e.getAttribute('data-json');

        if(request_type === 'URL') {
            request_uri = e.getAttribute('href');
        } else {
            request_uri = e.getAttribute('data-uri');
        }

        oLib.ajax({
            type: http_type, 
            url: URL + request_uri, 
            data: request_data,
            requestHeader: "application/json; charset=utf-8",
            responseType: "text",
            success: function(ret) {
                console.log(ret);
            },
            error: function(ret) {
                console.log('error');
            }
        });

        evt.preventDefault();
        return false;
    });
});