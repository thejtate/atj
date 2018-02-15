<?php
/**
 * @file
 * Form
 */

/**
 * After build page 1.
 */
function _atj_insurance_travel_insurance_after_build_1(&$form, &$form_state) {
  $f_submitted = &$form['submitted'];

  $add_traveler = '<div class="form-item">';
  $add_traveler .= '<input type="button" id="add-more-travelers" name="add_more" value="Add traveler">';
  $add_traveler .= '</div>';

  $f_submitted['travelers']['rows']['add_more'] = array(
    '#weight' => 99,
    '#markup' => $add_traveler
  );

  _atj_insurance_create_additional_age_rows($form, $form_state);

  $i = 1;
  foreach (element_children($f_submitted['travelers']['rows']) as $key) {
    if ($key != 'add_more' && $key != 'additional_travelers') {
      $f_submitted['travelers']['rows'][$key]['#attributes']['class'][] = 'atj-insurance-travelers-row';
      $f_submitted['travelers']['rows'][$key]['#attributes']['data-travelers-row-number'][] = $i;
      $i++;
    }
  }
}

/**
 * Form Validate page 1.
 */
function _atj_insurance_travel_insurance_validate_1(&$form, &$form_state) {
  $f_submitted = &$form['submitted'];
  $fs_submitted = &$form_state['values']['submitted'];
  $old_selected_packages_cost = array('total_amount' => 0);
  $selected_packages_cost = array('total_amount' => 0);

  _atj_insurance_travel_insurance_validate_dates($fs_submitted['dates']['departure_date'], $fs_submitted['dates']['return_date'], $f_submitted['dates']['return_date']);

  if (!form_get_errors()) {
    if (!empty($form_state['input']['submitted']['travelers']['rows'])) {
      $additional_travelers = $form_state['input']['submitted']['travelers']['rows'];
      if (isset($additional_travelers['row_1'])) {
        unset($additional_travelers['row_1']);
      }

      if (!empty($additional_travelers)) {
        $fs_submitted['travelers']['rows']['additional_travelers'] = serialize($additional_travelers);
      }
    }

    $session_exists = atj_insurance_cart_order_session_exists();
    if ($session_exists) {
      $old_selected_packages_cost = _atj_insurance_get_selected_packages_cost($form_state);
    }

    _atj_insurance_validate_packages_quick($form_state);
    if ($session_exists) {
      $selected_packages_cost = _atj_insurance_get_selected_packages_cost($form_state);
    }
  }

  if ($old_selected_packages_cost['total_amount'] != $selected_packages_cost['total_amount']) {
    $form_state['atj_insurance']['info'][] = t('Your pricing has been updated. Please review before proceeding.');
  }

  _atj_insurance_check_selected_packages_exists($form_state);

  if (empty($form_state['atj_insurance']['quote'])) {
    $form_state['rebuild'] = TRUE;
  }
}

/**
 * Form Alter page 1.
 */
function _atj_insurance_form_alter_1(&$form, &$form_state) {
  $f_submitted = &$form['submitted'];
  $errors = !empty($form_state['atj_insurance']['errors']) ?
    $form_state['atj_insurance']['errors'] : array();

  if (empty($form_state['triggering_element']) ||
    (!empty($form_state['triggering_element']) && ($form_state['triggering_element']['#value'] != 'Previous'))) {
    atj_insurance_cart_order_session_delete();
  }

  if (!empty($f_submitted['travelers']['rows']['additional_travelers'])) {
    $f_submitted['travelers']['rows']['additional_travelers']['#access'] = FALSE;
  }

  if (!empty($errors)) {
    $f_submitted['travelers_layout']['bhtp_errors'] = array(
      '#markup' => theme('atj_insurance_errors', array(
        'errors' => $errors,
      )),
    );
    $form_state['atj_insurance']['errors'] = array();
  }
}


/**
 *
 * Page 2.
 *
 */

/**
 * Form Validate page 2.
 */
