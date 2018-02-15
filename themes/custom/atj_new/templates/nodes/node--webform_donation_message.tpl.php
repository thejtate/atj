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
<section class="section section-lanterns">
  <div class="bg">
    <div class="bg">
      <?php if (!empty($top_image)): ?>
        <div class="bg-img"
             style="background-image: url('<?php print $top_image; ?>');"></div>
      <?php endif; ?>
    </div>
  </div>
  <div id="node-<?php print $node->nid; ?>"
       class="container <?php print $classes; ?>"<?php print $attributes; ?>>
    <div class="form form-lantern">
      <div class="img">
        <img src="<?php print !empty($lantern_image) ? $lantern_image : ''; ?>"
             alt="">
      </div>

      <?php print render($title_prefix); ?>
      <?php if (!$page): ?>
        <h2<?php print $title_attributes; ?>>
          <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
        </h2>
      <?php endif; ?>
      <?php print render($title_suffix); ?>

      <div class="content"<?php print $content_attributes; ?>>
        <div class="title">
          <?php print render($content['field_donation_mess_head_text']); ?>
        </div><!-- end .title -->
        <?php
        // We hide the comments and links now so that we can render them later.
        hide($content['comments']);
        hide($content['links']);
        hide($content['field_donation_mess_cancel_link']);
        print render($content);
        ?>
        <div class="link">
          <?php print render($content['field_donation_mess_cancel_link']); ?>
        </div><!-- end .link -->
      </div><!-- end .content -->

      <?php print render($content['links']); ?>
      <?php print render($content['comments']); ?>

    </div><!-- end .form-lantern -->
  </div><!-- end node -->


  <div class="float-elements">
    <div class="items">
      <div class="first-start">
        <div class="item img-2 large position-1 top-1"></div>
        <div class="item middle position-19 top-2"></div>
        <div class="item x-large position-7 top-3" data-key="8"></div>
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
        <div class="item large position-18 top-12"></div>
        <div class="item img-2 small position-8 top-13"></div>
        <div class="item x-small position-1 top-14"></div>
        <div class="item x-middle position-20 top-15"></div>
        <div class="item img-2 smallest position-4 top-16"></div>
        <div class="item x-small position-17 top-17"></div>
        <div class="item img-2 smallest position-10 top-18"></div>
        <div class="item x-large position-2 top-18"></div>
        <div class="item img-2 x-middle position-2 top-19"></div>
        <div class="item small position-20 top-20"></div>
        <div class="item x-middle position-18 top-21"></div>
        <div class="item img-2 small position-11 top-21"></div>
        <div class="item img-2 middle position-6 top-22"></div>
        <div class="item img-2 x-middle position-1 top-23"></div>
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
</section>