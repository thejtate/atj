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
<?php $display_pins = FALSE; ?>
<article class="item style-block-article <?php print $wrapper_cl; ?>">
  <div class="photo">
    <?php print render($content['field_reg_highl_image']); ?>
  </div>
  <div class="body">
    <h4><?php print render($content['field_reg_highl_title']); ?></h4>
    <?php if (isset($content['field_reg_highl_subtitle'])): ?>
      <div class="subtitle">
        <?php print render($content['field_reg_highl_subtitle']); ?>
      </div>
    <?php endif; ?>
    <?php print render($content['field_reg_highl_desc']); ?>

    <?php if (!empty($display_pins)): ?>
    <a class="link type-pin pin-link" data-target-tooltip="#pin-tooltip" href="#"
       data-gacategory="regions adventures" data-gaaction="pin" data-galabel="<?php print(!empty($field_collection_item->hostEntity()) ? $field_collection_item->hostEntity()->title : '');?>: <?php print check_plain($content['field_reg_highl_title'][0]['#markup'])?>"
       data-fid="<?php print $field_collection_item->item_id?>"><span class="ico ss-icon ss-glyphish-outlined ss-pushpin"></span><span class="ico ss-icon ss-glyphish-filled ss-pushpin"></span></a>
    <?php endif; ?>
  </div>
</article>