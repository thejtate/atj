<?php

/**
 * @file
 * Default theme implementation for field collection items.
 *
 * Available variables:
 * - $content: An array of comment items. Use render($content) to print them all, or
 *   print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $title: The (sanitized) field collection item label.
 * - $url: Direct url of the current entity if specified.
 * - $page: Flag for the full page state.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. By default the following classes are available, where
 *   the parts enclosed by {} are replaced by the appropriate values:
 *   - entity-field-collection-item
 *   - field-collection-item-{field_name}
 *
 * Other variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess()
 * @see template_preprocess_entity()
 * @see template_process()
 */
?>
<?php
$section_top_type = (isset($content['field_home_top_bl_type']) && !empty($content['field_home_top_bl_type']['#items'])) ?
  $content['field_home_top_bl_type']['#items'][0]['value'] : 'defaultstyle';
$top_bl_link = !empty($top_bl_link) ? $top_bl_link : '';
?>
<?php if ($section_top_type == 'style-season-giving'): ?>

  <div class="mobile-title">
    <?php if (!empty($content['field_top_title_image'])): ?>
      <div class="img">
        <?php print render($content['field_top_title_image']); ?>
      </div>
    <?php endif; ?>

    <?php print render($content['field_home_top_mob_sec_title']); ?>
  </div>

  <div class="content-wrap style-a">
    <header class="titles style-c">
      <div class="title-h1">
        <h2>
          <?php print htmlspecialchars_decode(render($content['field_home_top_sec_title'])); ?>
        </h2>
      </div>
    </header>
    <div class="desc style-d">
      <?php print render($content['field_home_top_slider_desc']); ?>

      <?php print $top_bl_link; ?>
    </div>
  </div>
<?php elseif ($section_top_type == 'style-new-year'): ?>
  <header class="titles style-d">
    <div class="title-h1">
      <h2>
        <?php print render($content['field_home_top_sec_title']); ?>
      </h2>
    </div>
  </header>
  <div class="desc style-f">
    <div class="text">
      <?php print render($content['field_home_top_slider_desc']); ?>
    </div>
    <?php print $top_bl_link; ?>
  </div>
<?php endif; ?>
