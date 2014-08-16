    //<editor-fold desc="Table functionality">
    $('.t thead .min').each(function () {
        var $$ = $(this);

        $$.click(function () {
            $$.parent().parent().parent().parent().find('tbody').hide();
        });
    });

    $('.t thead .max').each(function () {
        var $$ = $(this);
        $$.click(function () {
            $$.parent().parent().parent().parent().find('tbody').show();
        });
    });

    $('.t thead span').each(function () {
        var $$ = $(this);

        $$.click(function () {
            var filter = $$.parent().find(':nth-child(5)');

            /* TODO: is this necessary/dropping performance??? */
            if (filter.hasClass('vh')) {
                filter.removeClass('vh');
                $$.parent().find(':nth-child(2)').removeClass('vh');
            }
        });
    });

    $('.t thead td :nth-child(2)').each(function () {
        var $$ = $(this);

        $$.click(function () {
            $$.addClass('vh');
            $$.parent().find(':nth-child(3)').removeClass('vh');
        });
    });

    $('.t thead td :nth-child(3)').each(function () {
        var $$ = $(this);

        $$.click(function () {
            $$.addClass('vh');
            $$.parent().find(':nth-child(4)').removeClass('vh');
        });
    });

    $('.t thead td :nth-child(4)').each(function () {
        var $$ = $(this);

        $$.click(function () {
            $$.addClass('vh');
            $$.parent().find(':nth-child(2)').removeClass('vh');
        });
    });

    $('.t thead td :nth-child(5)').each(function () {
        var $$ = $(this);

        $$.click(function () {
            $$.parent().find('i').addClass('vh');
        });
    });

    var list_filter_arr = [
        []
    ];
    $('.t thead .f').each(function () {
        var $$ = $(this);
        var c = 0;

        $$.click(function () {
            var table = $$.parent().parent().parent().find('tr:nth-child(2)');
            var filter = $('#t-f');
            var flist = filter.find('ul');

            flist.empty();

            table.find('td').each(function () {
                c++;

                var val = '';
                var tid = $$.parent().parent().parent().parent().attr('id');

                if ((tid in list_filter_arr) && ('i-' + c in list_filter_arr[tid])) {
                    val = list_filter_arr[tid]['i-' + c];
                }

                flist.append('<li><label for="i-' + c + '">' + $(this).text().trim() + '</label>');
                flist.append('<li><input name="i-' + c + '" id="i-' + c + '" type="text" value="' + val + '"><select><option>=<option>!=<option>><option><<option><></select>');
            });

            filter.removeClass('vh');
        });
    });
    //</editor-fold>
    