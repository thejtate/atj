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
<div class="b-table style-f  <?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <h4><?php print $title; ?></h4>

    <div
            class="<?php print $classes; ?>"<?php print $attributes; ?>>
        <table>
            <tbody>
            <tr>
                <td>
                    <div class="subtitle">
                    <?php if(!empty($content['field_travel_ways_group_link']['#items'][0]['url'])): ?>
                        <a href="<?php print $content['field_travel_ways_group_link']['#items'][0]['url'];?>">
                    <?php endif; ?>
                        <span class="ico ss-icon ss-glyphish-outlined ss-usergroup"></span>
                      <?php print t('Group Trips'); ?>
                      <?php if(!empty($content['field_travel_ways_group_link']['#items'][0]['url'])): ?>
                        </a>
                      <?php endif; ?>

                    </div>
                </td>
                <td>
                    <div class="subtitle">
                      <?php if(!empty($content['field_travel_ways_custom_link']['#items'][0]['url'])): ?>
                        <a href="<?php print $content['field_travel_ways_custom_link']['#items'][0]['url'];?>">
                          <?php endif; ?>
                        <span class="ico ss-icon ss-glyphish-outlined ss-connection"></span>
                      <?php print t('Custom Trips'); ?>
                          <?php if(!empty($content['field_travel_ways_custom_link']['#items'][0]['url'])): ?>
                        </a>
                    <?php endif; ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                  <?php
                  hide($content['field_travel_ways_group_link']);
                  hide($content['field_travel_ways_custom_link']);
                  print render($content);
                  ?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>


</div>
