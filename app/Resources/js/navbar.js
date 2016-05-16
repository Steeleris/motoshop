(function($){
    'use strict';

    $(window).resize(function(){
        if ($(window).width() >= 768){
            toogleDropdowns();
        }
    });

    if ($(window).width() >= 768){
        toogleDropdowns();
    }

})(jQuery);

function toogleDropdowns(){
    var loginToggle = $('.login-toggle');
    var cartToggle = $('.cart-toggle');
    var loginBlock = $('.login-block');
    var cartBlock = $('.cart-block');

    // Login dropdown
    loginToggle.on('click', function(e){
        e.stopPropagation();
        loginBlock.toggle();
    });

    loginBlock.on('click', function(e){
        e.stopPropagation();
    });

    // Cart dropdown
    cartToggle.on('click', function(e){
        e.stopPropagation();
        cartBlock.toggle();
    });

    cartBlock.on('click', function(e){
        e.stopPropagation();
    });

    $(document).click( function(){
        $('.login-block').css('display', 'none');
        $('.cart-block').css('display', 'none');
    });
}