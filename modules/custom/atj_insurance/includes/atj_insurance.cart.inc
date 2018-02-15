<?php
/**
 * @file
 * Cart
 */

/**
 * Saves an order to the appropriate cart orders session variable.
 */
function atj_insurance_cart_order_session_save($data) {
  $key = 'atj_insurance_cart_order';
  $data_value = reset($data);
  $data_key = key($data);
  $optional_coverages = !empty($data[$data_key]['optional_coverages']) ? $data[$data_key]['optional_coverages'] : '';
  $optional_coverages_key = !empty($optional_coverages) ? key($optional_coverages) : '';
  $optional_coverages_value = !empty($optional_coverages) ? reset($optional_coverages) : '';

  if (empty($_SESSION[$key])) {
    $_SESSION[$key] = array($data_key => $data_value);
  }
  elseif (empty($_SESSION[$key][$data_key])) {
    $_SESSION[$key][$data_key] = $data_value;
  }
  else {
    $_SESSION[$key][$data_key]['optional_coverages'][$optional_coverages_key] = $optional_coverages_value;
  }
}

/**
 * Checks session exists.
 */
function atj_insurance_cart_order_session_exists() {
  $key = 'atj_insurance_cart_order';
  return !empty($_SESSION[$key]);
}

/**
 * Checks session exists.
 */
function atj_insurance_cart_order_session_package($package) {
  $key = 'atj_insurance_cart_order';
  return (!empty($_SESSION[$key]) && !empty($_SESSION[$key][$package]));
}

/**
 * Checks session get data.
 */
function atj_insurance_cart_order_session_get() {
  $key = 'atj_insurance_cart_order';
  return !empty($_SESSION[$key]) ? $_SESSION[$key] : array();
}

/**
 * Deletes all order from session variable.
 */
function atj_insurance_cart_order_session_delete() {
  $key = 'atj_insurance_cart_order';

  if (!empty($_SESSION[$key])) {
    unset($_SESSION[$key]);
  }
}

/**
 * Deletes item from session variable.
 */
function atj_insurance_cart_order_session_delete_item($data) {
  $key = 'atj_insurance_cart_order';

  if (!empty($_SESSION[$key][$data])) {
    unset($_SESSION[$key][$data]);
  }
}

/**
 * Deletes optional coverage from session variable.
 */
function atj_insurance_cart_order_session_delete_oc($package, $oc) {
  $key = 'atj_insurance_cart_order';

  if (!empty($_SESSION[$key][$package]) && isset($_SESSION[$key][$package]['optional_coverages'][$oc])) {
    unset($_SESSION[$key][$package]['optional_coverages'][$oc]);
  }
}

/**
 * Add package to cart.
 *
 * @param $package
 * @param $optional_coverages
 * @param $package_map
 * @param $bhtp_packages
 * @param $form_state
 */
