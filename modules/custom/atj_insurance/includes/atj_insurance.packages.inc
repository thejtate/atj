<?php
/**
 * @file
 * Packages
 */

/**
 * Create packages.
 *
 * @param $form
 * @param array $bhtp_packages
 */
function _atj_insurance_create_packages(&$form, $bhtp_packages = array()) {
  $packages_map = _atj_insurance_packages_map();
  $form['submitted']['packages_layout']['packages_wrapper']['packages']['header'] = array(
    '#markup' => theme('atj_insurance_packages_header'),
  );

  foreach ($packages_map as $package => $package_data) {
    $bhtp_package = !empty($bhtp_packages[$package]) ? $bhtp_packages[$package] : '';

    if (!empty($package_data['available']) && !empty($bhtp_package)) {
      _atj_insurance_create_package($form, $package, $bhtp_package);
    }
    else {
      $form['submitted']['packages_layout']['packages_wrapper']['packages'][$package]['#access'] = FALSE;
    }
  }
}

/**
 * Create package.
 *
 * @param $form
 * @param $package
 * @param $bhtp_package
 * @throws \Exception
 */
function _atj_insurance_create_package(&$form, $package, $bhtp_package) {
  $data = array();
  $packages_map = _atj_insurance_packages_map();
  $data['name'] = !empty($bhtp_package->packageName) ? $bhtp_package->packageName : '';
  $data['name'] = ($package == 'air_care_abroad') ? t('AirCare Abroad') : $data['name'];
  $data['base_amount'] = !empty($bhtp_package->baseQuoteAmount) ? $bhtp_package->baseQuoteAmount : 0;
  $data['total_fees'] = !empty($bhtp_package->packageFee) ? $bhtp_package->packageFee : 0;
  $data['total_amount'] = $data['base_amount'] + $data['total_fees'];
  $data['coverages'] = !empty($bhtp_package->coverages) ? $bhtp_package->coverages : '';
  $data['doc_link'] = !empty($bhtp_package->docLink) ? $bhtp_package->docLink : '';
  $data['id'] = !empty($packages_map[$package]['id']) ? $packages_map[$package]['id'] : '';
  $data['coverage_type'] = !empty($packages_map[$package]['coverage_type']) ?
    $packages_map[$package]['coverage_type'] : '';

  if (!empty($form['submitted']['packages_layout']['packages_wrapper']['packages'][$package])) {
    $f_package = &$form['submitted']['packages_layout']['packages_wrapper']['packages'][$package];
    $recommended = !empty($packages_map[$package]['recommended']) ?
      '<div class="package-recommended">' . t("Recommended") . '</div>' : '';

    if (!empty($recommended)) {
      $f_package['package_info']['recommended'] = array(
          '#markup' => $recommended,
        );
    }

    $claim_payout = _atj_insurance_get_oc_claim_payout($data);
    $data['claim_payout'] = !empty($claim_payout) ? implode(", ", $claim_payout) : '';

    $f_package['package_info']['package_row'] = array(
      '#type' => 'container',
      '#attributes' => array(
        'class' => array(
          'package-info',
          'packages-row',
        ),
      ),
    );

    $f_package['package_info']['package_row']['info'] = array(
      '#type' => 'markup',
      '#markup' => theme('atj_insurance_package_item', array('data' => $data)),
    );

    _atj_insurance_create_add_button($f_package['package_info']['package_row'], $package, $data['claim_payout']);
    _atj_insurance_create_optional_coverages($f_package, $package, $bhtp_package);
  }
}

/**
 * Create add to cart button.
 *
 * @param $f_package
 * @param $package_id
 */
