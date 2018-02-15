<?php

/**
 * @file
 * Default theme implementation for a single paragraph item.
 *
 * Available variables:
 * - $content: An array of content items. Use render($content) to print them
 *   all, or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. By default the following classes are available, where
 *   the parts enclosed by {} are replaced by the appropriate values:
 *   - entity
 *   - entity-paragraphs-item
 *   - paragraphs-item-{bundle}
 *
 * Other variables:
 * - $classes_array: Array of html class attribute values. It is flattened into
 *   a string within the variable $classes.
 *
 * @see template_preprocess()
 * @see template_preprocess_entity()
 * @see template_process()
 */
?>
<div class="b-food <?php print $classes; ?>"<?php print $attributes; ?>>
  <div class="row"<?php print $content_attributes; ?>>

        <div class="col col-md-6">
            <div class="hd">
              <h5><?php print render($content['field_par_rec_left_title']); ?></h5>
                <h6><?php print render($content['field_par_rec_left_subtitle']); ?></h6>
            </div>
            <div class="inner-col">
                <div class="img"><?php print render($content['field_par_rec_left_image']); ?></div>
                <div class="body">
                    <div class="row">
                        <?php if(!empty($content['field_par_rec_left_ingredients1']) && !empty($content['field_par_rec_left_ingredients2'])): ?>
                        <div class="col col-sm-6">
                            <?php print render($content['field_par_rec_left_ingredients1']);?>
                        </div>
                        <div class="col col-sm-6">
                          <?php print render($content['field_par_rec_left_ingredients2']);?>
                        </div>
                        <?php else: ?>
                        <div class="col col-sm-12">
                          <?php print render($content['field_par_rec_left_ingredients1']);?>
                          <?php print render($content['field_par_rec_left_ingredients2']);?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
          <?php print render($content['field_par_rec_left_description']);?>
        </div>
        <div class="col col-md-6">
            <div class="hd">
                <h5><?php print render($content['field_par_rec_right_title']); ?></h5>
                <h6><?php print render($content['field_par_rec_right_subtitle']); ?></h6>
            </div>
            <div class="inner-col">
                <div class="img"><?php print render($content['field_par_rec_right_image']); ?></div>
                <div class="body">
                    <div class="row">
                      <?php if(!empty($content['field_par_rec_right_ingredients1']) && !empty($content['field_par_rec_right_ingredients2'])): ?>
                          <div class="col col-sm-6">
                            <?php print render($content['field_par_rec_right_ingredients1']);?>
                          </div>
                          <div class="col col-sm-6">
                            <?php print render($content['field_par_rec_right_ingredients2']);?>
                          </div>
                      <?php else: ?>
                          <div class="col col-sm-12">
                            <?php print render($content['field_par_rec_right_ingredients1']);?>
                            <?php print render($content['field_par_rec_right_ingredients2']);?>
                          </div>
                      <?php endif; ?>
                    </div>
                </div>
            </div>
          <?php print render($content['field_par_rec_right_description']);?>
        </div>
    <?php print render($content); ?>
    </div>
</div>