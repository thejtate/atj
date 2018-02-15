<?php

/**
 * @file atj insurance helpers
 */

function _atj_insurance_validate_packages_quick(&$form_state) {
  $input = _atj_insurance_create_input_quick($form_state);
  $data = _atj_insurance_create_quote_data($input);

  $quote = array();
  $destination = !empty($input['destination']) ? $input['destination'] : '';
  $traveling_from = !empty($input['traveling_from']) ? $input['traveling_from'] : '';
  $departure_date = !empty($input['departure_date']) ? $input['departure_date'] : '';
  $return_date = !empty($input['return_date']) ? $input['return_date'] : '';
  $packages = _atj_insurance_packages_map();
  $packages = _atj_insurance_normalize_packages_map($packages, $destination, $traveling_from, $departure_date, $return_date);

  $form_state['atj_insurance']['errors'] = array();
  $errors = array();
  $default_error_message = t("Validation error, please try again. If this error persists, please contact the site administrator.");

  foreach ($packages as $key => $package) {
    $data->policy->productId = $package['rating_id'];
    $request = atj_insurance_send_request('POST', 'https://api.bhtp.com/v1/Quote', $data);
    if (!empty($request['code']) && ($request['code'] == ATJ_INSURANCE_NORMAL_RESPONSE)) {
      $quote[$key] = $request['response'];
    }
    else {
      $messages = (!empty($request['response']) && !empty($request['response']->messages)) ?
        $request['response']->messages : array();

      foreach ($messages as $message) {
        $message_code = !empty($message->code) ? $message->code : 0;
        $message_text = !empty($message->text) ? $message->text : '';
        $errors[$message_code] = $message_text;
      }
    }
  }

  _atj_insurance_normalize_quote_oc($quote);

  if (!empty($quote)) {
    $form_state['atj_insurance']['quote'] = serialize($quote);
  }
  else {
    $form_state['atj_insurance']['quote'] = '';
    $form_state['atj_insurance']['errors'] = !empty($errors) ? $errors : $default_error_message;
  }
}

/**
 * Create Quote data.
 *
 * @param $input
 * @param $package_name
 * @param $is_quick_quote
 * @return \stdClass
 */
function _atj_insurance_create_quote_data($input, $package_name = '', $is_quick_quote = TRUE) {
  $destination_country = !empty($input['destination']) ? $input['destination'] : '';
  $departure_date = !empty($input['departure_date']) ? $input['departure_date'] : '';
  $return_date = !empty($input['return_date']) ? $input['return_date'] : '';
  $additional_travelers = !empty($input['additional_travelers']) ?
    unserialize($input['additional_travelers']) : array();
  $deposit_date = !empty($input['deposit_date']) ? $input['deposit_date'] : '';
  $state_of_residence = !empty($input['traveling_from']) ? $input['traveling_from'] : '';
  $trip_cost = !empty($input['trip_cost']) ? $input['trip_cost'] : 0;

  $is_air = (($package_name == 'air_care') || ($package_name == 'air_care_abroad'));

  $travelers = array();

  if (!$is_quick_quote) {
    $additional_travelers = !empty($input['tl_additional_travelers']) ?
      unserialize($input['tl_additional_travelers']) : array();
    $tl_fields = array(
      'first_name',
      'last_name',
      'date_of_birth',
      'traveler_trip_cost',
      'gender',
      'relationship_to_primary',
      'email'
    );
    $policyholder_birth = !empty($input['ph_date_of_birth']) ? $input['ph_date_of_birth'] : '';
    $traveler_1_birth = !empty($input['date_of_birth']) ? $input['date_of_birth'] : array();

    if (is_array($policyholder_birth)) {
      $policyholder_birth = !empty($policyholder_birth['year']) ? implode('-', $policyholder_birth) : '';

      if (!empty($policyholder_birth)) {
        $policyholder_birth = new DateTime($policyholder_birth);
        $policyholder_birth = $policyholder_birth->format('Y-m-d');
      }
    }
    if (is_array($traveler_1_birth)) {
      $traveler_1_birth = !empty($traveler_1_birth['year']) ? implode('-', $traveler_1_birth) : '';

      if (!empty($traveler_1_birth)) {
        $traveler_1_birth = new DateTime($traveler_1_birth);
        $traveler_1_birth = $traveler_1_birth->format('Y-m-d');
      }
    }

    $travelers[0] = array(
      'first_name' => !empty($input['ph_first_name']) ? $input['ph_first_name'] : '',
      'last_name' => !empty($input['ph_last_name']) ? $input['ph_last_name'] : '',
      'date_of_birth' => $policyholder_birth,
      'trip_cost' => !empty($input['ph_trip_cost']) ? (int) $input['ph_trip_cost'] : 0,
      'gender' => !empty($input['ph_gender']) ? $input['ph_gender'] : '',
      'mobile_phone' => !empty($input['ph_mobile_phone']) ? $input['ph_mobile_phone'] : '',
      'email' => !empty($input['ph_email_address']) ? $input['ph_email_address'] : '',
      'address_line_1' => !empty($input['ph_address_line_1']) ? $input['ph_address_line_1'] : '',
      'address_line_2' => !empty($input['ph_address_line_2']) ? $input['ph_address_line_2'] : '',
      'city' => !empty($input['ph_city']) ? $input['ph_city'] : '',
      'state' => !empty($input['ph_state']) ? $input['ph_state'] : $state_of_residence,
      'postal_code' => !empty($input['ph_postal_code']) ? $input['ph_postal_code'] : '',
    );

    if (!empty($input['first_name'] && !empty($input['last_name']))) {
      $travelers[1] = array(
        'first_name' => !empty($input['first_name']) ? $input['first_name'] : '',
        'last_name' => !empty($input['last_name']) ? $input['last_name'] : '',
        'date_of_birth' => $traveler_1_birth,
        'traveler_trip_cost' => !empty($input['traveler_trip_cost']) ? (int) $input['traveler_trip_cost'] : 0,
        'gender' => !empty($input['gender']) ? $input['gender'] : '',
        'relationship_to_primary' => !empty($input['relationship_to_primary']) ? $input['relationship_to_primary'] : '',
        'email' => !empty($input['email']) ? $input['email'] : '',
      );
    }

    foreach ($additional_travelers as $key => $new_traveler) {
      foreach ($tl_fields as $field_name) {
        if (!empty($new_traveler[$field_name])) {
          if (($field_name == 'date_of_birth') && is_array($new_traveler['date_of_birth']) &&
            !empty($new_traveler['date_of_birth']['year'])
          ) {
            $travelers_date_of_birth = implode('-', $new_traveler['date_of_birth']);
            $travelers_date_of_birth = new DateTime($travelers_date_of_birth);
            $travelers[$key]['date_of_birth'] = $travelers_date_of_birth->format('Y-m-d');
          }
          elseif ($field_name == 'traveler_trip_cost') {
            $travelers[$key][$field_name] = (int) $new_traveler[$field_name];
          }
          else {
            $travelers[$key][$field_name] = $new_traveler[$field_name];
          }
        }
      }
    }
  }
  else {
    $age_fields = array('age_1', 'age_2', 'age_3', 'age_4');
    foreach ($age_fields as $field_name) {
      if (!empty($input[$field_name])) {
        $travelers[] = $input[$field_name];
      }
    }

    foreach ($additional_travelers as $new_traveler) {
      foreach ($age_fields as $field_name) {
        if (!empty($new_traveler[$field_name])) {
          $travelers[] = $new_traveler[$field_name];
        }
      }
    }
    $travelers_count = count($travelers);
    $trip_cost = _atj_insurance_count_trip_cost_for_each($trip_cost, $travelers_count, FALSE);
  }

  $data = new stdClass();
  $data->policy = new stdClass();

  $data->policy->destinationCountry = $destination_country;

  $data->policy->departureDate = $departure_date;
  $data->policy->returnDate = $return_date;
  $data->policy->isQuickQuote = $is_quick_quote;


  if (!$is_quick_quote) {
    $data->policy->fulfillmentMethod = 'email';

    if (!$is_air) {
      $data->policy->tripDepositDate = $deposit_date;
    }
  }
  else {
    $data->policy->tripDepositDate = $deposit_date;
  }

  $data->travelers = array();

  foreach ($travelers as $key => $age) {
    $new_traveler = new stdClass();
    $new_traveler->isPrimary = (!$key) ? TRUE : FALSE;

    if ($new_traveler->isPrimary) {
      $new_traveler->address = new stdClass();
      $new_traveler->address->stateOrProvince = $state_of_residence;
    }

    if (!$is_quick_quote) {
      $new_traveler->firstName = $travelers[$key]['first_name'];
      $new_traveler->lastName = $travelers[$key]['last_name'];
      $new_traveler->birthDate = $travelers[$key]['date_of_birth'];

      if (!$key) {
        $new_traveler->phoneNumber = $travelers[$key]['mobile_phone'];
        $new_traveler->email = $travelers[$key]['email'];

        if (!$is_air) {
          $new_traveler->tripCost = $travelers[$key]['trip_cost'];
        }

        $new_traveler->address->address1 = $travelers[$key]['address_line_1'];
        $new_traveler->address->address2 = $travelers[$key]['address_line_2'];
        $new_traveler->address->city = $travelers[$key]['city'];
        $new_traveler->address->postalCode = $travelers[$key]['postal_code'];
      }
      else {
        if (!$is_air) {
          $new_traveler->tripCost = $travelers[$key]['traveler_trip_cost'];
        }

        $new_traveler->relationship = $travelers[$key]['relationship_to_primary'];
      }
    }
    else {
      $new_traveler->age = $age;
      $new_traveler->tripCost = (!$key) ? $trip_cost['first'] : $trip_cost['each'];
    }

    $data->travelers[] = $new_traveler;
  }

  return $data;
}

