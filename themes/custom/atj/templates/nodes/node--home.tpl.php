<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>
<?php
$section_top_img = (isset($content['field_home_top_image']) && !empty($content['field_home_top_image']['#items'])) ?
  file_create_url($content['field_home_top_image']['#items'][0]['uri']) : '';
$section_content_img = (isset($content['field_content_sec_image']) && !empty($content['field_content_sec_image']['#items'])) ?
  file_create_url($content['field_content_sec_image']['#items'][0]['uri']) : '';
$tour_image = (isset($content['field_con_tour_sec_image']) && !empty($content['field_con_tour_sec_image']['#items'])) ?
  file_create_url($content['field_con_tour_sec_image']['#items'][0]['uri']) : '';
$featured_dest_image = (isset($content['field_home_dest_bg_image']) && !empty($content['field_home_dest_bg_image']['#items'])) ?
  file_create_url($content['field_home_dest_bg_image']['#items'][0]['uri']) : '';
$featured_dest_img_alt = (isset($content['field_home_dest_bg_image']) && !empty($content['field_home_dest_bg_image']['#items'][0]['alt'])) ?
  $content['field_home_dest_bg_image']['#items'][0]['alt'] : t('guided tours');
$news_image = (isset($content['field_home_bottom_image']) && !empty($content['field_home_bottom_image']['#items'])) ?
  file_create_url($content['field_home_bottom_image']['#items'][0]['uri']) : '';
$news_img_alt = (isset($content['field_home_bottom_image']) && !empty($content['field_home_bottom_image']['#items'][0]['alt'])) ?
  $content['field_home_bottom_image']['#items'][0]['alt'] : t('luxury tour operators');
$quote_image = (isset($content['field_home_quote_bg_img']) && !empty($content['field_home_quote_bg_img']['#items'])) ?
  file_create_url($content['field_home_quote_bg_img']['#items'][0]['uri']) : '';

$hide_lanterns = (!empty($content['field_home_special_hide_lanterns']) && !empty($content['field_home_special_hide_lanterns']['#items'])) ?
  $content['field_home_special_hide_lanterns']['#items'][0]['value'] : '';

$content_sec_link = isset($content_sec_link) ? $content_sec_link : '';
$tour_sec_link = isset($tour_sec_link) ? $tour_sec_link : '';

$news_block = isset($news_block) ? $news_block : '';
$newsletter_block = isset($newsletter_block) ? $newsletter_block : '';
$news_block_link = isset($news_block_link) ? $news_block_link : '';
?>

