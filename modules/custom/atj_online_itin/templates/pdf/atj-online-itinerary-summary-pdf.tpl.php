<?php
/**
 * Itinerary main template
 */

?>



    <h4><?php print render($day_pdf)?></h4>
<div class="container">
    <div class="title">
        <?php if(!empty($title)): ?>
          <h3><?php print render($title);?></h3>
        <?php endif; ?>
        <div class="sub-title">
        <?php print render($meals)?>
        <?php if(!empty($meals_value)): ?>
            <span><?php print render($meals_value);?></span>
        <?php endif; ?>

        </div>
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