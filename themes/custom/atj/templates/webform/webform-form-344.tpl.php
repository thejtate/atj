<?php

/**
 * @file
 * Customize the display of a complete webform.
 *
 * This file may be renamed "webform-form-[nid].tpl.php" to target a specific
 * webform on your site. Or you can leave it "webform-form.tpl.php" to affect
 * all webforms on your site.
 *
 * Available variables:
 * - $form: The complete form array.
 * - $nid: The node ID of the Webform.
 *
 * The $form array contains two main pieces:
 * - $form['submitted']: The main content of the user-created form.
 * - $form['details']: Internal information stored by Webform.
 *
 * If a preview is enabled, these keys will be available on the preview page:
 * - $form['preview_message']: The preview message renderable.
 * - $form['preview']: A renderable representing the entire submission preview.
 */
?>
<?php
// Print out the progress bar at the top of the page
print drupal_render($form['progressbar']);

// Print out the preview message if on the preview page.
if (isset($form['preview_message'])) {
  print '<div class="messages warning">';
  print drupal_render($form['preview_message']);
  print '</div>';
}

$node = !empty($form['#node']) ? $form['#node'] : '';
if ($node && !empty($node->field_wll_image)) {
  $image = field_view_field('node', $node, 'field_wll_image', array(
    'label' => 'hidden',
  ));
  $image = render($image);
}
?>
<?php if (isset($image)): ?>
  <div class="img">
    <?php print $image; ?>
  </div>
<?php endif; ?>
<div class="inner-form">
  <div class="form-item">
    <label><span class="form-required">*</span> <?php print t('Name of the person you’re
      sending this to'); ?> </label>

    <div class="row">
      <?php print drupal_render($form['submitted']['name_of_the_person_youre_sending_this_to']); ?>
      <?php print drupal_render($form['submitted']['gender_of_the_person']); ?>
    </div>
  </div>
  <div class="row">
    <?php print drupal_render($form['submitted']['their_email_address']); ?>
  </div>
  <div class="form-item">
    <label><span class="form-required">*</span> <?php print t('Who it’s from (that’s
      you!)'); ?> </label>

    <div class="row">
      <?php print drupal_render($form['submitted']['who_its_from_thats_you']); ?>
      <?php print drupal_render($form['submitted']['gender']); ?>
    </div>
  </div>
  <div class="row">
    <div class="form-item form-type-text col-sm-12">
      <?php print drupal_render($form['submitted']['your_email_address']); ?>
    </div>
  </div>
  <?php print drupal_render($form['submitted']); ?>
</div>
<?php print drupal_render_children($form); ?>