function _atj_insurance_create_add_button(&$f_package, $package_id, $claim_payout) {
  $packages_map = _atj_insurance_packages_map();
  $id = $packages_map[$package_id]['id'] . '-add-to-cart';
  $selected_packages = atj_insurance_cart_order_session_get();

  $f_package['package_payout'] = array(
    '#type' => 'container',
    '#attributes' => array(
      'class' => array(
        'column',
        'package-payout',
      ),
    ),
  );

  if (!empty($claim_payout)) {
    $f_package['package_payout']['claim_payout'] = array(
      '#markup' => '<div class="package-claim-payout">' . $claim_payout . '</div>',
    );
  }

  $f_package['package_payout']['add_to_cart'] = array(
    '#prefix' => '<div id="' . $id . '" class="optional-btn">',
    '#suffix' => '</div>',
    '#value' => t("Add to cart"),
    '#name' => $package_id . '__add',
    '#disabled' => !empty($selected_packages[$package_id]),
    '#type' => 'submit',
    '#ajax' => array(
      'callback' => 'atj_insurance_ajax_package_add_to_cart',
      'wrapper' => 'webform-ajax-wrapper-' . ATJ_INSURANCE_WEBFORM_ID,
    ),
  );
}

/**
 * Create optional coverages.
 *
 * @param $f_package
 * @param $package
 * @param $bhtp_package
 */
function _atj_insurance_create_optional_coverages(&$f_package, $package, $bhtp_package) {
  $bhtp_oc = (!empty($bhtp_package->coverages->Optional)) ?
    $bhtp_package->coverages->Optional : '';
  $packages_map = _atj_insurance_packages_map();
  $oc_map = !empty($packages_map[$package]['optional_coverages']) ?
    $packages_map[$package]['optional_coverages'] : array();
  $selected_packages = atj_insurance_cart_order_session_get();

  if (!empty($oc_map)) {
    $oc_id = $packages_map[$package]['id'] . '-optional-coverages';
    $f_package['optional_coverages']['#prefix'] = '<div id="' . $oc_id . '" class="optional-coverages">';
    $f_package['optional_coverages']['#suffix'] = '</div>';
  }

  foreach ($oc_map as $oc_key) {
    $bhtp_coverage = !empty($bhtp_oc[$oc_key]) ? $bhtp_oc[$oc_key] : '';
    $description = !empty($bhtp_coverage->description) ? $bhtp_coverage->description : '';
    $claim_payout_type = !empty($bhtp_coverage->claimPayoutType) ? $bhtp_coverage->claimPayoutType : '';

    if (!empty($f_package['optional_coverages'][$oc_key . '_oc'][$oc_key])) {
      $oc = &$f_package['optional_coverages'][$oc_key . '_oc'][$oc_key];
      if (!empty($claim_payout_type)) {
        $oc['#description'] = '<span class="claim-payout">' . $claim_payout_type . '</span><br>';
      }
      if (!empty($description)) {
        $oc['#description'] .= $description;
      }

      if (!empty($oc['#default_value'])) {
        $oc_selected = (!empty($selected_packages[$package]) && isset($selected_packages[$package]['optional_coverages'][$oc_key])) ?
          TRUE : FALSE;
        $oc_item_key = !empty($oc['#webform_component']['extra']['items']) ?
          $oc['#webform_component']['extra']['items'] : '';
        $oc_item_key = explode('|', $oc_item_key);
        $oc_item_key = !empty($oc_item_key[0]) ? $oc_item_key[0] : 0;

        $oc['#default_value'][0] = $oc_selected ? $oc_item_key : 0;
      }
    }

    if (!empty($bhtp_coverage) && !empty($f_package['optional_coverages'][$oc_key . '_oc'])) {
      if ($oc_key == 'crcc') {
        $f_package['optional_coverages']['crcc_oc']['pickup_date_from']['#attributes'] = array(
          'class' => array($packages_map[$package]['id'] . '--oc--' . $oc_key . '--pickup-date-from')
        );
        $f_package['optional_coverages']['crcc_oc']['pickup_date_to']['#attributes'] = array(
          'class' => array($packages_map[$package]['id'] . '--oc--' . $oc_key . '--pickup-date-to')
        );
      }
    }
    elseif (!empty($f_package['optional_coverages'][$oc_key . '_oc'])) {
      $f_package['optional_coverages'][$oc_key . '_oc']['#access'] = FALSE;
    }
  }
}

