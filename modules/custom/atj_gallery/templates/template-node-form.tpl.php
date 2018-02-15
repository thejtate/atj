<?php
/**
 * File: gallery event node add form template
 */

?>
<?php if ($form): ?>
  <?php print drupal_render($form['title']); ?>
  <?php print drupal_render($form['body']); ?>

  <div class="b-photos-type">
    <?php print drupal_render($form['field_gallery_type']); ?>
  </div>

  <div class="b-photos">
    <h3><?php print t("Images"); ?></h3>

    <div class="items">
      <div class="item type-square">
        <div class="bg">
          <?php print drupal_render($form['field_gallery_image_1']); ?>
        </div>
      </div>
      <div class="item type-half">
        <div class="bg">
          <?php print drupal_render($form['field_gallery_image_2']); ?>
        </div>
        </a>
      </div>
      <div class="item type-half">
        <div class="bg">
          <?php print drupal_render($form['field_gallery_image_3']); ?>
        </div>
      </div>
      <div class="item element-invisible">
        <div class="bg">
          <?php print drupal_render($form['field_gallery_image_4']); ?>
        </div>
      </div>
    </div>

  </div>

  <?php print drupal_render_children($form); ?>

<?php endif; ?>

