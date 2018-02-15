<?php

/**
 * Current module settings for extending fnl_store_payment_settings_form
 */
function atj_paypal_settings_form($form, &$form_state) {
  $form = array();

  $form['atj_paypal_type'] = array(
    '#type' => 'select',
    '#required' => TRUE,
    '#title' => t('Mode'),
    '#default_value' => variable_get('atj_paypal_type', 'card'),
    '#options' => array('paypal' => t('Redirect to paypal'), 'card' => t('Card'), 'payflow_card' => 'PayFlow pro. Card.'),
  );

  $form['atj_paypal_mode'] = array(
    '#type' => 'select',
    '#required' => TRUE,
    '#title' => t('Mode'),
    '#default_value' => variable_get('atj_paypal_mode', 'sandbox'),
    '#options' => array('live' => t('Live'), 'sandbox' => t('Sandbox')),
  );

  $form['live'] = array(
    '#type' => 'fieldset',
    '#tree' => FALSE,
    '#title' => t('Live settings'),
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
    '#states' => array(
      'visible' => array(
        ':input[name$="atj_paypal_mode"]' => array('value' => 'live'),
        ':input[name$="atj_paypal_type"]' => array('!value' => 'payflow_card'),
      )
    ),
    '#description' => 'Require account from http://paypal.com',
  );

  $form['live']['atj_paypal_live_client_id'] = array(
    '#type' => 'textfield',
    '#required' => FALSE,
    '#title' => t('Client ID'),
    '#default_value' => variable_get('atj_paypal_live_client_id', ''),
  );
  $form['live']['atj_paypal_live_client_secret'] = array(
    '#type' => 'textfield',
    '#required' => FALSE,
    '#title' => t('Client Secret'),
    '#default_value' => variable_get('atj_paypal_live_client_secret', ''),
  );

  $form['sandbox'] = array(
    '#type' => 'fieldset',
    '#tree' => FALSE,
    '#title' => t('Sandbox settings'),
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
    '#states' => array(
      'visible' => array(
        ':input[name$="atj_paypal_mode"]' => array('value' => 'sandbox'),
        ':input[name$="atj_paypal_type"]' => array('!value' => 'payflow_card')
      )),
    '#description' => 'Require account from http://paypal.com',
  );

  $form['sandbox']['atj_paypal_sandbox_client_id'] = array(
    '#type' => 'textfield',
    '#required' => FALSE,
    '#title' => t('Client ID'),
    '#default_value' => variable_get('atj_paypal_sandbox_client_id', ''),
  );
  $form['sandbox']['atj_paypal_sandbox_client_secret'] = array(
    '#type' => 'textfield',
    '#required' => FALSE,
    '#title' => t('Client Secret'),
    '#default_value' => variable_get('atj_paypal_sandbox_client_secret', ''),
  );

  $form['live_payflow'] = array(
    '#type' => 'fieldset',
    '#tree' => FALSE,
    '#title' => t('Live settings'),
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
    '#states' => array(
      'visible' => array(
        ':input[name$="atj_paypal_mode"]' => array('value' => 'live'),
        ':input[name$="atj_paypal_type"]' => array('value' => 'payflow_card')
      )),
    '#description' => 'Require account from http://manager.paypal.com',
  );

  $form['live_payflow']['atj_paypal_payflow_live_partner'] = array(
    '#type' => 'textfield',
    '#required' => FALSE,
    '#title' => t('Partner'),
    '#default_value' => variable_get('atj_paypal_payflow_live_partner', ''),
  );

  $form['live_payflow']['atj_paypal_payflow_live_vendor'] = array(
    '#type' => 'textfield',
    '#required' => FALSE,
    '#title' => t('Vendor'),
    '#default_value' => variable_get('atj_paypal_payflow_live_vendor', ''),
  );
  $form['live_payflow']['atj_paypal_payflow_live_user'] = array(
    '#type' => 'textfield',
    '#required' => FALSE,
    '#title' => t('User'),
    '#default_value' => variable_get('atj_paypal_payflow_live_user', ''),
  );
  
  $form['live_payflow']['atj_paypal_payflow_live_pass'] = array(
    '#type' => 'textfield',
    '#required' => FALSE,
    '#title' => t('Password'),
    '#default_value' => variable_get('atj_paypal_payflow_live_pass', ''),
  );


  $form['sandbox_payflow'] = array(
    '#type' => 'fieldset',
    '#tree' => FALSE,
    '#title' => t('Sandbox settings'),
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
    '#states' => array(
      'visible' => array(
        ':input[name$="atj_paypal_mode"]' => array('value' => 'sandbox'),
        ':input[name$="atj_paypal_type"]' => array('value' => 'payflow_card')
      )),
    '#description' => 'Require account from http://manager.paypal.com',
  );

  $form['sandbox_payflow']['atj_paypal_payflow_sandbox_partner'] = array(
    '#type' => 'textfield',
    '#required' => FALSE,
    '#title' => t('Partner'),
    '#default_value' => variable_get('atj_paypal_payflow_sandbox_partner', ''),
  );

  $form['sandbox_payflow']['atj_paypal_payflow_sandbox_vendor'] = array(
    '#type' => 'textfield',
    '#required' => FALSE,
    '#title' => t('Vendor'),
    '#default_value' => variable_get('atj_paypal_payflow_sandbox_vendor', ''),
  );
  $form['sandbox_payflow']['atj_paypal_payflow_sandbox_user'] = array(
    '#type' => 'textfield',
    '#required' => FALSE,
    '#title' => t('User'),
    '#default_value' => variable_get('atj_paypal_payflow_sandbox_user', ''),
  );

  $form['sandbox_payflow']['atj_paypal_payflow_sandbox_pass'] = array(
    '#type' => 'textfield',
    '#required' => FALSE,
    '#title' => t('Password'),
    '#default_value' => variable_get('atj_paypal_payflow_sandbox_pass', ''),
  );

  return system_settings_form($form);
}