/**
 * Create cart.
 *
 * @param $f_cart
 * @param $form_state
 * @param int $page_number
 * @throws \Exception
 */
function _atj_insurance_create_cart(&$f_cart, $form_state, $page_number = 0) {
  $selected_packages = atj_insurance_cart_order_session_get();
  $count = !empty($selected_packages) ? count($selected_packages) : 0;
  $bhtp_packages = !empty($form_state['atj_insurance']['quote']) ?
    unserialize($form_state['atj_insurance']['quote']) : array();
  $fees = '';
  $oc_items = '';

  $selected_packages_cost = _atj_insurance_get_selected_packages_cost($form_state);
  $total_amount = !empty($selected_packages_cost['total_amount']) ?
    $selected_packages_cost['total_amount'] : 0;

  $f_cart['coverage_cart'] = array(
    '#type' => 'container',
    '#attributes' => array(
      'class' => array(
        'coverage-cart',
      ),
      'id' => 'coverage-cart',
    ),
  );

  $cart = &$f_cart['coverage_cart'];

  $cart['cart_header'] = array(
    '#type' => 'markup',
    '#markup' => theme('atj_insurance_coverage_cart_header', array('count' => $count)),
  );

  foreach ($selected_packages as $package_key => $package_data) {
    $package = !empty($bhtp_packages[$package_key]) ?
      $bhtp_packages[$package_key] : array();
    $optional_coverages = !empty($package_data['optional_coverages']) ?
      $package_data['optional_coverages'] : array();

    if (!empty($package)) {
      $name = !empty($package->packageName) ? $package->packageName : '';
      $name = ($package_key == 'air_care_abroad') ? t('AirCare Abroad') : $name;
      $base_amount = !empty($selected_packages_cost[$package_key]['base_amount']) ?
        $selected_packages_cost[$package_key]['base_amount'] : 0;
      $total_fees = !empty($selected_packages_cost[$package_key]['total_fees']) ?
        $selected_packages_cost[$package_key]['total_fees'] : 0;

      foreach ($optional_coverages as $oc_key => $oc_value) {
        $bhtp_oc_all = !empty($package->coverages->Optional) ?
          $package->coverages->Optional : array();
        $bhtp_oc = !empty($bhtp_oc_all[$oc_key]) ? $bhtp_oc_all[$oc_key] : '';
        $oc_price = !empty($selected_packages_cost[$package_key][$oc_key]) ?
          $selected_packages_cost[$package_key][$oc_key] : 0;

        if (!empty($oc_value) && isset($oc_price)) {
          $oc_name = (!empty($bhtp_oc->shortName)) ? $bhtp_oc->shortName : $bhtp_oc->name;

          $oc_items .= theme('atj_insurance_coverage_cart_oc', array(
            'name' => $oc_name,
            'amount' => $oc_price,
          ));
        }
      }

      $fees .= theme('atj_insurance_coverage_cart_package_fees', array(
        'name' => $name . ' ' . t('Fees'),
        'amount' => $total_fees,
      ));

      $cart[$package_key] = array(
        '#type' => 'fieldset',
        '#attributes' => array(
          'class' => array(
            'cart-item',
          ),
        ),
      );

      if ($page_number == ATJ_INSURANCE_TRAVELER_PACKAGES_TAB) {
        $cart[$package_key]['remove_from_cart'] = array(
          '#value' => '+',
          '#name' => $package_key . '__remove',
          '#type' => 'submit',
          '#ajax' => array(
            'callback' => 'atj_insurance_ajax_package_remove_from_cart',
            'wrapper' => 'webform-ajax-wrapper-' . ATJ_INSURANCE_WEBFORM_ID,
          ),
        );
      }

      $cart[$package_key]['package_item'] = array(
        '#type' => 'markup',
        '#markup' => theme('atj_insurance_coverage_cart_package_info', array(
          'name' => $name,
          'base_amount' => $base_amount,
        )),
      );
    }
  }

  $cart['info'] = array(
    '#type' => 'markup',
    '#markup' => theme('atj_insurance_coverage_cart', array(
        'packages' => $selected_packages,
        'oc_items' => $oc_items,
        'fees' => $fees,
        'total_amount' => $total_amount,
      )
    ),
  );

  if ($page_number == -1) {
    $cart['buy_now'] = array(
      '#value' => t("Buy now"),
      '#name' => 'coverage_cart__buy_now',
      '#type' => 'submit',
      '#disabled' => empty($selected_packages) ? TRUE : FALSE,
      '#ajax' => array(
        'callback' => 'atj_insurance_ajax_cart_buy_now',
        'wrapper' => 'webform-ajax-wrapper-' . ATJ_INSURANCE_WEBFORM_ID,
      ),
    );
  }
}

