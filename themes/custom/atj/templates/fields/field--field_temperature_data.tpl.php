<?php

/**
 * @file field.tpl.php
 * Default template implementation to display the value of a field.
 *
 * This file is not used and is here as a starting point for customization only.
 * @see theme_field()
 *
 * Available variables:
 * - $items: An array of field values. Use render() to output them.
 * - $label: The item label.
 * - $label_hidden: Whether the label display is set to 'hidden'.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - field: The current template type, i.e., "theming hook".
 *   - field-name-[field_name]: The current field name. For example, if the
 *     field name is "field_description" it would result in
 *     "field-name-field-description".
 *   - field-type-[field_type]: The current field type. For example, if the
 *     field type is "text" it would result in "field-type-text".
 *   - field-label-[label_display]: The current label position. For example, if
 *     the label position is "above" it would result in "field-label-above".
 *
 * Other variables:
 * - $element['#object']: The entity to which the field is attached.
 * - $element['#view_mode']: View mode, e.g. 'full', 'teaser'...
 * - $element['#field_name']: The field name.
 * - $element['#field_type']: The field type.
 * - $element['#field_language']: The field language.
 * - $element['#field_translatable']: Whether the field is translatable or not.
 * - $element['#label_display']: Position of label display, inline, above, or
 *   hidden.
 * - $field_name_css: The css-compatible field name.
 * - $field_type_css: The css-compatible field type.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess_field()
 * @see theme_field()
 *
 * @ingroup themeable
 */
?>
<?php $data = (isset($items) && !empty($items)) ? $items[0]['#markup'] : ''; ?>

<div class="chart-wrap">
  <div class="chart" data-data="<?php print $data; ?>"></div>
  <div class="axis y">
    <span class="i"><span class="text"><?php print t('HOT'); ?></span></span>
    <span class="i"><span class="text"><?php print t('WARM'); ?></span></span>
    <span class="i"><span class="text"><?php print t('COOL'); ?></span></span>
    <span class="i"><span class="text"><?php print t('COLD'); ?></span></span>
  </div>
  <div class="axis x">
    <span class="i"><span class="text"><?php print t('Spring'); ?></span></span>
    <span class="i"><span class="text"><?php print t('Summer'); ?></span></span>
    <span class="i"><span class="text"><?php print t('Autumn'); ?></span></span>
    <span class="i"><span class="text"><?php print t('Winter'); ?></span></span>
  </div>
</div>
<div class="legend-wrapper">
  <div class="left-part">
    <span class="title"><?php print t('PRECIPITATION'); ?></span>
    <span class="legend-item ico-low"><?php print t('LOW'); ?></span>
    <span class="legend-item ico-med"><?php print t('MED'); ?></span>
    <span class="legend-item ico-high"><?php print t('HIGH'); ?></span>
  </div>
  <div class="right-part">
    <span class="title"><?php print t('MOST POPULAR TRAVEL TIME'); ?></span>
    <span class="ico ico-popular"></span>
  </div>
</div>
