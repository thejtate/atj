<?php
/**
 * @file Donation latern submission template.
 */

?>

<div class="donation">
    <div class="title">
        <div class="name">
            <?php print render($content['name']);?>
        </div>
        <?php if(!empty($content['city'])): ?>
                          <div class="address">
                            <?php print render($content['city']);?><?php print (!empty($content['state']) ? ', ' . $content['state'] :  ''); ?>
                          </div>
        <?php endif; ?>

    </div>
    <div class="text">
      <?php print render($content['message']);?>
    </div>
</div>