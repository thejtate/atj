<?php
/**
 * @file
 * Ajax callbacks.
 */

/**
 * Add to cart callback.
 *
 * @param $form
 * @param $form_state
 * @return array
 */
function atj_insurance_ajax_package_add_to_cart(&$form, $form_state) {
//  $f_submitted = &$form['submitted'];
  $triggering_element = _atj_insurance_get_triggering_element($form_state);
  $package = !empty($triggering_element['package']) ? $triggering_element['package'] : '';
//
//  $packages_map = _atj_insurance_packages_map();
//  $id = $packages_map[$package]['id'] . '-add-to-cart';
//
//  $add_button = drupal_render($f_submitted['packages_layout']['packages'][$package]['add_to_cart']);
//  $commands[] = ajax_command_replace('#' . $id, $add_button);
//
//  $cart = drupal_render($f_submitted['packages_layout']['cart_sidebar']['coverage_cart']);
//  $commands[] = ajax_command_replace('#coverage-cart', $cart);
//
//  return array('#type' => 'ajax', '#commands' => $commands);

//  if ($package == 'air_care') {
//    if (form_get_errors()) {
//      _atj_insurance_create_additional_flights($form, $form_state, 'air_care');
//    }
//  }

  return $form;
}

/**
 * Add to cart optional coverages callback.
 *
 * @param $form
 * @param $form_state
 * @return array
 */
function atj_insurance_ajax_package_optional_coverages(&$form, $form_state) {
  $triggering_element = _atj_insurance_get_triggering_element($form_state);
  $package = !empty($triggering_element['package']) ? $triggering_element['package'] : '';
  $optional_coverages = !empty($triggering_element['optional_coverages']) ? $triggering_element['optional_coverages'] : '';
  $f_submitted = &$form['submitted'];
  $f_package = &$form['submitted']['packages_layout']['packages_wrapper']['packages'][$package];
  $fs_package = &$form_state['input']['submitted']['packages_layout']['packages_wrapper']['packages'][$package];
  $bhtp_packages = !empty($form_state['atj_insurance']['quote']) ?
    json_decode($form_state['atj_insurance']['quote']) : array();

  $oc_checked = !empty($fs_package['optional_coverages'][$optional_coverages . '_oc'][$package . '__oc__' . $optional_coverages]) ?
    $fs_package['optional_coverages'][$optional_coverages . '_oc'][$package . '__oc__' . $optional_coverages] : '';

  if ($oc_checked) {
    $f_package['optional_coverages'][$optional_coverages . '_oc'][$package . '__oc__' . $optional_coverages]['#default_value'] = TRUE;
    $f_package['optional_coverages'][$optional_coverages . '_oc'][$package . '__oc__' . $optional_coverages]['#value'] = TRUE;
    $f_package['optional_coverages'][$optional_coverages . '_oc'][$package . '__oc__' . $optional_coverages]['#checked'] = TRUE;
  }

//  if (form_get_errors()) {
//    _atj_insurance_create_cart($f_submitted['packages_layout']['cart_sidebar'], $bhtp_packages);
//  }

  return $form;
}

/**
 * Remove from cart callback.
 *
 * @param $form
 * @param $form_state
 * @return array
 */
function atj_insurance_ajax_package_remove_from_cart(&$form, $form_state) {

  return $form;
}

/**
 * Buy now button ajax callback.
 *
 * @param $form
 * @param $form_state
 * @return mixed
 */
function atj_insurance_ajax_cart_buy_now(&$form, $form_state) {
  return $form;
}