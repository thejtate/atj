/**
 * Gallery.
 */
(function ($) {

  if (typeof Drupal != 'undefined') {
    Drupal.behaviors.atj_gallery = {
      attach: function (context, settings) {
        init();
      },

      completedCallback: function () {
        // Do nothing. But it's here in case other modules/themes want to override it.
      }
    }
  }

  $(function () {
    if (typeof Drupal == 'undefined') {
      init();
    }
  });

  $(window).bind("ajaxComplete", function (e, xhr, settings) {
    init();
  });

  $(window).load(function () {
    init();
  });

  function init() {
    var $type = $('.b-photos-type');

    if (!$type.length) return;
    $type.each(function( index ) {
      initGallery($(this));
      initMasonryPhotos();
    });


    $(".b-photos-type input").change(
      function () {
        var $this = $(this);
        var $parent = $this.parents('.b-photos-type');

        initGallery($parent);
        initMasonryPhotos();
      });
  }

  function initMasonryPhotos() {
    var wrappers = document.querySelectorAll('.b-photos .items');

    if (typeof Masonry == 'undefined' || !wrappers.length) return;

    for(var i = 0; i < wrappers.length; i++) {
      new Masonry(wrappers[i], {
        itemSelector: '.item',
        columnWidth: 479,
        gutter: 20
      });
    }
  }

  function initGallery($parent) {
    var $wrappers = $parent.siblings('.b-photos').find('.item');

    var type = $parent.find("input:checked").val();
    //console.log(type);

    $.each($wrappers, function (i, elem) {
      if (Drupal.settings.atj_gallery.hasOwnProperty(type)) {
        $(elem).removeClass().addClass("item " + Drupal.settings.atj_gallery[type][i]['class']);
      }
    });
  }

})
(jQuery);