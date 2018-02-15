<?php
/**
 * @file Package header.
 */
?>

<div class="packages-header">
  <div class="packages-row">
    <div class="column">
      <?php print t('Product'); ?>
    </div>
    <div class="column">
      <?php print t('Price'); ?>
    </div>
    <div class="column">
      <?php print t('Coverage Type'); ?>
      <a href="#" data-toggle="modal" data-target="#coverage-type">?</a>
      <div id="coverage-type"
           class="b-modal modal fade style-info" tabindex="-1" role="dialog"
           aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4>Coverage Type</h4>
              <a href="#" class="close close-btn" data-dismiss="modal">+</a>
            </div>

            <div class="modal-body">
              <p>"Comprehensive" coverage covers trip cancellation and interruption, many emergency medical expenses, and more.
                "Flight protection" coverage covers flight cancellations, missed connections, flight delays, and baggage issues.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="column">
      <?php print t('Claim Payout'); ?>
      <a href="#" data-toggle="modal" data-target="#claim-payout-type">?</a>
      <div id="claim-payout-type"
           class="b-modal modal fade style-info" tabindex="-1" role="dialog"
           aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4>Claim Payout</h4>
              <a href="#" class="close close-btn" data-dismiss="modal">+</a>
            </div>

            <div class="modal-body">
              <p>With "reimbursed coverages," you're paid for actual expenses incurred on your trip.
                Fixed benefits are specified amounts that you're paid for certain types of coverages.
                For instance, if you have ExactCare® Extra™ and your luggage is lost, we first work with you to establish that your luggage is indeed lost, and then we pay you $500.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>