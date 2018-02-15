<?php
/**
 * @file Package info.
 */
?>


  <div class="column package-name"><?php print $data['name']; ?></div>
  <div class="column package-amount">
    <?php print !empty($data['total_amount']) ? '$' . number_format((float) $data['total_amount'], 2, '.', '') : ''; ?>
  </div>

  <div class="column package-type">
    <div class="package-coverage-type">
      <?php print !empty($data['coverage_type']) ? $data['coverage_type'] : ''; ?>
    </div>

    <?php if (!empty($data['coverages']) && !empty($data['coverages']->Included)): ?>
      <div class="show-coverages-link">
        <a href="#" data-toggle="modal"
           data-target="#<?php print !empty($data['id']) ? $data['id'] . '-' : ''; ?>coverages"><?php print t('Show All Coverages'); ?></a>
      </div>
      <div id="<?php print !empty($data['id']) ? $data['id'] . '-' : ''; ?>coverages"
           class="b-modal modal fade style-info" tabindex="-1" role="dialog"
           aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4><?php print $data['name'] . ' ' . t('coverages'); ?></h4>
              <a href="#" class="close close-btn" data-dismiss="modal">+</a>
            </div>

            <div class="modal-body">
              <?php foreach ($data['coverages']->Included as $delta => $coverage): ?>
                <div
                  class="coverage-item <?php print $delta % 2 ? 'odd' : 'even'; ?>">
                  <div class="coverage-limit">
                    <?php print !empty($coverage->coverageLimitDisplayText) ? $coverage->coverageLimitDisplayText : ''; ?>
                  </div>

                  <h5><?php print !empty($coverage->name) ? $coverage->name : ''; ?></h5>

                  <div class="coverage-description">
                    <?php print !empty($coverage->claimPayoutType) ? '<span class="claim-payout">' . $coverage->claimPayoutType . '</span><br>' : ''; ?>
                    <?php print !empty($coverage->description) ? $coverage->description : ''; ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>

            <?php if (!empty($data['doc_link'])): ?>
              <div class="modal-footer">
                <?php print l(t('Description of Coverages'), $data['doc_link'], array(
                  'attributes' => array(
                    'class' => array('doc-link'),
                    'target' => '_blank'
                  )
                )); ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>



