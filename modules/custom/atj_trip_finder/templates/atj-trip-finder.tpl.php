<?php
/**
 * Trips theming
 */
?>

<?php foreach($countries as $country => $trips_info): ?>

  <div class="b-table style-c">
      <table>
        <tbody><tr>
          <td colspan="2"><h4><?php print check_plain($country)?></h4></td>
        </tr>
        <tr>
          <td><h6><?php print t('CUSTOM TRIPS'); ?></h6></td>
          <td>
            <?php if(!empty($trips_info['tailored_trips']->average_price)): ?>
              <?php print t('Averaging $!price per day*', array('!price' => $trips_info['tailored_trips']->average_price)); ?>
            <?php endif; ?>
            <?php if(!empty($trips_info['tailored_trips']->nid)): ?>
              <?php print l('learn more', 'node/' . $trips_info['tailored_trips']->nid)?> or
            <?php endif; ?>
            contact a <a href="<?php print $travel_specialist_url;?>">Travel Expert</a>.
          </td>
        </tr>
        <?php //print row twice for mobile and desktop version?>
        <?php foreach(array('mobile', 'desktop') as $type): ?>

          <?php if($type == 'mobile' && empty($trips_info['group_trips'])){
            continue;//don't print mobile row for empty trips
          }?>

          <tr<?php print $type =='mobile' ? ' class="mobile-only tablet-only"' : '';?>>

            <td<?php print $type =='mobile' ? ' colspan="2"' : '';?>>
              <h6><?php print t('small group trips'); ?></h6>

              <?php if($type =='desktop'): //print header in separate td for desktop?>
                </td>
                <td>
              <?php endif; ?>


              <?php if(!empty($trips_info['group_trips'])): ?>
              <div class="scrollable">
                <table class="table-small">
                  <tbody><tr>
                    <td><?php print $year;?></td>
                    <?php foreach($months as $month): ?>
                        <td><?php print strtoupper($month)?></td>
                    <?php endforeach; ?>
                  </tr>
                  <?php foreach($trips_info['group_trips'] as $trip_info): ?>

                    <tr>
                      <td>
                        <?php $first_trip_info_obj = reset($trip_info);?>
                        <span class="text"><?php print $first_trip_info_obj->node_title?></span>
                        <?php if(!empty($first_trip_info_obj->pdf_link)): ?>
                          <?php print $first_trip_info_obj->pdf_link;?>
                        <?php endif; ?>
                      </td>
                      <?php foreach($months as $month): ?>
                        <td>
                          <?php foreach($trip_info as $trip_info_item): ?>
                              <?php if($trip_info_item->month == $month): ?>

                              <a class="val" data-target-tooltip="#tooltip-<?php print $trip_info_item->month . '-' . $trip_info_item->nid?>">
                                <?php print $trip_info_item->date_day?>
                              </a>

                              <?php endif; ?>
                          <?php endforeach; ?>
                        </td>
                      <?php endforeach; ?>
                    </tr>

                  <?php endforeach; ?>

                  </tbody></table>
              </div>
              <?php else: ?>
                <?php print t('Currently, no Group Trips are available within the selected time frame for this destination.'); ?>
              <?php endif; ?>

            </td>
          </tr>
        <?php endforeach; ?>
        </tbody></table>
  </div>

<?php endforeach; ?>
<div class="tooltips">
  <?php foreach($countries as $country => $trips_info): ?>
    <?php if(!empty($trips_info['group_trips'])): ?>
      <?php foreach($trips_info['group_trips'] as $trip_info): ?>

        <?php foreach($trip_info as $trip_info_item): ?>
          <span class="table-tooltip" id="tooltip-<?php print $trip_info_item->month . '-' . $trip_info_item->nid?>">
          <span class="left-part">
            <span class="price"><?php print $trip_info_item->cost ?></span>
            <?php if (!empty($trip_info_item->{'number of days'})): ?>
              (<?php print format_plural(
                $trip_info_item->{'number of days'},
                '!count day',
                '!count days',
                array('!count' => $trip_info_item->{'number of days'})
              ) ?>)
            <?php endif; ?>
          </span>

          <span class="right-part"><?php print($trip_info_item->teaser) ?></span>
        </span>
        <?php endforeach; ?>

      <?php endforeach; ?>
    <?php endif; ?>
  <?php endforeach; ?>
</div>