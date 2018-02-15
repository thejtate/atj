<?php
/**
 * Created by PhpStorm.
 * User: dimateus
 */
$theme_path = base_path() . drupal_get_path('theme', 'atj');
?>
<div class="b-articles">

  <?php if(!empty($items)): ?>

      <div class="control-top type-a">
        <div class="form form-sort">
          <div class="form-item form-type-select">
            <select class="form-select must-see-redirect-select">

              <option value="<?php print url(current_path(), array('query' => array('sort' => 'country')));?>"<?php print $sort_type == 'country' ? ' selected=""' : ''?>>SORT BY: COUNTRY</option>
              <option value="<?php print url(current_path(), array('query' => array('sort' => 'date')));?>"<?php print $sort_type == 'date' ? ' selected=""' : ''?>>SORT BY: DATE</option>
            </select>
          </div>
        </div>
      </div>
      <?php if($sort_type == 'country'): ?>

          <?php foreach($items as $country => $items_group): ?>
              <div class="block-title">
                  <h4><span><?php print check_plain($country)?></span></h4>
              </div>
              <div class="field-items">
                <?php foreach($items_group as $item ): ?>

                     <?php print render($item);?>

                <?php endforeach; ?>
              </div>

          <?php endforeach; ?>

        <?php /** date sort_type **/?>
      <?php else: ?>
        <div class="block-title">
        </div>
        <div class="field-items">

            <?php foreach($items as $item): ?>
              <?php print render($item);?>
            <?php endforeach; ?>

        </div>

      <?php endif; ?>

  <?php else: ?>
    <h4><?php print($empty_title)?></h4>
    <div class="b-cols">
      <div class="row">
        <div class="col col-md-7">
          <?php print render($empty_text);?>
          <p class="rtecenter"><img src="<?php print $theme_path;?>/images/tmp/tmp-img-3.png" alt=""></p>
        </div>
      </div>
    </div>
  <?php endif; ?>

</div>
