(function () {

  var href = window.location.href;

  if(~href.indexOf('#!')) {
    window.location.href = href.replace('#!', '');
  } else if(~href.indexOf('/travel-destinations/')) {
    window.location.href = href.replace('/destinations/', '') + '/overview';
  }

})();