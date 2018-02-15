<?php

/**
 * @file
 * Default theme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>
<!DOCTYPE html>
<html>
<head>
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <!--[if (lt IE 9) & (!IEMobile)]>
  <script async type="text/javascript" src="<?php print base_path() . drupal_get_path('theme', 'atj') . '/js/lib/html5.js'; ?>"></script>
  <![endif]-->
  <style type="text/css">
    .clip-path-img-top {
      -webkit-clip-path: url(#clip-path-img-top);
      clip-path: url(#clip-path-img-top);
    }

    .clip-path-img-top-min {
      -webkit-clip-path: url(#clip-path-img-top-min);
      clip-path: url(#clip-path-img-top-min);
    }

    .clip-path-img {
      -webkit-clip-path: url(#clip-path-img);
      clip-path: url(#clip-path-img);
    }

    .clip-path-region {
      -webkit-clip-path: url(#clip-path-region);
      clip-path: url(#clip-path-region);
    }

    .clip-path-img-skew {
      -webkit-clip-path: url(#clip-path-img-skew);
      clip-path: url(#clip-path-img-skew);
    }

    .clip-path-experts {
      -webkit-clip-path: url(#clip-path-experts);
      clip-path: url(#clip-path-experts);
    }

    .clip-path-experts-a {
      -webkit-clip-path: url(#clip-path-experts-a);
      clip-path: url(#clip-path-experts-a);
    }

    .clip-path-img-top-a {
      -webkit-clip-path: url(#clip-path-img-top-a);
      clip-path: url(#clip-path-img-top-a);
    }

    .clip-path-quotes {
      -webkit-clip-path: url(#clip-path-quotes);
      clip-path: url(#clip-path-quotes);
    }

    .clip-path-img-top-d {
      -webkit-clip-path: url(#clip-path-img-top-d);
      clip-path: url(#clip-path-img-top-d);
    }
    .clip-path-img-top-a-float {
        -webkit-clip-path: url(#clip-path-img-top-a);
        clip-path: url(#clip-path-img-top-a);
    }

    .clip-path-img-top-f {
      -webkit-clip-path: url(#clip-path-img-top-f);
      clip-path: url(#clip-path-img-top-f);
    }

    .clip-path-img-full-height {
      -webkit-clip-path: url(#clip-path-img-full-height);
      clip-path: url(#clip-path-img-full-height);
    }
  </style>
  <?php print $scripts; ?>
    <!--Website calls-->
    <script type="text/javascript">
        var callback = function(formatted_number, mobile_number) {
            var elems = document.querySelectorAll(".phone-track");
            if(elems) {
                for(var i = 0; i < elems.length; i++) {

                    elems[i].href = "tel:" + mobile_number;
                    elems[i].innerHTML = "";
                    if(!elems[i].classList.contains('phone-track-link-only')) {
                        elems[i].appendChild(document.createTextNode(formatted_number));
                    }
                }
            }
        };
    </script>
    <script type="text/javascript">
        (function(a,e,c,f,g,b,d){var h={ak:"925451833",cl:"u3FwCKP1hmUQuYyluQM"};a[c]=a[c]||function(){(a[c].q=a[c].q||[]).push(arguments)};a[f]||(a[f]=h.ak);b=e.createElement(g);b.async=1;b.src="//www.gstatic.com/wcm/loader.js";d=e.getElementsByTagName(g)[0];d.parentNode.insertBefore(b,d);a._googWcmGet=function(b,d,e){a[c](2,b,h,d,null,new Date,e)}})(window,document,"_googWcmImpl","_googWcmAk","script");
    </script>

    <!-- Facebook Pixel Code -->
    <script>
      !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
        n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
        document,'script','https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '1286071611448337');
      fbq('track', 'PageView');
    </script>
    <noscript>
      <img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=1286071611448337&ev=PageView&noscript=1"/>
    </noscript>
    <!-- DO NOT MODIFY -->
    <!-- End Facebook Pixel Code -->

  <!--Start of Zopim Live Chat Script-->
<!--  <script type="text/javascript">-->
<!--    window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=-->
<!--      d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.-->
<!--    _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");-->
<!--      $.src="//v2.zopim.com/?4COIKjxUzV1C3Y6Zguf81pb8LKmEALm0";z.t=+new Date;$.-->
<!--        type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");-->
<!--  </script>-->
  <!--End of Zopim Live Chat Script-->
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?> onload="_googWcmGet(callback, '<?php print $telephone;?>')">
<div id="skip-link">
  <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
</div>
<?php print $page_top; ?>
<?php print $page; ?>
<?php print $page_bottom; ?>
<svg class="clip-path" width="0" height="0">
  <defs>
    <clipPath id="clip-path-img-top">
      <!--        <polygon points="0 0,0 556,646 714,1292 556,1292 0"></polygon>-->
      <polygon points="0 0,0 569,646 714,1292 569,1292 0"></polygon>
    </clipPath>
    <clipPath id="clip-path-img-top-min">
      <!--        <polygon points="0 0,0 346,646 503,1292 346,1292 0"></polygon>-->
      <polygon points="0 0,0 358,646 503,1292 358,1292 0"></polygon>
    </clipPath>
    <clipPath id="clip-path-img">
      <polygon points="0 0,1292 0,1292 714,0 1000"></polygon>
    </clipPath>
    <clipPath id="clip-path-region">
      <polygon points="0 0,1292 0,1292 560,0 860"></polygon>
    </clipPath>
    <clipPath id="clip-path-img-skew">
      <polygon points="0 286,1292 0,1292 714,0 1000"></polygon>
    </clipPath>
    <clipPath id="clip-path-experts">
      <polygon points="0 0,0 766,646 621,1292 766, 1292 0"></polygon>
    </clipPath>
    <clipPath id="clip-path-img-top-a">
      <!--        <polygon points="0 0,0 680,646 843,1292 680,1292 0"></polygon>-->
      <polygon points="0 0,0 698,646 843,1292 698,1292 0"></polygon>
    </clipPath>
    <clipPath id="clip-path-experts-a">
      <polygon points="0 0,0 766,646 621,1292 766, 1292 0, 646 145"></polygon>
    </clipPath>
    <clipPath id="clip-path-quotes">
      <polygon points="0 145,0 700,646 555,1292 700, 1292 145,646 0"></polygon>
    </clipPath>
    <clipPath id="clip-path-img-top-d">
      <polygon points="0 0,0 454,646 599,1292 454,1292 0"></polygon>
    </clipPath>
    <clipPath id="clip-path-img-top-f">
      <polygon points="0 0,0 698,646 843,1292 698,1292 0"></polygon>
    </clipPath>
    <clipPath id="clip-path-img-full-height">
      <polygon points="0 0,0 1300,1292 1300,1292 0,646 145"></polygon>
    </clipPath>
  </defs>
</svg>
<script type="text/javascript">
  /* <![CDATA[ */
  var google_conversion_id = 925451833;
  var google_custom_params = window.google_tag_params;
  var google_remarketing_only = true;
  /* ]]> */
</script>
<div style="position: absolute; overflow: hidden; height: 0;">
  <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>
</div>
<noscript>
  <div style="display:inline;">
    <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/925451833/?value=0&amp;guid=ON&amp;script=0"/>
  </div>
</noscript>
</body>
</html>