function _atj_insurance_create_full_quote_data($input, $package_key, $package, $page_num) {
  $optional_coverages = !empty($package['optional_coverages']) ? $package['optional_coverages'] : array();
  $package_data = _atj_insurance_create_quote_data($input, $package_key, FALSE);
  $package_data->policy->productId = $package['rating_id'];
  $package_data->coverages = array();
  $package_map = _atj_insurance_packages_map();
  $with_flights = !empty($package_map[$package_key]['flights']) ?
    $package_map[$package_key]['flights'] : '';

  if ($page_num == ATJ_INSURANCE_TRAVELER_BILLING_TAB) {
    foreach ($optional_coverages as $oc_key => $oc_value) {

      if (!empty($oc_value)) {
        $new_coverage = new stdClass();
        $new_coverage->ratingId = $oc_key;

        switch ($oc_key) {
          case 'fau':
            $new_coverage->coverageLimit = $oc_value;
            break;
          case 'crcc':
            $package_data->policy->rentalCarPickupDate = $oc_value['pickup_date'];
            $package_data->policy->rentalCarReturnDate = $oc_value['return_date'];
            break;
        }

        $package_data->coverages[] = $new_coverage;
      }
    }
  }

  if ($with_flights && (($page_num == ATJ_INSURANCE_TRAVELER_FLIGHTS_TAB) ||
      ($page_num == ATJ_INSURANCE_TRAVELER_BILLING_TAB))) {
    $additional_flights = !empty($input['additional_flights']) ?
      unserialize($input['additional_flights']) : array();

    $package_data->flights = array();

    if (!empty($input['flight_date'] && !empty($input['airline']))) {
      $new_flight = new stdClass();
      $new_flight->flightNumber = !empty($input['flight']) ? $input['flight'] : '';
      $new_flight->departureAirportCode = !empty($input['departure_airport_code']) ?
        $input['departure_airport_code'] : '';
      $new_flight->arrivalAirportCode = !empty($input['arrival_airport_code']) ?
        $input['arrival_airport_code'] : '';
      $new_flight->airlineCode = !empty($input['airline_code']) ? $input['airline_code'] : '';

      if (is_array($input['flight_date'])) {
        $flight_date = !empty($input['flight_date']['year']) ?
          implode('-', $input['flight_date']) : '';
        if (!empty($flight_date)) {
          $flight_date = new DateTime($flight_date);
          $flight_date = $flight_date->format('Y-m-d');
        }

        $new_flight->departureDate = $flight_date;
      }
      else {
        $new_flight->departureDate = $input['flight_date'];
      }

      $package_data->flights[] = $new_flight;
    }

    foreach ($additional_flights as $key => $new_flight) {
      if (!empty($new_flight['flight_date']) && empty($new_flight['flight_date']['year'])) {
        unset($new_flight['flight_date']);
      }
      $new_flight = array_filter($new_flight);

      if (!empty($new_flight)) {
        $flight = new stdClass();
        $flight->flightNumber = !empty($new_flight['flight']) ? $new_flight['flight'] : '';
        $flight->departureAirportCode = !empty($new_flight['departure_airport_code']) ?
          $new_flight['departure_airport_code'] : '';
        $flight->arrivalAirportCode = !empty($new_flight['arrival_airport_code']) ?
          $new_flight['arrival_airport_code'] : '';
        $flight->airlineCode = !empty($new_flight['airline_code']) ?
          $new_flight['airline_code'] : '';
        $package_data->flights[] = $flight;

        if (is_array($new_flight['flight_date'])) {
          $flight_date = !empty($new_flight['flight_date']['year']) ?
            implode('-', $new_flight['flight_date']) : '';
          if (!empty($flight_date)) {
            $flight_date = new DateTime($flight_date);
            $flight_date = $flight_date->format('Y-m-d');
          }

          $flight->departureDate = $flight_date;
        }
        else {
          $flight->departureDate = $new_flight['flight_date'];
        }
      }
    }

  }

  return $package_data;
}

