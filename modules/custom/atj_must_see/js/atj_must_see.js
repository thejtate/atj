(function ($) {
    var COOKIE_NAME = Drupal.settings.atjMustSee.cookieName
        ,ATJ_MUST_SEE_COOCKE_LIFETIME = Drupal.settings.atjMustSee.lifeTime
        ,pins = getPinsFromCookie();

    Drupal.behaviors.atjMustSee = {
      attach: function (context, settings) {
          initPinLinks(context);
          initRemovePinLinks(context);
          initMustSeePageLink();
          initNewLocationFromSelect($('select.must-see-redirect-select'));
      }
    };

    function initPinLinks(context) {
        $('a.pin-link', context).once('pin-actions', function() {
            var $link = $(this);

            if(isPinAdded($link.data('fid').toString())) {
                $link.addClass('active');
            }

            $link.on('click', function () {
                var $this = $(this);

                if (!navigator.cookieEnabled) {
                    alert( 'Please enable  cookie' );
                }

                if ($this.hasClass('active')) {
                    removePin($this.data('fid').toString());
                    $this.removeClass('active');
                } else {
                    addPin($this.data('fid').toString());
                    $this.addClass('active');
                }

                initMustSeePageLink();//update link count
            });
        });
    }

    function initRemovePinLinks(context) {
        $('a.pin-remove', context).once('pin-actions', function() {
            $(this).on('click', function () {
                var $this = $(this),
                    $parent = $this.parents('.pin-article');

                removePin($this.data('fid').toString());
                initMustSeePageLink();
                $parent.addClass('deleted');
                return false;
            });
        });
    }

    function initMustSeePageLink() {
        var count = pins.length;
        $('span.must-see-count').html('(' + count + ')');
    }

    function isPinAdded(fid) {
        return pins.indexOf(fid) != -1;
    }

    function addPin(fid) {
        var idx = pins.indexOf(fid);
        if (idx == -1) {
            pins.push(fid);
            savePinsToCookie();
        }
    }

    function removePin(fid) {
        var idx = pins.indexOf(fid);
        if (idx != -1) {
            pins.splice(idx, 1);
            savePinsToCookie();
        }
    }

    function getPinsFromCookie() {
        var cookie = getCookie(COOKIE_NAME);
        return cookie ? cookie.split('-') : [];
    }

    function savePinsToCookie() {
        setCookie(COOKIE_NAME, pins.join('-'), {'expires' : ATJ_MUST_SEE_COOCKE_LIFETIME, 'path' : '/'});
    }


    function getCookie(name) {
        var matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    function setCookie(name, value, options) {
        options = options || {};

        var expires = options.expires;

        if (typeof expires == "number" && expires) {
            var d = new Date();
            d.setTime(d.getTime() + expires * 1000);
            expires = options.expires = d;
        }
        if (expires && expires.toUTCString) {
            options.expires = expires.toUTCString();
        }

        value = encodeURIComponent(value);

        var updatedCookie = name + "=" + value;

        for (var propName in options) {
            updatedCookie += "; " + propName;
            var propValue = options[propName];
            if (propValue !== true) {
                updatedCookie += "=" + propValue;
            }
        }

        document.cookie = updatedCookie;
    }

    function initNewLocationFromSelect($select) {

        $select.once().on('change', checkControl);

        function checkControl() {
            var val = $(this).val();

            if (val == null || val == 'none') return;

            window.location = $(this).val();
        }
    }

})(jQuery);
