<?php
/**
 * @file Region Section template
 */

?>
<section class="section section-region">
  <div class="bg" style="background-image: url('<?php print !empty($background_img) ? $background_img : ''; ?>');"></div>
  <div class="inner">
    <div class="container">
      <div class="desc-region">
        <?php print $title_prefix; ?>
        <?php print $title; ?>
        <?php print $title_suffix; ?>
        <div class="text">
          <?php print $text; ?>
        </div>
        <?php if (!empty($show_form)): ?>
          <?php print render($show_form);?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
