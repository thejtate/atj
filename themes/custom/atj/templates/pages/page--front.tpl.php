<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>

<div id="outer-wrapper" class="outer-wrapper">

  <header id="site-header" class="site-header style-a">
    <div class="book-now-link mobile-only">
      <?php print l(t('BOOK NOW'), 'node/' . ATJ_WEBFORM_CONTACT_NID, array(
        'attributes' => array('class' => array('link style-orange type-read-more-b')),
        'html' => TRUE,
      )); ?>
    </div>

    <div class="container">
      <div class="info-links mobile-only">
        <?php //print $telephone; ?>
        <?php //print $main_email; ?>
      </div>
      <div class="logo">
        <a href="<?php print $front_page; ?>">
          <img src="<?php print $logo; ?>"
               alt="<?php print t('Asia Transpacific Journeys'); ?>"/></a>
      </div>
      <?php print l('', '#', array('external' => TRUE, 'attributes' => array('class' => array('btn-nav', 'mobile-only')))); ?>
      <nav class="navigation-container-mobile mobile-only">
        <div class="navigation-wrapper">
          <?php print render($page['top_header']); ?>
          <div class="menu-item">
            <?php print render($page['header']); ?>
          </div>
          <div class="menu-item menu-with-icons">
            <ul class="menu">
<!--              <li><a href="--><?php //print url('node/151')?><!--">MUST SEE <span class="must-see-count"></span> <span class="ico ss-icon ss-glyphish-outlined ss-pushpin"></span></a></li>-->
              <li><a href="<?php print url('node/' . ATJ_CUSTOM_TRIP_FINDER_NID)?>">TRIP FINDER <span class="ico ss-icon ss-glyphish-outlined ss-usergroup"></span></a></li>
              <li><a href="<?php print url(ATJ_MY_JOURNEY_URL); ?>">MY JOURNEY <span class="ico ss-icon ss-glyphish-outlined ss-map"></span></a></li>
              <li><?php print l(t('bOOK YOUR TRIP'), 'node/' . ATJ_WEBFORM_CONTACT_NID, array(
                  'attributes' => array('class' => array('link style-orange type-read-more-b')),
                  'html' => TRUE,
              )); ?></li>
              <li><?php print l(t('View catalog'), 'node/' . ATJ_WEBFORM_CATALOG_NID, array(
                  'attributes' => array('class' => array('link style-purple type-read-more-b')),
                  'html' => TRUE,
              )); ?></li>
            </ul>
          </div>
          <?php print isset($social_block) ? $social_block : '' ; ?>
          <?php if (isset($mobile_menu_telephone)): ?>
            <div class="tel">
              <?php print $mobile_menu_telephone; ?>
            </div>
          <?php endif; ?>
          <?php if (isset($mobile_menu_logo)): ?>
            <div class="mobile-logo pull-center">
              <?php print $mobile_menu_logo; ?>
            </div>
          <?php endif; ?>
        </div>
      </nav>
      <nav class="navigation-container">
        <div class="nav-top">
          <ul class="menu">
<!--            <li><a href="--><?php //print url('node/151')?><!--">MUST SEE <span class="must-see-count"></span> <span class="ico ss-icon ss-glyphish-outlined ss-pushpin"></span></a></li>-->
            <li><a href="<?php print url('node/' . ATJ_CUSTOM_TRIP_FINDER_NID)?>">TRIP FINDER <span class="ico ss-icon ss-glyphish-outlined ss-usergroup"></span></a></li>
            <li><a href="<?php print url(ATJ_MY_JOURNEY_URL); ?>">MY JOURNEY <span class="ico ss-icon ss-glyphish-outlined ss-map"></span></a></li>
          </ul>
          <?php print render($page['top_header']); ?>
        </div>
        <div class="nav-bottom">
          <?php print render($page['header']); ?>
        </div>
      </nav>
      <div class="info-wrapper">
        <?php print render($page['bottom_header']); ?>
      </div>
      <div class="info-wrapper-tablet">
        <?php print isset($social_block) ? $social_block : '' ; ?>
        <?php if (isset($telephone_tablet)): ?>
          <?php print $telephone_tablet; ?>
        <?php endif; ?>
        <div class="btns">
          <div class="btn"><?php print l(t('View catalog'), 'node/' . ATJ_WEBFORM_CATALOG_NID, array(
              'attributes' => array('class' => array('link style-purple type-read-more-b')),
              'html' => TRUE,
            )); ?></div>
          <div class="btn"><?php print l(t('bOOK YOUR TRIP'), 'node/' . ATJ_WEBFORM_CONTACT_NID, array(
              'attributes' => array('class' => array('link style-orange type-read-more-b')),
              'html' => TRUE,
            )); ?></div>
        </div>
      </div>
    </div>
    <?php print !empty($atj_admin_menu) ? $atj_admin_menu : ''; ?>
  </header>

  <div class="inner-wrapper">
    <?php if ($messages): ?>
      <div id="messages">
        <div class="clearfix">
          <?php print $messages; ?>
        </div>
      </div> <!-- /#messages -->
    <?php endif; ?>

<!--    <div class="content-wrapper">-->

      <div class="element-invisible"><a id="main-content"></a></div>
      <?php if ($action_links): ?>
        <ul class="action-links">
          <?php print render($action_links); ?>
        </ul>
      <?php endif; ?>
      <?php if ($tabs): ?>
        <div class="b-tabs-user-control">
          <div class="tabs">
            <?php print render($tabs); ?>
          </div>
        </div>
      <?php endif; ?>

      <div class="content-inner">

        <div class="main-content-wrapper">
          <?php print render($page['content_top']); ?>
          <?php print render($page['content']); ?>
        </div>
      </div>
      <?php print render($page['content_bottom']); ?>
<!--    </div>-->
  </div>

  <footer id="site-footer" class="site-footer">
    <?php if(!empty($page['footer_signup'])): ?>
        <div class="form form-sign-up">
          <?php print render($page['footer_signup']);?>
        </div>
    <?php endif; ?>
    <div class="container">
      <div class="left-part">
        <?php print render($page['footer_top']); ?>
      </div>
      <div class="right-part">
        <?php print render($page['footer']); ?>
      </div>
    </div>
    <div class="navigation">
      <?php print render($page['footer_bottom']); ?>
    </div>
  </footer>

</div> <!-- /#outer-wrapper -->
<?php print render($page['sticky']); ?>