function _atj_insurance_add_to_cart($package, $optional_coverages, $package_map, $bhtp_packages, $form_state) {
  $cart_packages = atj_insurance_cart_order_session_get();
  $oc_data = array();

  if (!empty($optional_coverages)) {
    $bhtp_oc_all = !empty($bhtp_packages[$package]->coverages->Optional) ?
      $bhtp_packages[$package]->coverages->Optional : array();
    $bhtp_oc = !empty($bhtp_oc_all[$optional_coverages]) ?
      $bhtp_oc_all[$optional_coverages] : '';

    if (!empty($bhtp_oc)) {
      $oc_data[$optional_coverages] = _atj_insurance_check_oc_checked($form_state, $package, $optional_coverages);

      if (!empty($oc_data[$optional_coverages])) {
        switch ($optional_coverages) {
          case 'fau':
            $oc_data[$optional_coverages] = !empty($form_state['input']['submitted']['packages_layout']['packages_wrapper']['packages'][$package]['optional_coverages']['fau_oc']['coverage_limit']) ?
              $form_state['input']['submitted']['packages_layout']['packages_wrapper']['packages'][$package]['optional_coverages']['fau_oc']['coverage_limit'] : FALSE;
            break;
          case 'crcc':
            $date_from = !empty($form_state['input']['submitted']['packages_layout']['packages_wrapper']['packages'][$package]['optional_coverages']['crcc_oc']['pickup_date_from']) ?
              $form_state['input']['submitted']['packages_layout']['packages_wrapper']['packages'][$package]['optional_coverages']['crcc_oc']['pickup_date_from'] : '';
            $date_to = !empty($form_state['input']['submitted']['packages_layout']['packages_wrapper']['packages'][$package]['optional_coverages']['crcc_oc']['pickup_date_to']) ?
              $form_state['input']['submitted']['packages_layout']['packages_wrapper']['packages'][$package]['optional_coverages']['crcc_oc']['pickup_date_to'] : '';

            $departure_date = (!empty($date_from) && is_array($date_from) &&
              (!empty($date_from['year']))) ? new DateTime(implode('-', $date_from)) : '';
            $return_date = (!empty($date_to) && is_array($date_to) &&
              !empty($date_to['year'])) ? new DateTime(implode('-', $date_to)) : '';

            if (!empty($departure_date) && !empty($return_date)) {
              $oc_data[$optional_coverages] = array(
                'pickup_date' => $departure_date->format('Y-m-d'),
                'return_date' => $return_date->format('Y-m-d'),
              );
            }
            break;
        }
      }
    }
  }

  $session_package = array(
    $package => array(
      'name' => $package_map[$package]['name'],
      'optional_coverages' => $oc_data,
    ),
  );

  switch ($package) {
    case 'exact_care_extra':
      if (empty($cart_packages) || ((count($cart_packages) == 1) && !empty($cart_packages['exact_care_extra']))) {
        atj_insurance_cart_order_session_save($session_package);
      }
      break;
    case 'exact_care_value':
      if (empty($cart_packages['exact_care']) &&
        empty($cart_packages['exact_care_family']) &&
        empty($cart_packages['exact_care_extra'])
      ) {
        atj_insurance_cart_order_session_save($session_package);
      }
      break;
    case 'exact_care':
      if (empty($cart_packages['exact_care_value']) &&
        empty($cart_packages['exact_care_family']) &&
        empty($cart_packages['exact_care_extra'])
      ) {
        atj_insurance_cart_order_session_save($session_package);
      }
      break;
    case 'exact_care_family':
      if (empty($cart_packages['exact_care']) &&
        empty($cart_packages['exact_care_value']) &&
        empty($cart_packages['exact_care_extra'])
      ) {
        atj_insurance_cart_order_session_save($session_package);
      }
      break;
    case 'air_care':
      if (empty($cart_packages['air_care_abroad']) &&
        empty($cart_packages['exact_care_extra'])
      ) {
        atj_insurance_cart_order_session_save($session_package);
      }
      break;
    case 'air_care_abroad':
      if (empty($cart_packages['air_care']) &&
        empty($cart_packages['exact_care_extra'])
      ) {
        atj_insurance_cart_order_session_save($session_package);
      }
      break;
  }
}

/**
 * Get optional coverages price.
 *
 * @param $bhtp_oc
 * @param $form_state
 * @param $optional_coverages
 * @param $package
 * @return int
 */
function _atj_insurance_get_oc_price($bhtp_oc, $oc_value, $optional_coverages, $package) {
  $oc_price = 0;

  switch ($optional_coverages) {
    case 'cfar':
    case 'med':
    case 'eeu':
      $oc_price = !empty($bhtp_oc->premium) ? $bhtp_oc->premium : 0;
      break;
    case 'fau':
      $quote_limits = !empty($bhtp_oc->premiumsByLimit) ?
        $bhtp_oc->premiumsByLimit : '';

      if (!empty($oc_value) && !empty($quote_limits)) {
        $oc_price = !empty($quote_limits->$oc_value) ? $quote_limits->$oc_value : 0;
      }

      if (empty($oc_price) && !empty($bhtp_oc->premium)) {
        $oc_price = $bhtp_oc->premium;
      }
      break;
    case 'crcc':
      if (!empty($oc_value)) {
        $pickup_date = $oc_value['pickup_date'];
        $return_date = $oc_value['return_date'];

        $departure_date = new DateTime($pickup_date);
        $return_date = new DateTime($return_date);

        $interval = $departure_date->diff($return_date);
        $days = $interval->days;
        $days++;

        $oc_price = !empty($bhtp_oc->premiumsByDay->$days) ? $bhtp_oc->premiumsByDay->$days : 0;
      }
      break;
  }

  return $oc_price;
}