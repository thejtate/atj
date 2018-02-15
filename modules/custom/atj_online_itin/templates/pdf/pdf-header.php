<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
        "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" version="XHTML+RDFa 1.0" dir="ltr">
<head><script>
    function subst() {
        var vars = {};
        var query_strings_from_url = document.location.search.substring(1).split('&');
        for (var query_string in query_strings_from_url) {
            if (query_strings_from_url.hasOwnProperty(query_string)) {
                var temp_var = query_strings_from_url[query_string].split('=', 2);
                vars[temp_var[0]] = decodeURI(temp_var[1]);
            }
        }
        var css_selector_classes = ['page', 'frompage', 'topage', 'webpage', 'section', 'subsection', 'date', 'isodate', 'time', 'title', 'doctitle', 'sitepage', 'sitepages'];
        for (var css_class in css_selector_classes) {
            if (css_selector_classes.hasOwnProperty(css_class)) {
                var element = document.getElementsByClassName(css_selector_classes[css_class]);
                for (var j = 0; j < element.length; ++j) {
                    element[j].textContent = vars[css_selector_classes[css_class]];
                }
            }
        }
        if(vars['page'] == 1) {
            var main_wrap = document.getElementById('main-wrap');
            main_wrap.style.display = 'none' ;
        }

        if(vars['page'] > 1) {
            var main_wrap_first = document.getElementById('main-wrap-first');
            main_wrap_first.style.display = 'none' ;
        }
    }
</script>
  <style type="text/css">
    @font-face {
      font-family: 'din-cond-bold';
      src: url("/sites/all/themes/custom/atj/fonts/din-cond-bold.woff") format("woff"), url("/sites/all/themes/custom/atj/fonts/din-cond-bold.woff2") format("woff2");
      font-weight: normal;
      font-style: normal;
    }
  </style>
</head><body style="border:0; margin: 0;" onload="subst()">
<table style="width: 100%;position: absolute; top: 18pt;right: 18pt;" id="main-wrap-first" >
    <tr>
        <td></td>
        <td style="text-align:right;font-family: din-cond-bold; font-size: 11pt; color: #fbac2d; text-transform: uppercase">
            Page <span class="page"></span> of <span class="topage"></span>
        </td>
    </tr>
</table>
<table style="width: 100%" id="main-wrap">
    <tr>
        <td></td>
        <td style="text-align:right;font-family: din-cond-bold; font-size: 11pt; color: #6c2561; text-transform: uppercase">
            Page <span class="page"></span> of <span class="topage"></span>
        </td>
    </tr>
</table>
</body></html>