function _atj_insurance_travel_insurance_validate_2(&$form, &$form_state) {
  $triggering_element = _atj_insurance_get_triggering_element($form_state);
  $package = !empty($triggering_element['package']) ? $triggering_element['package'] : '';
  $operation = !empty($triggering_element['operation']) ? $triggering_element['operation'] : '';
  $optional_coverages = !empty($triggering_element['optional_coverages']) ?
    $triggering_element['optional_coverages'] : '';
  $package_map = _atj_insurance_packages_map();
  $bhtp_packages = !empty($form_state['atj_insurance']['quote']) ?
    unserialize($form_state['atj_insurance']['quote']) : array();

  $f_packages = &$form['submitted']['packages_layout']['packages_wrapper']['packages'];
  $fs_packages = &$form_state['input']['submitted']['packages_layout']['packages_wrapper']['packages'];

  if (array_key_exists($package, $package_map)) {
    $form_state['values']['op'] = t('Save Draft');
    $form_state['submitted'] = FALSE;
    $form_state['rebuild'] = TRUE;

    if (!empty($optional_coverages)) {
      $oc_checked = _atj_insurance_check_oc_checked($form_state, $package, $optional_coverages);
      $operation = 'remove';

      if ($oc_checked) {
        $operation = 'add';

        if ($optional_coverages == 'crcc') {
          _atj_insurance_travel_insurance_validate_crcc($f_packages, $fs_packages, $package);
        }
      }
    }

    $errors = form_get_errors();
    switch ($operation) {
      case 'add':
        if (!$errors) {
          _atj_insurance_add_to_cart($package, $optional_coverages, $package_map, $bhtp_packages, $form_state);
        }
        break;
      case 'remove':
        $errors = !empty($errors) ? $errors : array();
        foreach ($errors as $error_key => $message) {
          atj_insurance_form_unset_error($error_key);
        }

        if (!empty($optional_coverages)) {
          atj_insurance_cart_order_session_delete_oc($package, $optional_coverages);
        }
        else {
          _atj_insurance_oc_uncheck($form_state, $package);
          atj_insurance_cart_order_session_delete_item($package);
        }
        break;
    }
  }
  else {
    $card_packages = atj_insurance_cart_order_session_get();
    foreach ($card_packages as $card_package_key => $card_package) {
      $card_oc = !empty($card_package['optional_coverages']) ?
        $card_package['optional_coverages'] : array();
      if (array_key_exists('crcc', $card_oc) && !empty($card_oc['crcc'])) {
        _atj_insurance_travel_insurance_validate_crcc($f_packages, $fs_packages, $card_package_key);
      }
    }
  }
}

/**
 * Form Alter page 2.
 */
function _atj_insurance_form_alter_2(&$form, &$form_state) {
  $f_submitted = &$form['submitted'];
  $form['#attributes']['class'][] = 'with-cart';
  $bhtp_packages = !empty($form_state['atj_insurance']['quote']) ?
    unserialize($form_state['atj_insurance']['quote']) : array();
  $error = empty($bhtp_packages) ? TRUE : FALSE;
  $info = !empty($form_state['atj_insurance']['info']) ?
    $form_state['atj_insurance']['info'] : array();

  $storage = _atj_insurance_get_webform_storage($form_state);
  $destination = !empty($storage['destination']) ? $storage['destination'] : '';
  $traveling_from = !empty($storage['traveling_from']) ? $storage['traveling_from'] : '';
  $departure_date = !empty($storage['departure_date']) ? $storage['departure_date'] : '';
  $return_date = !empty($storage['return_date']) ? $storage['return_date'] : '';
  $package_map = _atj_insurance_packages_map();
  $package_map = _atj_insurance_normalize_packages_map($package_map, $destination, $traveling_from, $departure_date, $return_date);

  foreach ($package_map as $map_package_key => $map_package) {
    $with_crcc = (!empty($map_package['optional_coverages']) &&
      in_array('crcc', $map_package['optional_coverages'])) ? TRUE : FALSE;

    if ($with_crcc) {
      $f_submitted['packages_layout']['packages_wrapper']['packages'][$map_package_key]['optional_coverages']['crcc_oc']['pickup_date_from']['#start_date'] = $storage['departure_date'];
      $f_submitted['packages_layout']['packages_wrapper']['packages'][$map_package_key]['optional_coverages']['crcc_oc']['pickup_date_from']['#end_date'] = $storage['return_date'];
      $f_submitted['packages_layout']['packages_wrapper']['packages'][$map_package_key]['optional_coverages']['crcc_oc']['pickup_date_to']['#start_date'] = $storage['departure_date'];
      $f_submitted['packages_layout']['packages_wrapper']['packages'][$map_package_key]['optional_coverages']['crcc_oc']['pickup_date_to']['#end_date'] = $storage['return_date'];
    }
  }

  $card_packages = atj_insurance_cart_order_session_get();
  if (empty($card_packages)) {
    $form['actions']['next']['#disabled'] = TRUE;
  }

  if (!$error) {
    _atj_insurance_normalize_packages($bhtp_packages);
    _atj_insurance_create_packages($form, $bhtp_packages);
    _atj_insurance_create_cart($f_submitted['packages_layout']['cart_sidebar'], $form_state, ATJ_INSURANCE_TRAVELER_PACKAGES_TAB);
  }
  else {
    $f_submitted['packages_layout']['#access'] = FALSE;
    $errors = !empty($form_state['atj_insurance']['errors']) ?
      $form_state['atj_insurance']['errors'] : array();

    $f_submitted['bhtp_errors'] = array(
      '#markup' => theme('atj_insurance_errors', array(
        'errors' => $errors,
      )),
    );
  }

  if (!empty($info)) {
    $f_submitted['travelers_layout']['bhtp_errors'] = array(
      '#markup' => theme('atj_insurance_errors', array(
        'errors' => $info,
      )),
    );
    $form_state['atj_insurance']['info'] = array();
  }
}