function _atj_insurance_validate_packages_full(&$form_state, $page_num, $trip_cost_changed = FALSE) {
  $input = _atj_insurance_get_webform_storage($form_state);
  $quote = !empty($form_state['atj_insurance']['quote']) ?
    unserialize($form_state['atj_insurance']['quote']) : array();
  $errors = array();
  $form_state['atj_insurance']['errors'] = array();
  $default_error_message = t("Validation error, please try again. If this error persists, please contact the site administrator.");
  $package_map = _atj_insurance_packages_map();
  $destination = !empty($input['destination']) ? $input['destination'] : '';
  $traveling_from = !empty($input['traveling_from']) ? $input['traveling_from'] : '';
  $departure_date = !empty($input['departure_date']) ? $input['departure_date'] : '';
  $return_date = !empty($input['return_date']) ? $input['return_date'] : '';

  $packages = _atj_insurance_normalize_packages_map($package_map, $destination, $traveling_from, $departure_date, $return_date);

  if ($page_num == ATJ_INSURANCE_TRAVELER_DETAIL_TAB) {
    $travelers = !empty($form_state['input']['submitted']['travelers_layout']['travelers']) ?
      $form_state['input']['submitted']['travelers_layout']['travelers'] : array();
    $policyholder = !empty($travelers['policyholder']) ? $travelers['policyholder'] : array();
    $traveler_2 = !empty($travelers['traveler_2']) ? $travelers['traveler_2'] : array();
    $input = array_merge($input, $policyholder, $traveler_2);

    if (isset($travelers['policyholder'])) {
      unset($travelers['policyholder']);
    }
    if (isset($travelers['traveler_2'])) {
      unset($travelers['traveler_2']);
    }

    if (!empty($travelers)) {
      $input['tl_additional_travelers'] = serialize($travelers);
    }
  }
  if ($page_num == ATJ_INSURANCE_TRAVELER_FLIGHTS_TAB) {
    $flights = !empty($form_state['input']['submitted']['flight_builder_layout']['flights']) ?
      $form_state['input']['submitted']['flight_builder_layout']['flights'] : array();
    $flight_1 = !empty($flights['flight_1']) ? $flights['flight_1'] : array();
    $input = array_merge($input, $flight_1);

    if (isset($flights['flight_1'])) {
      unset($flights['flight_1']);
    }
    if (!empty($flights)) {
      $input['additional_flights'] = serialize($flights);
    }
  }

  foreach ($packages as $package_key => $package) {
    $with_flights = !empty($package_map[$package_key]['flights']) ?
      $package_map[$package_key]['flights'] : FALSE;

    if (($page_num == ATJ_INSURANCE_TRAVELER_DETAIL_TAB) ||
      (($page_num == ATJ_INSURANCE_TRAVELER_FLIGHTS_TAB) && $with_flights)) {

      $package['rating_id'] = !empty($package_map[$package_key]['rating_id']) ?
        $package_map[$package_key]['rating_id'] : '';
      $selected_package = atj_insurance_cart_order_session_package($package_key);

      switch ($page_num) {
        case ATJ_INSURANCE_TRAVELER_DETAIL_TAB:
          if (!$with_flights) {
            $package_data = _atj_insurance_create_full_quote_data($input, $package_key, $package, $page_num);
          }
          elseif ($trip_cost_changed) {
            $package_data = _atj_insurance_create_quote_data($input);
            $package_data->policy->productId = $package['rating_id'];
          }
          break;
        case ATJ_INSURANCE_TRAVELER_FLIGHTS_TAB:
          $package_data = _atj_insurance_create_full_quote_data($input, $package_key, $package, $page_num);
          break;
      }

      if (!empty($package_data)) {
        $request = atj_insurance_send_request('POST', 'https://api.bhtp.com/v1/Quote', $package_data);
        if (!empty($request['code']) && ($request['code'] == ATJ_INSURANCE_NORMAL_RESPONSE)) {
          $quote[$package_key] = $request['response'];
        }
        elseif ($selected_package) {
          $messages = (!empty($request['response']) && !empty($request['response']->messages)) ?
            $request['response']->messages : array();

          foreach ($messages as $message) {
            $message_code = !empty($message->code) ? $message->code : 0;
            $message_text = !empty($message->text) ? $message->text : '';
            $errors[$message_code] = $message_text;
          }

          if (empty($errors)) {
            $errors[0] = $default_error_message;
          }
        }

        if (!empty($errors)) {
          $form_state['atj_insurance']['errors'] = $errors;
        }
      }
    }
  }

  _atj_insurance_normalize_quote_oc($quote);

  if (!empty($quote)) {
    $form_state['atj_insurance']['quote'] = serialize($quote);
  }
}

/**
 * Purchase.
 *
 * @param $form
 * @param $form_state
 */
