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
$url = (isset($content['field_gallery_text_link']) &&
  !empty($content['field_gallery_text_link']['#items'])) ?
  $content['field_gallery_text_link']['#items'][0]['url'] : '';

$style_image = isset($style_image) ? $style_image : '';
?>

<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <div class="content"<?php print $content_attributes; ?>>

    <a href="<?php print $url; ?>">
      <div class="bg">
        <div class="clip">
          <?php print $style_image; ?>
        </div>
      </div>
      <div class="titles">
        <?php print render($content['field_gallery_text_title']); ?>
        <span
          class="link type-read-more style-white"><?php print t('EXPLORE'); ?>
          <span class="ico ss-icon ss-standard ss-navigateright"></span></span>
      </div>
    </a>

    <?php //print render($content); ?>
  </div>
</div>
