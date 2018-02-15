<?php

/**
 * Helper class to work with ohMyEmma responses
 */
class OhMyEmmaResult {

  public $is_valid = FALSE;
  public $data = NULL;
  public $error_message = '';
  public $code;
  public $full_response;

  public function __construct($data) {
    $this->code = !empty($data['code']) ? $data['code'] : FALSE;
    $this->full_response = $data;

    if($this->code && $this->code == 200) {
      try {
        $this->data = !empty($data['details']) ? json_decode($data['details']) : NULL;
        $this->is_valid = TRUE;
      } catch(Exception $e) {
        $this->error_message = t('Error parsing JSON %message', array('%message' => $e->getMessage()));
      }
    } else {
      $this->error_message = t('Error on Api request, error code %code', array('%code' => $this->code));
    }
  }


  public function getErrorMessageWithFullResponse() {
    return $this->error_message . ' ' . $this->getFullResponseAsText();
  }

  public function getFullResponseAsText() {
    return '<pre>' . print_r($this->full_response, TRUE) . '</pre>';
  }
}