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
$style_images = isset($style_images) ? $style_images : array();
$map = isset($type_map) ? $type_map : array();
$back_image = isset($back_image) ? $back_image : '';
?>

<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <div class="content"<?php print $content_attributes; ?>>

    <div class="b-photos">
      <?php if ($back_image): ?>
        <div class="block-bg"
             style="background-image: url('<?php print $back_image; ?>');">
        </div>
      <?php endif; ?>

      <?php if (isset($content['field_gallery_title'])): ?>
        <h4><?php print render($content['field_gallery_title']); ?></h4>
      <?php endif; ?>

      <div class="items">
        <?php foreach ($style_images as $delta => $image): ?>
          <div
            class="item style-block-photo <?php print isset($map[$delta]['class']) ? $map[$delta]['class'] : ''; ?>">
            <div class="bg">
              <div class="clip">
                <?php print $image; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <?php hide($content['field_gallery_type']); ?>
    <?php hide($content['field_gallery_back_image']); ?>
    <?php hide($content['field_gallery_image_1']); ?>
    <?php hide($content['field_gallery_image_2']); ?>
    <?php hide($content['field_gallery_image_3']); ?>
    <?php hide($content['field_gallery_image_4']); ?>
    <?php print render($content); ?>
  </div>
</div>
