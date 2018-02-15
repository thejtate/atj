<?php
/**
 * @file
 * Separate template for top section. Has the same $vars as page template
 */
$min_style_top = (isset($min_style_top) || !isset($page['subnavigation']) || empty($page['subnavigation'])) ?
  TRUE : FALSE;

?>
<?php if(empty($hide_top_section)): ?>
  <section class="section type-top section-top <?php print $min_style_top ? 'style-min' : ''; ?><?php print render($section_additional_classes)?>">

    <?php if (!empty($top_image)): ?>
      <div class="bg">
        <div class="<?php print $min_style_top ? 'clip-path-img-top-min' : 'clip-path-img-top'; ?>">
          <div class="bg-img" style="background-image: url('<?php print $top_image; ?>');"
               data-top="transform:translate3d(0px, 0px, 0px)"
               data-top-bottom="transform:translate3d(0px, 150px, 0px)"
               role="img" aria-label="<?php print !empty($top_img_alt) ? $top_img_alt : ''; ?>"></div>
        </div>

        <svg width="100%" height="100%">
          <g clip-path="url(#<?php print $min_style_top ? 'clip-path-img-top-min' : 'clip-path-img-top'; ?>)">
            <image data-top="@transform:translate(0, 0)"
                   data-top-bottom="@transform:translate(0, 150)" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php print $top_image; ?>"
                   width="100%" height="100%" preserveAspectRatio="xMidYMid slice"
                   alt="<?php print !empty($top_img_alt) ? $top_img_alt : ''; ?>"></image>
          </g>
        </svg>
      </div>
    <?php endif; ?>
    <div class="inner">
      <?php print isset($share_block) ? $share_block : ''; ?>
      <div class="container">
        <?php print render($before_titles);?>
        <header class="titles<?php print render($title_wrap_classes)?>">
          <h1>
            <?php if (!empty($title_image)): ?>
              <?php print $title_image; ?>
            <?php endif; ?>

            <?php print render($title_prefix); ?>
            <?php if ($title): ?>
              <span><?php print $title; ?></span>
            <?php endif; ?>
            <?php print render($title_suffix); ?>
          </h1>
          <?php print render($append_title); ?>
          <?php if (!empty($subtitle)): ?>
            <h5><?php print $subtitle; ?></h5>
          <?php endif; ?>
        </header>
        <?php print render($after_titles);?>
        <?php if (!empty($body)): ?>
          <div class="text">
            <?php print $body; ?>
          </div>
        <?php endif; ?>
        <?php if (!empty($page['subnavigation'])): ?>
          <div class="navigation">
            <?php print render($page['subnavigation']); ?>
          </div>
        <?php endif; ?>
        <?php if(!empty($video_mp4) && !empty($video_webm)): ?>
          <a class="btn-play" href="#thailand-video" data-toggle="modal" data-target="#popup-thailand-video"></a>
        <?php endif; ?>
      </div>
    </div>
  </section>
<?php endif; ?>