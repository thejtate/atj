<?php

/**
 * @file
 * Default theme implementation to display a block.
 *
 * Available variables:
 * - $block->subject: Block title.
 * - $content: Block content.
 * - $block->module: Module that generated the block.
 * - $block->delta: An ID for the block, unique within each module.
 * - $block->region: The block region embedding the current block.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - block: The current template type, i.e., "theming hook".
 *   - block-[module]: The module generating the block. For example, the user
 *     module is responsible for handling the default user navigation block. In
 *     that case the class would be 'block-user'.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Helper variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $block_zebra: Outputs 'odd' and 'even' dependent on each block region.
 * - $zebra: Same output as $block_zebra but independent of any block region.
 * - $block_id: Counter dependent on each block region.
 * - $id: Same output as $block_id but independent of any block region.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 * - $block_html_id: A valid HTML ID and guaranteed unique.
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>
<?php
$default_background = isset($default_background) ? $default_background : '';
$default_desc = isset($default_desc) ? $default_desc : '';
$destinatinations_list = isset($destinatinations_list) ? $destinatinations_list : '';
$theme_path = drupal_get_path('theme', 'atj');
?>
<section class="section type-after-top section-region">

  <div class="default-view">
    <div class="bg">
      <div class="clip-path-region">
        <div class="bg-img"
             style="background-image: url('<?php print $default_background; ?>');"
             data-bottom-top="transform:translate3d(0px, -150px, 0px)"
             data-top-bottom="transform:translate3d(0px, 150px, 0px)"></div>
      </div>

      <svg width="100%" height="100%">
        <g clip-path="url(#clip-path-region)">
          <image xmlns:xlink="http://www.w3.org/1999/xlink"
                 xlink:href="<?php print $default_background; ?>"
                 width="100%" height="100%" preserveAspectRatio="xMidYMid slice"
                 data-bottom-top="@transform:translate(0, -150)"
                 data-top-bottom="@transform:translate(0, 150)"></image>
        </g>
      </svg>
    </div>
    <div class="inner">
      <div class="container">

        <div id="<?php print $block_html_id; ?>"
             class="<?php print $classes; ?>"<?php print $attributes; ?>>

          <?php print render($title_prefix); ?>
          <?php if ($block->subject): ?>
            <h2<?php print $title_attributes; ?>><?php print $block->subject ?></h2>
          <?php endif; ?>
          <?php print render($title_suffix); ?>

          <div class="block-white pull-center">
            <div class="text-generator">
              <?php print $default_desc; ?>
            </div>
            <a id="btn-generate" class="btn-generate" href="#"><img
                src="<?php print $theme_path . '/images/tmp/img-title.png'; ?>"
                alt=""/></a>
          </div>


        </div>

      </div>
    </div>
  </div>

  <?php if ($destinatinations_list): ?>
    <?php print render($destinatinations_list); ?>
  <?php endif; ?>

</section>