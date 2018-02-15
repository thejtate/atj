<?php
/**
 * @file
 * Separate template for top section. Has the same $vars as page template
 */
?>
<?php if(empty($hide_top_section)): ?>
  <section class="section section-top">
    <div class="bg">
      <div class="bg-img" style="background-image: url('<?php print !empty($top_image) ? $top_image : ''; ?>');"></div>
    </div>
    <?php if (!empty($share_block)): ?>
    <div class="share-block-wrap">
      <?php print $share_block; ?>
    </div>
    <?php endif; ?>
    <div class="container">
      <div class="inner-wrap">
        <?php if (!empty($title)) : ?>
          <div class="title-wrap">
            <h1><?php print $title; ?></h1>
          </div>
        <?php endif; ?>
        <div class="desc">
          <?php print !empty($body) ? $body : ''; ?>
        </div>
        <?php print !empty($search_top) ? render($search_top) : ''; ?>
      </div>
    </div>
  </section>
  <?php print render($field_hn_plan_items); ?>
<?php endif; ?>