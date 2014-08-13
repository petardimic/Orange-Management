$(document).ready(function () {
    'use strict';

    //<editor-fold desc="Box functionality">
    $('.b > h1 .min, .b > h2 .min').each(function () {
        var $$ = $(this);

        $$.click(function () {
            $$.parent().parent().find('.bc-1').hide();
        });
    });

    $('.b > h1 .max, .b > h2 .max').each(function () {
        var $$ = $(this);

        $$.click(function () {
            $$.parent().parent().find('.bc-1').show();
        });
    });
    //</editor-fold>
});