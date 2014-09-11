/*$('.accordion-section-title').click(function (e) {
    var currentAttrValue = $(this).attr('href');

    $('.accordion .accordion-section-title').removeClass('active');
    $('.accordion .accordion-section-content').slideUp(300).removeClass('open');

    if (!$(e.target).is('.active')) {
        $(this).addClass('active');
        $('.accordion ' + currentAttrValue).slideDown(300).addClass('open');
    }

    e.preventDefault();
}); */