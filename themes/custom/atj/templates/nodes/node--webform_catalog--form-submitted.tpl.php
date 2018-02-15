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
$theme_path = base_path() . path_to_theme();
$catalog_image = isset($field_catalog_preview_image) &&
  isset($field_catalog_preview_image[LANGUAGE_NONE][0]) ? file_create_url($field_catalog_preview_image[LANGUAGE_NONE][0]['uri']) : '';

$params = drupal_get_query_parameters();
$source = !empty($params['source']) ? $params['source'] : '';

$obapi_catalog_js = array(
  '#type' => 'html_tag',
  '#tag' => 'script',
  '#attributes' => array(
    'type' => 'text/javascript',
  ),
  '#value' => "obApi('track', 'Request a Catalog');",
  '#weight' => '-98',
);

drupal_add_html_head($obapi_catalog_js, 'atj_obapi_catalog');
?>
<script>
  fbq('track', 'Lead', {
    content_name: 'Request a catalog'
  });
</script>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print $user_picture; ?>

  <?php print render($title_prefix); ?>
  <?php print render($title_suffix); ?>

  <div>
    <div class="content"<?php print $content_attributes; ?>>
      <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      print render($content);
      ?>
    </div>
    <figure class="b-figcaption style-a">
      <div class="img">
        <?php if($catalog_image): ?>
          <img src="<?php print $catalog_image; ?>" alt="">
        <?php endif; ?>
          <a class="link type-read-more style-red" href="<?php print url(ATJ_CATALOG_ULR);?>">VIEW/DOWNLOAD <span class="ico ss-icon ss-standard ss-navigateright"></span></a>
      </div>
      <figcaption>
        <h4>THANK YOU FOR YOUR INTEREST <br> IN OUR CATALOG.</h4>
        <p>You may view and download our entire 80 page Catalog by clicking the link above. If you chose the print version, your print catalog should arrive within 5-10 business days via US mail.</p>
        <br>
        <p>In the meantime, if you would like to begin a dialogue right away about our destinations, please contact one of our expert Asia Travel Experts today. Avail yourself of the service, expertise and passion that has made ATJ the industry leader in the Asia/Pacific region.</p>
        <address>
          Email: <a href="mailto:travel@atj.com">travel@atj.com</a> <br>
          Toll-free: <a href="tel:8006422742">800-642-2742</a>
        </address>
      </figcaption>
    </figure>

  </div>

  <?php print render($content['links']); ?>

  <?php print render($content['comments']); ?>


  <?php if ($source == 'popup'): ?>
    <!-- Google Code for Timed Popup - Request a Catalog Conversion Page -->
    <script type="text/javascript">
      /* <![CDATA[ */
      var google_conversion_id = 925451833;
      var google_conversion_language = "en";
      var google_conversion_format = "3";
      var google_conversion_color = "ffffff";
      var google_conversion_label = "cjWICK2hpHQQuYyluQM";
      var google_remarketing_only = false;
      /* ]]> */
    </script>
    <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
    </script>
    <noscript>
      <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/925451833/?label=cjWICK2hpHQQuYyluQM&amp;guid=ON&amp;script=0"/>
      </div>
    </noscript>

  <?php else: ?>

    <script type="text/javascript">
      /* <![CDATA[ */
      var google_conversion_id = 925451833;
      var google_conversion_language = "en";
      var google_conversion_format = "3";
      var google_conversion_color = "ffffff";
      var google_conversion_label = "eJnRCNTP_2QQuYyluQM";
      var google_remarketing_only = false;
      /* ]]> */
    </script>
    <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
    </script>
    <noscript>
      <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/925451833/?label=$conv_code_label&amp;guid=ON&amp;script=0"/>
      </div>
    </noscript>

  <?php endif; ?>

</div>
