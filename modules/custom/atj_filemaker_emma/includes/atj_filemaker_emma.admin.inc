<?php
/**
 * @file
 *  settings form.
 */

/**
 * Module settings form.
 */
function atj_filemaker_emma_settings_form($form, &$form_state){


  $form['emma'] = array(
    '#type' => 'fieldset',
    '#tree' => FALSE,
    '#title' => t('Emma API settings'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  $form['emma']['atj_filemaker_emma_account_id'] = array(
    '#type' => 'textfield',
    '#required' => TRUE,
    '#title' => t('Account id'),
    '#description' => t('like 9999585'),
    '#default_value' => variable_get('atj_filemaker_emma_account_id'),
  );

  $form['emma']['atj_filemaker_public_api_key'] = array(
    '#type' => 'textfield',
    '#required' => TRUE,
    '#title' => t('Public API key'),
    '#default_value' => variable_get('atj_filemaker_public_api_key'),
  );

  $form['emma']['atj_filemaker_private_api_key'] = array(
    '#type' => 'textfield',
    '#required' => TRUE,
    '#title' => t('Private API key'),
    '#default_value' => variable_get('atj_filemaker_private_api_key'),
  );

  $form['emma_integration'] = array(
    '#type' => 'fieldset',
    '#tree' => FALSE,
    '#title' => t('Emma Synchronization settings'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  $form['emma_integration']['atj_filemaker_emma_group_id'] = array(
    '#type' => 'textfield',
    '#required' => FALSE,
    '#title' => t('Group id, to synchronize to Filemaker. Only for test mode.'),
    '#description' => t('Test 3443041'),
    '#default_value' => variable_get('atj_filemaker_emma_group_id'),
  );

  $form['emma_integration']['atj_filemaker_emma_cron_enable'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable synchronization by cron (only fm updates, not EM webhhoks)'),
    '#default_value' => variable_get('atj_filemaker_emma_cron_enable', FALSE),
  );

  $form['emma_integration']['atj_filemaker_emma_test_mode'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable Test Mode'),
    '#default_value' => variable_get('atj_filemaker_emma_test_mode', FALSE),
  );

  return system_settings_form($form);
}