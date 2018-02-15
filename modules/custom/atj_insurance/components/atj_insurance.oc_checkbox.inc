<?php

/**
 * @file
 * ATJ Insurance optional coverages checkbox component.
 */

/**
 * Implements _webform_defaults_component().
 */
function _webform_defaults_oc_checkbox() {
  return array(
    'name' => '',
    'form_key' => NULL,
    'required' => 0,
    'pid' => 0,
    'weight' => 0,
    'value' => '',
    'extra' => array(
      'items' => '',
//      'multiple' => NULL,
//      'aslist' => NULL,
//      'empty_option' => '',
//      'optrand' => 0,
//      'other_option' => NULL,
//      'other_text' => t('Other...'),
//      'title_display' => 0,
//      'description' => '',
//      'description_above' => FALSE,
//      'custom_keys' => FALSE,
      'options_source' => '',
      'private' => FALSE,
//      'analysis' => TRUE,
    ),
  );
}

/**
 * Implements _webform_theme_component().
 */
function _webform_theme_oc_checkbox() {
  return array(
    'webform_display_select' => array(
      'render element' => 'element',
      'file' => 'components/atj_insurance.oc_checkbox.inc',
    ),
  );
}

/**
 * Implements _webform_edit_component().
 */
function _webform_edit_oc_checkbox($component) {
  $form = array();

  $form['extra']['items'] = array(
    '#type' => 'textfield',
    '#title' => t('Options'),
    '#default_value' => $component['extra']['items'],
    '#description' => t('<strong>Key-value pairs MUST be specified as "safe_key|Some readable option"</strong>. Use of only alphanumeric characters and underscores is recommended in keys.') . ' ' . theme('webform_token_help'),
    '#cols' => 60,
    '#rows' => 5,
    '#weight' => 0,
    '#required' => TRUE,
    '#wysiwyg' => FALSE,
//    '#element_validate' => array('_webform_edit_validate_select'),
  );

  $form['value'] = array(
    '#type' => 'textfield',
    '#title' => t('Default value'),
    '#default_value' => $component['value'],
    '#description' => t('The default value of the field identified by its key. For multiple selects use commas to separate multiple defaults.') . ' ' . theme('webform_token_help'),
    '#size' => 60,
    '#maxlength' => 1024,
    '#weight' => 0,
  );

  return $form;
}

/**
 * Implements _webform_render_component().
 */
function _webform_render_oc_checkbox($component, $value = NULL, $filter = TRUE, $submission = NULL) {
  $node = isset($component['nid']) ? node_load($component['nid']) : NULL;

  $element = array(
    '#title' => $filter ? webform_filter_xss($component['name']) : $component['name'],
    '#title_display' => $component['extra']['title_display'] ? $component['extra']['title_display'] : 'before',
    '#required' => $component['required'],
    '#weight' => $component['weight'],
    '#description' => $filter ? webform_filter_descriptions($component['extra']['description'], $node) : $component['extra']['description'],
    '#theme_wrappers' => array('webform_element'),
    '#translatable' => array('title', 'description', 'options'),
    '#ajax' => array(
      'callback' => 'atj_insurance_ajax_package_optional_coverages',
      'wrapper' => 'webform-ajax-wrapper-' . ATJ_INSURANCE_WEBFORM_ID,
    ),
  );
  $element['#pre_render'] = array();

  // Convert the user-entered options list into an array.
  $default_value = $filter ? webform_replace_tokens($component['value'], $node) : $component['value'];
  $options = _webform_select_options($component, TRUE, $filter);
  if (empty($options)) {
    $element['#access'] = FALSE;
  }

  if ($component['required']) {
    $element['#attributes']['required'] = 'required';
  }

  $element['#options'] = $options;

  if (!isset($value)) {
    $value = array_filter(array_map('trim', explode(',', $default_value)), 'strlen');
  }

  $value = (array)$value;

  $element['#default_value'] = array();
  foreach ($value as $option_value) {
    $element['#default_value'][] = $option_value === '' ? NULL : $option_value;
  }

  $element['#type'] = 'checkboxes';
  $element['#theme_wrappers'] = array_merge(array('checkboxes'), $element['#theme_wrappers']);
  $element['#process'] = array_merge(element_info_property('checkboxes', '#process'), array('webform_expand_select_ids'));

  return $element;
}


/**
 * Implements _webform_display_component().
 */
function _webform_display_oc_checkbox($component, $value, $format = 'html', $submission = array()) {
  $value = (array) $value;
  ksort($value, SORT_NUMERIC);
  return array(
    '#title' => $component['name'],
    '#title_display' => $component['extra']['title_display'] ? $component['extra']['title_display'] : 'before',
    '#weight' => $component['weight'],
//    '#multiple' => TRUE,
    '#theme' => 'atj_insurance_display_oc_checkbox',
    '#theme_wrappers' => $format == 'html' ? array('webform_element') : array('webform_element_text'),
    '#format' => $format,
    '#options' => _webform_select_options($component, TRUE),
    '#value' => $value,
    '#translatable' => array('title', 'options'),
  );
}