$('.tabview .tab-links a').on('click', function(e)  {
    var currentAttrValue = $(this).attr('href');
 
    $('.tabview ' + currentAttrValue).show().siblings().hide();
    $(this).parent('li').addClass('active').siblings().removeClass('active');
    e.preventDefault();
});