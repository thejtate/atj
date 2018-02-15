<?php

/**
 * @file
 * Module settings.
 */

/**
 * Module settings form.
 */
function atj_filemaker_settings_form($form, &$form_state){

  $form['atj_filemaker_host'] = array(
    '#type' => 'textfield',
    '#required' => TRUE,
    '#title' => t('Host'),
    '#description' => t('Without protocol (http) and without trailing slash.'),
    '#default_value' => variable_get('atj_filemaker_host'),
  );

  $form['atj_filemaker_database'] = array(
    '#type' => 'textfield',
    '#required' => TRUE,
    '#title' => t('Database'),
    '#default_value' => variable_get('atj_filemaker_database'),
  );

  $form['atj_filemaker_user'] = array(
    '#type' => 'textfield',
    '#required' => TRUE,
    '#title' => t('User'),
    '#default_value' => variable_get('atj_filemaker_user'),
  );

  $form['atj_filemaker_password'] = array(
    '#type' => 'textfield',
    '#required' => TRUE,
    '#title' => t('Password'),
    '#default_value' => variable_get('atj_filemaker_password'),
    '#size' => 40,
  );

  return system_settings_form($form);
}