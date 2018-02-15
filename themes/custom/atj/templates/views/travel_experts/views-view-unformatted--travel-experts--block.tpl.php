<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>

<?php foreach ($rows as $id => $row): ?>
  <section class="section section-guide">
    <?php print $row; ?>
  </section>
  <div class="desc-for-section-guide container">
    <?php print $row; ?>
  </div>
<?php endforeach; ?>