/**
 *
 * Page 3.
 *
 */

/**
 * Form Alter page 3.
 */
function _atj_insurance_form_alter_3(&$form, &$form_state) {
  $f_submitted = &$form['submitted'];
  $bhtp_packages = !empty($form_state['atj_insurance']['quote']) ?
    unserialize($form_state['atj_insurance']['quote']) : array();
  $f_travelers = &$form['submitted']['travelers_layout']['travelers'];
  $form['#attributes']['class'][] = 'with-cart';
  $errors = !empty($form_state['atj_insurance']['errors']) ?
    $form_state['atj_insurance']['errors'] : array();

  $storage = _atj_insurance_get_webform_storage($form_state);
  $trip_cost = !empty($storage['trip_cost']) ? $storage['trip_cost'] : 0;

  $f_submitted['travelers_layout']['travelers']['tl_additional_travelers']['#access'] = FALSE;
  $additional_travelers = !empty($storage['additional_travelers']) ?
    unserialize($storage['additional_travelers']) : array();

  $travelers = array();
  $age_fields = array('age_1', 'age_2', 'age_3', 'age_4');
  foreach ($age_fields as $field_name) {
    if (!empty($storage[$field_name])) {
      $travelers[] = $storage[$field_name];
    }
  }

  foreach ($additional_travelers as $new_traveler) {
    foreach ($age_fields as $field_name) {
      if (!empty($new_traveler[$field_name])) {
        $travelers[] = $new_traveler[$field_name];
      }
    }
  }

  $travelers_amount = count($travelers);
  $trip_cost_for_each = _atj_insurance_count_trip_cost_for_each($trip_cost, $travelers_amount, FALSE);

  if (empty($f_travelers['policyholder']['ph_trip_cost']['#default_value']) ||
    ($form_state['triggering_element']['#value'] == 'Next')) {
    $f_travelers['policyholder']['ph_trip_cost']['#default_value'] = $trip_cost_for_each['first'];
  }

  if (!empty($storage['traveling_from'])) {
    $f_travelers['policyholder']['ph_state']['#default_value'] = $storage['traveling_from'];
    $f_travelers['policyholder']['ph_state']['#attributes']['disabled'] = 'disabled';
  }

  if ($travelers_amount == 1) {
    $f_submitted['travelers_layout']['travelers']['traveler_2']['#attributes']['class'][] = 'element-invisible';
    foreach (element_children($f_submitted['travelers_layout']['travelers']['traveler_2']) as $key) {
      $f_submitted['travelers_layout']['travelers']['traveler_2'][$key]['#required'] = FALSE;
    }
  }
  elseif (($travelers_amount == 2) && (empty($f_travelers['traveler_2']['traveler_trip_cost']['#default_value']) ||
      ($form_state['triggering_element']['#value'] == 'Next'))) {
    $f_travelers['traveler_2']['traveler_trip_cost']['#default_value'] = $trip_cost_for_each['each'];
  }
  elseif ($travelers_amount > 2) {
    if (empty($f_travelers['traveler_2']['traveler_trip_cost']['#default_value']) ||
      ($form_state['triggering_element']['#value'] == 'Next')) {
      $f_travelers['traveler_2']['traveler_trip_cost']['#default_value'] = $trip_cost_for_each['each'];
    }
    _atj_insurance_create_additional_travelers($form, $travelers_amount, $trip_cost_for_each['each'], $storage, $form_state['triggering_element']['#value']);
  }

  _atj_insurance_create_cart($f_submitted['travelers_layout']['cart_sidebar'], $form_state, ATJ_INSURANCE_TRAVELER_DETAIL_TAB);

  if (!empty($errors)) {
    $f_submitted['travelers_layout']['travelers']['bhtp_errors'] = array(
      '#markup' => theme('atj_insurance_errors', array(
        'errors' => $errors,
      )),
    );
    $form_state['atj_insurance']['errors'] = array();
  }

  drupal_add_js(
    array(
      'atj_insurance' => array(
        'travelers_amount' => $travelers_amount,
      )
    ),
    'setting'
  );
}

