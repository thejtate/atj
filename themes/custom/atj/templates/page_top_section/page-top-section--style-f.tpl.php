<?php
/**
 * @file
 * Separate template for top section. Has the same $vars as page template
 */
?>
<?php if(empty($hide_top_section)): ?>
  <section class="section type-top section-top<?php print render($section_additional_classes)?>">

    <?php if (!empty($top_image)): ?>
      <div class="bg">
        <div class="clip-path-img-top-a">
          <div class="bg-img" style="background-image: url('<?php print $top_image; ?>');"
               data-top="transform:translate3d(0px, 0px, 0px)"
               data-top-bottom="transform:translate3d(0px, 150px, 0px)"></div>
        </div>

        <svg width="100%" height="100%">
          <g clip-path="url(#clip-path-img-top-a)">
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
        <div class="left-part">
        <?php print render($before_titles);?>
        <?php if (!empty($title_image)): ?>
          <div class="img">
              <?php print $title_image; ?>
          </div>
        <?php endif; ?>

        <header class="titles style-b">
          <h1>
            <?php print render($title_prefix); ?>
            <?php if ($title): ?>
              <?php print $title; ?>
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
          <div class="desc style-d">
            <?php print render($body); ?>
          </div>
        <?php endif; ?>
        <?php if (!empty($page['subnavigation'])): ?>
          <div class="navigation">
            <?php print render($page['subnavigation']); ?>
          </div>
        <?php endif; ?>
        </div>
      </div>
    </div>
      <div class="clip-path-img-top-a-float">
          <div class="float-elements">
              <div class="items">
                  <div class="item img-2 large position-1 delay-1"></div>
                  <div class="item middle position-2 delay-7"></div>
                  <div class="item x-large position-3 delay-12"></div>
                  <div class="item x-small position-4 delay-2"></div>
                  <div class="item small position-4 delay-3"></div>
                  <div class="item x-small position-5 delay-13"></div>
                  <div class="item img-2 x-small position-6 delay-22"></div>
                  <div class="item img-2 small position-7 delay-15"></div>
                  <div class="item img-2 small position-8 delay-24"></div>
                  <div class="item img-2 x-small position-9 delay-21"></div>
                  <div class="item small position-10 delay-14"></div>
                  <div class="item large position-11 delay-4"></div>
                  <div class="item img-2 small position-11 delay-6"></div>
                  <div class="item x-small position-12 delay-18"></div>
                  <div class="item x-middle position-13 delay-17"></div>
                  <div class="item img-2 smallest position-13 delay-23"></div>
                  <div class="item x-small position-14 delay-11"></div>
                  <div class="item img-2 smallest position-15 delay-9"></div>
                  <div class="item img-2 x-middle position-16"></div>
                  <div class="item small position-17 delay-10"></div>
                  <div class="item img-2 small position-19 delay-16"></div>
                  <div class="item img-2 middle position-20 delay-8"></div>
                  <div class="item img-2 x-middle position-20 delay-20"></div>
              </div>
          </div>
      </div>
  </section>
<?php endif; ?>