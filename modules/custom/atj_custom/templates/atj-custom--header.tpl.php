<?php
/**
 * @file Header template
 */

?>

<div class="info">
  <?php print isset($telephone) ? $telephone : ''; ?>
  <?php print isset($social_block) ? $social_block : ''; ?>
</div>
<div class="btns">
  <div class="btn">
    <?php print l(t('bOOK YOUR TRIP'), 'node/' . ATJ_WEBFORM_CONTACT_NID, array(
      'attributes' => array('class' => array('link style-orange type-read-more-b')),
      'html' => TRUE,
    )); ?>
  </div>
  <div class="btn">
    <?php print l(t('view CATALOG'), 'node/' . ATJ_WEBFORM_CATALOG_NID, array(
      'attributes' => array('class' => array('link style-purple type-read-more-b')),
      'html' => TRUE,
    )); ?>
  </div>
</div>