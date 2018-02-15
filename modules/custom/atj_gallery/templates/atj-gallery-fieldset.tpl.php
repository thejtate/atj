<?php
/**
 * File: gallery event node add form template
 */

?>
<?php
$type = isset($type) ? $type : '';
$map = isset($map) ? $map : '';
?>

<?php if ($form): ?>

  <?php $form['field_gallery_title']['#printed'] = FALSE; ?>
  <?php $form['field_gallery_back_image']['#printed'] = FALSE; ?>
  <?php print drupal_render($form['field_gallery_title']); ?>
  <?php print drupal_render($form['field_gallery_back_image']); ?>

  <div class="b-photos-type">
    <?php $form['field_gallery_type']['#printed'] = FALSE; ?>
    <?php print drupal_render($form['field_gallery_type']); ?>
  </div>

  <div class="b-photos">
    <h3><?php print t("Images"); ?></h3>

    <div class="items">
      <div class="item <?php print isset($map[$type][0]['class']) ? $map[$type][0]['class'] : 'type-square'; ?>">
        <div class="bg">
          <?php $form['field_gallery_image_1']['#printed'] = FALSE; ?>
          <?php print drupal_render($form['field_gallery_image_1']); ?>
        </div>
      </div>
      <div class="item <?php print isset($map[$type][1]['class']) ? $map[$type][1]['class'] : 'type-half'; ?>">
        <div class="bg">
          <?php $form['field_gallery_image_2']['#printed'] = FALSE; ?>
          <?php print drupal_render($form['field_gallery_image_2']); ?>
        </div>
        </a>
      </div>
      <div class="item <?php print isset($map[$type][2]['class']) ? $map[$type][2]['class'] : 'type-half'; ?>">
        <div class="bg">
          <?php $form['field_gallery_image_3']['#printed'] = FALSE; ?>
          <?php print drupal_render($form['field_gallery_image_3']); ?>
        </div>
      </div>
      <div class="item <?php print isset($map[$type][3]['class']) ? $map[$type][3]['class'] : 'element-invisible'; ?>">
        <div class="bg">
          <?php $form['field_gallery_image_4']['#printed'] = FALSE; ?>
          <?php print drupal_render($form['field_gallery_image_4']); ?>
        </div>
      </div>
    </div>

  </div>

  <?php print drupal_render_children($form); ?>

<?php endif; ?>

