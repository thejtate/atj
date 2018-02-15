<?php
/**
 * @file
 * Default theme implementation for beans.
 *
 * Available variables:
 * - $content: An array of comment items. Use render($content) to print them all, or
 *   print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $title: The (sanitized) entity label.
 * - $url: Direct url of the current entity if specified.
 * - $page: Flag for the full page state.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. By default the following classes are available, where
 *   the parts enclosed by {} are replaced by the appropriate values:
 *   - entity-{ENTITY_TYPE}
 *   - {ENTITY_TYPE}-{BUNDLE}
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
$data = (isset($variables['content']['field_temperature_data']) &&
  !empty($variables['content']['field_temperature_data']['#items'])) ?
  $variables['content']['field_temperature_data']['#items'][0]['value'] : '';
?>

<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <div class="content"<?php print $content_attributes; ?>>
    <div class="b-chart">
      <?php print render($content['field_country_content_type']); ?>
      <div class="chart-wrap">
        <div class="ideal"></div>
        <svg class="chart" data-data="<?php print $data; ?>"></svg>
        <div class="axis y">
          <span class="i"><span class="text"><?php print t('HOT'); ?></span></span>
          <span class="i"><span class="text"><?php print t('WARM'); ?></span></span>
          <span class="i"><span class="text"><?php print t('COOL'); ?></span></span>
          <span class="i"><span class="text"><?php print t('COLD'); ?></span></span>
        </div>
        <div class="axis x">
          <span class="i"><span class="text"><?php print t('Jan'); ?></span></span>
          <span class="i"><span class="text"><?php print t('Feb'); ?></span></span>
          <span class="i"><span class="text"><?php print t('Mar'); ?></span></span>
          <span class="i"><span class="text"><?php print t('Apr'); ?></span></span>
          <span class="i"><span class="text"><?php print t('May'); ?></span></span>
          <span class="i"><span class="text"><?php print t('Jun'); ?></span></span>
          <span class="i"><span class="text"><?php print t('Jul'); ?></span></span>
          <span class="i"><span class="text"><?php print t('Aug'); ?></span></span>
          <span class="i"><span class="text"><?php print t('Sep'); ?></span></span>
          <span class="i"><span class="text"><?php print t('OcT'); ?></span></span>
          <span class="i"><span class="text"><?php print t('Nov'); ?></span></span>
          <span class="i"><span class="text"><?php print t('Dec'); ?></span></span>
        </div>
      </div>
      <div class="legend"><span><?php print t('IDEAL TEMPERATURE'); ?></span></div>
    </div>
    <?php hide($content['field_temperature_data']); ?>
    <?php print render($content); ?>
  </div>
</div>
