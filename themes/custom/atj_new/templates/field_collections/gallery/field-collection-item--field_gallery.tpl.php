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
$img_1 = !empty($content['field_gallery_image_1']) &&
  !empty($content['field_gallery_image_1']['#items']) ?
  file_create_url($content['field_gallery_image_1']['#items'][0]['uri']) : '';
$img_2 = !empty($content['field_gallery_image_2']) &&
  !empty($content['field_gallery_image_2']['#items']) ?
  file_create_url($content['field_gallery_image_2']['#items'][0]['uri']) : '';
$img_3 = !empty($content['field_gallery_image_3']) &&
  !empty($content['field_gallery_image_3']['#items']) ?
  file_create_url($content['field_gallery_image_3']['#items'][0]['uri']) : '';
$img_4 = !empty($content['field_gallery_image_4']) &&
  !empty($content['field_gallery_image_4']['#items']) ?
  file_create_url($content['field_gallery_image_4']['#items'][0]['uri']) : '';
?>
<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <div class="section section-grid"<?php print $content_attributes; ?>>

    <div class="row">
      <div class="col-xs-6">
        <div class="item style-b-rectangle">
          <div class="bg" style="background-image: url('<?php print $img_1; ?>');">
          </div>
        </div>
      </div>
      <div class="col-xs-6">
        <div class="item style-b-rectangle">
          <div class="bg" style="background-image: url('<?php print $img_2; ?>');">
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6">
        <div class="item style-b-rectangle">
          <div class="bg" style="background-image: url('<?php print $img_3; ?>');">
          </div>
        </div>
      </div>
      <div class="col-xs-6">
        <div class="item style-b-rectangle">
          <div class="bg" style="background-image: url('<?php print $img_4; ?>');">
          </div>
        </div>
      </div>
    </div>

    <?php //print render($content); ?>
  </div>
</div>
