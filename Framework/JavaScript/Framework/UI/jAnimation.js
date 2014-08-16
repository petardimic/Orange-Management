$('.ani-click').each(function () {
    var $$ = $(this);

    $$.click(function () {
        var $$$ = $($$.data().aniref);

        if ($$.data().anistate === 1) {
            $$.data('anistate', 0);
            var aniout = $$.data().aniout;

            if (aniout === 'slide-left') {
                $$$.animate({
                    marginLeft: -2 * $$$.position().left - $$$.width()
                }, $$.data().anitime);
            }
        } else {
            $$.data('anistate', 1);
            var aniin = $$.data().aniin;

            if (aniin === 'slide-right') {
                $$$.animate({
                    marginLeft: ($$$.position().left - $$$.width()) + $$$.width()
                }, $$.data().anitime);
            }
        }
    });
});