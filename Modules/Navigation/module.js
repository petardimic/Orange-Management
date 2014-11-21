/* global supports_html5_storage, setCookie, getCookie */
$(document).ready(function () {
    "use strict";

    var sidebar = document.getElementById("s-nav"),
        scrollPos = sidebar.scrollTop;

    /* [BEGIN]: Load/Save old navigation status */
    var $localStorage = supports_html5_storage();
    var navigation = null;

    if (!$localStorage) {
        navigation = getCookie('1000500001');
    } else {
        navigation = localStorage['1000500001'];
    }

    var naviOBJ = null;

    if (navigation !== null) {
        naviOBJ = JSON.parse(navigation);

        if ('1000500000' in naviOBJ) {
            sidebar.hide();
            $('#content').css('margin-left', 0);
        }

        var val = null;
        for (var key in naviOBJ) {
            //noinspection JSUnfilteredForInLoop
            if (!isNaN(key)) {
                val = naviOBJ[key];
                sidebar.find('.' + val + ' li:not(:first-child)').hide();
                sidebar.find('.' + val + ' .min').hide();
                sidebar.find('.' + val + ' .max').show();
            }
        }
    }

    sidebar.find('li .min').click(function () {
        $(this).parent().parent().children('li:not(:first-child)').slideUp();
        naviOBJ[$(this).parent().parent().attr('class')] = $(this).parent().parent().attr('class');

        if (!$localStorage) {
            setCookie('1000500000', JSON.stringify(naviOBJ), 365, window.location.host, '/');
        }
        else {
            localStorage['1000500000'] = JSON.stringify(naviOBJ);
        }
    });

    sidebar.find('li .max').click(function () {
        $(this).parent().parent().children('li:not(:first-child)').slideDown();
        delete naviOBJ[$(this).parent().parent().attr('class')];

        if (!$localStorage) {
            setCookie('1000500000', JSON.stringify(naviOBJ), 365, window.location.host, '/');
        }
        else {
            localStorage['1000500000'] = JSON.stringify(naviOBJ);
        }
    });

    sidebar.find('.hide').click(function () {
        $(this).hide();
        $('#content').css('margin-left', 0);
    });

    /* [BEGIN]: Hide and Show sidenav */
    $(document).keydown(function (e) {
        if (e.ctrlKey && e.altKey && e.which === 78) {
            if (!sidebar.hasClass('.hidden')) {
                sidebar.show();
                $('#content').css('margin-left', sidebar.width());
                delete naviOBJ['1000500000'];
            } else {
                sidebar.hide();
                $('#content').css('margin-left', 0);
                naviOBJ['1000500000'] = 0;
            }

            if (!$localStorage) {
                setCookie('1000500000', JSON.stringify(naviOBJ), 365, window.location.host, '/');
            }
            else {
                localStorage['1000500000'] = JSON.stringify(naviOBJ);
            }
        }
    });
    /* [END]: Hide and Show sidenav */

    /* [END]: Load/Save old navigation status */
});