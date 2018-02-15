<?php
/**
 * @file Consultation payment form.
 */
?>

<div class="part-right">
  <div class="btn-wrap style-f">
    <div class="submit-wrapper">
      <?php print drupal_render($form['submit_button']); ?>
    </div>
  </div>
</div>

<?php print drupal_render_children($form); ?>