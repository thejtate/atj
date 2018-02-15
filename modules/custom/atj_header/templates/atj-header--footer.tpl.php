<?php
/**
 * @file Footer template
 */
?>
<footer id="site-footer" class="site-footer <?php print !empty($footer_class) ? $footer_class : ''; ?>">
  <div class="container">
    <div class="logo">
      <a href="<?php print $front_page; ?>">
        <img src="<?php print $logo; ?>" alt="<?php print t('ATJ'); ?>"/>
      </a>
    </div>

    <div class="navigation">
      <?php print render($page['footer_top']); ?>
    </div>

    <?php print render($page['footer']); ?>
    <?php print render($page['footer_bottom']); ?>

    <?php if (!empty($copyright)): ?>
      <div class="copy">
        <p><?php print $copyright; ?></p>
      </div>
    <?php endif; ?>

  </div>
</footer>