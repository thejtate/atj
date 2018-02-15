<?php

/**
 * @file
 */

/**
 * Page callback, list of all itineraries with pager.
 *
 * @return string
 */
function atj_online_itin_list_page() {
  module_load_include('inc', 'atj_filemaker', '/includes/atj_filemaker.odbc');

  $limit = !empty($_GET['limit']) ? (int) $_GET['limit'] : 20;
  $offset = !empty($_GET['offset']) ? (int) $_GET['offset'] : 0;

  $query = "SELECT ItineraryID, UUID, SUBSTR(ItineraryTitle, 0, 255), DepartureDate, ItineraryStatusA, ItineraryRecordType FROM Itinerary
ORDER BY ItineraryID DESC
OFFSET $offset ROWS
FETCH FIRST $limit ROWS ONLY";

  $count = atj_filemaker_select('select count(*) as c from itinerary', atj_online_itin_fm_get_connection());
  $count = !empty($count[0]['c']) ? $count[0]['c'] : 0;

  $rows = atj_filemaker_select($query, atj_online_itin_fm_get_connection());
  if(!empty($rows)) {
    foreach ($rows as &$row) {
      $row['ItineraryID'] = !empty($row['ItineraryID']) ? l($row['ItineraryID'], 'itinerary/' . $row['UUID'], array('attributes' => array('target' => '_blank'))) : '';
    }
  } else {
    $rows = array();
  }

  $pager = array();
  if($offset >= $limit) {
    $pager[] = l('< Prev', 'itinerary-list', array('query' => array('limit' => $limit, 'offset' => $offset - $limit)));
  }

  $pager[] = '(Page ' . ceil($offset/$limit) . ' of ' . ceil($count/$limit) . ' total)';
  if($offset <= $count - $limit) {
    $pager[] = l('Next >', 'itinerary-list', array('query' => array('limit' => $limit, 'offset' => $offset + $limit)));
  }

  $header = array('ItineraryID', 'UUID',  'ItineraryTitle', 'DepartureDate', 'ItineraryStatusA', 'ItineraryRecordType');

  return theme('table', array(
      'header' => $header,
      'rows' => $rows,
      'attributes' => array('width' => '100%')
    )) . implode(' ', $pager);
}