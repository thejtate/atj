(function ($) {
    Drupal.behaviors.atjPaypal = {
        attach: function (context, settings) {
            initCardMaskChanger(context);
        }
    };
    function initCardMaskChanger(context) {

        $('select.mask-card-type', context).once('cardmaskchanger', function () {
            var $card_type = $(this)
                ,$card = $('input.mask-card')
                ,$cvv = $('input.mask-cvv');

            $card_type.on('change', function() {

                var val = $(this).val();
                if(val == 'amex') {
                    $card.mask('9999-999999-99999', {placeholder: '_'});
                    $card.attr('placeholder', '____-______-_____');
                    $cvv.mask('999?9', {placeholder: '_'});
                    $cvv.attr('placeholder', '____');
                } else {
                    $card.mask('9999-9999-9999-999?9', {placeholder: '_'});
                    $card.attr('placeholder', '____-____-____-____');
                    $cvv.mask('999', {placeholder: '_'});
                    $cvv.attr('placeholder', '___');
                }
            });

        });
    }
})(jQuery);