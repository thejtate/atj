<?php

/**
 * Including, init sdk.
 */

$composerAutoload = dirname(__DIR__) . '/paypal_sdk/autoload.php';
if (!file_exists($composerAutoload)) {
  //If the project is used as its own project, it would use rest-api-sdk-php composer autoloader.
  $composerAutoload = dirname(__DIR__) . '/paypal_sdk/paypal/rest-api-sdk-php/vendor/autoload.php';


  if (!file_exists($composerAutoload)) {
    drupal_set_message("The 'vendor' folder is missing. You must run 'composer update' to resolve application dependencies.\nPlease see the README for more information.\n", 'error');
  }
}
require_once $composerAutoload;

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;


function atj_paypal_pay_init() {

  if(variable_get('atj_paypal_mode', 'sandbox') == 'sandbox') {
    $clientId = variable_get('atj_paypal_sandbox_client_id', '');
    $clientSecret = variable_get('atj_paypal_sandbox_client_secret', '');
  } else {
    $clientId = variable_get('atj_paypal_live_client_id', '');
    $clientSecret = variable_get('atj_paypal_live_client_secret', '');
  }
//  $clientId = 'AUbxqUMMnNOWSdK6aGgJcHcMwpxfm9715SUbESPIQneyfqR8j1szeGb-6BqkZ9_dUyPaDpjrySOT6X38';
//  $clientSecret = 'EAHLgcd57TX7nTw0Zi7VpZv8wROjZcMXzt1clNrPS3fXjBbwOhHfOShLJOu2Pnzb7XMfrtGek7PnZmwd';


  /**
   * All default curl options are stored in the array inside the PayPalHttpConfig class. To make changes to those settings
   * for your specific environments, feel free to add them using the code shown below
   * Uncomment below line to override any default curl options.
   */
//PayPalHttpConfig::$defaultCurlOptions[CURLOPT_SSLVERSION] = CURL_SSLVERSION_TLSv1_2;


  /** @var \Paypal\Rest\ApiContext $apiContext */
  $apiContext = getApiContext($clientId, $clientSecret);

  return $apiContext;
}

function getApiContext($clientId, $clientSecret)
{


  // ### Api context
  // Use an ApiContext object to authenticate
  // API calls. The clientId and clientSecret for the
  // OAuthTokenCredential class can be retrieved from
  // developer.paypal.com

  $apiContext = new ApiContext(
    new OAuthTokenCredential(
      $clientId,
      $clientSecret
    )
  );

  // Comment this line out and uncomment the PP_CONFIG_PATH
  // 'define' block if you want to use static file
  // based configuration

  $mode = variable_get('atj_paypal_mode', 'sandbox');

  $apiContext->setConfig(
    array(
      'mode' => $mode,
      'log.LogEnabled' => true,
      'log.FileName' => '../PayPal.log',
      'log.LogLevel' => ($mode == 'sandbox') ? 'DEBUG' : 'INFO', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
      'cache.enabled' => true,
      // 'http.CURLOPT_CONNECTTIMEOUT' => 30
      // 'http.headers.PayPal-Partner-Attribution-Id' => '123123123'
      //'log.AdapterFactory' => '\PayPal\Log\DefaultLogFactory' // Factory class implementing \PayPal\Log\PayPalLogFactory
    )
  );

  // Partner Attribution Id
  // Use this header if you are a PayPal partner. Specify a unique BN Code to receive revenue attribution.
  // To learn more or to request a BN Code, contact your Partner Manager or visit the PayPal Partner Portal
  // $apiContext->addRequestHeader('PayPal-Partner-Attribution-Id', '123123123');

  return $apiContext;
}