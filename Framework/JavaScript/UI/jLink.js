$(document).ready(function () {
    'use strict';

    $('.link-act').each(function(){
        $$ = $(this);


    });

    /* <a href="" class="d-call" data-requestType="GET" data-json="{}" data-form="[]"> */
    $('.d-call').each(function () {
        $(this).click(function () {
            event.preventDefault();

            var tagType = $(this).get(0).tagName;
            var src = null;

            if(tagType === 'BUTTON') {
                src = $(this).data().src;
            } else if(tagType === 'A') {
                src = $(this).attr("href");
            }

            $.ajax({
                type: $(this).data().requesttype,
                url: URL + src,
                data: JSON.stringify($(this).data().json),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function (res) {
                    if(typeof res !== 'undefined' && res.type === 1) {
                        console.log(res.msg);
                    }
                },
                error: function(msg){
                    console.log(msg);
                }
            });

            return false;
        });
    });
});