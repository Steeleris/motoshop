(function($){
    'use strict';

    $('.add-to-cart').click( function(){
        var productId = $(this).data('product-id');
        var addToCartUrl = Routing.generate('moto_add_to_cart');

        $.ajax({
            method: 'POST',
            url: addToCartUrl,
            data: { id: productId }
        }).success(function(){
            loadCart();
        });
    });

    loadCart();

    $('.buy-btn').on('click', function(){
        purchase();
    });

})(jQuery);

function loadCart() {
    var getCartUrl = Routing.generate('moto_get_cart');

    $.ajax({
        method: 'POST',
        url: getCartUrl,
        success: function(data){
            var dataSize = Object.keys(data).length;
            $('.products-amount').text(dataSize);
        }
    }).done(function(data) {
        var cartContent = $('.cart-content');
        cartContent.empty();
        if ($.isEmptyObject(data)) {
            cartContent.html('<p class="text-muted text-center">Your cart looks empty</p>');
        }

        var limit = 0;

        $.each(data, function(key, value){
            cartContent.append(loadProduct(value, key).join(''));

            if (++limit > 4)
                return false;
        });

        $('.cart-content .close-btn').on('click', function(){
            removeProduct($(this).data('product-id'));
        });
    });


    function loadProduct(product, id){
        return [
            '<li>',
            '<span class="item">',
            '<span class="item-left">',
            '<span class="item-info">',
            '<span>' + product.title + '</span>',
            '<span>$' + product.price + '</span>',
            '</span>',
            '</span>',
            '<span class="item-right">',
            '<button class="btn btn-xs btn-danger pull-right close-btn" data-product-id="' +
            + id +
            '">x</button>',
            '</span>',
            '</span>',
            '</li>'
        ];
    }
}

function removeProduct(productId){
    var removeFromCartUrl = Routing.generate('moto_remove_from_cart');

    $.ajax({
        method: 'POST',
        url: removeFromCartUrl,
        data: { id: productId },
        success: function() {
            loadCart();
        }
    });
}

function purchase(){
    var purchaseUrl = Routing.generate('moto_purchase');

    $.ajax({
        method: 'POST',
        url: purchaseUrl,
        success: function(sent) {
            if (sent) {
                $('#purchaseModal').modal('show');
            }
        }
    });
}