function _atj_insurance_purchase(&$form, &$form_state) {
  $input = _atj_insurance_get_webform_storage($form_state);
  $quote = array();
  $errors = array();
  $form_state['atj_insurance']['errors'] = array();
  $default_error_message = t("Validation error, please try again. If this error persists, please contact the site administrator.");
  $package_map = _atj_insurance_packages_map();

  $selected_packages = atj_insurance_cart_order_session_get();
  $card = !empty($form_state['input']['submitted']['billing_info_layout']['card']) ?
    $form_state['input']['submitted']['billing_info_layout']['card'] : array();

  foreach ($selected_packages as $package_key => $package) {
    $package['rating_id'] = !empty($package_map[$package_key]['rating_id']) ? $package_map[$package_key]['rating_id'] : '';
    $package_data = _atj_insurance_create_full_quote_data($input, $package_key, $package, ATJ_INSURANCE_TRAVELER_BILLING_TAB);

    $package_data->paymentInformation = new stdClass();
    $package_data->paymentInformation->cardNumber = !empty($card['card_number']) ? $card['card_number'] : '';
    $package_data->paymentInformation->expirationDate = !empty($card['card_expiration']) ? $card['card_expiration'] : '';
    $package_data->paymentInformation->cardCode = !empty($card['card_security_number']) ? $card['card_security_number'] : '';
    $package_data->paymentInformation->firstName = !empty($input['ph_first_name']) ? $input['ph_first_name'] : '';
    $package_data->paymentInformation->lastName = !empty($input['ph_last_name']) ? $input['ph_last_name'] : '';
    $package_data->paymentInformation->address = !empty($input['ph_address_line_1']) ? $input['ph_address_line_1'] : '';
    $package_data->paymentInformation->city = !empty($input['ph_city']) ? $input['ph_city'] : '';
    $package_data->paymentInformation->state = !empty($input['ph_state']) ? $input['ph_state'] : '';
    $package_data->paymentInformation->zip = !empty($input['ph_postal_code']) ? $input['ph_postal_code'] : '';
    $package_data->paymentInformation->paymentMethod = 'CreditCard';

    $request = atj_insurance_send_request('POST', 'https://api.bhtp.com/v1/Purchase', $package_data);
    if (!empty($request['code']) && ($request['code'] == ATJ_INSURANCE_NORMAL_RESPONSE)) {
      $quote[$package_key] = $request['response'];
    }
    else {
      $messages = (!empty($request['response']) && !empty($request['response']->messages)) ?
        $request['response']->messages : array();

      foreach ($messages as $message) {
        $message_code = !empty($message->code) ? $message->code : 0;
        $message_text = !empty($message->text) ? $message->text : '';
        $errors[$message_code] = $message_text;
      }

      if (empty($errors)) {
        $errors[0] = $default_error_message;
      }
    }

    if (!empty($errors)) {
      $form_state['atj_insurance']['errors'] = $errors;
    }
  }

  $policy = '';
  end($quote);
  $last_key = key($quote);

  foreach ($quote as $quote_package_key => $quote_response) {
    if (!empty($quote_response->policyNumber)) {
      $policy .= $quote_response->packageName . ': ' . $quote_response->policyNumber;
      $policy .= ($quote_package_key != $last_key) ? ' | ' : '';

      atj_insurance_cart_order_session_delete_item($quote_package_key);
    }
  }

  if (!empty($policy)) {
    $form_state['values']['submitted']['policy'] = $policy;
  }
  elseif (empty($form_state['atj_insurance']['errors'])) {
    $form_state['atj_insurance']['errors'][0] = $default_error_message;
  }
}

/**
 * Create input data.
 *
 * @param $form_state
 * @return array
 */
function _atj_insurance_create_input_quick($form_state) {
  $fs_submitted = &$form_state['input']['submitted'];
  $destination = !empty($fs_submitted['select_a_destination']) ?
    $fs_submitted['select_a_destination'] : array();
  $dates = !empty($fs_submitted['dates']) ? $fs_submitted['dates'] : array();
  $travelers = !empty($fs_submitted['travelers']['rows']) ? $fs_submitted['travelers']['rows'] : array();
  $travelers_1 = !empty($travelers['row_1']) ? $travelers['row_1'] : array();
  $additional_travelers = '';

  if (is_array($destination['deposit_date'])) {
    $deposit_date = !empty($destination['deposit_date']['year']) ?
      implode('-', $destination['deposit_date']) : '';
    if (!empty($deposit_date)) {
      $deposit_date = new DateTime($deposit_date);
      $deposit_date = $deposit_date->format('Y-m-d');
    }

    $destination['deposit_date'] = $deposit_date;
  }
  if (is_array($dates['departure_date'])) {
    $departure_date = !empty($dates['departure_date']['year']) ?
      implode('-', $dates['departure_date']) : '';

    if (!empty($departure_date)) {
      $departure_date = new DateTime($departure_date);
      $departure_date = $departure_date->format('Y-m-d');
    }

    $destination['departure_date'] = $departure_date;
  }
  if (is_array($dates['return_date'])) {
    $return_date = !empty($dates['return_date']['year']) ?
      implode('-', $dates['return_date']) : '';

    if (!empty($return_date)) {
      $return_date = new DateTime($return_date);
      $return_date = $return_date->format('Y-m-d');
    }

    $destination['return_date'] = $return_date;
  }

  if (isset($travelers['row_1'])) {
    unset($travelers['row_1']);
  }
  if (!empty($travelers)) {
    $additional_travelers = serialize($travelers);
  }

  $input = array_merge($destination, $travelers_1);
  $input['additional_travelers'] = $additional_travelers;

  return $input;
}

/**
 * Validate dates.
 *
 * @param $date_from
 * @param $date_to
 * @param $form
 */
function _atj_insurance_travel_insurance_validate_dates(&$date_from, &$date_to, &$form, $limit_validation_errors = NULL) {
  $month_from = !empty($date_from['month']) ? (int) $date_from['month'] : 0;
  $day_from = !empty($date_from['day']) ? (int) $date_from['day'] : 0;
  $year_from = !empty($date_from['year']) ? (int) $date_from['year'] : 0;

  $month_to = !empty($date_to['month']) ? (int) $date_to['month'] : 0;
  $day_to = !empty($date_to['day']) ? (int) $date_to['day'] : 0;
  $year_to = !empty($date_to['year']) ? (int) $date_to['year'] : 0;

  $valid_date_from = checkdate($month_from, $day_from, $year_from);
  $valid_date_to = checkdate($month_to, $day_to, $year_to);

  $departure_date = (!empty($date_from) && is_array($date_from) &&
    (!empty($date_from['year']))) ? implode('-', $date_from) : '';
  $return_date = (!empty($date_to) && is_array($date_to) &&
    !empty($date_to['year'])) ? implode('-', $date_to) : '';
  $parents = !empty($form['#parents']) ? $form['#parents'] : array();

  if (empty($parents) && !empty($limit_validation_errors)) {
    $parents = $limit_validation_errors[0];
    $parents[] = $form['#webform_component']['form_key'];
  }

  if (!empty($departure_date) && !empty($return_date) && $valid_date_from && $valid_date_to) {
    $departure_date = new DateTime($departure_date);
    $return_date = new DateTime($return_date);

    if ($return_date < $departure_date) {
      form_set_error(implode('][', $parents), t("The entered date must be !date or later.", array('!date' => $departure_date->format('Y-m-d'))), $limit_validation_errors);
    }
  }
  else {
    form_set_error(implode('][', $parents), t("Incorrect date."), $limit_validation_errors);
  }
}

/**
 * Validate Car Rental Collision Coverage optional coverage.
 *
 * @param $f_packages
 * @param $fs_packages
 * @param $package
 */
