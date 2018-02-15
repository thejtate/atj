<?php

/**
 * @file
 * PHP execute extended tool admin interface.
 */

/**
 * Settings form builder for phpx_tools module.
 */
function phpx_tools_settings_form($form, $form_state) {
  $info = variable_get('phpx_tools_forms', array('devel_execute_form' => array('code')));
  $default_value = '';

  if (!empty($info)) {
    foreach ($info as $form_id => $fields) {
      foreach ($fields as $field) {
        $default_value .= "$form_id|$field\n";
      }
    }
  }

  $form['phpx_tools_forms'] = array(
    '#type' => 'textarea',
    '#title' => t('Forms NAMES to add syntax highlighting.'),
    '#description' => t('Enter form names and field names separated with <strong>"|"</strong> symbol. Each pair should be on the new line.'),
    '#default_value' => $default_value,
  );

  $form['actions']['#type'] = 'actions';
  $form['actions']['submit'] = array('#type' => 'submit', '#value' => t('Save configuration'));
  $form['#theme'] = 'system_settings_form';

  return $form;
}

/**
 * Submit handler for phpx_tools_settings_form form.
 */
function phpx_tools_settings_form_submit($form, $form_state) {
  $config = array();

  if ($lines = explode("\n", $form_state['values']['phpx_tools_forms'])) {
    foreach ($lines as $line) {
      if (!empty($line)) {
        list($form_id, $field) = explode('|', $line);
        // Remove all the line breaks and add field into thr form array.
        $config[$form_id][] = preg_replace("/\n|\r/", '', $field);
      }
    }
  }

  variable_set('phpx_tools_forms', $config);
  drupal_set_message(t('The configuration options have been saved.'));
}
