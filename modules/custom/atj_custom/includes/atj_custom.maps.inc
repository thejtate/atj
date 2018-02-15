<?php
/**
 * @file Custom maps
 */

/**
 * Social map.
 *
 * @return array
 */
function _atj_custom_social_admin_settings_map() {
  return array(
    'atj_custom_social_settings_facebook' => array(
      'title' => t('Facebook'),
      'class' => 'ss-facebook'
    ),
    'atj_custom_social_settings_twitter' => array(
      'title' => t('Twitter'),
      'class' => 'ss-twitter'
    ),
    'atj_custom_social_settings_youtube' => array(
      'title' => t('Youtube'),
      'class' => 'ss-youtube'
    ),
    'atj_custom_social_settings_instagram' => array(
      'title' => t('Instagram'),
      'class' => 'ss-instagram'
    ),
    'atj_custom_social_settings_pinterest' => array(
      'title' => t('Pinterest'),
      'class' => 'ss-pinterest'
    ),
  );
}

/**
 * Social Share map.
 *
 * @return array
 */
function _atj_custom_social_share_admin_settings_map() {
  return array(
    'atj_custom_social_share_settings_facebook' => array(
      'title' => t('Facebook'),
      'class' => 'ico ss-icon ss-social-regular ss-facebook st_facebook_custom'
    ),
    'atj_custom_social_share_settings_twitter' => array(
      'title' => t('Twitter'),
      'class' => 'ico ss-icon ss-social-regular ss-twitter st_twitter_custom'
    ),
    'atj_custom_social_share_settings_mail' => array(
      'title' => t('Mail'),
      'class' => 'ico ss-icon ss-standard ss-mail st_email_custom'
    ),
  );
}