$('a, button, input[type=submit]').each(function () {
    $$ = $(this);

    $$.click(function () {
        if (!$$.attr('data-request') || $$.attr('data-http')) {
            return true;
        }

        var request_type = $$.data().request;
        var http_type = $$.data().http;
        var request_uri = $$.data().uri;
        var request_data = $$.data().json;

        if (request_type === 'url') {
            request_uri = $$.attr('href');
        }

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
    });
});
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