/**
 * Form Validate page 3.
 */
function _atj_insurance_travel_insurance_validate_3(&$form, &$form_state) {
  $package_map = _atj_insurance_packages_map();
  $trip_cost_key = _atj_insurance_get_webform_storage_trip_cost_key($form_state);
  $trip_cost = !empty($form_state['storage']['submitted'][$trip_cost_key]) ?
    $form_state['storage']['submitted'][$trip_cost_key] : 0;
  $form_state['atj_insurance']['info'] = array();
  $new_trip_cost = 0;

  if (!empty($form_state['input']['submitted']['travelers_layout']['travelers'])) {
    $additional_travelers = $form_state['input']['submitted']['travelers_layout']['travelers'];
    if (isset($additional_travelers['policyholder'])) {
      if (!empty($additional_travelers['policyholder']['ph_trip_cost'])) {
        $new_trip_cost += (int)$additional_travelers['policyholder']['ph_trip_cost'];
      }
      unset($additional_travelers['policyholder']);
    }
    if (isset($additional_travelers['traveler_2'])) {
      if (!empty($additional_travelers['traveler_2']['traveler_trip_cost'])) {
        $new_trip_cost += (int)$additional_travelers['traveler_2']['traveler_trip_cost'];
      }
      unset($additional_travelers['traveler_2']);
    }

    if (!empty($additional_travelers)) {
      $form_state['values']['submitted']['travelers_layout']['travelers']['tl_additional_travelers'] = serialize($additional_travelers);
    }

    foreach ($additional_travelers as $traveler) {
      if (!empty($traveler['traveler_trip_cost'])) {
        $new_trip_cost += (int)$traveler['traveler_trip_cost'];
      }
    }
  }

  $trip_cost_changed = ($trip_cost != $new_trip_cost) ? TRUE : FALSE;
  if ($trip_cost != $new_trip_cost) {
    $form_state['storage']['submitted'][$trip_cost_key] = $new_trip_cost;
  }

  $old_selected_packages_cost = _atj_insurance_get_selected_packages_cost($form_state);
  _atj_insurance_validate_packages_full($form_state, ATJ_INSURANCE_TRAVELER_DETAIL_TAB, $trip_cost_changed);
  $selected_packages_cost = _atj_insurance_get_selected_packages_cost($form_state);

  if (!empty($form_state['atj_insurance']['errors'])) {
    $form_state['rebuild'] = TRUE;
  }

  if ($old_selected_packages_cost['total_amount'] != $selected_packages_cost['total_amount']) {
    $form_state['atj_insurance']['info'][] = t('Your pricing has been updated. Please review before proceeding.');
  }

  $card_packages = atj_insurance_cart_order_session_get();
  foreach ($card_packages as $cp_key => $card_package) {
    $with_flights = (!empty($package_map[$cp_key]) && !empty($package_map[$cp_key]['flights']));

    if (!$with_flights) {
      unset($card_packages[$cp_key]);
    }
  }

  if (empty($card_packages) && ($form_state['triggering_element']['#value'] == 'Next')) {
    $old_page = &$form_state['webform']['page_num'];
    $form_state['submitted'] = TRUE;
    $old_page = $old_page + 1;
  }

  _atj_insurance_check_selected_packages_exists($form_state);
}


