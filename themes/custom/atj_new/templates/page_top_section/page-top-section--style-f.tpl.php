<?php
/**
 * @file
 * Separate template for top section. Has the same $vars as page template
 */
?>
<?php if (empty($hide_top_section)): ?>
  <section class="section section-top <?php print render($section_additional_classes)?>">
    <div class="bg">
      <?php if (!empty($top_image)): ?>
        <div class="bg-img" style="background-image: url('<?php print $top_image; ?>');"></div>
      <?php endif; ?>

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
    <div class="container">
      <div class="inner-wrap">
        <?php print render($title_prefix); ?>
        <?php if ($title): ?>
          <div class="title-wrap">
            <h1><?php print $title; ?></h1>
          </div>
        <?php endif; ?>
        <?php print render($title_suffix); ?>

        <?php if (!empty($body)): ?>
          <div class="desc">
            <?php print render($body); ?>
          </div>
        <?php endif; ?>

        <?php if (!empty($donation_link)): ?>
          <div class="link-wrap">
            <?php print render($donation_link); ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

<?php endif; ?>