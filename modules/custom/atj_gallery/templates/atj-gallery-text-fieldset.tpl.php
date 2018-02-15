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

  <div class="b-photos b-photos-text">
    <h3><?php print t("Images"); ?></h3>

    <div class="items">
      <div class="item <?php print isset($map[$type][0]['class']) ? $map[$type][0]['class'] : 'type-square'; ?>">
        <div class="bg">
          <?php print drupal_render($form[LANGUAGE_NONE][0]); ?>
        </div>
      </div>
      <div class="item <?php print isset($map[$type][1]['class']) ? $map[$type][1]['class'] : 'type-half'; ?>">
        <div class="bg">
          <?php print drupal_render($form[LANGUAGE_NONE][1]); ?>
        </div>
        </a>
      </div>
      <div class="item <?php print isset($map[$type][2]['class']) ? $map[$type][2]['class'] : 'type-half'; ?>">
        <div class="bg">
          <?php print drupal_render($form[LANGUAGE_NONE][2]); ?>
        </div>
      </div>
      <div class="item <?php print isset($map[$type][3]['class']) ? $map[$type][3]['class'] : 'element-invisible'; ?>">
        <div class="bg">
          <?php print drupal_render($form[LANGUAGE_NONE][3]); ?>
        </div>
      </div>
    </div>

  </div>

  <?php print drupal_render_children($form); ?>

<?php endif; ?>