/**
 *
 * Page 4.
 *
 */

/**
 * After build page 4.
 */
function _atj_insurance_travel_insurance_after_build_4(&$form, &$form_state) {
  $f_submitted = &$form['submitted'];
//  $storage = _atj_insurance_get_webform_storage($form_state);
//  $destination = !empty($storage['destination']) ? $storage['destination'] : '';
//  $air_packages = _atj_insurance_get_air_packages();
//  $air_packages = _atj_insurance_normalize_packages_map($air_packages, $destination);

  _atj_insurance_create_additional_flights($form, $form_state);
  _atj_insurance_create_add_flight_button($f_submitted);

}

/**
 * Form Alter page 4.
 */
function _atj_insurance_form_alter_4(&$form, &$form_state) {
  $storage = _atj_insurance_get_webform_storage($form_state);
  $destination = !empty($storage['destination']) ? $storage['destination'] : '';
  $package_map = _atj_insurance_packages_map();
  $package_map = _atj_insurance_normalize_packages_map($package_map, $destination);
  $f_filights = &$form['submitted']['flight_builder_layout']['flights'];
  $errors = !empty($form_state['atj_insurance']['errors']) ?
    $form_state['atj_insurance']['errors'] : array();
  $info = !empty($form_state['atj_insurance']['info']) ?
    $form_state['atj_insurance']['info'] : array();
  $form['#attributes']['class'][] = 'with-cart';
  $bhtp_packages = !empty($form_state['atj_insurance']['quote']) ?
    unserialize($form_state['atj_insurance']['quote']) : array();

  $f_filights['flight_1']['flight_date']['#start_date'] = $storage['departure_date'];
  $f_filights['flight_1']['flight_date']['#end_date'] = $storage['return_date'];

  if (!empty($f_filights['additional_flights'])) {
    $f_filights['additional_flights']['#access'] = FALSE;
  }

  _atj_insurance_create_cart($form['submitted']['flight_builder_layout']['cart_sidebar'], $form_state);

  if (!empty($errors)) {
    $f_filights['bhtp_errors'] = array(
      '#markup' => theme('atj_insurance_errors', array(
        'errors' => $errors,
      )),
    );
    $form_state['atj_insurance']['errors'] = array();
  }
  if (!empty($info)) {
    $f_filights['bhtp_errors'] = array(
      '#markup' => theme('atj_insurance_errors', array(
        'errors' => $info,
      )),
    );
    $form_state['atj_insurance']['info'] = array();
  }
}

/**
 * Form Validate page 4.
 */
function _atj_insurance_travel_insurance_validate_4(&$form, &$form_state) {
  _atj_insurance_travel_insurance_validate_flight($form, $form_state);

  if (!form_get_errors()) {
    if (!empty($form_state['input']['submitted']['flight_builder_layout']['flights'])) {
      $additional_flights = $form_state['input']['submitted']['flight_builder_layout']['flights'];
      if (isset($additional_flights['flight_1'])) {
        unset($additional_flights['flight_1']);
      }

      if (!empty($additional_flights)) {
        $form_state['values']['submitted']['flight_builder_layout']['flights']['additional_flights'] = serialize($additional_flights);
      }
    }

    $old_selected_packages_cost = _atj_insurance_get_selected_packages_cost($form_state);
    _atj_insurance_validate_packages_full($form_state, ATJ_INSURANCE_TRAVELER_FLIGHTS_TAB);
    $selected_packages_cost = _atj_insurance_get_selected_packages_cost($form_state);

    if ($old_selected_packages_cost['total_amount'] != $selected_packages_cost['total_amount']) {
      $form_state['atj_insurance']['info'][] = t('Your pricing has been updated. Please review before proceeding.');
    }
  }

  _atj_insurance_check_selected_packages_exists($form_state);

  if (!empty($form_state['atj_insurance']['errors'])) {
    $form_state['rebuild'] = TRUE;
  }
}

