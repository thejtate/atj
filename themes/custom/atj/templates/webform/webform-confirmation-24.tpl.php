<?php

/**
 * @file
 * Customize confirmation screen after successful submission.
 *
 * This file may be renamed "webform-confirmation-[nid].tpl.php" to target a
 * specific webform e-mail on your site. Or you can leave it
 * "webform-confirmation.tpl.php" to affect all webform confirmations on your
 * site.
 *
 * Available variables:
 * - $node: The node object for this webform.
 * - $progressbar: The progress bar 100% filled (if configured). This may not
 *   print out anything if a progress bar is not enabled for this node.
 * - $confirmation_message: The confirmation message input by the webform
 *   author.
 * - $sid: The unique submission ID of this submission.
 * - $url: The URL of the form (or for in-block confirmations, the same page).
 */
?>
<?php
$obapi_newsletter_js = array(
  '#type' => 'html_tag',
  '#tag' => 'script',
  '#attributes' => array(
    'type' => 'text/javascript',
  ),
  '#value' => "obApi('track', 'Enewsletter Sign Up');",
  '#weight' => '-98',
);

drupal_add_html_head($obapi_newsletter_js, 'atj_obapi_newsletter');
?>
<!-- Google Code for e-Newsletter Sign-up Conversion Page -->
<script type="text/javascript">
  /* <![CDATA[ */
  var google_conversion_id = 925451833;
  var google_conversion_language = "en";
  var google_conversion_format = "3";
  var google_conversion_color = "ffffff";
  var google_conversion_label = "8KPfCMzN_2QQuYyluQM";
  var google_remarketing_only = false;
  /* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
  <div style="display:inline;">
    <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/925451833/?label=8KPfCMzN_2QQuYyluQM&amp;guid=ON&amp;script=0"/>
  </div>
</noscript>
<?php print $progressbar; ?>
<div class="form form-type-a">
  <div class="webform-confirmation success">
    <?php if ($confirmation_message): ?>
      <?php print $confirmation_message ?>
    <?php else: ?>
      <p><?php print t('Thank you, your submission has been received.'); ?></p>
    <?php endif; ?>
  </div>
</div>