function _atj_insurance_travel_insurance_validate_crcc(&$f_packages, $fs_packages, $package) {
  $date_from = !empty($fs_packages[$package]['optional_coverages']['crcc_oc']['pickup_date_from']['year']) ?
    $fs_packages[$package]['optional_coverages']['crcc_oc']['pickup_date_from'] : '';
  $date_to = !empty($fs_packages[$package]['optional_coverages']['crcc_oc']['pickup_date_to']['year']) ?
    $fs_packages[$package]['optional_coverages']['crcc_oc']['pickup_date_to'] : '';

  $parents = array(
    'submitted',
    'packages_layout',
    'packages_wrapper',
    'packages',
    $package,
    'optional_coverages',
    'crcc_oc'
  );
  $limit_validation_errors = array($parents);

  if (empty($date_from)) {
    $parents[] = 'pickup_date_from';
    form_set_error(implode('][', $parents), t('Pickup Date From field is required.'), $limit_validation_errors);
  }
  if (empty($date_to)) {
    $parents[] = 'pickup_date_to';
    form_set_error(implode('][', $parents), t('Pickup Date To field is required.'), $limit_validation_errors);
  }
  else {
    $f_date_to = &$f_packages[$package]['optional_coverages']['crcc_oc']['pickup_date_to'];
    _atj_insurance_travel_insurance_validate_dates($date_from, $date_to, $f_date_to, $limit_validation_errors);
  }
}

/**
 * Validate AirCare fields.
 *
 * @param $f_packages
 * @param $fs_packages
 * @param $package
 */
function _atj_insurance_travel_insurance_validate_flight(&$form, $form_state) {
  $flights = !empty($form_state['input']['submitted']['flight_builder_layout']['flights']) ?
    $form_state['input']['submitted']['flight_builder_layout']['flights'] : array();
  $parents = array(
    'submitted',
    'flight_builder_layout',
    'flights'
  );
  $limit_validation_errors = array($parents);
  $f_flights = &$form['submitted']['flight_builder_layout']['flights'];

  foreach ($flights as $flight_key => $flight) {
    $flight_parents = $parents;
    $flight_parents[] = $flight_key;

    foreach ($flight as $field_key => $field) {
      $field_parents = $flight_parents;
      $title = !empty($f_flights['flight_1'][$field_key]['#title']) ? $f_flights['flight_1'][$field_key]['#title'] : '';

      if (($field_key == 'flight_date') && empty($field['year'])) {
        $field_parents[] = 'flight_date';
        form_set_error(implode('][', $field_parents), $title . t(' field is required.'), array($flight_parents));
        $errors[] = implode('][', $field_parents);
      }
      elseif (empty($field)) {
        $field_parents[] = $field_key;
        form_set_error(implode('][', $field_parents), $title . t(' field is required.'), array($flight_parents));
        $errors[] = implode('][', $field_parents);
      }
    }
  }
}

/**
 * Create additional flight fields.
 *
 * @param $form
 * @param $form_state
 */
function _atj_insurance_create_additional_flights(&$form, &$form_state) {
  $fs_flights = !empty($form_state['input']['submitted']['flight_builder_layout']['flights']) ?
    $form_state['input']['submitted']['flight_builder_layout']['flights'] : array();
  $f_flights = &$form['submitted']['flight_builder_layout']['flights'];

  $triggering_element = !empty($form_state['triggering_element']['#value']) ?
    $form_state['triggering_element']['#value'] : '';

  if ($triggering_element == t('Previous')) {
    $input = _atj_insurance_get_webform_storage($form_state);
    $fs_flights = !empty($input['additional_flights']) ?
      unserialize($input['additional_flights']) : array();
  }

  if (isset($fs_flights['flight_1'])) {
    unset($fs_flights['flight_1']);
  }
  $weight = !empty($f_flights['flight_1']['#weight']) ? $f_flights['flight_1']['#weight'] : 0;
  foreach ($fs_flights as $key => $flight) {

    if (!empty($flight)) {
      $f_flights[$key] = $f_flights['flight_1'];
      $f_flights[$key]['#title'] = $key;
      $f_flights[$key]['#webform_component']['form_key'] = $key;
      $f_flights[$key]['#webform_component']['name'] = $key;
      $f_flights[$key]['#weight'] = ++$weight;
      $f_flights[$key]['#validated'] = FALSE;
      $flight_1_key = array_search('flight_1', $f_flights['flight_1']['#parents']);
      $f_flights[$key]['#parents'][$flight_1_key] = $key;

      foreach (element_children($f_flights[$key]) as $flight_key) {
        $f_flights[$key][$flight_key]['#id'] = str_replace('-flight-1-', '-' . $key . '-', $f_flights[$key][$flight_key]['#id']);
        $f_flights[$key][$flight_key]['#name'] = str_replace('[flight_1]', '[' . $key . ']', $f_flights[$key][$flight_key]['#name']);
        $f_flights[$key][$flight_key]['#default_value'] = !empty($flight[$flight_key]) ? $flight[$flight_key] : '';
        $f_flights[$key][$flight_key]['#value'] = !empty($flight[$flight_key]) ? $flight[$flight_key] : '';
        $f_flights[$key][$flight_key]['#validated'] = FALSE;
        $flight_1_key = array_search('flight_1', $f_flights[$key][$flight_key]['#parents']);
        $f_flights[$key][$flight_key]['#parents'][$flight_1_key] = $key;

        $type = !empty($f_flights[$key][$flight_key]['#type']) ? $f_flights[$key][$flight_key]['#type'] : '';
        if ($type == 'date') {
          $f_flights[$key][$flight_key]['year']['#name'] = str_replace('[flight_1]', '[' . $key . ']', $f_flights[$key][$flight_key]['year']['#name']);
          $f_flights[$key][$flight_key]['month']['#name'] = str_replace('[flight_1]', '[' . $key . ']', $f_flights[$key][$flight_key]['month']['#name']);
          $f_flights[$key][$flight_key]['day']['#name'] = str_replace('[flight_1]', '[' . $key . ']', $f_flights[$key][$flight_key]['day']['#name']);

          $flight_1_key = array_search('flight_1', $f_flights[$key][$flight_key]['year']['#parents']);
          $f_flights[$key][$flight_key]['year']['#parents'][$flight_1_key] = $key;
          $f_flights[$key][$flight_key]['month']['#parents'][$flight_1_key] = $key;
          $f_flights[$key][$flight_key]['day']['#parents'][$flight_1_key] = $key;
        }
      }
    }
    else {
      unset($form_state['input']['submitted']['flight_builder_layout']['flights'][$key]);
    }
  }
}

/**
 * Packages map.
 *
 * @return array
 */
