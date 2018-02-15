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
$url = !empty($content['field_hn_top_dest_items_link']) ? $content['field_hn_top_dest_items_link']['#items'][0]['url'] : '';
?>
<div class="clip <?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <div class="wrap"<?php print $content_attributes; ?>>

    <a href="<?php print $url; ?>" class="top-destination-link">
      <span class="img only-mobile">
        <?php print render($content['field_hn_top_dest_items_mob_img']); ?>
      </span>
      <span class="img">
        <?php print render($content['field_hn_top_dest_items_img']); ?>
      </span>
      <?php if (!empty($content['field_hn_top_dest_items_hov_img'])): ?>
        <span class="img-bg">
          <?php print render($content['field_hn_top_dest_items_hov_img']); ?>
        </span>
      <?php endif; ?>
      <span class="top-destination_title">
        <?php print render($content['field_hn_top_dest_items_title']); ?>
      </span>
      <span class="top-destination_number">
        <?php print !empty($position) ? $position : ''; ?>
      </span>
    </a>

    <?php hide($content['field_hn_top_dest_items_link']); ?>
    <?php print render($content); ?>
  </div>
</div>