/**
 *
 * Page 5.
 *
 */

/**
 * After build page 5.
 */
function _atj_insurance_travel_insurance_after_build_5(&$form, &$form_state) {
  $package_map = _atj_insurance_packages_map();

  $card_packages = atj_insurance_cart_order_session_get();
  foreach ($card_packages as $cp_key => $card_package) {
    $with_flights = (!empty($package_map[$cp_key]) && !empty($package_map[$cp_key]['flights']));

    if (!$with_flights) {
      unset($card_packages[$cp_key]);
    }
  }

  if (empty($card_packages) && ($form_state['triggering_element']['#value'] == 'Previous')) {
    $old_page = &$form_state['webform']['page_num'];
    $form_state['submitted'] = TRUE;
    $old_page = $old_page - 1;
  }
}

/**
 * Form Alter page 5.
 */
function _atj_insurance_form_alter_5(&$form, &$form_state) {
  $f_submitted = &$form['submitted'];
  $bhtp_packages = !empty($form_state['atj_insurance']['quote']) ?
    unserialize($form_state['atj_insurance']['quote']) : array();
  $form['#attributes']['class'][] = 'with-cart';
  $errors = !empty($form_state['atj_insurance']['errors']) ?
    $form_state['atj_insurance']['errors'] : array();
  $info = !empty($form_state['atj_insurance']['info']) ?
    $form_state['atj_insurance']['info'] : array();

  $form['submitted']['policy']['#access'] = FALSE;
  $form['submitted']['order']['#access'] = FALSE;

  if (!empty($errors)) {
    $f_submitted['bhtp_errors'] = array(
      '#markup' => theme('atj_insurance_errors', array(
        'errors' => $errors,
      )),
    );
    $form_state['atj_insurance']['errors'] = array();
  }
  if (!empty($info)) {
    $f_submitted['bhtp_errors'] = array(
      '#markup' => theme('atj_insurance_errors', array(
        'errors' => $info,
      )),
    );
    $form_state['atj_insurance']['info'] = array();
  }

  if (!empty($form['submitted']['billing_info_layout']['card']['terms_conditions'])) {
    $terms = &$form['submitted']['billing_info_layout']['card']['terms_conditions'];
    $terms_conditions_link = l(t('Terms & Conditions'), 'https://www.bhtp.com/legal/terms-conditions',array('attributes' => array('target'=>'_blank')));
    $fraud_link = l(t('Fraud Warning'), 'https://www.bhtp.com/legal/fraud-warning',array('attributes' => array('target'=>'_blank')));
    $terms['#options']['read_and_agree_with_terms'] = str_replace('Terms & Conditions', $terms_conditions_link, $terms['#options']['read_and_agree_with_terms']);
    $terms['#options']['read_and_agree_with_terms'] = str_replace('Fraud Warning', $fraud_link, $terms['#options']['read_and_agree_with_terms']);
  }

  _atj_insurance_create_cart($f_submitted['billing_info_layout']['cart_sidebar'], $form_state, ATJ_INSURANCE_TRAVELER_BILLING_TAB);
  _atj_insurance_set_autocomplete_off_attribure($form);
}

/**
 * Form Validate page 5.
 */
function _atj_insurance_travel_insurance_validate_5(&$form, &$form_state) {
  $selected_packages_cost = _atj_insurance_get_selected_packages_cost($form_state);
  if (!empty($selected_packages_cost)) {
    $form_state['values']['submitted']['order'] = serialize($selected_packages_cost);
  }

  _atj_insurance_purchase($form, $form_state);

  if (!empty($form_state['atj_insurance']['errors'])) {
    $form_state['rebuild'] = TRUE;
  }
}