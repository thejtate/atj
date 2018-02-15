(function ($) {

  if (typeof Drupal != 'undefined') {
    Drupal.behaviors.atj = {
      attach: function (context, settings) {
        if($(context).is('span.form-required, span.form-optional')) {
          return; //skip form invoke init. due performance issue
        }
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
    initArticlesItemsPosition();
    initBlocksAnimation();
    initStickyControls('.cart-sidebar', {
      indentTop: -14,
      bottomOfElm: $('.webform-client-form-205'),
      bottomOfCorrection: -110
    });
  });

  $(window).load(function () {
    initArticlesItemsPosition();
    initMasonryPhotos();
    initMasonryItems();
    initBlocksAnimation();
    initFlexsliderHome();
    initFlexsliderQuotes();
    initFlexsliderSectionTop();
    initStickyControls('.cart-sidebar', {
      indentTop: -14,
      bottomOfElm: $('.webform-client-form-205'),
      bottomOfCorrection: -110
    });
    initPopupLink();
  });

  function init() {
    initIECheck();
    initSectionWidth();
    //initScrollR(); old parallax
    initSelect();
    initMapHilight();
    initMapDrag();
    initShare();
    initElmsAnimation();
    initPickList();
    initDestinationGenerator();
    initShowModal();
    initTooltip();
    initMobileNav();
    initNav();
    initBlockNavigation();
    initGalleryPopup();
    initScrollMagic(); //new parallax
    //initPlayVideo();
    initPlayVideoInPopup();
    initSlider();
    initSelectPickDestination();
    initBookBlockGallery();
    initSectionTopSlider();
    initCollapsed();
    initScroll();
    initBlockOpen();
    initTooltipForElements();
    initMozillaCheck();
    initFlexsliderFoundation();
    initWarning();
  }

  function initWarning() {
    var $wrapper = $('.b-warning');
    if(!$wrapper.length) return;

    $wrapper.find('.close-btn').on('click touch', function(e) {
      e.preventDefault();

      $wrapper.slideUp('500');
    })

  }

  function initFlexsliderFoundation() {
    var $wrapper = $('.section-lanterns');

    if(typeof $.flexslider == 'undefined' || !$wrapper.length) return;

    var $flexslider = $wrapper.find('.flexslider');

    $flexslider.flexslider({
      controlNav: true,
      directionNav: false,
      slideshowSpeed: 7000,
      start: function(slider) {
        setHeight(slider);
      },
      before: function(slider) {
        setHeight(slider);
      }
    });

    $(window).on('resize', function() {
      $flexslider.each(function() {
        var $this = $(this);
        var $current = $this.find('.flex-active-slide');

        $current.parent().height($current.outerHeight());
      });
    }).resize();

    function setHeight(slider) {
      var slide = slider.slides.eq(slider.animatingTo);

      slide.parent().height(slide.outerHeight());
    }
  }

  function initMozillaCheck() {
    if ($.browser.mozilla)  $("html").addClass("mozilla");
  }

  function initTooltipForElements() {
    var $wrap = $('.float-elements');

    if (!$wrap.length) return;

    var $tooltip = $('#tooltip-donation-1');

    if (!$tooltip.length) return;

    var $elements =  $wrap.find('.items .item');
    var $tooltipName = $tooltip.find('.name');
    var $tooltipAddress = $tooltip.find('.address');
    var $tooltipText = $tooltip.find('.text');

      if (typeof Drupal != 'undefined'
          && typeof Drupal.settings != 'undefined'
          && typeof Drupal.settings.atj_lanterns != 'undefined') {

          var testDrupalArray = Drupal.settings.atj_lanterns;
      } else {
          var testDrupalArray = [
              {name:'Bob' , address: 'Oklahoma City, OK' , text: 'Well wishes from OK! We’ll be in Myanmar next June to help out however we can.'},
              {name:'Bob-1' , address: 'address-1' , text: 'text-1 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque eos exercitationem explicabo'},
              {name:'Bob-2' , address: 'address-2' , text: 'text-2 Lorem ipsum '},
              {name:'Bob-3' , address: 'address-3' , text: 'text-3 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque eos exercitationem explicabo dolor sit amet, consectetur adipisicing elit. Eaque eos exercitationem explicabo'},
              {name:'Bob-4' , address: 'address-4' , text: 'text-4 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque eos '},
              {name:'Bob-5' , address: 'address-5' , text: 'text-5 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque eos exercitationem explicabo exercitationem explicabo'},
              {name:'Bob-6' , address: 'address-6' , text: 'text-6 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque eos exercitationem explicabo'},
              {name:'Bob-7' , address: 'address-7' , text: 'text-7 Lorem ipsum dolor sit amet, consectetur '},
              {name:'Bob-8' , address: 'address-8' , text: 'text-8 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque eos exercitationem explicabo'},
              {name:'Bob-9' , address: 'address-9' , text: 'text-9 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque eos exercitationem explicabo Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque eos exercitationem explicabo Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque eos exercitationem explicabo'}
          ];
      }

    $elements.on('mouseenter', elmMouseEnter);
    $elements.on('mouseleave', elmMouseLeave);
    $tooltip.on('mouseleave', elmMouseLeave);

    function elmMouseEnter() {
      var $el = $(this);

      if ($el.hasClass('paused')) return;
      $el.addClass('paused');

      updateTooltipText($el);
      updateTooltipPosition($el);
    }

    function elmMouseLeave(e) {
      var $target = $(e.relatedTarget);

      if($target.closest('.donation-tooltip').length || $target.closest('.paused').length) return;

      $elements.removeClass('paused');
      $tooltip.removeClass('active');
      $tooltip.attr('style', '');
    }

    function updateTooltipText(el) {
      var key;

      if (el.attr('data-key') > -1 ) {
        key =  el.attr('data-key');
      } else {
        key = randomInteger(0, testDrupalArray.length - 1);
        el.attr('data-key', key);
        animationIteration(el[0]);
      }

      $tooltipName.html(testDrupalArray[key].name);
      $tooltipAddress.html(testDrupalArray[key].address);
      $tooltipText.html(testDrupalArray[key].text);
    }

    function updateTooltipPosition(el) {
      var tooltipLeft =  Math.round(el.offset().left) - $tooltip.outerWidth() + el.outerWidth()/2;
      var tooltipTop =  Math.round(el.offset().top) - $tooltip.outerHeight() + el.outerHeight()/2;
      var winTop = $(window).scrollTop();

      tooltipTop = tooltipTop < winTop ? winTop : tooltipTop;
      tooltipLeft = tooltipLeft + $tooltip.outerWidth() + 30 > window.innerWidth ? window.innerWidth - $tooltip.outerWidth() - 30 : tooltipLeft;
      tooltipLeft = tooltipLeft < 0 ? 0 : tooltipLeft;

      $tooltip.css({'top': tooltipTop + 'px', 'left': tooltipLeft + 'px'});
      $tooltip.addClass('active');
    }

    function animationIteration(currentEl)  {

      currentEl.addEventListener("webkitAnimationIteration", function() {
        currentEl.setAttribute("data-key", -1);
      });
    }

    function randomInteger(min, max) {
      var rand = min + Math.random() * (max + 1 - min);
      rand = Math.floor(rand);

      return rand;
    }
  }

  function  initPopupLink() {
    var $link = $(".popup-link");

    if (!$link.length) return;
    var cookeName = "popup-active";
    var cookePopupActive = $.cookie(cookeName);
    if (cookePopupActive) return;

    setTimeout(function() {
      $.cookie(cookeName, "1", {
        expires: 86400,
        path: '/'
      });
      $link.trigger("click", "touch");
    }, 8000);
  }

  function initBlockOpen() {
    var $wrapper = $(".b-sticky-btn");
    var $html = $("html");

    if (!$wrapper.length || $html.hasClass('desktop')) return;

    if ($wrapper.hasClass('processed')) return;

    $wrapper.addClass('processed');

    var $btnControl = $wrapper.find(".title");

    $btnControl.on('click touch', function(e) {
      e.preventDefault();

      $wrapper.toggleClass('open');
    })
  }

  function initScroll() {

    var $wrapper = $(".b-itinerary");
    if (!$wrapper.length) return;

    $wrapper.find('.scrollbar-macosx').scrollbar({
      disableBodyScroll: true,
    });
  }

  function initCollapsed() {
    var $wrapper = $('.b-itinerary');

    if (!$wrapper.length) return;

    var  $btnsCollapsed = $wrapper.find('.btn-collapsed');
    var  $items = $wrapper.find('.items .item');
    var  $itemsContent = $items.find('.item-content');

    $btnsCollapsed.on('click touch', function(e) {
      e.preventDefault();

      var $thisItem = $(this).closest('.item');

      $thisItem.toggleClass('collapsed');
      $thisItem.find('.item-content').slideToggle(500);
    });

    $wrapper.find('.link-control').on('click touch', function(e) {
      e.preventDefault();
      $wrapper.toggleClass('all-expanded');

      if ($wrapper.hasClass('all-expanded')) {
        $items.addClass('collapsed');
        $itemsContent.slideDown(500);
      } else {
        $items.removeClass('collapsed');
        $itemsContent.slideUp(500);
      }
    });
  }

  function initSectionTopSlider() {
    var $wrapper = $('.navigation-type-a.for-not-supported');
    var $nav = $wrapper.find('.nav li');
    var length = $nav.length;
    var $content = $wrapper.find('.item');
    var current = 0;
    var speed = 4000;

    setActive(current);

    $nav.find('a').on('click', function(e) {
      e.preventDefault();

      clearInterval(timer);
      setActive($(this).parent().index());
    });

    $wrapper.find('select').on('click', function() {
      clearInterval(timer);
    });

    var timer = setInterval(function() {
      current++;
      current = (current > length - 1) ? 0 : current;
      setActive(current);
    }, speed);

    function setActive(index) {
      $nav.removeClass('active').eq(index).addClass('active');
      $content.removeClass('active').eq(index).addClass('active');
    }
  }

  function initStickyControls($el, options) {
    if (typeof $el == 'string') {
      $el = $($el);

      if (!$el.length || $el.hasClass('processed')) return;
    }

    $el.addClass('processed');

    var config = {
      height: $el.outerHeight(),
      offsetTop: $el.offset().top,
      indentTop: options.indentTop ? options.indentTop : 0,
      pseudoClassName: 'pseudo-el',
      stickyIfPosition: options.stickyIfPosition ? options.stickyIfPosition : 'top',
      bottomOfElm: options.bottomOfElm.length ? options.bottomOfElm.offset().top + options.bottomOfElm.outerHeight() : 0,
      bottomOfCorrection: options.bottomOfCorrection ? options.bottomOfCorrection : 0
    };

    var $pseudoEl = [];

    $el.on('click touch', function() {
      if(!$el.hasClass('sticky')) {
        config.height = $el.outerHeight();
        config.offsetTop = $el.offset().top;
      }
    });

    checkPosition();
    $(window).on('resize', updateStyles);

    $(window).on('scroll resize', function () {
      checkPosition();
    });

    function updateStyles() {
      if(options.bottomOfElm.length) {
        config.bottomOfElm = options.bottomOfElm.offset().top + options.bottomOfElm.outerHeight();
      }

      if(!$pseudoEl.length) {
        config.height = $el.outerHeight();
        config.offsetTop = $el.offset().top;
      } else {
        config.height = $pseudoEl.outerHeight();
        config.offsetTop = $pseudoEl.offset().top;
      }

    }

    function checkPosition() {
      var position = config.stickyIfPosition !== 'top' ? config.offsetTop + config.height : config.offsetTop;

      if ($(window).scrollTop() > position + config.indentTop) {
        createPseudoEl();
      } else {
        removePseudo();
      }

      if(options.bottomOfElm.length && config.bottomOfElm + config.bottomOfCorrection < $(window).scrollTop() + config.height) {
        $el.addClass('bottom-of-elm');
      } else {
        $el.removeClass('bottom-of-elm');
      }
    }

    function createPseudoEl() {
      $el.addClass('sticky');

      if ($pseudoEl.length) return;

      $pseudoEl = $el.clone().removeClass('sticky').addClass(config.pseudoClassName);
      $el.after($pseudoEl);
    }

    function removePseudo() {
      $el.removeClass('sticky');

      if (!$pseudoEl.length) return;

      $pseudoEl.remove();
      $pseudoEl = [];
    }
  }

  function initFlexsliderSectionTop() {
    var $wrapper = $('.section-top');

    if(typeof $.flexslider == 'undefined' || !$wrapper.length) return;

    var $flexslider = $wrapper.find('.flexslider');

    if(!$flexslider.length) return;

    var slideShow = $flexslider.hasClass('slideShow');
    var $bgs = $wrapper.find('.bgs');

    $flexslider.flexslider({
      directionNav: false,
      slideshow: slideShow,
      slideshowSpeed: 10000,
      start: function(slider) {
        setHeight(slider);
        bgAnimation(slider);
      },
      before: function(slider) {
        setHeight(slider);
        bgAnimation(slider);
      }
    });

    $(window).on('resize', function() {
      $flexslider.each(function() {
        var $this = $(this);
        var $current = $this.find('.flex-active-slide');

        $current.parent().height($current.outerHeight());
      });
    });

    function bgAnimation(slider) {
      $bgs.each(function() {
        var $this = $(this);
        var $list = $this.find('li');

        $list.removeClass('active');
        $list.eq(slider.animatingTo).addClass('active');
      });
    }

    function setHeight(slider) {
      var slide = slider.slides.eq(slider.animatingTo);

      slide.parent().height(slide.outerHeight());
    }
  }

  function initFlexsliderHome() {
    var $wrapper = $('.section-group-trips');

    var $current = $wrapper.find('.controls .current');
    var $total = $wrapper.find('.controls .total');

    if(typeof $.flexslider == 'undefined' || !$wrapper.length) return;

    $wrapper.find('.flexslider').flexslider({
      slideshowSpeed: 12000,
      start: function(slider) {
        $total.text(slider.count);
        $current.text(slider.currentSlide + 1);
      },
      after: function(slider) {
        $current.text(slider.currentSlide + 1);
      }
    });

    var $btnNext = $wrapper.find('.next-slide');
    var $btnNextFlex = $wrapper.find('.flex-next');
    var $btnPrev = $wrapper.find('.prev-slide');
    var $btnPrevFlex = $wrapper.find('.flex-prev');

    $btnNext.on('click', function(e) {
      e.preventDefault();

      $btnNextFlex.trigger('click');
    });

    $btnPrev.on('click', function(e) {
      e.preventDefault();

      $btnPrevFlex.trigger('click');
    });
  }

  function initFlexsliderQuotes() {
    var $wrapper = $('.section-quotes');

    if(typeof $.flexslider == 'undefined' || !$wrapper.length) return;

    var $flexslider = $wrapper.find('.flexslider');

    $flexslider.flexslider({
      controlNav: false,
      directionNav: false,
      slideshowSpeed: 7000,
      start: function(slider) {
        setHeight(slider);
      },
      before: function(slider) {
        setHeight(slider);
      }
    });

    $(window).on('resize', function() {
      $flexslider.each(function() {
        var $this = $(this);
        var $current = $this.find('.flex-active-slide');

        $current.parent().height($current.outerHeight());
      });
    }).resize();

    function setHeight(slider) {
      var slide = slider.slides.eq(slider.animatingTo);

      slide.parent().height(slide.outerHeight());
    }
  }

  function initBookBlockGallery() {
    var config = {
      $wrapper: $('section.section-top-experts'),
      $bookBlock: $('#bb-bookblock'),
      $navNext: $('#bb-nav-next'),
      $navPrev: $('#bb-nav-prev'),
      speed: 800
    };

    if(!config.$bookBlock.length) return;

    var $slides = config.$bookBlock.children();
    var current = 0;

    if($('html').hasClass('ie')) {
      initIe();
    } else {
      initNotIe();
    }

    addPagination();

    //initialization form IE
    function initIe() {
      setActive(current);

      config.$navNext.on('click touchstart', function() {
        current++;
        setActive(current);
        return false;
      });

      config.$navPrev.on('click touchstart', function() {
        current--;
        setActive(current);
        return false;
      });
    }

    //initialization form Not IE
    function initNotIe() {
      config.$bookBlock.bookblock({
        speed: config.speed,
        shadows: false,
        onBeforeFlip: function(page) {
          config.$wrapper.css('zIndex', 5);

        },
        onEndFlip: function(old, page, isLimit) {
          config.$wrapper.css('zIndex', 3);
          checkSlide(page);
        }
      });

      //add navigation events
      config.$navNext.on('click touchstart', function() {
        config.$bookBlock.bookblock('next');
        return false;
      });

      config.$navPrev.on('click touchstart', function() {
        config.$bookBlock.bookblock('prev');
        return false;
      });

      //add swipe events
      $slides.on({
        'swipeleft': function(event) {
          config.$bookBlock.bookblock('next');
          return false;
        },
        'swiperight': function(event) {
          config.$bookBlock.bookblock('prev');
          return false;
        }
      });

      //add keyboard events
      $(document).keydown(function(e) {
        var keyCode = e.keyCode || e.which,
          arrow = {
            left : 37,
            up : 38,
            right : 39,
            down : 40
          };

        switch(keyCode) {
          case arrow.left:
            config.$bookBlock.bookblock( 'prev' );
            break;
          case arrow.right:
            config.$bookBlock.bookblock( 'next' );
            break;
        }
      });
    }

    function checkSlide(page) {
      config.$navNext.removeClass('hidden');
      config.$navPrev.removeClass('hidden');

      if(page == $slides.length - 1) {
        config.$navNext.addClass('hidden');
      } else if(page == 0) {
        config.$navPrev.addClass('hidden');
      }
    }

    function setActive(index) {
      checkSlide(index);

      $slides.removeClass('active');
      $slides.eq(index).addClass('active');
    }

    function addPagination() {
      $slides.each(function(i) {
        var $this = $(this);
        var $links = '';

        for(var y = 0; y < $slides.length; y++) {
          $links += '<a href="#" ' + 'class="' + ((y == i) ? 'active' : '')  + ' bb-custom-dot"' + '></a>';
        }

        $this.find('.text-inner').append('<div class="navigation">' + $links + '</div>');

        $links = $this.find('.navigation a');

        $links.each(function(x) {
          $(this).on('click touchstart', function(event) {

            if($('html').hasClass('ie')) {
              current = $(this).index();
              setActive(current);
            } else {
              config.$bookBlock.bookblock('jump', x + 1);
            }

            return false;
          });
        });
      });
    }
  }

  function initBlocksAnimation() {
    var $wrapper = $('.b-photos-type-2.style-a');

    if(!$wrapper.length && !$wrapper.hasClass('processed')) return;

    $wrapper.addClass('processed');

    var $items = $wrapper.find('.item');
    var itemsLength = $items.length;
    var itemsAnimation = [];
    var speed = 150;
    var randomAnimation = false;

    if(randomAnimation) {
      getRandom(itemsAnimation);
    }

    for (var x = 0; x < itemsLength; x++) {
      animation(itemsAnimation[x], x);
    }

    function animation(y, x) {
      setTimeout(function() {
        $items.eq(randomAnimation ? y : x).css('opacity', 1);
      }, x*speed)
    }

    function getRandom(arr) {
      var num = randomInteger(0, itemsLength - 1);
      var result = checkRandom(arr, num);

      if (!result) {
        itemsAnimation.push(num);
      }

      if(arr.length !== itemsLength) {
        getRandom(itemsAnimation);
      }
    }

    function checkRandom(arr, num) {
      var result = false;

      for (var y = 0; y < arr.length; y++) {
        if (arr[y] == num) {
          result = true;

          break;
        }
      }

      return result;
    }

    function randomInteger(min, max) {
      var rand = min + Math.random() * (max + 1 - min);
      rand = Math.floor(rand);

      return rand;
    }
  }

  function initSlider() {
    var wrapper = document.querySelector('.b-slider');

    if(!wrapper) return;

    var slides = wrapper.querySelectorAll('.slide');
    var slidesLength = slides.length;

    if(!slidesLength) return;

    var secondSlideCount = new CountUp(document.querySelector('.b-slider .slide-2 .ico-text'), 0, 100, 0, 2.5, {
      useEasing: true,
      useGrouping: true
    });

    //var sixthSlideCount = new CountUp(document.querySelector('.b-slider .slide-6 .title.bottom'), 0, 50000, 0, 2.5, {
    //  useEasing: true,
    //  useGrouping: true
    //});

    var options = {
      current: 0,
      prefix: 'slide-',
      animationSpeed: 500
    };

    var pager = buildPager(slides);
    wrapper.appendChild(pager.wrapper);

    setActive(options.current);

    if(!document.documentElement.classList.contains('desktop')) {
      var hammertime = new Hammer(wrapper);

      hammertime.on('swipe', function(ev) {
        checkSlide(ev.deltaX);
      });
    }

    pager.wrapper.addEventListener('click', function(e) {
      e.preventDefault();

      var target = e.target;

      if(target.nodeName == 'A' && !target.parentNode.classList.contains('active')) {
        var index = getIndex(target.parentNode);

        setActive(index);
      }
    });

    $(document).on('mousewheel', wheelHandler);

    var scrollPos;
    var oldDate = 0;
    var wheel = 0;
    var isScrolling = false;

    function wheelHandler(e) {
      var newDate = new Date().getTime();
      var scrollAllowed = true;
      var delta = e.deltaY;

      if(wheel < 10 && (newDate - oldDate) < 20) {
        scrollPos -= e.deltaY * (10-wheel);
        wheel++;
      } else {

        if((newDate - oldDate) > 100) {
          wheel = 0;
          scrollPos -= e.deltaY * 60;
        } else {
          scrollAllowed = false;
        }

      }

      oldDate = new Date().getTime();

      if(scrollAllowed && !isScrolling) {
        isScrolling = true;

        checkSlide(delta);

        setTimeout(function() {
          isScrolling = false;
        }, options.animationSpeed);
      }
    }

    function checkSlide(direction) {
      var index;

      if(direction > 0) {
        index = (options.current - 1) < 0 ? slidesLength - 1 : options.current - 1;
      } else {
        index = (options.current + 1) > slidesLength - 1 ? 0 : options.current + 1;
      }

      setActive(index);
    }

    function setActive(index) {
      slides[options.current].classList.remove('animate');

      document.documentElement.classList.remove(options.prefix + options.current);
      options.current = index;
      document.documentElement.classList.add(options.prefix + options.current);

      for(var i = 0; i < slidesLength; i++) {
        if(options.current == i) {
          slides[i].classList.add('active');
          pager.items[i].classList.add('active');
        } else {
          slides[i].classList.remove('active');
          pager.items[i].classList.remove('active');
        }
      }

      setTimeout(function() {
        slides[options.current].classList.add('animate');

        switch(options.current) {
          case 1:
            secondSlideCount.start();
            break;
          //case 5:
          //  sixthSlideCount.start();
          //  break;
          default:
            secondSlideCount.reset();
            break;
        }

      }, options.animationSpeed);
    }

    function buildPager() {
      var items = [];
      var wrapper = document.createElement('div');
      wrapper.className = 'slider-pager';

      for(var i = 0; i < slidesLength; i++) {
        var pagerItem = document.createElement('div');
        pagerItem.className = 'pager-item';

        var link = document.createElement('a');
        link.href = '#' + options.prefix + i;

        pagerItem.appendChild(link);
        items.push(wrapper.appendChild(pagerItem));
      }

      return {
        wrapper: wrapper,
        items: items
      };
    }

    function getIndex(node) {
      var childs = node.parentNode.childNodes;

      for (var i = 0; i < childs.length; i++) {
        if (node == childs[i]) break;
      }

      return i;
    }
  }

  function initPlayVideo() {
    var wrapper = document.querySelector('.section-top');

    if(!wrapper) return;

    var btn = wrapper.querySelector('.btn-play');

    if(!btn || btn.classList.contains('btn-play-processed')) return;

    btn.classList.add('btn-play-processed');
    btn.addEventListener('click', checkVideo);

    function checkVideo(e) {
      e.preventDefault();

      var href = this.getAttribute('href').replace('#', '');
      var video = document.getElementById(href);

      if(!video) return;

      if (video.paused) {
        video.play();
        document.documentElement.classList.add('video-is-active');
        video.addEventListener('ended', endedHandler);
      } else {
        endedHandler();
      }

      function endedHandler() {
        video.pause();
        document.documentElement.classList.remove('video-is-active');
        video.removeEventListener('ended', endedHandler);
      }
    }
  }

  function initPlayVideoInPopup() {
    var $btn = $('.section-top .btn-play');

    if (!$btn.length) return;

    var currentVideo, url;

    $btn.on('click touch', function (e) {
      e.preventDefault();

      var href = this.getAttribute('href').replace('#', '');
      currentVideo = document.getElementById(href);

      if(currentVideo.tagName == 'VIDEO') {
        videoControl(currentVideo);
      } else if(currentVideo) {
        currentVideo.setAttribute('src', currentVideo.getAttribute('src') + '&autoplay=1');
      }
    });

    $('.modal').on('hide.bs.modal', function () {
      if (currentVideo) {
        if(currentVideo.tagName == 'VIDEO') {
          videoControl(currentVideo);
        } else {
          url = currentVideo.getAttribute('src').replace('&autoplay=1', '');
          currentVideo.setAttribute('src', url);

          $(currentVideo).after($(currentVideo).clone());
          $(currentVideo).remove();
        }

        currentVideo = false;
      }
    });

    function videoControl(video) {
      if (video.paused) {
        video.play();
      } else {
        video.pause();
      }
    }
  }

  function initGalleryPopup() {
    baguetteBox.run('.b-gallery', {
      animation: 'fadeIn'
    });

    baguetteBox.run('.b-articles .link-view', {
      animation: 'fadeIn'
    });
  }

  function initBlockNavigation() {
    if(document.documentElement.classList.contains('mobile')) return;

    var wrapper = document.querySelector('.b-navigation');

    if(!wrapper) return;

    var listsWrapper = wrapper.querySelectorAll('li');

    if(!listsWrapper.length || wrapper.classList.contains('menu-wrapper-processed')) return;

    wrapper.classList.add('menu-wrapper-processed');

    var currentUl;

    for(var y = 0; y < listsWrapper.length; y++) {
      if(y !== 0 && y % Math.ceil(listsWrapper.length/3) == 0) {
        currentUl = document.createElement('ul');
        currentUl.className = 'menu';
        currentUl.appendChild(listsWrapper[y]);
        listsWrapper[0].parentNode.parentNode.appendChild(currentUl);
      } else if(y > Math.ceil(listsWrapper.length/3)) {
        currentUl.appendChild(listsWrapper[y]);
      }
    }
  }

  function initNav() {
    if(document.documentElement.classList.contains('mobile')) return;

    var wrapper = document.querySelector('.navigation-container');

    if(!wrapper) return;

    var listsWrapper = wrapper.querySelectorAll('li.menu-columns .menu-wrapper > ul');

    if(!listsWrapper.length || wrapper.classList.contains('menu-wrapper-processed')) return;

    wrapper.classList.add('menu-wrapper-processed');

    var currentList;
    var currentUl;
    for(var i = 0; i < listsWrapper.length; i++) {
      currentList = listsWrapper[i].querySelectorAll('li');

      for(var y = 0; y < currentList.length; y++) {
        if(y !== 0 && y % Math.ceil(currentList.length/3) == 0) {
          currentUl = document.createElement('ul');
          currentUl.className = 'menu';
          currentUl.appendChild(currentList[y]);
          listsWrapper[i].parentNode.appendChild(currentUl);
        } else if(y > Math.ceil(currentList.length/3)) {
          currentUl.appendChild(currentList[y]);
        }
      }
    }
  }

  function initMobileNav() {
    var btn = document.querySelector('.btn-nav');

    if(!btn || btn.classList.contains('btn-nav-processed')) return;

    btn.classList.add('btn-nav-processed');

    btn.addEventListener('click', function(e) {
      e.preventDefault();

      document.body.classList.toggle('mobile-nav');
    });

    var wrapper = document.querySelector('.navigation-container-mobile .navigation-wrapper');
    var expandedList = wrapper.querySelectorAll('.navigation-container-mobile .menu li.expanded > a');

    wrapper.style.height = window.innerHeight + 'px';

    window.addEventListener('resize', function() {
      wrapper.style.height = window.innerHeight + 'px';
    });

    if(!expandedList.length) return;

    for(var i = 0; i < expandedList.length; i++) {
      expandedList[i].addEventListener('click', function(e) {
        if(e.target.innerText.toLowerCase() !== 'destinations') {
          e.preventDefault();

          this.parentNode.classList.toggle('active-lvl');
        }
      });
    }
  }

  function initTooltip() {
    var btns = document.querySelectorAll('[data-target-tooltip]');

    if(!btns.length) return;

    var tooltips = document.querySelector('.tooltips');
    if(tooltips) {
      document.body.appendChild(tooltips);
    }

    var current;

    for(var i = 0; i < btns.length; i++) {
      btns[i].addEventListener('mouseover', tooltipHandler);
      btns[i].addEventListener('click', tooltipHandler);

      if(!btns[i].classList.contains('type-pin')) {
        btns[i].addEventListener('mouseout', removeCurrent);
      }

    }

    window.addEventListener('resize', removeCurrent);

    function removeCurrent() {
      if(!current) return;

      if(!current.classList.contains('pin-tooltip')) {
        current.classList.remove('active');
        current.setAttribute('style', '');
      } else {
        setTooltipPosition(document.querySelector('[data-target-tooltip="#' + current.id + '"]'), current);
      }
    }

    function tooltipHandler(e) {
      e.preventDefault();

      var tooltip = this.hasAttribute('data-target-tooltip') && this.getAttribute('data-target-tooltip') ? document.querySelector(this.getAttribute('data-target-tooltip')) : null;

      if(tooltip) {
        current = tooltip;

        if(tooltip.classList.contains('pin-tooltip')) {
          if($.cookie('pin') !== undefined) return;

          if(!tooltip.classList.contains('processed')) {
            tooltip.querySelector('.type-btn').addEventListener('click', function(e) {
              e.preventDefault();

              $.cookie('pin', 1, {expires: 365 * 10, path: '/'});
              current.classList.remove('active');
              current.setAttribute('style', '');
            });

            tooltip.classList.add('processed');
          }
        }

        setTooltipPosition(this, tooltip);
        tooltip.classList.add('active');
      }

    }

    function setTooltipPosition(target, tooltip) {
      var o = offset(target);
      var left = o.left - target.offsetWidth/2 - tooltip.offsetWidth;
      var top = o.top + target.offsetHeight/2;

      if(left <= 0 || tooltip.classList.contains('pin-tooltip')) {
        tooltip.classList.add('top');
        left = o.left + 12;
        top = o.top - tooltip.offsetHeight - target.offsetHeight/2;
      } else {
        tooltip.classList.remove('top');
      }

      tooltip.style.left = left + 'px';
      tooltip.style.top = top + 'px';
    }

    function offset(element) {
      var rect = element.getBoundingClientRect();

      return {
        top: rect.top + pageYOffset,
        left: rect.left + pageXOffset
      }
    }
  }

  function initShowModal() {
    if(window.location.hash) {
      showModal();
    }

    window.addEventListener('hashchange', function() {
      showModal();
    });

    $('.modal').on('hide.bs.modal', function (e) {
      window.location.hash = '#';
    });

    function showModal() {
      var $hash = $(window.location.hash);

      if($hash.length && $hash.hasClass('b-modal')) $hash.modal('toggle');
    }
  }

  function initDestinationGenerator() {
    var wrapper = document.querySelector('.page-wanderlust .section-region');

    if(!wrapper) return;

    var btn = document.getElementById('btn-generate');
    btn.addEventListener('click', start);
    var active;

    var listOfRegions = wrapper.querySelectorAll('.regions-list li');
    var regionsLength = listOfRegions.length;
    var btnsBack = wrapper.querySelectorAll('.link.type-back-a');

    for(var y = 0; y < btnsBack.length; y++) {
      back(y);
    }

    createMapsList();

    var list = document.getElementById('maps').querySelectorAll('li');
    var r = [];

    getRandom();

    function createMapsList() {
      var mapsWrapper = document.createElement('div');
      mapsWrapper.id = 'maps';
      mapsWrapper.className = 'maps';

      var ul = document.createElement('ul');

      for(var i = 0; i < regionsLength; i++) {
        var li = document.createElement('li');
        var img = new Image();
        img.src = listOfRegions[i].querySelector('.map img').getAttribute('src');

        li.appendChild(img);
        ul.appendChild(li);
      }

      mapsWrapper.appendChild(ul);
      wrapper.appendChild(mapsWrapper);
    }

    function back(y) {
      btnsBack[y].addEventListener('click', function(e) {
        e.preventDefault();

        wrapper.classList.remove('animation-state-2');
        listOfRegions[active].classList.remove('animate');

        wrapper.removeChild(document.getElementById('maps'));

        createMapsList();

        list = document.getElementById('maps').querySelectorAll('li');
        r = [];

        getRandom();
      });
    }

    function start(e) {
      e.preventDefault();

      wrapper.classList.add('animation-state-1');

      setTimeout(function() {
        for(var i = 0; i < r.length; i++) {

          (function(i) {
            setTimeout(function() {

              if(i > 0) {
                list[r[i - 1]].classList.remove('animate');
              }

              list[r[i]].classList.add('animate');

              if(i == r.length - 1) {
                end(r[i]);
              }
            }, 300 + (300*i));
          })(i);
        }
      }, 1000);
    }

    function end(i) {
      active = i;

      setTimeout(function() {
        list[i].classList.remove('animate');
      }, 500);

      setTimeout(function() {
        listOfRegions[i].classList.add('animate');
        wrapper.classList.remove('animation-state-1');
        wrapper.classList.add('animation-state-2');
      }, 800);
    }

    function getRandom() {
      var current = random(0, regionsLength - 1);

      if(r.indexOf(current) == -1) {
        r.push(current);
      }

      if(r.length < 6 && r.length < regionsLength) getRandom();
    }

    function random(min, max) {
      var rand = min - 0.5 + Math.random() * (max - min + 1);
      rand = Math.round(rand);
      return Math.abs(rand);
    }
  }

  function initPickList() {
    var $form = $('.form-pick-list select');

    if(!$form) return;

    $form.on('change', function() {
      window.location = $(this).val();
    });
  }

  function initElmsAnimation() {
    window.sr = ScrollReveal({
      duration: 1000,
      scale: 1,
      easing: 'ease',
      origin: 'top',
      mobile: false
    });

    sr.reveal('.page-tour-guides .section-guide .inner-block', {
      distance: '50px'
    });
  }

  function initShare() {
    var wrapper = document.querySelector('.share-block');

    if (!wrapper) return;

    var btn = wrapper.querySelector('.btn');

    btn.addEventListener('click', function (e) {
      e.preventDefault();

      wrapper.classList.toggle('active');
    })
  }

  function initScrollR() {

    if(document.documentElement.classList.contains('tablet') || document.documentElement.classList.contains('mobile')) {
      return;
    }

    var s = skrollr.init({
      render: function (data) {

      },
      forceHeight: false,
      smoothScrolling: false
    });
  }

  function initIECheck() {
    if (($.browser.msie) || ($.browser.msedge))  $("html").addClass("ie");
  }

  function initScrollMagic() {
    if (document.documentElement.classList.contains('tablet') ||
      document.documentElement.classList.contains('mobile') ||
      document.documentElement.classList.contains('parallax-processed')) {

      return;
    }
    document.documentElement.classList.add('parallax-processed');

    var divImg= [];
    var safari = $.browser.safari;
    var ie = document.documentElement.classList.contains('ie');
    var parallaxItems = document.querySelectorAll('.clip-path-img-top, .clip-path-img-top-min, .clip-path-img, .clip-path-region, .clip-path-img-skew, .clip-path-experts, .clip-path-img-top-a, .clip-path-quotes, .clip-path-img-top-d, .clip-path-img-top-f, .clip-path-img-full-height, .section-lanterns');

    if (!parallaxItems.length) return;

    var controller = new ScrollMagic.Controller({globalSceneOptions: {triggerHook: "1"}});

    for (var i = 0; i < parallaxItems.length; i++) {
      if (!ie || parallaxItems[i].classList.contains('section')) {
        var currentDivImg = parallaxItems[i].querySelectorAll(".bg-img");

        if (!currentDivImg.length) continue;

        for(var y = 0; y < currentDivImg.length; y++) {
          if (safari) currentDivImg[y].style.WebkitTransform = "translateZ(1px)";// fix safari issue
          newScene(parallaxItems[i], currentDivImg[y]);
        }

      } else {
        var currentSvgImage = parallaxItems[i].parentNode.querySelector('image[width]');
        if (!currentSvgImage) continue;
        currentSvgImage.setAttribute('height', parallaxItems[i].offsetHeight + 150);
        currentSvgImage.setAttribute('y', -225);
        newScene(parallaxItems[i], currentSvgImage);
      }
    }

    window.addEventListener('resize', function() {
      for (var i = 0; i < divImg.length; i++) {
        divImg[i][1].duration(window.innerHeight + divImg[i][0].offsetHeight);
      }
    });

    function newScene(item, currentImage) {
      if (currentImage.tagName == "VIDEO") TweenLite.set(currentImage, {xPercent: "-50"});
      divImg.push([item, new ScrollMagic.Scene({triggerElement: item, duration: window.innerHeight + item.offsetHeight})
        .setTween(currentImage, {y: "300", ease: Linear.easeNone})
        .addTo(controller)]);
    }
  }

  function initSectionWidth() {
    var clipPathImg = document.querySelectorAll('.clip-path-img-top, .clip-path-img-top-min, .clip-path-img, .clip-path-region, .clip-path-img-skew, .clip-path-experts, .clip-path-img-top-a, .clip-path-experts-a, .clip-path-quotes, .clip-path-img-top-d, .clip-path-img-top-f, .clip-path-img-full-height');
    var clipPath = document.querySelectorAll('#clip-path-img-top polygon, #clip-path-img-top-min polygon, #clip-path-img polygon, #clip-path-region polygon, #clip-path-img-skew polygon, #clip-path-experts polygon, #clip-path-img-top-a polygon, #clip-path-experts-a polygon, #clip-path-quotes polygon, #clip-path-img-top-d polygon, #clip-path-img-top-f polygon, #clip-path-img-full-height polygon');

    if (!clipPathImg.length || !clipPath.length) return;

    var isTouch = touchCheck();
    var isMobile = mobileCheck();
    var isSafari = safariCheck();
    var IeCheck = ieEdgeCheck();

    setPoly();

    if (isSafari) {
      for (var i = 0; i < clipPathImg.length; i++) {
        clipPathImg[i].style.WebkitTransform = "translateZ(1px)";
      }
    }

    if(!isTouch && !isSafari && !IeCheck) {
      timer = setTimeout(function () {
        initRendering(1);
      }, 20);
    }

    var timer;
    window.addEventListener('resize', function () {
      setPoly();

      if(!isTouch && !isSafari && !IeCheck) {
        clearTimeout(timer);
        timer = setTimeout(function () {
          initRendering(1);
        }, 20);
      }

    });

    function setPoly() {
      var windowW = window.innerWidth;
      var windowWHalf = windowW / 2;
      var sectionFullHeight = $('.clip-path-img-full-height');
      var sectionHeight = sectionFullHeight.length ? sectionFullHeight.closest('.section').outerHeight() : 0;

      //height top 145, mobile 46.

      try {
        clipPath[0].setAttribute('points', '0 0,0' + (isMobile ? ' 424,' : ' 569,') + windowWHalf + (isMobile ? ' 470,' : ' 714,') + windowW + (isMobile ? ' 424,' : ' 569,') + windowW + ' 0');
        clipPath[1].setAttribute('points', '0 0,0' + (isMobile ? ' 254,' : ' 358,') + windowWHalf + (isMobile ? ' 300,' : ' 503,') + windowW + (isMobile ? ' 254,' : ' 358,') + windowW + ' 0');
        clipPath[2].setAttribute('points', '0 0,' + windowW + ' 0,' + windowW + (isMobile ? ' 434,' : ' 714,') + '0 ' + (isMobile ? '520' : '1000'));
        clipPath[3].setAttribute('points', '0 0,' + windowW + ' 0,' + windowW + ' 560,' + '0 ' + (isMobile ? '670' : '860'));
        clipPath[4].setAttribute('points', '0 ' + (isMobile ? '85' : '286') + ',' + windowW + ' 0,' + windowW + (isMobile ? ' 434,' : ' 714,') + '0 ' + (isMobile ? '520' : '1000'));
        clipPath[5].setAttribute('points', '0 0,0' + (isMobile ? ' 470,' : ' 766,') + windowWHalf + (isMobile ? ' 424,' : ' 621,') + windowW + (isMobile ? ' 470,' : ' 766,') + windowW + ' 0');
        clipPath[6].setAttribute('points', '0 0,0' + (isMobile ? ' 604,' : ' 698,') + windowWHalf + (isMobile ? ' 650,' : ' 843,') + windowW + (isMobile ? ' 604,' : ' 698,') + windowW + ' 0');
        clipPath[7].setAttribute('points', '0 0,0' + (isMobile ? ' 470,' : ' 766,') + windowWHalf + (isMobile ? ' 424,' : ' 621,') + windowW + (isMobile ? ' 470,' : ' 766,') + windowW + ' 0,' + windowWHalf + (isMobile ? ' 46' : ' 145'));
        clipPath[8].setAttribute('points', '0' + (isMobile ? ' 46,' : ' 145,') + '0' + (isMobile ? ' 470,' : ' 700,') + windowWHalf + (isMobile ? ' 424,' : ' 555,') + windowW + (isMobile ? ' 470,' : ' 700,') + windowW + (isMobile ? ' 46,' : ' 145,') + windowWHalf + ' 0');
        clipPath[9].setAttribute('points', '0 0,0' + (isMobile ? ' 604,' : ' 454,') + windowWHalf + (isMobile ? ' 650,' : ' 599,') + windowW + (isMobile ? ' 604,' : ' 454,') + windowW + ' 0');
        clipPath[10].setAttribute('points', '0 0,0' + (isMobile ? ' 604,' : ' 698,') + windowWHalf + (isMobile ? ' 650,' : ' 843,') + windowW + (isMobile ? ' 604,' : ' 698,') + windowW + ' 0,' + windowWHalf + (isMobile ? ' 46' : ' 145'));

        clipPath[11].setAttribute('points', '0 0,0 ' + sectionHeight +',' + windowW + ' ' + sectionHeight+ ',' + windowW + ' 0,' + windowWHalf + (isMobile ? ' 46' : ' 145'));
      } catch (e) {
        if(console && console.log) {console.log('clipPath undefined: ' + e.message)}
      }

      if(!isTouch && !isSafari && !IeCheck) {
        initRendering(0.99);
      }
    }

    function initRendering(o) {
      for (var i = 0; i < clipPathImg.length; i++) {
        clipPathImg[i].style.opacity = o;
      }
    }

    function safariCheck() {
      if($.browser.safari) return true;
    }

    function touchCheck() {
      if(document.documentElement.classList.contains('tablet') ||
        mobileCheck()) {
        return true;
      }
    }

    function mobileCheck() {
      if(document.documentElement.classList.contains('mobile')) {
        return true;
      }
    }

    function ieEdgeCheck() {
      if(document.documentElement.classList.contains('ie')) {
        return true;
      }
    }
  }

  function initSelect() {
    $('select').not('.select-pick-destination').select2({
      width: 'full',
      minimumResultsForSearch: Infinity
    });
  }

  function initSelectPickDestination() {
    if($('html').hasClass('mobile')) return;

    $('.select-pick-destination').select2({
      width: 'full',
      adaptDropdownCssClass: function (c) {
        return c;
      },
      minimumResultsForSearch: Infinity
    });
  }

  function initArticlesItemsPosition() {
    var wrapper = document.querySelectorAll('.b-articles > .field-items');

    if(!wrapper.length) return;

    var options = {
      width: 300,
      offsetLeft: 20,
      offsetBottom: 45
    };

    for(var i = 0; i < wrapper.length; i++) {
      if(!wrapper[i].classList.contains('processed')) {
        wrapper[i].classList.add('processed');
        init(wrapper[i]);
      }
    }

    function init(el) {

      window.addEventListener('resize', function() {
        setPosition(el);
      });

      setPosition(el);
      setHandlers(el);
    }

    function setPosition(el) {
      var elms = el.children;

      if(!elms.length) return;

      var wrapperWidth = el.offsetWidth;
      var counter = 0;
      var height = 0;
      var maxItems, position, width, currentTop;

      for(var i = 0; i < elms.length; i++) {
        width = options.width + options.offsetLeft;
        position = counter * width;

        elms[i].style.position = 'absolute';
        elms[i].style.left = position + 'px';

        if(maxItems !== undefined) {
          currentTop = elms[i - maxItems].offsetHeight + parseInt(elms[i - maxItems].style.top) + options.offsetBottom;
        } else {
          currentTop = 0;
        }

        if(currentTop + elms[i].offsetHeight  > height) {
          height = currentTop + elms[i].offsetHeight;
        }

        elms[i].style.top = currentTop + 'px';

        if(position + width * 2 > wrapperWidth) {
          if(maxItems == undefined) {
            maxItems = i + 1;
          }

          counter = 0;
        } else {
          counter++;
        }
      }

      el.style.position = 'relative';
      el.style.height = height + options.offsetBottom + 'px';
    }

    function setHandlers(wrapper) {
      var items = wrapper.querySelectorAll('.item');

      for (var y = 0; y < items.length; y++) {

        items[y].addEventListener('click', function (e) {
          var target = e.target;

          if (this.querySelector('.hidden-field') && checkClass(target, 'type-read-more')) {
            e.preventDefault();

            readMoreHandler(this);
            setPosition(wrapper);
          } else if(checkClass(target, 'type-pin')) {
            e.preventDefault();

            pinHandler(this);
          }
        });
      }
    }

    function checkClass(el, elClass) {
      if(el.classList.contains(elClass) || el.parentNode.classList.contains(elClass)) {
        return true;
      }
    }

    function readMoreHandler(self) {
      var btn = self.querySelector('.type-read-more');
      var text = btn.querySelector('.link-text');
      var hiddenField = self.querySelector('.hidden-field');

      btn.classList.toggle('active');
      hiddenField.classList.toggle('visible-field');

      if (btn.classList.contains('active')) {
        text.innerText = 'Read less';
      } else {
        text.innerText = 'Read more';
      }
    }

    function pinHandler(self) {
      var elClass;
      var btn = self.querySelector('.type-pin');

      if (btn.classList.contains('active')) {
        elClass = 'not-attached';
        self.classList.add(elClass);
      } else {
        elClass = 'attached';
        self.classList.add(elClass);
      }

      setTimeout(function() {
        self.classList.remove(elClass);
      }, 1000);
    }
  }

  function initMasonryPhotos() {
    var wrappers = document.querySelectorAll('.b-photos .items');

    if (typeof Masonry == 'undefined' || !wrappers.length) return;

    for (var i = 0; i < wrappers.length; i++) {
      new Masonry(wrappers[i], {
        itemSelector: '.item',
        columnWidth: 479,
        gutter: 20,
        transitionDuration: 0
      });
    }
  }

  function initMasonryItems() {
    var wrappers = document.querySelectorAll('.b-items > .field-items');

    if (typeof Masonry == 'undefined' || !wrappers.length) return;

    for (var i = 0; i < wrappers.length; i++) {
      new Masonry(wrappers[i], {
        itemSelector: '.item',
        columnWidth: 480,
        gutter: 20,
        transitionDuration: 0
      });
    }
  }

  function initMapHilight() {
    var wrapper = document.getElementById('b-map');

    if (typeof $.fn.maphilight == 'undefined' || !wrapper) return;

    $(wrapper).find('.map-img').maphilight({
      fillOpacity: 0,
      strokeColor: 'transparent',
      stroke: false,
      strokeWidth: 0
    });

    var map = wrapper.querySelector('map');

    var current;

    if(document.documentElement.classList.contains('desktop')) {
      map.addEventListener('mousemove', mapOverHandler);
    }

    map.addEventListener('mouseout', mouseOutHandler);

    if(document.documentElement.classList.contains('tablet')) {
      map.addEventListener('click', function(e) {
        e.preventDefault();

        if (current) {
          window.location.href = e.target.href;
        }

        mapOverHandler(e);
      });
    }

    function mapOverHandler(e) {
      var target = e.target;

      if (current || !target.hasAttribute('id')) return;

      var el = wrapper.querySelector('[data-area=' + target.getAttribute('id') + ']');

      if (el) {
        el.classList.add('active');
        current = el;
      }
    }

    function mouseOutHandler() {
      if (!current) return;

      current.classList.remove('active');
      current = null;
    }
  }

  function initMapDrag() {
    var wrapper = document.getElementById('b-map');

    if (!wrapper) return;

    var dragObjWrapper = wrapper.querySelector('.map-wrapper');
    var dragObj = wrapper.querySelector('.map');

    window.addEventListener('resize', function () {
      dragObj.style.left = 0;
    });

    dragObj.onmousedown = function (e) {
      var thumbCoords = getCoords(dragObj);
      var shiftX = e.pageX - thumbCoords.left;
      var sliderCoords = getCoords(dragObjWrapper);

      document.onmousemove = function (e) {
        var newLeft = e.pageX - shiftX - sliderCoords.left;

        if (newLeft + dragObjWrapper.offsetWidth < wrapper.offsetWidth) {
          newLeft = wrapper.offsetWidth - dragObjWrapper.offsetWidth;
        }

        var rightEdge = dragObjWrapper.offsetWidth - dragObj.offsetWidth;

        if (newLeft > rightEdge) {
          newLeft = rightEdge;
        }

        dragObj.style.left = newLeft + 'px';
      };

      document.onmouseup = function () {
        document.onmousemove = document.onmouseup = null;
      };

      return false;
    };

    dragObj.ondragstart = function () {
      return false;
    };

    function getCoords(elem) {
      var box = elem.getBoundingClientRect();

      return {
        top: box.top + pageYOffset,
        left: box.left + pageXOffset
      };
    }
  }
})(jQuery);