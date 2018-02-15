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
<div class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <div class="content"<?php print $content_attributes; ?>>

    <div class="photo">
      <?php print render($content['field_f_dest_2_col_img']); ?>
    </div>
    <div class="body">
      <div class="blog-article-col-wrap">
        <div class="row">
          <div class="col-sm-6">
            <div class="blog-article-title-wrap">
              <div class="blog-article-title">
                <span class="count"><?php print !empty($position) ? $position : ''; ?></span>
                <?php print render($content['field_f_dest_2_col_title']); ?>
              </div>
              <div class="desc">
                <?php print render($content['field_f_dest_2_col_desc']); ?>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="btn btn-link">
              <?php print render($content['field_f_dest_2_col_link']); ?>
            </div>
          </div>
        </div>
      </div>

      <div class="blog-article-col-wrap">
        <div class="row">
          <div class="col-md-6">
            <?php print render($content['field_f_dest_2_col_left']); ?>
          </div>
          <div class="col-md-6">
            <?php print render($content['field_f_dest_2_col_right']); ?>
          </div>
        </div>
      </div>
    </div>

    <?php print render($content); ?>
  </div>
</div>
