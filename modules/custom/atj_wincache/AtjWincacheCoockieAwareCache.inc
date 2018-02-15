<?php
/**
 * Extends the win cache to factor in the specified cookie values.
 */
class AtjWincacheCoockieAwareCache extends DrupalWinCache {

  /**
   * List of cookie keys That will change page cache cid.
   *
   * @var array
   */
  private $cookieKeys = array('catreg', 'catreg2' , 'planner');

  /**
   * Alter the CID to include the cookie values we need.
   */
  function prepare_cid($cid) {
    // Make sure we only alter the CID for the page cache.
    if ($this->bin == 'cache_page') {
      $cookies = $this->cookieKeys;
      foreach ($cookies as $cookie_name) {
        if (isset($_COOKIE[$cookie_name])) {
          $cid = $cookie_name . ':1|' . $cid;
        }
      }
    }
    return $cid;
  }

  function get($cid) {
    $cid = $this->prepare_cid($cid);
    return parent::get($cid);
  }

  function set($cid, $data, $expire = CACHE_PERMANENT) {
    $cid = $this->prepare_cid($cid);
    parent::set($cid, $data, $expire);
  }

  function clear($cid = NULL, $wildcard = FALSE) {
    $cid = $this->prepare_cid($cid);
    parent::clear($cid, $wildcard);
  }
}