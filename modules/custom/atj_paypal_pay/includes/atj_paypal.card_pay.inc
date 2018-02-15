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
use PayPal\Api\Transaction;
use PayPal\Api\Address;

/**
 * @param $type
 * @param $number
 * @param $month
 * @param $year
 * @param $cvv
 * @param $first_name
 * @param $last_name
 * @param $product_name
 * @param $product_desc
 * @param $price
 * @return array ['status' => "success" or "error", 'message' => ""  if error]
 */
function atj_paypal_pay($type, $number, $month, $year, $cvv, $first_name, $last_name, $product_name, $product_desc, $price) {
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
  $card = new CreditCard();
  $card->setType($type)
    ->setNumber($number)
    ->setExpireMonth($month)
    ->setExpireYear($year)
    ->setCvv2($cvv)
    ->setFirstName($first_name)
    ->setLastName($last_name);
  //->setBillingAddress($address);

// ### FundingInstrument
// A resource representing a Payer's funding instrument.
// For direct credit card payments, set the CreditCard
// field on this object.
  $fi = new FundingInstrument();
  $fi->setCreditCard($card);

// ### Payer
// A resource representing a Payer that funds a payment
// For direct credit card payments, set payment method
// to 'credit_card' and add an array of funding instruments.
  $payer = new Payer();
  $payer->setPaymentMethod("credit_card")
    ->setFundingInstruments(array($fi));

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

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to sale 'sale'
  $payment = new Payment();
  $payment->setIntent("sale")
    ->setPayer($payer)
    ->setTransactions(array($transaction));

  try {
    $payment->create($api_context);

  } catch (PayPal\Exception\PayPalConnectionException $e) {
    $error_message = "Payment error. \n";

    $error_object = json_decode($e->getData());
    if(!empty($error_object->name) && !empty($error_object->details)) {
      switch ($error_object->name) {
        case 'VALIDATION_ERROR':
          $error_message =  "Payment failed due to invalid Credit Card details:\n";
          foreach ($error_object->details as $er)
          {
            $error_message .= atj_paypal_eror_field_name($er->field) . " - \t";
            $error_message .= $er->issue . "\n";
          }
          break;
      }
    }

    watchdog('atj_paypal', 'Error: !message !data', array('!message' => $e->getMessage(), '!data' => $e->getData()));
    return array('status' => 'error', 'message' => $error_message);
  } catch (Exception $e) {

    watchdog('atj_paypal', 'Error: !message !data', array('!message' => $e->getMessage()));
    return array('status' => 'error', 'message' => 'Payment error');
  }

  //["created", "approved", "failed", "partially_completed", "in_progress"]
  if($payment->getState() !== 'failed') {
    return array('status' => 'success', 'state' => $payment->getState(), 'id' => $payment->getId());
  } else {
    return array('status' => 'error', 'message' => 'Payment error');
  }
}

function atj_paypal_eror_field_name($field) {
  $output = str_replace('payer.funding_instruments[0]', '', $field);
  $output = str_replace('_', ' ', $output);
  $output = str_replace('.', ' ', $output);
  return $output;
}