<?php
/**
 * @file payflow pro payment.
 */


function atj_paypal_payflow_pro_pay($number, $month, $year, $cvv, $first_name, $last_name, $street1, $street2, $city, $state, $zip, $country, $comment1, $comment2, $email, $phone, $price) {
  
  $credentials = atj_paypal_payflow_pro_get_credentials();
 
  $request = $credentials + array(
      'TENDER' => 'C',// c = credit card
      'TRXTYPE' => 'S',// s = sale
      'CURRENCY' => 'USD',
      'AMT' => number_format($price, 2, '.', ''),
      'ACCT' => $number,
      'EXPDATE' => $month . $year,
      'CVV2' => $cvv,
      'BILLTOFIRSTNAME' => substr($first_name, 0, 45),
      'BILLTOLASTNAME' => substr($last_name, 0, 45),
      'BILLTOSTREET' => substr($street1, 0, 150),
      'BILLTOSTREET2' => substr($street2, 0, 150),
      'BILLTOCITY' => substr($city, 0, 45),
      'BILLTOSTATE' => substr($state, 0, 2),
      'BILLTOZIP' => substr($zip, 0, 10),
      'BILLTOCOUNTRY' => substr($country, 0, 2),
      'BILLTOEMAIL' => substr($email, 0, 100),
      'BILLTOPHONENUM' => substr(preg_replace('/\D+/', '', $phone), 0, 10),
      'SHIPTOFIRSTNAME' => substr($first_name, 0, 45),
      'SHIPTOLASTNAME' => substr($last_name, 0, 45),
      'SHIPTOSTREET' => substr($street1, 0, 150),
      'SHIPTOSTREET2' => substr($street2, 0, 150),
      'SHIPTOCITY' => substr($city, 0, 45),
      'SHIPTOSTATE' => substr($state, 0, 2),
      'SHIPTOZIP' => substr($zip, 0, 10),
      'SHIPTOCOUNTRY' => substr($country, 0, 2),
      'SHIPTOEMAIL' => substr($email, 0, 100),
      'SHIPTOPHONENUM' => substr(preg_replace('/\D+/', '', $phone), 0, 10),
      'COMMENT1' => substr($comment1, 0, 150),
      'COMMENT2' => substr($comment2, 0, 150),
    );

//  dsm($request);return (array('status' => 'success'));

  $response = atj_paypal_payflow_call($request);

  if(empty($response)) {
    return array('status' => 'error', 'message' => 'Error connecting to PayPal');
  } else if($response['RESULT'] == 0) {
    return array('status' => 'success','id' => $response['PNREF'], 'state' =>$response['RESPMSG']);
  } else {
    watchdog('atj_paypal', 'Error payflow execute: !message !user_message', array('!message' => $response['RESPMSG'], '!user_message' => atj_paypal_payflow_link_result_message($response['RESULT'])));
   return array('status' => 'error', 'message' => atj_paypal_payflow_link_result_message($response['RESULT']));
  }
}

function atj_paypal_payflow_pro_get_credentials() {

  if (variable_get('atj_paypal_mode', 'sandbox') == 'sandbox') {
    return array(
      'PARTNER' => variable_get('atj_paypal_payflow_sandbox_partner', ''),
      'VENDOR' => variable_get('atj_paypal_payflow_sandbox_vendor', ''),
      'USER' => variable_get('atj_paypal_payflow_sandbox_user', ''),
      'PWD' => variable_get('atj_paypal_payflow_sandbox_pass', ''),
    );
  }
  else {
    return array(
      'PARTNER' => variable_get('atj_paypal_payflow_live_partner', ''),
      'VENDOR' => variable_get('atj_paypal_payflow_live_vendor', ''),
      'USER' => variable_get('atj_paypal_payflow_live_user', ''),
      'PWD' => variable_get('atj_paypal_payflow_live_pass', ''),
    );
  }
}

function atj_paypal_payflow_call($params) {
  $environment = variable_get('atj_paypal_mode', 'sandbox');

  $paramList = array();
  foreach($params as $index => $value) {
    $paramList[] = $index . "[" . strlen($value) . "]=" . $value;
  }

  $apiStr = implode("&", $paramList);

  // Which endpoint will we be using?
  if( $environment == "sandbox") {
    $endpoint = "https://pilot-payflowpro.paypal.com/";
  } else {
    $endpoint = "https://payflowpro.paypal.com";
  }

  // Initialize our cURL handle.
  $curl = curl_init($endpoint);

  curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

  // If you get connection errors, it may be necessary to uncomment
  // the following two lines:
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

  curl_setopt($curl, CURLOPT_POST, TRUE);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $apiStr);

  $result = curl_exec($curl);
  if($result === FALSE) {
    watchdog('atj_paypal', 'Error payflow curl execute: !message ', array('!message' => curl_error($curl)));
    return FALSE;
  }
  else return atj_paypal_parse_payflow_string($result);
}

