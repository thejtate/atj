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
$link = !empty($content['field_home_top_items_link']['#items']) ?
  $content['field_home_top_items_link']['#items'][0] : '';
$type = !empty($content['field_home_top_items_type']) ?
  $content['field_home_top_items_type']['#items'][0]['value'] : '';
$url = (!empty($link['url']) && $type != 'interactive_trip_finder')  ? $link['url'] : '';
$url_title = !empty($link['title']) ? $link['title'] : '';
$custom_planner = !empty($custom_planner) ? $custom_planner : array();
$title = !empty($content['field_home_top_items_title']['#items']) ?
  $content['field_home_top_items_title']['#items'][0]['value'] : '';
?>

<?php //print !empty($url) ? '<a href="' . $url . '">' : ''; ?>
  <div class="bg">
    <div class="img">
        <?php print render($content['field_home_top_items_image']); ?>
    </div>
  </div>
  <?php print render($content['field_home_top_items_icon']); ?>
    <div class="v-center">
        <?php if($type == 'custom_planner_small' || $type == 'interactive_trip_finder'): ?>
            <h6><?php print $title; ?></h6>
        <?php else:?>
            <h5><?php print $title; ?></h5>
        <?php endif; ?>
        <?php if(!empty($trip_finder_form)): ?>
            <div class="form form-pick-destination">
                <?php print render($trip_finder_form);?>
            </div>
        <?php endif; ?>
        <?php if (!empty($custom_planner)): ?>
          <div class="form form-pick-destination">
          <?php print render($custom_planner); ?>
          </div>
        <?php endif; ?>
        <?php print render($content['field_home_top_items_link']); ?>
    </div>
<?php //print !empty($url) ? '</a>' : ''; ?>



<?php hide($content['field_home_top_items_title']); ?>
<?php hide($content['field_home_top_items_link']); ?>
<?php hide($content['field_home_top_items_type']); ?>
<?php print render($content); ?>