function _atj_insurance_packages_map() {
  $packages = array(
    'exact_care_extra' => array(
      'name' => 'ExactCare Extra',
      'id' => 'exact-care-extra',
      'rating_id' => 30,
      'recommended' => TRUE,
      'coverage_type' => t('Comprehensive'),
      'optional_coverages' => array(
        'cfar',
        'crcc',
        'med',
        'eeu',
      ),
      'flights' => TRUE,
      'available' => TRUE,
    ),
    'exact_care_value' => array(
      'name' => 'ExactCare Value',
      'id' => 'exact-care-value',
      'rating_id' => 32,
      'coverage_type' => t('Comprehensive'),
      'optional_coverages' => array(
        'fau',
        'crcc',
        'med',
        'eeu',
      ),
      'available' => TRUE,
    ),
    'exact_care' => array(
      'name' => 'ExactCare',
      'id' => 'exact-care',
      'rating_id' => 31,
      'coverage_type' => t('Comprehensive'),
      'optional_coverages' => array(
        'cfar',
        'fau',
        'crcc',
        'med',
        'eeu',
      ),
      'available' => TRUE,
    ),
    'exact_care_family' => array(
      'name' => 'ExactCare Family',
      'id' => 'exact-care-family',
      'rating_id' => 7,
      'coverage_type' => t('Comprehensive'),
      'optional_coverages' => array(
        'fau',
        'crcc',
        'eeu',
      ),
      'available' => FALSE,
    ),
    'air_care' => array(
      'name' => 'AirCare',
      'id' => 'air-care',
      'rating_id' => 4,
      'coverage_type' => t('Flight Protection'),
      'flights' => TRUE,
      'available' => TRUE,
    ),
    'air_care_abroad' => array(
      'name' => 'AirCare Abroad',
      'id' => 'air-care-abroad',
      'rating_id' => 3,
      'coverage_type' => t('Flight Protection'),
      'flights' => TRUE,
      'available' => TRUE,
    ),
  );

  return $packages;
}

/**
 * Get triggering element.
 *
 * @param $form_state
 * @return array
 */
function _atj_insurance_get_triggering_element($form_state) {
  $triggering_element = array();
  $triggering_element_name = !empty($form_state['input']['_triggering_element_name']) ?
    $form_state['input']['_triggering_element_name'] : $form_state['triggering_element']['#name'];

  if (strrchr($triggering_element_name, "[") != FALSE) {
    $triggering_element_name = substr(strrchr($triggering_element_name, "["), 1, -1);
  }

  $triggering_element_pieces = explode('__', $triggering_element_name);
  $triggering_element['package'] = !empty($triggering_element_pieces[0]) ? $triggering_element_pieces[0] : '';
  $triggering_element['operation'] = !empty($triggering_element_pieces[1]) ? $triggering_element_pieces[1] : '';
  $triggering_element['optional_coverages'] = !empty($triggering_element_pieces[2]) ? $triggering_element_pieces[2] : '';

  return $triggering_element;
}

/**
 * Check optional coverage checked.
 *
 * @param $form_state
 * @param $package
 * @param $optional_coverage
 * @return string
 */
function _atj_insurance_check_oc_checked($form_state, $package, $optional_coverage) {
  $fs_package = !empty($form_state['input']['submitted']['packages_layout']['packages_wrapper']['packages'][$package]) ?
    $form_state['input']['submitted']['packages_layout']['packages_wrapper']['packages'][$package] : '';
  $oc_checked = (!empty($fs_package) && !empty($fs_package['optional_coverages'][$optional_coverage . '_oc'])
    && !empty($fs_package['optional_coverages'][$optional_coverage . '_oc'][$optional_coverage][$package . '__oc__' . $optional_coverage])) ?
    $fs_package['optional_coverages'][$optional_coverage . '_oc'][$optional_coverage][$package . '__oc__' . $optional_coverage] : FALSE;

  return $oc_checked;
}

/**
 * Normalize packages.
 *
 * @param $package_quote
 */
function _atj_insurance_normalize_packages(&$package_quote) {
  $selected_packages = atj_insurance_cart_order_session_get();

  foreach ($selected_packages as $key => $package) {
    if (empty($package_quote[$key])) {
      atj_insurance_cart_order_session_delete_item($key);
      $key = '';
    }

    switch ($key) {
      case 'exact_care_extra':
        if (isset($package_quote['exact_care_value'])) {
          unset($package_quote['exact_care_value']);
        }
        if (isset($package_quote['exact_care_family'])) {
          unset($package_quote['exact_care_family']);
        }
        if (isset($package_quote['exact_care'])) {
          unset($package_quote['exact_care']);
        }
        if (isset($package_quote['air_care'])) {
          unset($package_quote['air_care']);
        }
        if (isset($package_quote['air_care_abroad'])) {
          unset($package_quote['air_care_abroad']);
        }
        break;
      case 'exact_care_value':
        if (isset($package_quote['exact_care'])) {
          unset($package_quote['exact_care']);
        }
        if (isset($package_quote['exact_care_family'])) {
          unset($package_quote['exact_care_family']);
        }
        if (isset($package_quote['exact_care_extra'])) {
          unset($package_quote['exact_care_extra']);
        }
        break;
      case 'exact_care':
        if (isset($package_quote['exact_care_value'])) {
          unset($package_quote['exact_care_value']);
        }
        if (isset($package_quote['exact_care_family'])) {
          unset($package_quote['exact_care_family']);
        }
        if (isset($package_quote['exact_care_extra'])) {
          unset($package_quote['exact_care_extra']);
        }
        break;
      case 'exact_care_family':
        if (isset($package_quote['exact_care_value'])) {
          unset($package_quote['exact_care_value']);
        }
        if (isset($package_quote['exact_care'])) {
          unset($package_quote['exact_care']);
        }
        if (isset($package_quote['exact_care_extra'])) {
          unset($package_quote['exact_care_extra']);
        }
        break;
      case 'air_care':
        if (isset($package_quote['air_care_abroad'])) {
          unset($package_quote['air_care_abroad']);
        }
        if (isset($package_quote['exact_care_extra'])) {
          unset($package_quote['exact_care_extra']);
        }
        break;
      case 'air_care_abroad':
        if (isset($package_quote['air_care'])) {
          unset($package_quote['air_care']);
        }
        if (isset($package_quote['exact_care_extra'])) {
          unset($package_quote['exact_care_extra']);
        }
        break;
    }

  }
}

