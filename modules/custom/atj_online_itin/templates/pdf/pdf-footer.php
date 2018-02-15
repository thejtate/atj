<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
        "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" version="XHTML+RDFa 1.0" dir="ltr"
     >
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
    }
</script>
<style type="text/css">
  @font-face {
    font-family: 'din-bold';
    src: url("/sites/all/themes/custom/atj/fonts/din-bold.woff") format("woff"), url("/sites/all/themes/custom/atj/fonts/din-bold.woff2") format("woff2");
    font-weight: normal;
    font-style: normal;
  }
  @font-face {
      font-family: 'din-cond-bold';
      src: url("/sites/all/themes/custom/atj/fonts/din-cond-bold.woff") format("woff"), url("/sites/all/themes/custom/atj/fonts/din-cond-bold.woff2") format("woff2");
      font-weight: normal;
      font-style: normal;
  }
</style>
</head><body style="border:0; margin: 0;" onload="subst()">
<table style="width: 100%">
  <tr>
    <td></td>
    <td style="text-align:right;font-family: din-cond-bold; font-size: 12pt; color: #3d3d3d">
        <span style="display: inline-block; margin-right: 8pt">&nbsp;</span>
        <?php $keys = array('c_org', 'c_name', 'c_phone', 'c_mail', 'UserFullName', 'UserEmail', 'UserPhone'); ?>
        <?php foreach($keys as $key): ?>
          <?php if(!empty($_GET[$key])): ?>
                <span style="display: inline-block; margin-right: 8pt"><?php print $_GET[$key];?></span>
          <?php endif; ?>
        <?php endforeach; ?>
    </td>
  </tr>
</table>
</body></html>