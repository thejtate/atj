<?php
/**
 * Itinerary main template
 */

?>
<div class="body-inner">
    <div class="section-top">
        <div class="bg" style="background-image: url('<?php print '/' . $theme_path . '/images/bg/bg-section-top-pdf.png'; ?>');"></div>
        <div class="title">
            <div class="sub-title">
              <?php print filter_xss($NameSforPrintedItins);?>
            </div>
            <h1>
                <?php if(!empty($type)): ?>
                  <?php print filter_xss(render($type))?>
                <?php else: ?>
                  PROPOSED ITINERARY
                <?php endif; ?>
            </h1>
            <?php print render($header_logos);?>
        </div>
    </div>
    <div class="itinerary-headers">
        <div class="container">
            <h2><?php print filter_xss($tl);?></h2>
        </div>
    </div>
    <div class="info">
      <?php if(!empty($ItineraryRecordType) && $ItineraryRecordType =='Agent'): ?>
          <span><?php print filter_xss($c_org);?></span>
          <span><?php print filter_xss($c_name);?></span>
          <span><?php print filter_xss($c_phone);?></span>
          <span><?php print filter_xss($c_mail);?></span>
      <?php else: ?>
          <span><?php print filter_xss($UserFullName);?></span>
          <span><?php print filter_xss($UserEmail);?>  </span>
          <span><?php print filter_xss($UserPhone);?>  </span>
      <?php endif; ?>
    </div>
    <div class="b-itinerary">
      <?php if(!empty($main_image)):?>
          <div class="img main-image">
              <div class="container">
                <?php print render($main_image);?>
              </div>
          </div>
      <?php endif;?>
        <div class="items">
            <?php if(!empty($summary)):?>
              <?php foreach($summary as $summary_item): ?>
                <div class="item">
                  <?php print $summary_item; ?>
                </div>
              <?php endforeach; ?>
            <?php endif;?>
        </div>
        <div class="itinerary-footer">
            <div class="container">
                <?php print render($footer_header);?>
                <?php if(!empty($cf)): ?>
                    <div class="text scrollbar-macosx">
                        <div class="text-inner">
                            <?php print render($cf);?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        </div>
    </div>
<div class="page-br"></div>
</div>