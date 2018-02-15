(function ($) {
    Drupal.behaviors.customAtjActions = {
        attach: function (context, settings) {
            attachSelectAll($('a.select-all', context));
            attachSelectRedirectListener($('select.redirect-select', context));
            attachGoogleCustomEvents($('a[data-gacategory], input[data-gacategory], select[data-gacategory]', context));
        }
    };

    function attachSelectAll($element) {
        $element.once('select-handler', function () {
            var $this = $(this),
                $checkboxes = $this.parents('form').find('.to-select-all input[type=checkbox]');

            $this.on('click', function () {
                if(!($checkboxes.filter(':not(:checked)').length)) {
                    //if all already checked
                    $checkboxes.prop('checked', false);
                } else {
                    $checkboxes.prop('checked', true);
                }
                return false;
            });
        })
    }
    function attachGoogleCustomEvents($links) {

        if(typeof ga !== 'undefined') {

            $links.filter('a, input').once('ga-event').on('click', function(e) {
                var $this = $(this)
                    , category = $this.data('gacategory')
                    , action = $this.data('gaaction')
                    , label = $this.data('galabel');

                 ga('send', 'event',  category, action, label);
            });

            $links.filter('select').once('ga-event').on('change', function(e) {
                var $this = $(this);
                if($this.val() !== 'none') {
                    var category = $this.data('gacategory')
                        , action = $this.data('gaaction')
                        , label = $this.find('option:selected').text();
                    ga(['send', 'event',  category, action, label]);
                }

            });
        }
    }

    function attachSelectRedirectListener($select) {

        $select.once('redirect-change').on('change', checkControl);

        function checkControl() {
            var $this = $(this);
            var val = $this.val();

            if (val == null || val == 'none') return;
            window.location = val;
        }

        $select.val('none');

        $select.trigger('change');
    }

})(jQuery);