function _atj_insurance_get_webform_storage($form_state) {
  $values = $form_state['storage']['submitted'];
  $components = $form_state['complete form']['#node']->webform['components'];
  $result = array();

  foreach ($values as $cid => $value) {
    $key = !empty($components[$cid]['form_key']) ? $components[$cid]['form_key'] : $cid;
    if (isset($result[$key])) {
      $uniq_key = $key;
      $i = 0;
      while (isset($result[$uniq_key])) {
        $uniq_key = $key . '_' . $i;
        $i++;
      }
      $key = $uniq_key;
    }
    $result[$key] = $value;
  }

  return $result;
}

function _atj_insurance_get_webform_storage_trip_cost_key($form_state) {
  $values = $form_state['storage']['submitted'];
  $components = $form_state['complete form']['#node']->webform['components'];
  $result = '';

  foreach ($values as $cid => $value) {
    $key = !empty($components[$cid]['form_key']) ? $components[$cid]['form_key'] : $cid;
    if ($key == 'trip_cost') {
      $result = $cid;
    }
  }

  return $result;
}

function _atj_insurance_get_air_packages() {
  $package_map = _atj_insurance_packages_map();
  $air_packages = array();

  foreach ($package_map as $map_package_key => $map_package) {
    $with_flights = !empty($map_package['flights']) ? TRUE : FALSE;

    if ($with_flights) {
      $air_packages[$map_package_key] = $map_package;
    }
  }

  return $air_packages;
}

/**
 * Traveler details step.
 * Create additional travelers.
 *
 * @param $form
 * @param $travelers_amount
 * @param $trip_cost_for_each
 * @param $storage
 * @param $triggering_element_value
 */
function _atj_insurance_create_additional_travelers(&$form, $travelers_amount, $trip_cost_for_each, $storage, $triggering_element_value = '') {
  $f_travelers = &$form['submitted']['travelers_layout']['travelers'];
  $weight = !empty($f_travelers['traveler_2']['#weight']) ? $f_travelers['traveler_2']['#weight'] : 0;
  $additional_travelers = !empty($storage['tl_additional_travelers']) ? unserialize($storage['tl_additional_travelers']) : array();

  for ($i = 3; $i <= $travelers_amount; $i++) {
    $key = 'traveler_' . $i;
    $f_travelers[$key] = $f_travelers['traveler_2'];
    $f_travelers[$key]['#title'] = $key;
    $f_travelers[$key]['#webform_component']['form_key'] = $key;
    $f_travelers[$key]['#webform_component']['name'] = $key;
    $f_travelers[$key]['#weight'] = ++$weight;

    if (empty($additional_travelers[$key]['traveler_trip_cost']) || ($triggering_element_value == 'Next')) {
      $f_travelers[$key]['traveler_trip_cost']['#default_value'] = $trip_cost_for_each;
    }

    $f_travelers[$key]['traveler_title']['#markup'] = '<h4>' . t('Traveler') . ' #' . $i . '</h4>';
  }
}

/**
 * Count cost for each traveler.
 *
 * @param $trip_cost
 * @param $travelers_amount
 * @param $format
 * @return array
 */
function _atj_insurance_count_trip_cost_for_each($trip_cost, $travelers_amount, $format = TRUE) {
  $trip_cost_for_each = array(
    'first' => 0,
    'each' => 0,
  );

  if (!$travelers_amount) {
    return $trip_cost_for_each;
  }

  $each = floor($trip_cost / $travelers_amount);
  $remainder = $trip_cost - ($each * $travelers_amount);
  $trip_cost_for_each['first'] = $format ? number_format($each + $remainder, 2) : (int) ($each + $remainder);
  $trip_cost_for_each['each'] = $format ? number_format($each, 2) : (int) $each;

  return $trip_cost_for_each;
}

/**
 * Normalize package map.
 *
 * @param $package_map
 * @param $destination
 * @param string $traveling_from
 * @param string $departure_date
 * @param string $return_date
 * @return mixed
 */
function _atj_insurance_normalize_packages_map($package_map, $destination, $traveling_from = '', $departure_date = '', $return_date = '') {

  if (($destination == 'US') && (array_key_exists('air_care_abroad', $package_map))) {
    unset($package_map['air_care_abroad']);
  }
  elseif (($destination != 'US') && (array_key_exists('air_care', $package_map))) {
    unset($package_map['air_care']);
  }

  if (($traveling_from == 'NY') && !empty($departure_date) && !empty($return_date)) {
    $departure_date = new DateTime($departure_date);
    $return_date = new DateTime($return_date);
    $diff = $departure_date->diff($return_date);
    $diff_days = $diff->days;
    $diff_days++;

    if ($diff_days > ATJ_INSURANCE_NY_EXACT_MAX_DAYS) {
      if (array_key_exists('exact_care_extra', $package_map)) {
        unset($package_map['exact_care_extra']);
      }
      if (array_key_exists('exact_care_value', $package_map)) {
        unset($package_map['exact_care_value']);
      }
      if (array_key_exists('exact_care_family', $package_map)) {
        unset($package_map['exact_care_family']);
      }
      if (array_key_exists('exact_care', $package_map)) {
        unset($package_map['exact_care']);
      }
    }
  }

  foreach ($package_map as $key => $package) {
    if (empty($package['available'])) {
      unset($package_map[$key]);
    }
  }

  return $package_map;
}

/**
 * Page 1 Age rows.
 *
 * @param $form
 * @param $form_state
 */
function _atj_insurance_create_additional_age_rows(&$form, $form_state) {
  $travelers = !empty($form_state['input']['submitted']['travelers']['rows']) ?
    $form_state['input']['submitted']['travelers']['rows'] : array();
  $f_rows = &$form['submitted']['travelers']['rows'];

  $triggering_element = !empty($form_state['triggering_element']['#value']) ?
    $form_state['triggering_element']['#value'] : '';

  if ($triggering_element == t('Previous')) {
    $input = _atj_insurance_get_webform_storage($form_state);
    $travelers = !empty($input['additional_travelers']) ? unserialize($input['additional_travelers']) : array();
  }

  if (isset($travelers['row_1'])) {
    unset($travelers['row_1']);
  }
  $weight = !empty($f_rows['row_1']['#weight']) ? $f_rows['row_1']['#weight'] : 0;
  foreach ($travelers as $key => $row) {
    $row = array_filter($row);

    if (!empty($row)) {
      $f_rows[$key] = $f_rows['row_1'];
      $f_rows[$key]['#title'] = $key;
      $f_rows[$key]['#webform_component']['form_key'] = $key;
      $f_rows[$key]['#webform_component']['name'] = $key;
      $f_rows[$key]['#weight'] = ++$weight;
      $f_rows[$key]['age_1']['#required'] = FALSE;

      foreach (element_children($f_rows[$key]) as $age_key) {
        $f_rows[$key][$age_key]['#name'] = str_replace('[row_1]', '[' . $key . ']', $f_rows[$key][$age_key]['#name']);
        $f_rows[$key][$age_key]['#default_value'] = !empty($row[$age_key]) ? $row[$age_key] : '';
        $f_rows[$key][$age_key]['#value'] = !empty($row[$age_key]) ? $row[$age_key] : '';
      }
    }
    else {
      unset($form_state['input']['submitted']['travelers']['rows'][$key]);
    }
  }
}


