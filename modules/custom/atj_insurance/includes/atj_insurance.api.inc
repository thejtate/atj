<?php

/**
 * @file atj insurance api
 */

/**
 * Send request.
 *
 * @param $method
 * @param string $url
 * @param array $data
 * @param bool|TRUE $authorization
 * @param bool|TRUE $return_error_message
 * @return array|mixed
 */
function atj_insurance_send_request($method, $url = '',  $data = array(), $authorization = TRUE) {
  $result_data = array();
  $auth_token = variable_get('atj_insurance_token', '');

  $options = array(
    'method' => $method,
    'data' => json_encode($data),
    'headers' => array(
      'Content-Type' => 'application/json',
      'Authorization' => $authorization ? 'Bearer ' . $auth_token : '',
    ),
  );

  $result = drupal_http_request($url, $options);
  $result_code = !empty($result->code) ? $result->code : 0;
  $result_error = !empty($result->error) ? $result->error : '';

  if ($result_code != ATJ_INSURANCE_NORMAL_RESPONSE) {
    if (empty($auth_token)) {
      $result_code = ATJ_INSURANCE_AUTHENTICATION_ERROR;
    }

    switch ($result_code) {
      case ATJ_INSURANCE_AUTHENTICATION_ERROR:
        $result = atj_insurance_authentication();
        if ($result) {
          atj_insurance_send_request($method, $url, $data, $authorization);
        }
        break;
      default:
        $json_data = !empty($result->data) ? json_decode($result->data) : '';
        $result_data_no_json = !empty($result->data) ? $result->data : '';
        $messages = !empty($json_data->messages) ? $json_data->messages : $result_data_no_json;

        if (!empty($data->paymentInformation)) {
          unset($data->paymentInformation);
        }

        watchdog('atj_insurance', 'Error: %error, Code: %code, Path: %path,<br/> Data: <br/>%data<br/> Error messages: <br/>%response', array(
          '%error' => $result_error,
          '%code' => $result_code,
          '%path' => $url,
          '%data' => var_export($data, TRUE),
          '%response' => var_export($messages, TRUE),
        ), WATCHDOG_ERROR);
        break;
    }
  }

  $result_data['response'] = !empty($result->data) ? json_decode($result->data) : '';
  $result_data['code'] = $result_code;

  return $result_data;
}

/**
 * Authentication.
 */
function atj_insurance_authentication() {
  $agent_code = variable_get('atj_insurance_agent_code', '');
  $username = variable_get('atj_insurance_email', '');
  $password = variable_get('atj_insurance_password', '');
  $url = "https://api.bhtp.com/v1/auth/login/" . $agent_code;

  if ($agent_code && $username && $password) {
    $data = array(
      "username" => $username,
      "password" => $password
    );

    $options = array(
      'method' => 'POST',
      'data' => json_encode($data),
      'headers' => array(
        'Content-Type' => 'application/json'
      ),
    );

    $result = drupal_http_request($url, $options);
    $result_code = !empty($result->code) ? $result->code : 0;
    $result_error = !empty($result->error) ? $result->error : '';

    if ($result_code != ATJ_INSURANCE_NORMAL_RESPONSE) {
      watchdog('atj_insurance', 'Authentication error: %error, Code: %code', array(
        '%error' => $result,
        '%code' => $result_code
      ), WATCHDOG_ERROR);
    }
    else {
      $result_data = json_decode($result->data);
      variable_set('atj_insurance_token', $result_data->token);
      return TRUE;
    }
  }

  return FALSE;
}