(function($){
    'use strict';

    // Login form

    $('.login-toggle').on('click', function(e){
        e.stopPropagation();
        $('.login-block').toggle();
    });

    $('.login-block').on('click', function(e){
        e.stopPropagation();
    });

    $(document).click( function(){
        $('.login-block').css('display', 'none');
    });
})(jQuery);