<div id="node-<?php print $node->nid; ?>"
     class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h2<?php print $title_attributes; ?>><a
        href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <div class="content"<?php print $content_attributes; ?>>

    <section class="section type-top style-a section-top">
      <?php if ($section_top_img): ?>
        <div class="bg">
          <div class="clip-path-img-top-a">

            <?php print !empty($bg_img_list) ? $bg_img_list : ''; ?>

            <div class="navigation-type-a">
              <?php print render($content['field_home_top_items']); ?>
            </div>
          </div>

          <?php print !empty($bg_img_svg_list) ? $bg_img_svg_list : ''; ?>
        </div>
      <?php endif; ?>

      <div class="inner">
        <div class="container">

          <div class="inner-wrap">

            <?php print render($content['field_home_top_slider']); ?>

          </div>

        </div>
        <div class="navigation-type-a for-not-supported">
          <?php print render($top_items_for_not_supported); ?>
        </div>
      </div>
    </section>

    <?php if (!empty($content['field_home_special_section'])): ?>
      <?php print render($content['field_home_special_bg_img']); ?>
      <section class="section section-lanterns">
        <div class="inner">
          <div class="container">
            <?php print render($content['field_home_special_section']); ?>
          </div>
        </div>
        <?php if (empty($hide_lanterns)): ?>
          <div class="float-elements">
            <div class="items">

              <div class="first-start">
                <div class="item img-2 large position-1 top-1"></div>
                <div class="item middle position-19 top-2"></div>
                <div class="item x-large position-7 top-3"></div>
                <div class="item x-small position-20 top-4"></div>
                <div class="item small position-5 top-5"></div>
                <div class="item x-small position-15 top-6"></div>
                <div class="item img-2 middle position-2 top-7"></div>
                <div class="item img-2 x-small position-7 top-7"></div>
                <div class="item img-2 small position-1 top-8"></div>
                <div class="item img-2 small position-20 top-9"></div>
                <div class="item img-2 x-small position-15 top-10"></div>
                <div class="item small position-11 top-11"></div>
                <div class="item x-large position-1 top-12"></div>
              </div>

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

              <div class="item img-2 large position-1 delay-25"></div>
              <div class="item middle position-2 delay-31"></div>
              <div class="item x-large position-3 delay-36"></div>
              <div class="item x-small position-4 delay-26"></div>
              <div class="item small position-4 delay-27"></div>
              <div class="item x-small position-5 delay-37"></div>
              <div class="item img-2 x-small position-6 delay-46"></div>
              <div class="item img-2 small position-7 delay-39"></div>
              <div class="item img-2 small position-8 delay-48"></div>
              <div class="item img-2 x-small position-9 delay-45"></div>
              <div class="item small position-10 delay-38"></div>
              <div class="item large position-11 delay-28"></div>
              <div class="item img-2 small position-11 delay-30"></div>
              <div class="item x-small position-12 delay-42"></div>
              <div class="item x-middle position-13 delay-43"></div>
              <div class="item img-2 smallest position-13 delay-47"></div>
              <div class="item x-small position-14 delay-35"></div>
              <div class="item img-2 smallest position-15 delay-33"></div>
              <div class="item img-2 x-middle position-40"></div>
              <div class="item small position-17 delay-34"></div>
              <div class="item img-2 small position-19 delay-40"></div>
              <div class="item img-2 middle position-20 delay-34"></div>
              <div class="item img-2 x-middle position-20 delay-44"></div>
            </div>
          </div>
        <?php endif; ?>
      </section>
    <?php endif; ?>

    <?php if (!empty($hide_content)): ?>
      <section class="section type-after-top section-top-experts">
        <div class="bookblock-view">
          <div class="bg">
            <div class="clip-path-experts-a">
              <div class="bg-img" style="background-image: url('<?php print __THEME_PATH . '/images/tmp/FlipBook-GeneralLook-Cover-mobile.jpg'; ?>');" data-bottom-top="transform:translate3d(0px, -150px, 0px)" data-top-bottom="transform:translate3d(0px, 150px, 0px)"></div>
            </div>

            <svg width="100%" height="100%">
              <g clip-path="url(#clip-path-experts-a)">
                <image data-bottom-top="@transform:translate(0, -150)" data-top-bottom="@transform:translate(0, 150)" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php print __THEME_PATH . '/images/tmp/FlipBook-GeneralLook-Cover-mobile.jpg'; ?>" width="100%" height="100%" preserveAspectRatio="xMidYMin slice"></image>
              </g>
            </svg>
          </div>
          <div class="inner">
            <div class="container">
              <div class="inner-block">
                <header class="titles">
                  <div class="img"><?php print render($content['field_content_sec_mobile_image']); ?></div>
                  <h5 class="rtecenter"><?php print render($content['field_content_section_title']); ?></h5>
                  <h3 class="rtecenter"><?php print render($content['field_content_sec_subtitle']); ?></h3>
                </header>
                <div class="rtecenter">
                  <?php print render($content['field_content_sec_link']); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php print render($content['field_flipbook']); ?>
      </section>

      <?php if (!empty($content['field_home_quotes']) && $quote_image): ?>
        <section class="section section-quotes">
          <?php if ($quote_image): ?>
            <div class="bg">
              <div class="clip-path-quotes">
                <div class="bg-img" style="background-image: url('<?php print $quote_image; ?>');"
                     data-bottom-top="transform:translate3d(0px, -150px, 0px)"
                     data-top-bottom="transform:translate3d(0px, 150px, 0px)"></div>
              </div>

              <svg width="100%" height="100%" >
                <g clip-path="url(#clip-path-quotes)">
                  <image data-bottom-top="@transform:translate(0, -150)"
                         data-top-bottom="@transform:translate(0, 150)" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php print $quote_image; ?>"
                         width="100%" height="100%" preserveAspectRatio="xMidYMin slice"></image>
                </g>
              </svg>
            </div>
          <?php endif; ?>

          <div class="inner">
            <div class="container">
              <div class="inner-block">
                <?php print render($content['field_home_quotes']); ?>
              </div>
            </div>
          </div>
        </section>
      <?php endif; ?>

      <?php if (!empty($featured_dest_image) && empty($featured_special_content)): ?>
        <section class="section style-a section-destination">
          <div class="bg">
            <div class="clip-path-img-top-a">
              <div class="bg-img"
                   style="background-image: url('<?php print $featured_dest_image; ?>');"
                   data-bottom-top="transform:translate3d(0px, -150px, 0px)"
                   data-top-bottom="transform:translate3d(0px, 150px, 0px)"></div>
            </div>

            <svg width="100%" height="100%">
              <g clip-path="url(#clip-path-img-top-a)">
                <image data-bottom-top="@transform:translate(0, -150)"
                       data-top-bottom="@transform:translate(0, 150)"
                       xmlns:xlink="http://www.w3.org/1999/xlink"
                       xlink:href="<?php print $featured_dest_image; ?>"
                       width="100%" height="100%"
                       preserveAspectRatio="xMidYMid slice"></image>
              </g>
            </svg>
          </div>

          <div class="inner">
            <div class="container">
              <div class="inner-block">
                <div class="subtitle style-a">
                  <?php print render($content['field_home_dest_top_text']); ?>
                </div>
                <div class="subtitle style-b">
                  <?php print render($content['field_home_dest_top2_text']); ?>
                </div>
                <header class="titles">
                  <h2>
                    <?php print render($content['field_home_dest_title_image']); ?>
                    <span><?php print render($content['field_home_dest_title']); ?></span>
                  </h2>
                  <h5><?php print render($content['field_home_dest_subtitle']); ?></h5>
                </header>
                <div class="text">
                  <?php print render($content['field_home_dest_description']); ?>
                </div>
                <?php print render($content['field_home_dest_link']); ?>
              </div>
            </div>
          </div>
        </section>
      <?php elseif (!empty($featured_special_content)): ?>
        <?php print $featured_special_content; ?>
      <?php endif; ?>

      <?php if (isset($content['field_group_trips_title']) && isset($content['field_group_trips_item'])) : ?>
        <section class="section type-before-bottom style-a section-group-trips">
          <div class="bg">
            <div class="clip-path-img-top-f">
              <div class="bg-img"
                   style="background-image: url(<?php print __THEME_PATH . '/images/tmp/section-img-36.jpg'; ?>);"
                   data-bottom-top="transform:translate3d(0px, -150px, 0px)"
                   data-top-bottom="transform:translate3d(0px, 150px, 0px)"></div>
            </div>

            <svg width="100%" height="100%">
              <g clip-path="url(#clip-path-img-top-f)">
                <image data-bottom-top="@transform:translate(0, -150)"
                       data-top-bottom="@transform:translate(0, 150)"
                       xmlns:xlink="http://www.w3.org/1999/xlink"
                       xlink:href="<?php print __THEME_PATH . '/images/tmp/section-img-36.jpg'; ?>"
                       width="100%" height="100%"
                       preserveAspectRatio="xMidYMid slice"></image>
              </g>
            </svg>
          </div>

          <div class="inner">
            <div class="container">
              <div class="inner-block">
                <?php print render($content['field_group_trips_title']); ?>
                <?php print render($content['field_group_trips_item']); ?>
              </div>
            </div>
          </div>
        </section>
      <?php endif; ?>
    <?php endif; ?>

    <section class="section type-bottom section-latest">
      <?php if ($news_image): ?>
        <div class="bg">
          <div class="clip-path-img-full-height">
            <div class="bg-img" style="background-image: url('<?php print $news_image; ?>');"
                 data-bottom-top="transform:translate3d(0px, -150px, 0px)"
                 data-top-bottom="transform:translate3d(0px, 150px, 0px)"></div>
          </div>

          <svg width="100%" height="100%" >
            <g clip-path="url(#clip-path-img-full-height)">
              <image data-bottom-top="@transform:translate(0, -150)" data-top-bottom="@transform:translate(0, 150)" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php print $news_image; ?>"
                     width="100%" height="100%" preserveAspectRatio="xMidYMid slice"></image>
            </g>
          </svg>
        </div>
      <?php endif; ?>

      <div class="inner">
        <div class="container">
          <header class="titles style-a">
            <h3><?php print render($content['field_home_bottom_sec_subtitle']); ?></h3>
          </header>
          <?php if ($news_block): ?>
            <?php print $news_block; ?>
            <div class="bottom-control pull-center">
              <?php if ($news_block_link): ?>
                <?php print $news_block_link; ?>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <?php
    hide($content['field_home_special_hide_lanterns']);
    hide($content['field_home_dest_type']);
    hide($content['body']);
    hide($content['field_home_top_slider']);
    hide($content['field_home_bottom_sec_title']);
    hide($content['field_con_tour_title_image']);
    hide($content['field_con_tour_sec_title']);
    hide($content['field_con_tour_sec_subtitle']);
    hide($content['field_con_tour_sec_desc']);
    // We hide the comments and links now so that we can render them later.
    hide($content['field_home_top_bl_type']);
    hide($content['field_home_bottom_image']);
    hide($content['field_home_top_bl_link']);
    hide($content['field_con_tour_sec_link']);
    hide($content['field_content_sec_link']);
    hide($content['field_con_tour_sec_image']);
    hide($content['field_home_top_image']);
    hide($content['field_content_sec_image']);
    hide($content['field_home_dest_bg_image']);
    hide($content['field_home_dest_link']);
    hide($content['field_home_quote_bg_img']);
    hide($content['comments']);
    hide($content['links']);
    //print render($content);
    ?>
  </div>

  <?php print render($content['links']); ?>

  <?php print render($content['comments']); ?>

</div>