/**
 * parse_payflow_string: Parses a response string from Payflow and returns an
 * associative array of response parameters.
 */
function atj_paypal_parse_payflow_string($str) {
  $workstr = $str;
  $out = array();

  while(strlen($workstr) > 0) {
    $loc = strpos($workstr, '=');
    if($loc === FALSE) {
      // Truncate the rest of the string, it's not valid
      $workstr = "";
      continue;
    }

    $substr = substr($workstr, 0, $loc);
    $workstr = substr($workstr, $loc + 1); // "+1" because we need to get rid of the "="

    if(preg_match('/^(\w+)\[(\d+)]$/', $substr, $matches)) {
      // This one has a length tag with it.  Read the number of characters
      // specified by $matches[2].
      $count = intval($matches[2]);

      $out[$matches[1]] = substr($workstr, 0, $count);
      $workstr = substr($workstr, $count + 1); // "+1" because we need to get rid of the "&"
    } else {
      // Read up to the next "&"
      $count = strpos($workstr, '&');
      if($count === FALSE) { // No more "&"'s, read up to the end of the string
        $out[$substr] = $workstr;
        $workstr = "";
      } else {
        $out[$substr] = substr($workstr, 0, $count);
        $workstr = substr($workstr, $count + 1); // "+1" because we need to get rid of the "&"
      }
    }
  }

  return $out;
}

/**
 * Returns the message to display to a customer explaining the RESULT of a
 * Payflow transaction.
 *
 * @param $result
 *   The RESULT value from a Payflow transaction.
 *
 * @return
 *   An error or explanation message fit for display to a customer.
 */
function atj_paypal_payflow_link_result_message($result) {
  switch (intval($result)) {
    case 0:
      return t('Transaction approved.');
    case 1:
    case 5:
    case 26:
      return t('The Payflow hosted checkout page is not configured for use. Please contact an administrator to resolve this issue.');
    case 2:
    case 25:
      return t('You have attempted to use an invalid payment method. Please check your payment information and try again.');
    case 3:
      return t('The specified transaction type is not appropriate for this transaction.');
    case 4:
    case 6:
      return t('The payment request specified an invalid amount format or currency code. Please contact an administrator to resolve this issue.');
    case 7:
    case 8:
    case 9:
    case 10:
    case 19:
    case 20:
      return t('The payment request included invalid parameters. Please contact an administrator to resolve this issue.');
    case 11:
    case 115:
    case 160:
    case 161:
    case 162:
      return t('The payment request timed out. Please try again or contact an administrator to resolve the issue.');
    case 12:
    case 13:
    case 22:
    case 23:
    case 24:
      return t('Payment declined. Please check your payment information and try again.');
    case 27:
    case 28:
    case 29:
    case 30:
    case 31:
    case 32:
    case 33:
    case 34:
    case 35:
    case 36:
    case 37:
    case 52:
    case 99:
    case 100:
    case 101:
    case 102:
    case 103:
    case 104:
    case 105:
    case 106:
    case 107:
    case 108:
    case 109:
    case 110:
    case 111:
    case 113:
    case 116:
    case 118:
    case 120:
    case 121:
    case 122:
    case 132:
    case 133:
    case 150:
    case 151:
      return t('The transaction failed at PayPal. Please contact an administrator to resolve this issue.');
    case 50:
    case 51:
      return t('Payment was declined due to insufficient funds or transaction limits. Please check your payment information and try again.');
    case 112:
      return t('Address and Zip code do not match. Please check your payment information and try again.');
    case 114:
      return t('Card Security Code (CVV) does not match. Please check your payment information and try again.');
    case 117:
    case 125:
    case 127:
    case 128:
      return t('Payment was declined due to merchant fraud settings. Please contact an administrator to resolve this issue.');
    case 126:
      return t('Payment was flagged for review by the merchant. We will validate the payment and update your order as soon as possible.');
    default:
      return t('Payment error');

  }
}