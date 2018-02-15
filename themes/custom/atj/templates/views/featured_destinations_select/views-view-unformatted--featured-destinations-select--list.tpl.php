<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php if(!empty($rows) && count($rows) > 1): ?>


<div class="form form-pick-list">
  <div class="form-item form-type-select">
    <?php if (isset($select)) : ?>
      <?php print $select; ?>
    <?php else : ?>
      <?php foreach ($rows as $id => $row): ?>
        <?php print $row; ?>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>
<?php endif; ?>