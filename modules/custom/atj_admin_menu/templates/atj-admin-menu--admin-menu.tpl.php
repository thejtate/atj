<?php
/**
 * @file Admin menu template.
 */

?>

<div class="logout-btn">
  <?php print l(t('Log out'), '/user/logout', array(
    'attributes' => array(
      'class' => array(
        'link',
        'style-orange',
        'type-read-more-b'
      )
    )
  )); ?>
</div>