<?php
/**
 * @file
 * Theme hook and theme functions
 */

/**
 * Implementation of hook_theme().
 */
function atj_insurance_theme($existing, $type, $theme, $path) {
  $theme_path = drupal_get_path('module', 'atj_insurance');
  $items = array();

  $items['atj_insurance_package_selection'] = array(
    'template' => 'atj-insurance-package-selection',
    'variables' => array('data' => NULL),
    'render element' => 'form',
    'path' => $theme_path . '/templates',
  );

  $items['atj_insurance_package_item'] = array(
    'template' => 'atj-insurance-package-item',
    'variables' => array('data' => NULL),
    'path' => $theme_path . '/templates',
  );

  $items['atj_insurance_packages_header'] = array(
    'template' => 'atj-insurance-packages-header',
    'path' => $theme_path . '/templates',
  );

  $items['atj_insurance_coverage_cart'] = array(
    'template' => 'atj-insurance-coverage-cart',
    'variables' => array('packages' => NULL,'oc_items' => NULL, 'fees' => NULL, 'total_amount' => NULL),
    'path' => $theme_path . '/templates',
  );

  $items['atj_insurance_coverage_cart_header'] = array(
    'variables' => array('count' => NULL),
  );

  $items['atj_insurance_coverage_cart_package_info'] = array(
    'variables' => array('name' => NULL, 'base_amount' => NULL),
  );

  $items['atj_insurance_coverage_cart_package_fees'] = array(
    'variables' => array('name' => NULL, 'amount' => NULL),
  );

  $items['atj_insurance_coverage_cart_oc'] = array(
    'variables' => array('name' => NULL, 'amount' => NULL),
  );

  $items['atj_insurance_errors'] = array(
    'variables' => array('errors' => NULL),
  );

  $items['atj_insurance_display_oc_checkbox'] = array(
    'render element' => 'element',
  );

  return $items;
}

/**
 * Theme function for render cart header.
 */
function theme_atj_insurance_coverage_cart_header($vars) {
  $output = t('Coverage Cart') . '<span class="count">' . $vars['count'] . '</span>';
  $output = '<div class="cart-header">' . $output . '</div>';

  return $output;
}

/**
 * Theme function for render package item.
 */
function theme_atj_insurance_coverage_cart_package_info($vars) {
  $output = '<div class="package-name">' . $vars['name'] . '</div>';
  $output .= '<span class="amount">' . '$' . number_format((float)$vars['base_amount'], 2, '.', '') . '</span>';

  return $output;
}

/**
 * Theme function for render cart fees.
 */
function theme_atj_insurance_coverage_cart_package_fees($vars) {
  $output = '<div class="cart-item">';
  $output .= '<div class="package-name">' . $vars['name'] . '</div>';
  $output .= '<span class="amount">' . '$' . number_format((float)$vars['amount'], 2, '.', '') . '</span>';
  $output .= '</div>';
  return $output;
}

/**
 * Theme function for render cart optional coverages.
 */
function theme_atj_insurance_coverage_cart_oc($vars) {
  $output = '<div class="oc-name">' . $vars['name'] . '</div>';
  $output .= '<span class="amount">' . '$' . number_format((float)$vars['amount'], 2, '.', '') . '</span>';
  return $output;
}

/**
 * Theme function for render errors.
 */
function theme_atj_insurance_errors($vars) {
  $errors = $vars['errors'];
  $output = '';
  $output .= "<div class=\"bhtp-messages \">\n";
  if (count($errors) > 1) {
    $output .= " <ul>\n";
    foreach ($errors as $message) {
      $output .= '  <li>' . $message . "</li>\n";
    }
    $output .= " </ul>\n";
  }
  else {
    $output .= reset($errors);
  }
  $output .= "</div>\n";

  return $output;
}

function theme_atj_insurance_display_oc_checkbox($variables) {
  $element = $variables['element'];
  $value = reset($element['#value']);

  if (!empty($value)) {
    $key = key($element['#value']);
    $value = !empty($element['#options'][$key]) ? $element['#options'][$key] : '';
  }
  else {
    $value = '';
  }
  return $value;
}