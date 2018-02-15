<?php

namespace Kite\OhMyEmma\Interfaces;

/**
 * Created by PhpStorm.
 * User: dimateus
 * Date: 04/08/2017
 * Time: 13:14
 */

class SearchesOverrided extends Searches {

  /**
   * Request Object passed in via the
   * factory controller.
   *
   * @var object
   */
  private $_request = '';

  public function getSearchesWithFilters( $searchId = '', $members = FALSE, $deleted = FALSE, $filters = array()) {
    $this->_request->method = "GET";
    $url = '/searches';
    if ($searchId !== '') {
      $url .= '/' . $searchId;
      if ($members === true) {
        $url .= '/members';
      }
    }

    if ($deleted === true) {
      $filters['deleted'] = 'true';
    }

    if (is_array($filters) === true && !empty($filters)) {
      $url .= '?' . http_build_query($filters);
    }

    return $this->_request->processRequest($url);
  }

  public function __construct($request) {
    if (is_object($request)) {
      $this->_request = $request;
    } else {
      return 'You can not use this class without a valid request object';
    }
  }


}