/**
 * Create add flight button.
 *
 * @param $f_submitted
 * @param $package
 */
function _atj_insurance_create_add_flight_button(&$f_submitted) {
  $add_flight = '<div class="form-item">';
  $add_flight .= '<input type="button" id="add-flight" name="add_more" value="Add another flight">';
  $add_flight .= '</div>';
  $add_more_weight = 0;

  $i = 1;
  foreach (element_children($f_submitted['flight_builder_layout']['flights']) as $key) {
    if ($key != 'add_more' && $key != 'additional_flights' && $key != 'flights_title') {
      $f_submitted['flight_builder_layout']['flights'][$key]['#attributes']['class'][] = 'atj-insurance-flight-row';
      $f_submitted['flight_builder_layout']['flights'][$key]['#attributes']['data-flight-row-number'][] = $i;
      $invisible = ($i == 1) ? 'element-invisible' : '';

      $remove_flight = '<div class="form-item">';
      $remove_flight .= '<input type="button" class="remove-flight ' . $invisible . '" data-flight-row-number="' . $i . '" value="Remove">';
      $remove_flight .= '</div>';
      $f_submitted['flight_builder_layout']['flights'][$key]['remove'] = array(
        '#weight' => 99,
        '#markup' => $remove_flight
      );

      if ($f_submitted['flight_builder_layout']['flights'][$key]['#weight'] > $add_more_weight) {
        $add_more_weight = $f_submitted['flight_builder_layout']['flights'][$key]['#weight'];
      }

      $i++;
    }
  }

  $f_submitted['flight_builder_layout']['flights']['add_more'] = array(
    '#weight' => ++$add_more_weight,
    '#markup' => $add_flight
  );
}

function _atj_insurance_get_oc_claim_payout($data) {
  $claim_payout = array();

  if (!empty($data['coverages']->Included)) {
    $included_coverages = $data['coverages']->Included;
    foreach ($included_coverages as $coverage) {
      if (!empty($coverage->claimPayoutType)) {
        $claim_payout[] = $coverage->claimPayoutType;
      }
    }
  }
  if (!empty($data['coverages']->Optional)) {
    $optional_coverages = $data['coverages']->Optional;
    foreach ($optional_coverages as $coverage) {
      if (!empty($coverage->claimPayoutType)) {
        $claim_payout[] = $coverage->claimPayoutType;
      }
    }
  }
  if (!empty($claim_payout)) {
    $claim_payout = array_unique($claim_payout);
    foreach($claim_payout as $cp_key => $cp_value) {
      if ($cp_value == 'Reimbursement') {
        $claim_payout[$cp_key] = t('Reimbursed Expenses');
      }
      if ($cp_value == 'Fixed') {
        $claim_payout[$cp_key] = t('Fixed Benefit');
      }
    }
  }

  return $claim_payout;
}
