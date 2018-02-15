<?php
/**
 * @file Header template
 */
?>
<header id="site-header" class="site-header style-b">
  <div class="container">
    <div class="logo">
      <a href="<?php print $front_page; ?>">
        <img src="<?php print $logo; ?>" alt="<?php print t('ATJ'); ?>"/>
      </a>
    </div>
    <a class="btn-nav mobile-only" href="#"></a>

    <div class="navigation-container-mobile mobile-only">
      <div class="navigation-wrapper">
        <?php print render($page['top_header']); ?>
        <div class="menu-item">
          <?php print render($page['header']); ?>
        </div>
        <div class="menu-item menu-with-icons">
          <?php print !empty($menu_icons_mobile) ? $menu_icons_mobile : ''; ?>
        </div>
        <?php print !empty($social_block) ? $social_block : ''; ?>
        <?php if (!empty($menu_telephone_mobile)): ?>
          <div class="tel">
            <?php print $menu_telephone_mobile; ?>
          </div>
        <?php endif; ?>
        <?php if (!empty($logo)): ?>
          <div class="mobile-logo pull-center">
            <img src="<?php print $logo; ?>" alt="<?php print t('ATJ'); ?>"/>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <nav class="navigation-container">
      <div class="nav-top">
        <?php if (!empty($telephone)): ?>
          <div class="info">
            <?php print t('CALL US AT'); ?> <?php print $telephone; ?>
          </div>
        <?php endif; ?>
        <?php print !empty($social_block) ? $social_block : ''; ?>
        <?php print !empty($menu_icons) ? $menu_icons : ''; ?>
        <?php print render($page['top_header']); ?>
      </div>
      <div class="nav-bottom">
        <?php print render($page['header']); ?>
      </div>
    </nav>

    <div class="info-wrapper">
      <div class="btns">
        <div class="btn">
          <?php print !empty($book_your_trip) ? $book_your_trip : ''; ?>
        </div>
        <div class="btn">
          <?php print !empty($view_catalog) ? $view_catalog : ''; ?>
        </div>
      </div>
    </div>
  </div>
</header>