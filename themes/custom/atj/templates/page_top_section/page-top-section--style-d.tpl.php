<?php
/**
 * @file
 * Separate template for top section. Has the same $vars as page template
 */
?>
<?php if(empty($hide_top_section)): ?>
  <section class="section type-top style-d section-top <?php print render($section_additional_classes)?>">
    <?php if ($top_image): ?>
      <div class="bg">
        <div class="clip-path-img-top-d">
          <div class="bg-img" style="background-image: url('<?php print $top_image; ?>');"
               data-top="transform:translate3d(0px, 0px, 0px)"
               data-top-bottom="transform:translate3d(0px, 150px, 0px)"></div>
            <div class="navigation-type-a">
              <?php print render($subnavigation); ?>
            </div>
        </div>

        <svg width="100%" height="100%">
          <g clip-path="url(#clip-path-img-top-d)">
            <image data-top="@transform:translate(0, 0)"
                   data-top-bottom="@transform:translate(0, 150)" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php print $top_image; ?>"
                   width="100%" height="100%" preserveAspectRatio="xMidYMid slice"></image>
          </g>
        </svg>
      </div>
    <?php endif; ?>
    <div class="inner">
      <?php print isset($share_block) ? $share_block : ''; ?>
      <div class="container">
        <?php print render($before_titles);?>
        <header class="titles style-a<?php print render($title_wrap_classes)?>">
          <h1>
            <?php print render($title_image); ?>
            <?php print render($title_prefix); ?>
            <?php if ($title): ?>
              <span><?php print $title; ?></span>
            <?php endif; ?>
            <?php print render($title_suffix); ?>
          </h1>
          <?php print render($append_title); ?>
          <?php if ($subtitle): ?>
            <h5><?php print $subtitle; ?></h5>
          <?php endif; ?>
        </header>
        <?php print render($after_titles);?>
        <?php if (!empty($body)): ?>
          <div class="desc style-c">
            <div class="text">
              <?php print $body; ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if(!empty($video_mp4) && !empty($video_webm)): ?>
          <a class="btn-play" href="#thailand-video" data-toggle="modal" data-target="#popup-thailand-video"></a>
        <?php endif; ?>
      </div>
      <?php if (!empty($subnavigation_not_supported)): ?>
          <div class="navigation-type-a for-not-supported">
            <?php print render($subnavigation_not_supported); ?>
          </div>
      <?php endif; ?>
    </div>
  </section>
<?php endif; ?>