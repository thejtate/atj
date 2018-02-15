<?php
/**
 * @file Donation latern submission template.
 */

?>

<div class="donation">
  <div class="title">
    <div class="name">
      <?php print render($content['name']); ?><?php print (!empty($content['state']) ? ', ' . $content['state'] : ''); ?>
    </div>

  </div>
  <div class="text">
    <?php print render($content['message']); ?>
  </div>
</div>