(function ($) {

  if (typeof Drupal != 'undefined') {
    Drupal.behaviors.projectName = {
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
    initArticlesItemsPosition();
    initBlocksAnimation();
  });

  $(window).on('load', function() {
    initArticlesItemsPosition();
    initBlocksAnimation();
    initPopupLink();
    initMasonryItems();
  });

  function init() {
    initIECheck();
    initTooltipForElements();
    initShowModal();
    initMapHilight();
    initMapDrag();
    initBlockNavigation();
    initPickList();
    initNav();
    initMobileNav();
    initScrollMagic();
    initSelect();
    initTravelSlider();
    initBlogArticleSlider();
    initShare();
    initDestinationGenerator();
    initTooltip();
  }

  function initPickList() {
    var $form = $('.form-pick-list select');

    if(!$form) return;

    $form.on('change', function() {
      window.location = $(this).val();
    });
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

  function initMapHilight() {
    var wrapper = document.getElementById('b-map');

    if (typeof $.fn.maphilight == 'undefined' || !wrapper) return;

    $(wrapper).find('.map-img').maphilight({
      fillOpacity: 0,
      strokeColor: 'transparent',
      stroke: false,
      strokeWidth: 0,
      groupBy: 'id'
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

  function initIECheck() {
    if (($.browser.msie) || ($.browser.msedge))  $("html").addClass("ie");
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

  function initDestinationGenerator() {
    var wrapper = document.querySelector('.page-wanderlust .section-destination-generator');

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

  function initShare() {
    var wrapper = document.querySelector('.share-block');

    if (!wrapper) return;

    var btn = wrapper.querySelector('.btn');

    btn.addEventListener('click', function (e) {
      e.preventDefault();

      wrapper.classList.toggle('active');
    })
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

  function initBlocksAnimation() {
    var $wrapper = $('.b-photos-type-2.style-a');

    if(!$wrapper.length || $wrapper.hasClass('processed')) return;

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
      var $item = $items.eq(randomAnimation ? y : x);
      var $ico = $item.find('.ico');

      if($ico.parent().hasClass('item')) {
        $item.find('label').after($ico);
      }

      setTimeout(function() {
        $item.css('opacity', 1);
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

  function initBlogArticleSlider() {
    var $wrapper = $('.style-blog-article-slider');

    if(typeof $.flexslider == 'undefined' || !$wrapper.length) return;

    var $slider_counter_current = $('.slider-counter .current-slider');

    $wrapper.flexslider({
      animation: "fade",
      controlNav: true,
      directionNav: true,
      touch: false,
      pauseOnHover: true,
      slideshowSpeed: 7000,
      reverse: true,
      after: function() {
        count();
      }
    });

    count();
    function count() {
      $slider_counter_current.text($('.flex-control-nav li').find('.flex-active').text());
    }

    $('.slider-counter .all-sliders').text($('.flex-control-nav li').length);

  }

  function initTravelSlider() {
    var $wrapper = $('.b-travel-slider');

    if(typeof $.flexslider == 'undefined' || !$wrapper.length) return;

    $wrapper.each(function(){
      var $currentWrap = $(this);

      var $flexslider = $currentWrap.find('.flexslider');
      var $text =  $currentWrap.find('.slider-text');

      $flexslider.flexslider({
        animation: "fade",
        controlNav: false,
        touch: false,
        directionNav: false,
        pauseOnHover: false,
        slideshowSpeed: 7000,
        pauseOnAction: false,
        reverse: true,
      });

      $text.flexslider({
        animation: "fade",
        touch: false,
        controlNav: true,
        pauseOnHover: false,
        slideshowSpeed: 7000,
        pauseOnAction: false,
        directionNav: false,
        sync: $flexslider,
        controlsContainer: $currentWrap.find(".custom-controls-container")
        //after: function() {
        //  rebase();
        //}
      });

      //var $flexControl = $currentWrap.find('.flex-control-nav');
      //var $flexControlNav = $currentWrap.find('.flex-control-nav li');
      //
      //$currentWrap.find('.pagination-title').each(function(index){
      //  $flexControlNav.eq(index).find('a').text($(this).html());
      //});
      //
      //function rebase() {
      //  var $this = $flexControlNav.find('a.flex-active');
      //  $this.parent('li').prependTo($flexControl);
      //}
    });
  }

  function initArticlesItemsPosition() {
    var wrapper = document.querySelectorAll('.b-articles > .field-items');

    if(!wrapper.length) return;

    var $wrap = $('.b-articles');

    var options = {
      width: 300,
      offsetLeft: 44,
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

  function initSelect() {
    $('select').not('.select-pick-destination').select2({
      width: 'full',
      minimumResultsForSearch: Infinity
    });
  }

  function initScrollMagic() {
    if (document.documentElement.classList.contains('tablet') || document.documentElement.classList.contains('mobile') || document.documentElement.classList.contains('parallax-processed')) {

      return;
    }
    document.documentElement.classList.add('parallax-processed');

    var parallaxItems = document.querySelectorAll('.section-lanterns, .section-destination-generator, body:not(.without-parallax) .section-ways-travel, .latest-inner-wrap, .b-travel-slider, body:not(.without-parallax) .section-top');

    if (!parallaxItems.length) return;

    var divImg = [];
    var controller = new ScrollMagic.Controller({ globalSceneOptions: { triggerHook: "1" } });

    for (var i = 0; i < parallaxItems.length; i++) {
      var currentDivImg = parallaxItems[i].querySelectorAll(".bg-img");

      if (!currentDivImg.length) continue;

      for (var y = 0; y < currentDivImg.length; y++) {
        newScene(parallaxItems[i], currentDivImg[y]);
      }
    }

    window.addEventListener('resize', function () {
      for (var i = 0; i < divImg.length; i++) {
        divImg[i][1].duration(window.innerHeight + divImg[i][0].offsetHeight);
      }
    });

    function newScene(item, currentImage) {
      divImg.push([item, new ScrollMagic.Scene({ triggerElement: item, duration: window.innerHeight + item.offsetHeight }).setTween(currentImage, { y: "300", ease: Linear.easeNone }).addTo(controller)]);
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

  function initShowModal() {
    checkHash(window.location.hash);

    $(window).on('hashchange', function() {
      checkHash(window.location.hash);
    });

    $('.modal').on('hide.bs.modal', function () {
      var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
      window.location.hash = '';
      $('html, body').scrollTop(scrollTop);
    });

    function checkHash(hash) {
      if(!hash) return;

      var $el = $(hash);

      if($el.length && $el.hasClass('b-modal')) {
        $el.modal('show');
      }
    }
  }

  window.removeMarketoDefaultStyles = function(form) {
    form.find('style').remove();
    form.removeAttr('style');
    form.find('.mktoFormRow').addClass('form-item');
    form.find('.mktoButtonRow').removeClass('mktoButtonRow').addClass('form-actions');
    form.find('button').addClass('form-submit');
    form.find('input, textarea, label, .mktoFormCol, .mktoButtonWrap, .mktoRequired').removeAttr('style');
    form.find('.mktoOffset, .mktoGutter, .mktoClear, .mktoLabel').remove();
    form.removeClass('mktoForm').addClass('mktoFormWithoutStyles');
  };

  window.changeMarketoDefaultBtnText = function(form, text) {
    form.find('button').text(text);
  };

  window.addTextBeforeBtn = function(form, text) {
    form.find('button').before('<div class="text-before-btn">' + text + '</div>')
  };

  window.successMessage = function(form, text) {
    form.hide();
    form.after('<div class="success-message">' + text + '</div>')
  };

})(jQuery);