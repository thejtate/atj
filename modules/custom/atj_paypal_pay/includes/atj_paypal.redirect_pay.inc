<?php
module_load_include('inc', 'atj_paypal', 'includes/atj_paypal.sdk');

use PayPal\Api\Amount;
use PayPal\Api\CreditCard;
use PayPal\Api\Details;
use PayPal\Api\FundingInstrument;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\Address;

/**
 * @param $product_name
 * @param $product_desc
 * @param $price
 * @return array ['status' => "success" or "error", 'message' => ""  if error]
 */
function atj_paypal_create_payment($product_name, $product_desc, $price) {
  $api_context = atj_paypal_pay_init();

//  $address = new Address();
//  $address->setLine1('111 First Street');
//  $address->setCity('Saratoga');
//  $address->setState('CA');
//  $address->setPostalCode('95070');
//  $address->setCountryCode('US');
//  $address->setLine2('111 First Street');
  // ### CreditCard
// A resource representing a credit card that can be
// used to fund a payment.


// ### Payer
// A resource representing a Payer that funds a payment
// For paypal account payments, set payment method
// to 'paypal'.
  $payer = new Payer();
  $payer->setPaymentMethod("paypal");

// ### Itemized information
// (Optional) Lets you specify item wise
// information
  $item1 = new Item();
  $item1->setName($product_name)
    ->setDescription($product_desc)
    ->setCurrency('USD')
    ->setQuantity(1)
//    ->setTax(0.3)
    ->setPrice($price);

  $itemList = new ItemList();
  $itemList->setItems(array($item1));

// ### Additional payment details
// Use this optional field to set additional
// payment information such as tax, shipping
// charges etc.
  $details = new Details();
  $details->setSubtotal($price);
    /*->setShipping(1.2)
    ->setTax(1.3);*/

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
  $amount = new Amount();
  $amount->setCurrency("USD")
    ->setTotal($price)
    ->setDetails($details);

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it.
  $transaction = new Transaction();
  $transaction->setAmount($amount)
    ->setItemList($itemList)
//    ->setDescription("Payment description")
    ->setInvoiceNumber(uniqid());

  // ### Redirect urls
// Set the urls that the buyer must be redirected to after
// payment approval/ cancellation.
  $baseUrl = url(base_path(), array('absolute' => TRUE));
  $redirectUrls = new RedirectUrls();
  $redirectUrls->setReturnUrl($baseUrl . "atj-paypal-success")
    ->setCancelUrl($baseUrl . "atj-paypal-cancel");

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to 'sale'
  $payment = new Payment();
  $payment->setIntent("sale")
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions(array($transaction));


  // ### Create Payment
// Create a payment by calling the 'create' method
// passing it a valid apiContext.
// (See bootstrap.php for more on `ApiContext`)
// The return object contains the state and the
// url to which the buyer must be redirected to
// for payment approval
  try {
    $payment->create($api_context);
  } catch (Exception $ex) {
    watchdog('atj_paypal', 'Error: !message !data', array('!message' => $ex->getMessage()));
    return array('status' => 'error', 'message' => 'Payment error');
  }

// ### Get redirect url
// The API response provides the url that you must redirect
// the buyer to. Retrieve the url from the $payment->getApprovalLink()
// method
  $approvalUrl = $payment->getApprovalLink();

  //drupal_goto($approvalUrl);
//  return $approvalUrl;

  return array('status' => 'success', 'state' => $payment->getState(), 'id' => $payment->getId(), 'approval_url' => $approvalUrl);
}


function atj_paypal_execute_payment() {
  $api_context = atj_paypal_pay_init();

    // Get the payment Object by passing paymentId
    // payment id was previously stored in session in
    // CreatePaymentUsingPayPal.php
    $paymentId = $_GET['paymentId'];
    $payment = Payment::get($paymentId, $api_context);

  // ### Payment Execute
  // PaymentExecution object includes information necessary
  // to execute a PayPal account payment.
  // The payer_id is added to the request query parameters
  // when the user is redirected from paypal back to your site
  $execution = new PaymentExecution();
  $execution->setPayerId($_GET['PayerID']);

  try {
    // Execute the payment
    // (See bootstrap.php for more on `ApiContext`)
    $result = $payment->execute($execution, $api_context);


    try {
      $payment = Payment::get($paymentId, $api_context);
    } catch (Exception $ex) {

      watchdog('atj_paypal', 'Error Get Payment on execute: !message !data', array('!message' => $ex->getMessage()));
      return array('status' => 'error', 'message' => 'Payment error');
    }
  } catch (Exception $ex) {
    watchdog('atj_paypal', 'Error Executed Payment: !message !data', array('!message' => $ex->getMessage()));
    return array('status' => 'error', 'message' => 'Payment error');
  }

  //["created", "approved", "failed", "partially_completed", "in_progress"]
  if($payment->getState() !== 'failed') {
    $payer = $payment->getPayer();
    $payer_info = !empty($payer) ? $payer->getPayerInfo() : NULL;
    $shipping_address = !empty($payer) ? $payer->getPayerInfo()->getShippingAddress() : NULL;
    return array(
      'status' => 'success',
      'id' => $paymentId,
      'state' => $payment->getState(),
      'user_data' => array(
        'fist_name' => !empty($payer_info) ? $payer_info->getFirstName() : '',
        'last_name' => !empty($payer_info) ? $payer_info->getLastName() : '',
        'address1' => !empty($shipping_address) ? $shipping_address->getLine1() : '',
        'address2' => !empty($shipping_address) ? $shipping_address->getLine2() : '',
        'country' => !empty($shipping_address) ? $shipping_address->getCountryCode() : '',
        'city' => !empty($shipping_address) ? $shipping_address->getCity() : '',
        'state' => !empty($shipping_address) ? $shipping_address->getState() : '',
        'zip' => !empty($shipping_address) ? $shipping_address->getPostalCode() : '',
        'email' => !empty($payer_info) ? $payer_info->getEmail() : '',
        'phone' => !empty($payer_info) ? $payer_info->getPhone() : '',
      )
    );
  } else {
    return array('status' => 'error', 'message' => 'Payment error');
  }

}