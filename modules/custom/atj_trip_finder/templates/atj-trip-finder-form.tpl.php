<?php
/**
 *
 **/
?>

<?php if ($form): ?>
  <div class="form form-sort-type-a form-trip-finder">
    <?php print render($form['year']);?>
    <?php print render($form['month']);?>
  </div>
  <?php print drupal_render_children($form) ?>
<?php endif; ?>
