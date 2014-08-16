//<editor-fold desc="Min/Max/Close/Save button behaviour">
$('.min').each(function () {
    var $$ = $(this);

    $$.click(function () {
        $$.addClass('vh');
        $$.parent().find('.max').removeClass('vh');
    });
});

$('.max').each(function () {
    var $$ = $(this);

    $$.click(function () {
        $$.addClass('vh');
        $$.parent().find('.min').removeClass('vh');
    });
});

var dim = $('#dim');
$('.close, .save').each(function () {
    var $$ = $(this);

    $$.click(function () {
        $$.parent().parent().parent().addClass('vh');

        if (!dim.hasClass('vh')) {
            dim.addClass('vh');
        }
    });
});
//</editor-fold>

//<editor-fold desc="Dim functionality">
$('.dim').each(function () {
    var $$ = $(this);

    $$.click(function () {
        $('#dim').removeClass('vh');
    });
});
//</editor-fold>