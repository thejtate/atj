<?php

/**
* @file
* Administration page callbacks.
*/

/**
* Form builder.
*
* @ingroup forms
* @see system_settings_form().
*/
function atj_insurance_admin_settings() {

  $form['atj_insurance_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('ATJ Insurance'),
    '#collapsible' => TRUE,
  );

  $form['atj_insurance_settings']['atj_insurance_email'] = array(
    '#type' => 'textfield',
    '#size' => 50,
    '#title' => t('Email'),
    '#default_value' => variable_get('atj_insurance_email', ""),
  );

  $form['atj_insurance_settings']['atj_insurance_password'] = array(
    '#type' => 'textfield',
    '#size' => 50,
    '#title' => t('Password'),
    '#default_value' => variable_get('atj_insurance_password', ""),
  );

  $form['atj_insurance_settings']['atj_insurance_agent_code'] = array(
    '#type' => 'textfield',
    '#size' => 50,
    '#title' => t('Agent Code'),
    '#default_value' => variable_get('atj_insurance_agent_code', ""),
  );

  $form['atj_insurance_settings']['atj_insurance_agency_code'] = array(
    '#type' => 'textfield',
    '#size' => 50,
    '#title' => t('Agency Code'),
    '#default_value' => variable_get('atj_insurance_agency_code', ""),
  );

  return system_settings_form($form);
}