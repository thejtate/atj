<?php
/**
 * Itinerary main template
 */

?>
<div>

<div class="title">
    <h4><?php print render($day)?></h4>
    <div class="sub-title">
        <?php print render($meals)?>
        <?php if(!empty($meals_value)): ?>
            <span><?php print render($meals_value);?></span>
        <?php endif; ?>
      <?php if(!empty($title)): ?>
            <h5><?php print render($title);?></h5>
        <?php endif; ?>
    </div>
    <a href="#" class="btn-collapsed"></a>
</div>
    <div class="item-content">
      <?php echo $s;?>
      <?php if(!empty($dest_image)): ?>
          <div class="img">
            <?php print $dest_image;?>
          </div>
      <?php endif; ?>
      <?php if(!empty($on_image)): ?>
        <?php print $on_image;?>
      <?php endif; ?>
    </div>
</div>
