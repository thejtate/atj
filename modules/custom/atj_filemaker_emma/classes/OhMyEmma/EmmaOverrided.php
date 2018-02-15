<?php
use Kite\OhMyEmma\Emma;
use Kite\OhMyEmma\Request;

/**
 * Created by PhpStorm.
 * User: dimateus
 * Date: 04/08/2017
 * Time: 13:15
 */

class EmmaOverrided extends  Emma {
  /**
   * cURL request object
   *
   * @var object
   */
  private $_request = '';

  /**
   *
   * Magic method called when reading inaccessible properties
   * This method will instantiate interfaces if they have not
   * yet been instantiated.
   *
   * @param string $property
   */
  public function __get($interface){


   //check if the passed property matches our interfaces
    if(in_array($interface, array(
      'SearchesOverrided',
      'Events',
      'Fields',
      'Groups',
      'Mailings',
      'Members',
      'Responses',
      'Searches',
      'Triggers',
      'Webhooks'
      )))
    {
      //if this interface has not been instantiated, create a new instance
      if(!isset($this->$interface)) {
        $reflectedInterface = new \ReflectionClass('\\Kite\\OhMyEmma\\Interfaces\\' . $interface);
        $this->$interface = $reflectedInterface->newInstanceArgs(array('_request' => $this->_request));
        return $this->$interface;
      }

      //otherwise, return the existing instance
      return $this->$interface;
    }
    return;
  }

  public function __construct($account_id, $public_key, $private_key) {
    $this->_request = new Request(
      $account_id,
      $public_key,
      $private_key
    );
  }

}