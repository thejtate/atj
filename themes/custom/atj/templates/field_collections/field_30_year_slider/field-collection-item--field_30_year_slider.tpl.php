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
$type = isset($field_30_year_slider_type) ? $field_30_year_slider_type[0]['value'] : '';
$main_title = isset($main_title) ? $main_title : '';
$subtitle = isset($subtitle) ? $subtitle : '';
$path_to_theme = drupal_get_path('theme', 'atj');
?>

<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <div class="content"<?php print $content_attributes; ?>>
    <?php print render($content['field_common_top_image']); ?>

    <div class="slider-inner-wrapper">
      <div class="container">
        <?php switch ($type):

          case 'slide_1': ?>
            <div class="titles">
              <h2><?php print $main_title; ?></h2>
              <h5><?php print $subtitle; ?></h5>
            </div>
            <?php print render($content['field_30_year_slider_date']); ?>
            <?php print render($content['field_30_year_slider_desc']); ?>
            <?php break; ?>

          <?php case 'slide_2': ?>
            <div class="clearfix">
              <div class="titles">
                <h1><?php print $main_title; ?></h1>
                <h5><?php print $subtitle; ?></h5>
              </div>
              <div class="items">
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
              </div>
            </div>
            <div class="title">
              <span>
                <?php print render($content['field_30_year_slider_title_top']); ?>
              </span>
            </div>
            <div class="total-wrapper">
              <?php print render($content['field_30_year_slider_subtitle']); ?>
              <div class="total">
                <span class="ico"></span>=<span class="ico-text"> 100</span>
              </div>
            </div>
            <?php break; ?>

          <?php case 'slide_3': ?>
            <div class="left-part">
              <div class="titles">
                <h2><?php print $main_title; ?></h2>
                <h5><?php print $subtitle; ?></h5>
              </div>
              <div class="title">
                <?php print render($content['field_30_year_slider_title_top']); ?>
              </div>
            </div>
            <div class="right-part">
              <div class="map">
                <img
                  src="<?php print $path_to_theme; ?>/images/tmp/slide-map-a.png"
                  alt=""/>
              </div>
              <div class="items">
                <div class="item">
                  <span class="el">1.Thailand</span>

                  <div class="marker">1</div>
                </div>
                <div class="item">
                  <span class="el">3.Vietnam</span>

                  <div class="marker">3</div>
                </div>
                <div class="item">
                  <span class="el">5.Myanmar</span>

                  <div class="marker">5</div>
                </div>
                <div class="item">
                  <span class="el">7.Bangkok</span>

                  <div class="marker">7</div>
                </div>
                <div class="item">
                  <span class="el">9.Indonesia</span>

                  <div class="marker">9</div>
                </div>
                <div class="item">
                  <span class="el">2.Cambodia</span>

                  <div class="marker">2</div>
                </div>
                <div class="item">
                  <span class="el">4.China</span>

                  <div class="marker">4</div>
                </div>
                <div class="item">
                  <span class="el">6.Laos</span>

                  <div class="marker">6</div>
                </div>
                <div class="item">
                  <span class="el">8.India</span>

                  <div class="marker">8</div>
                </div>
                <div class="item">
                  <span class="el">10.Hong Kong</span>

                  <div class="marker">10</div>
                </div>
              </div>
              <div class="items mobile-only">
                <div class="item">
                  <span class="el">1.Thailand</span>
                </div>
                <div class="item">
                  <span class="el">2.Cambodia</span>
                </div>
                <div class="item">
                  <span class="el">3.Vietnam</span>
                </div>
                <div class="item">
                  <span class="el">4.China</span>
                </div>
                <div class="item">
                  <span class="el">5.Myanmar</span>
                </div>
                <div class="item">
                  <span class="el">6.Laos</span>
                </div>
                <div class="item">
                  <span class="el">7.Bangkok</span>
                </div>
                <div class="item">
                  <span class="el">8.India</span>
                </div>
                <div class="item">
                  <span class="el">9.Indonesia</span>
                </div>
                <div class="item">
                  <span class="el">10.Hong Kong</span>
                </div>
              </div>
            </div>
            <?php break; ?>

          <?php case 'slide_4': ?>
            <div class="title">
                <span>
                  <?php print render($content['field_30_year_slider_title_top']); ?>
                </span>
            </div>
            <div class="clearfix">
              <div class="titles">
                <h2><?php print $main_title; ?></h2>
                <h5><?php print $subtitle; ?></h5>
              </div>
              <div class="items-wrapper">
                <span class="subtitle">number of people reached 1987-2016</span>

                <div class="items">
                  <div class="item"><span class="clip"><span class="item-inner"><span
                          class="ico ico-guides"></span><span class="title">Guides</span></span></span>
                  </div>
                  <div class="item"><span class="clip"><span class="item-inner"><span
                          class="ico ico-drivers"></span><span class="title">Drivers</span></span></span>
                  </div>
                  <div class="item"><span class="clip"><span class="item-inner"><span
                          class="ico ico-hotels"></span><span class="title">hotels</span></span></span>
                  </div>
                  <div class="item"><span class="clip"><span class="item-inner"><span
                          class="ico ico-restaurants"></span><span
                          class="title">restaurants</span></span></span></div>
                  <div class="item"><span class="clip"><span class="item-inner"><span
                          class="ico ico-partners"></span><span class="title">IN-COUNTRY PARTNERS & STAFF</span></span></span>
                  </div>
                  <div class="item"><span class="clip"><span class="item-inner"><span
                          class="ico ico-artisans"></span><span class="title">artisans/expert guides</span></span></span>
                  </div>
                </div>
                <div class="axis"><img
                    src="<?php print $path_to_theme; ?>/images/tmp/tmp-axis.png"
                    alt=""/></div>
              </div>
            </div>
            <div class="title bottom">
                <span>
                  <?php print render($content['field_30_year_slider_title_bot']); ?>
                </span>
            </div>
            <div class="bottom-title">
              <span>approximately</span>
            </div>
            <?php break; ?>

          <?php case 'slide_5': ?>
            <div class="title">
                <span>
                  <?php print render($content['field_30_year_slider_title_top']); ?>
                </span>
            </div>
            <div class="clearfix">
              <div class="titles">
                <h2><?php print $main_title; ?></h2>
                <h5><?php print $subtitle; ?></h5>
              </div>
              <div class="calendar">
                <img
                  src="<?php print $path_to_theme; ?>/images/tmp/tmp-calendar.png"
                  alt=""/>
              </div>
            </div>
            <hr/>
            <?php break; ?>

          <?php case 'slide_6': ?>
            <div class="clearfix">
              <div class="titles">
                <h2><?php print $main_title; ?></h2>
                <h5><?php print $subtitle; ?></h5>
              </div>
              <div class="items">
                <div class="title">
                  <?php print render($content['field_30_year_slider_title_top']); ?>
                </div>
                <div class="title bottom">
                  <?php print render($content['field_30_year_slider_title_bot']); ?>
                </div>
                <div class="subtitle">approximately</div>
              </div>
            </div>
            <div class="thank-you">Thank You.</div>
            <?php break; ?>

          <?php endswitch; ?>


      </div>
    </div>

    <?php //print render($content); ?>
  </div>
</div>
