/*$('a, button, input[type=submit]').each(function () {
    var $$ = $(this);

    $$.click(function (e) {
        if (!$$.attr('data-request') || !$$.attr('data-http')) {
            return true;
        }

        var request_type = $$.data().request;
        var http_type = $$.data().http;
        var request_uri = '';
        var request_data = $$.data().json;

        if (request_type === 'URL') {
            request_uri = $$.attr('href');
        } else {
            request_uri = $$.data().uri;
        }

        console.log(request_type);
        console.log(http_type);
        console.log(request_uri);
        console.log(request_data);

        $.ajax({
            type: http_type,
            url: URL + request_uri,
            data: JSON.stringify(request_data),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function (res) {
                if (typeof res !== 'undefined' && res.type === 1) {
                    console.log(res.msg);


                }
            },
            error: function (msg) {
                console.log(msg);
            }
        });

        e.preventDefault();
        return false;
    });
});*/
/*
 RETURN OBJECT = JSON
 types: INTERACTION, DIALOG, OBJ, HTML
 msg-level: WARNING, INFO, ERROR, OK, DEBUG
 {
 "type": 1,
 "msg": {
 "level": 1,
 "text": "Here some text"
 },

 }
 */