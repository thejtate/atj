<?php
/**
 * @file Region Section template
 */

?>

<section class="section type-after-top section-region">
  <?php if (isset($background_img)): ?>
    <div class="bg">
      <div class="clip-path-region">
        <div class="bg-img" style="background-image: url('<?php print $background_img; ?>');"
             data-bottom-top="transform:translate3d(0px, -150px, 0px)"
             data-top-bottom="transform:translate3d(0px, 150px, 0px)"></div>
      </div>

      <svg width="100%" height="100%">
        <g clip-path="url(#clip-path-region)">
          <image data-bottom-top="@transform:translate(0, -150)"
                 data-top-bottom="@transform:translate(0, 150)" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php print $background_img; ?>"
                 width="100%" height="100%" preserveAspectRatio="xMidYMid slice"></image>
        </g>
      </svg>
    </div>
  <?php endif; ?>
  <div class="inner">
    <div class="container">
      <div class="desc-region">
        <div class="map">
          <?php print $map; ?>
        </div>
        <?php print $title_prefix; ?>
          <?php print $title; ?>
        <?php print $title_suffix; ?>
        <div class="text">
          <?php print $text; ?>
        </div>
        <?php if (isset($show_form) && $show_form): ?>
          <?php print render($show_form);?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
