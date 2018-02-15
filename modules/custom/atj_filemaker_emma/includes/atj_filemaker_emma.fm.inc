<?php
/**
 * @file
 *  Filemaker functions
 */

/**
 * Get contacts info from filemaker.
 *
 * @param array $emails
 * @return array|bool
 */
function atj_filemaker_emma_fm_get_contacts($emails) {
  module_load_include('inc', 'atj_filemaker_emma', '/includes/atj_filemaker_emma.test');
  module_load_include('inc', 'atj_filemaker', '/includes/atj_filemaker.odbc');


  array_walk($emails, function(&$email) { $email = "'" . str_replace("'", "''", $email) . "'"; });

  $query = 'select c.aModificationTimestamp as contactModified, p.aModificationTimestamp as profileModified, c.*, p.*, c.ContactID from "Contact" as c
LEFT OUTER JOIN "Contact\'s Travel Profile" as p
on c.ContactID = p.ContactID
where LOWER(c.PrimaryEmail) IN(' . implode(' ,', $emails) . ')';

  $result = atj_filemaker_select($query, atj_filemaker_emma_fm_get_connection());
  atj_filemaker_emma_fm_fix_encoding($result);
  return $result;
}

function atj_filemaker_emma_fm_get_contacts_by_id($ids) {
  module_load_include('inc', 'atj_filemaker_emma', '/includes/atj_filemaker_emma.test');
  module_load_include('inc', 'atj_filemaker', '/includes/atj_filemaker.odbc');

  array_walk($ids, function(&$id) { $id = "'$id'"; });

  $query = 'select c.aModificationTimestamp as contactModified, p.aModificationTimestamp as profileModified, c.*, p.*, c.ContactID from "Contact" as c
LEFT OUTER JOIN "Contact\'s Travel Profile" as p
on c.ContactID = p.ContactID
where c.ContactID IN(' . implode(' ,', $ids) . ')';

  $result = atj_filemaker_select($query, atj_filemaker_emma_fm_get_connection());
  atj_filemaker_emma_fm_fix_encoding($result);
  return $result;
}

/**
 * Execute sql to FM database.
 *
 * @param $sql
 * @return bool
 */
function atj_filemaker_emma_fm_sql($sql) {
  $connection = atj_filemaker_emma_fm_get_connection();
  try {
    $pdo = atj_filemaker_pdo($connection);
    if(!$pdo) {
      return FALSE;
    }

    $stmt = $pdo->query($sql);
    if(!$stmt) {
      watchdog('atj_filemaker', 'SQL Error on query filemaker: @message @sql', array('@message' => print_r($pdo->errorInfo(), TRUE), '@sql' => $sql), WATCHDOG_ERROR);
      drupal_set_message(t('SQL Error on query record to filemaker: @message @sql', array('@message' => print_r($pdo->errorInfo(), TRUE), '@sql' => $sql)), 'error');
    }

    return !empty($stmt) ? TRUE : FALSE;
  } catch(Exception $e) {
    watchdog('atj_filemaker', 'DB Error on query filemaker: @message', array('@message' => $e->getMessage()), WATCHDOG_ERROR);
    drupal_set_message(t('DB Error on insert record to filemaker: @message',  array('@message' => $e->getMessage())), 'error');
  }

  return FALSE;
}

function atj_filemaker_emma_fm_fix_encoding(&$results) {
  if (!empty($results)) {
    foreach ($results as &$row) {
      foreach ($row as $key => &$field) {
        $field = iconv('Windows-1252', 'UTF-8', $field);
      }
    }
  }
}