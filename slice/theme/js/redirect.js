(function () {
  'use strict';

  var href = window.location.href;

  if(~href.indexOf('#!')) {
    window.location.href = href.replace('#!', '');
  }

})();