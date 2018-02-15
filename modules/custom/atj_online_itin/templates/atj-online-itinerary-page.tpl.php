<?php
/**
 * Itinerary main template
 */

?>

<?php if(!empty($main_image)):?>
    <div class="img main-image">
      <?php print render($main_image);?>
    </div>
<?php endif;?>
<div class="itinerary-headers">
    <h4><?php print filter_xss($tl);?></h4>
    <h6><?php print filter_xss($NameSforPrintedItins);?></h6>
</div>
<div class="b-itinerary">
    <div class="info">
        <?php if(!empty($ItineraryRecordType) && $ItineraryRecordType =='Agent'): ?>
            <div><?php print filter_xss($c_org);?></div>
            <div><?php print filter_xss($c_name);?></div>
            <div><?php print filter_xss($c_phone);?></div>
            <div><?php print filter_xss($c_mail);?></div>
        <?php else: ?>
        <div><?php print filter_xss($UserFullName);?></div>
        <div><?php print filter_xss($UserEmail);?>  </div>
        <div><?php print filter_xss($UserPhone);?>  </div>
        <?php endif; ?>
    </div>
    <div class="btns-wrap">
        <a class="print-button" href="javascript:window.print()"><span class="ss-icon ss-glyphish-filled ss-print"></span></a>
        <a class="print-button" href="<?php print $pdf_url ;?>" rel="nofollow"><span class="ss-icon ss-glyphish-filled ss-download"></span></a>
        <a class="link-control" href="#">
            <span><?php print t('EXPAND ALL'); ?></span>
            <span><?php print t('COLLAPSE ALL'); ?></span>
        </a>
    </div>
    <div class="items">
        <?php if(!empty($summary)):?>
          <?php foreach($summary as $summary_item): ?>
            <div class="item">
              <?php print $summary_item; ?>
            </div>
          <?php endforeach; ?>
        <?php endif;?>
    </div>
    <div class="hide-text">
        hide
        <span>hide</span>
    </div>
    <div class="itinerary-footer">
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