/**
 * Return webform fields map to ignore save and display in statistics
 */
function _atj_insurance_payment_webforms_ignore_fields() {
  return array(
    'card_number',
    'card_expiration',
    'card_security_number',
  );
}

/**
 * Set attribute autocomplete off.
 *
 * @param $form
 */
function _atj_insurance_set_autocomplete_off_attribure(&$form) {
  $webforms_autocomplete_map = _atj_insurance_payment_webforms_ignore_fields();
  $form_card = &$form['submitted']['billing_info_layout']['card'];

  foreach ($webforms_autocomplete_map as $field) {
    if (!empty($form_card[$field])) {
      $form_card[$field]['#attributes']['autocomplete'] = 'off';
    }
  }
}

function _atj_insurance_oc_uncheck(&$form_state, $package) {
  $package_map = _atj_insurance_packages_map();
  $fs_package = &$form_state['input']['submitted']['packages_layout']['packages_wrapper']['packages'][$package];
  $package_map_oc = (!empty($package_map[$package]) && !empty($package_map[$package]['optional_coverages'])) ?
    $package_map[$package]['optional_coverages'] : array();

  foreach($package_map_oc as $oc_key) {
    if (!empty($fs_package['optional_coverages'][$oc_key . '_oc'][$oc_key])) {
      $fs_package['optional_coverages'][$oc_key . '_oc'][$oc_key][$package . '__oc__' . $oc_key] = null;
    }
  }
}

/**
 * Clears an error against one form element.
 *
 * @param $name
 *   The name of the form element.
 */
function atj_insurance_form_unset_error($name) {
  $errors = &drupal_static('form_set_error', array());
  $removed_messages = array();
  if (isset($errors[$name])) {
    $removed_messages[] = $errors[$name];
    unset($errors[$name]);
  }
  $_SESSION['messages']['error'] = array_diff($_SESSION['messages']['error'], $removed_messages);
}

/**
 * Normalize optional coverages.
 *
 * @param $quote
 */
function _atj_insurance_normalize_quote_oc(&$quote) {
  foreach ($quote as $quote_key => $quote_data) {
    $optional_coverages = !empty($quote[$quote_key]->coverages->Optional) ?
      $quote[$quote_key]->coverages->Optional : array();

    foreach ($optional_coverages as $cover_key => $cover) {
      $available = !empty($cover->coverageAvailable) ? $cover->coverageAvailable : FALSE;
      $id = !empty($cover->ratingId) ? strtolower($cover->ratingId) : '';

      if (!empty($available) && ($id !== $cover_key)) {
        $quote[$quote_key]->coverages->Optional[$id] = $cover;
      }

      if ($id !== $cover_key) {
        unset($quote[$quote_key]->coverages->Optional[$cover_key]);
      }
    }
  }
}

function _atj_insurance_get_selected_packages_cost($form_state) {
  $selected_packages = atj_insurance_cart_order_session_get();
  $bhtp_packages = !empty($form_state['atj_insurance']['quote']) ?
    unserialize($form_state['atj_insurance']['quote']) : array();
  $packages_cost = array();
  $total_amount = 0;

  foreach ($selected_packages as $package_key => $package_data) {
    $package = !empty($bhtp_packages[$package_key]) ?
      $bhtp_packages[$package_key] : array();
    $optional_coverages = !empty($package_data['optional_coverages']) ?
      $package_data['optional_coverages'] : array();

    if (!empty($package)) {
      $packages_cost[$package_key] = array();
      $packages_cost[$package_key]['base_amount'] = !empty($package->baseQuoteAmount) ? $package->baseQuoteAmount : 0;
      $packages_cost[$package_key]['total_fees'] = !empty($package->packageFee) ? $package->packageFee : 0;
      $optional_coverages_amount = 0;

      foreach ($optional_coverages as $oc_key => $oc_value) {
        $bhtp_oc_all = !empty($package->coverages->Optional) ?
          $package->coverages->Optional : array();
        $bhtp_oc = !empty($bhtp_oc_all[$oc_key]) ? $bhtp_oc_all[$oc_key] : '';
        $oc_price = _atj_insurance_get_oc_price($bhtp_oc, $oc_value, $oc_key, $package_key);

        if (!empty($oc_value) && isset($oc_price)) {
          $packages_cost[$package_key][$oc_key] = $oc_price;
          $optional_coverages_amount += $oc_price;
        }
      }

      $total_amount = $total_amount + $packages_cost[$package_key]['base_amount'] + $packages_cost[$package_key]['total_fees'] + $optional_coverages_amount;
    }
  }

  if (!empty($total_amount)) {
    $packages_cost['total_amount'] = $total_amount;
  }
  return $packages_cost;
}

/**
 * Check all packages and optional coverages exists.
 * @param $form_state
 */
function _atj_insurance_check_selected_packages_exists(&$form_state) {
  $bhtp_packages = !empty($form_state['atj_insurance']['quote']) ?
    unserialize($form_state['atj_insurance']['quote']) : array();
  $error = FALSE;
  $selected_packages = atj_insurance_cart_order_session_get();

  foreach ($selected_packages as $package_key => $package_data) {
    $package = !empty($bhtp_packages[$package_key]) ?
      $bhtp_packages[$package_key] : array();
    $optional_coverages = !empty($package_data['optional_coverages']) ?
      $package_data['optional_coverages'] : array();

    if (!empty($package)) {
      $package_oc = !empty($package->coverages->Optional) ? $package->coverages->Optional : array();
      foreach ($optional_coverages as $oc_key => $oc_value) {
        if (empty($package_oc[$oc_key]) || (!empty($package_oc[$oc_key]) && empty($package_oc[$oc_key]->coverageAvailable))) {
          atj_insurance_cart_order_session_delete_oc($package_key, $oc_key);
          $error = TRUE;
        }
      }
    }
    else {
      atj_insurance_cart_order_session_delete_item($package_key);
      $error = TRUE;
    }
  }

  if ($error) {
    $form_state['atj_insurance']['info'][] = t('Some of your products are no longer available. Please review before proceeding.');
  }
}