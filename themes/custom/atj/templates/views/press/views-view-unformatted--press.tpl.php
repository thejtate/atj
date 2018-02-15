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
<div class="content-control">
  <?php print l(t('BACK') . '<span class="ico ss-icon ss-standard ss-navigateleft"></span>', 'node/' . ATJ_PRESS_LANDING_NID, array(
    'html' => TRUE,
    'attributes' => array('class' => array('link', 'type-back-b', 'style-red'))
  )); ?>
</div>
<div class="b-cols">
  <div class="row">
    <div class="col col-md-8">
      <h4 class="rtecenter"><?php print $view->human_name; ?></h4>
      <?php foreach ($rows as $id => $row): ?>
        <div<?php if ($classes_array[$id]) {
          print ' class="' . $classes_array[$id] . '"';
        } ?>>
          <?php print $row; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
