(function ($) {
    Drupal.behaviors.customAtjTripApplication = {
        attach: function (context, settings) {
            attachFormFullNameUpdater(context);
        }
    };

    function attachFormFullNameUpdater(context) {

        $('form.trip-application-form', context).once('full-name-updater', function(){

            var $form = $(this)
                ,$first = $form.find('.first-name')
                ,$middle = $form.find('.middle-name')
                ,$last = $form.find('.last-name')
                ,$placeholders = $form.find('span.full-name');

            $first.add($middle).add($last).each(function(){
                var elem = $(this);

                // Save current value of element
                elem.data('oldVal', elem.val());

                // Look for changes in the value
                elem.bind("propertychange change click keyup input paste", function(event){
                    // If value has changed...
                    if (elem.data('oldVal') != elem.val()) {
                        // Updated stored value
                        elem.data('oldVal', elem.val());

                        var fullName = $first.val() + ' ' + $middle.val() + ' ' + $last.val();
                        $placeholders.html(fullName);
                    }
                });
            });

        });
    }

})(jQuery);