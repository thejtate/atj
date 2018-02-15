<?php
/**
 * @file Coverage cart.
 */
?>
<?php if (empty($packages)): ?>
  <div class="cart-empty">
    <?php print t('YOU HAVE NO ITEMS IN YOUR CART'); ?>
  </div>
<?php else: ?>
  <?php if (!empty($oc_items)): ?>
    <div class="cart-item">
      <h5 class="title"><?php print t('Optional Coverages'); ?></h5>
      <?php print $oc_items; ?>
    </div>
  <?php endif; ?>
  <?php print !empty($fees) ? $fees : ''; ?>
<?php endif; ?>
<div class="cart-footer">
  <span class="cart-title"><?php print t('Total:'); ?></span>
  <span class="total-amount">
    <?php print '$' . number_format((float) $total_amount, 2, '.', ''); ?>
  </span>
</div>