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

module_load_include("inc", "atj_custom", "includes/atj_custom.maps");

function atj_custom_admin_settings() {

  $form['atj_custom_header_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Header'),
    '#collapsible' => TRUE,
  );

  $form['atj_custom_header_settings']['telephone'] = array(
    '#type' => 'textfield',
    '#size' => 50,
    '#title' => t('Telephone'),
    '#default_value' => variable_get('telephone', ""),
  );

  $form['atj_custom_header_settings']['main_email'] = array(
    '#type' => 'textfield',
    '#size' => 50,
    '#title' => t('Email'),
    '#default_value' => variable_get('main_email', ''),
  );

  $form['atj_custom_social_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Social Settings'),
    '#collapsible' => TRUE,
  );

  $form['atj_custom_social_share_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Social Share settings'),
    '#collapsible' => TRUE,
  );

  $form['atj_custom_contacts'] = array(
    '#type' => 'fieldset',
    '#title' => t('Contacts'),
    '#collapsible' => TRUE,
  );

  $form['atj_custom_contacts']['traver_specialist_email'] = array(
    '#type' => 'textfield',
    '#size' => 50,
    '#title' => t('Travel Specialist email'),
  );

  $socials = _atj_custom_social_admin_settings_map();

  foreach($socials as $key => $data){
    $form['atj_custom_social_settings'][$key] = array(
      '#type' => 'textfield',
      '#size' => 50,
      '#title' => $data['title'],
      '#default_value' => variable_get($key, ""),
    );
  }

  $socials_share = _atj_custom_social_share_admin_settings_map();

  foreach($socials_share as $key => $data) {
    $form['atj_custom_social_share_settings'][$key] = array(
      '#type' => 'checkbox',
      '#title' => $data['title'],
      '#default_value' => variable_get($key, ""),
    );
  }

  $form['atj_custom_footer_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Footer'),
    '#collapsible' => TRUE,
  );

  $form['atj_custom_footer_settings']['copyright'] = array(
    '#type' => 'textfield',
    '#size' => 50,
    '#title' => t('Copyright'),
    '#default_value' => variable_get('copyright', ""),
  );

  return system_settings_form($form);
}