<?php
/**
 * @file
 *  Local db functions
 */


/**
 * Save information to local table.
 *
 * @param $email
 * @param $emma
 * @param $filemaker
 * @param string $contact_values_hash
 * @param string $profile_values_hash
 * @param int $profile_values_changed
 * @param int $contact_values_changed
 * @internal param \Filemaker $fm_id ContactID
 */
function atj_filemaker_emma_db_save_data($email, $emma, $filemaker, $contact_values_hash = '', $profile_values_hash = '', $contact_values_changed = REQUEST_TIME,  $profile_values_changed = REQUEST_TIME) {
  $fm_id = $filemaker['ContactID'];
  db_merge('atj_filemaker_emma')
    ->key(array('fm_id' => $fm_id))
    ->fields(array(
      'fm_id' => $fm_id,
      'em_id' => !empty($emma->member_id) ? $emma->member_id : '',
      'email' => strtolower($email),
      'emma' => serialize($emma),
      'filemaker' => serialize($filemaker),
      'profile_values_hash' => $profile_values_hash,
      'contact_values_hash' => $contact_values_hash,
      'profile_values_changed' => $profile_values_changed,
      'contact_values_changed' => $contact_values_changed,
    ))
    ->execute();
}

function atj_filemaker_emma_db_save_not_processed($data) {
  $data['changed'] = !empty($data['changed']) ? $data['changed'] : REQUEST_TIME;
  drupal_write_record('atj_filemaker_emma_not_processed_changes', $data);
}

/**
 * Get saved data from local db.
 *
 * @param $fm_id string
 *  Filemaker ContactID
 * @return mixed
 */
function atj_filemaker_emma_db_get_data($fm_id) {
  $result = db_select('atj_filemaker_emma', 'fe')
    ->fields('fe')
    ->condition('fm_id', $fm_id)
    ->execute()->fetchAssoc();

  _atj_filemaker_emma_db_unserialize($result);
  return $result;
}

function atj_filemaker_emma_db_get_data_by_em_id($em_id) {
  $result = db_select('atj_filemaker_emma', 'fe')
    ->fields('fe')
    ->condition('em_id', $em_id)
    ->execute()->fetchAssoc();

  _atj_filemaker_emma_db_unserialize($result);
  return $result;
}

/**
 * Get saved data from local db.
 *
 * @param $fm_id string
 *  Filemaker ContactID
 * @return mixed
 */
function atj_filemaker_emma_db_get_data_timestamp($fm_id) {
  $result = db_select('atj_filemaker_emma', 'fe')
    ->fields('fe', array('changed'))
    ->condition('fm_id', $fm_id)
    ->execute()->fetchField();

  return !empty($result) ? $result : NULL;
}


/**
 * Get saved data from local db by email.
 *
 * @param $email
 * @return mixed
 */
function atj_filemaker_emma_db_get_data_by_email($email) {
  $email = strtolower($email);
  $result =  db_select('atj_filemaker_emma', 'fe')
    ->fields('fe')
    ->condition('email', $email)
    ->execute()->fetchAssoc();

  _atj_filemaker_emma_db_unserialize($result);

  return $result;
}

/**
 * Get saved data from local db by array of emails.
 *
 * @param $email
 * @return mixed
 */
function atj_filemaker_emma_db_get_data_by_multiple_emails($emails) {

  array_walk($emails, function(&$v){$v = strtolower($v);});

  $result =  db_select('atj_filemaker_emma', 'fe')
    ->fields('fe')
    ->condition('email', $emails, 'IN')
    ->execute()->fetchAllAssoc('fm_id', PDO::FETCH_ASSOC);

  foreach ($result as &$row) {
    _atj_filemaker_emma_db_unserialize($row);
  }

  return $result;
}

/**
 * Get local emails if exist
 *
 * @param $emails
 * @return mixed
 */
function atj_filemaker_emma_db_get_exist_multiple_emails($emails) {

  array_walk($emails, function(&$v){$v = strtolower($v);});

  $result =  db_select('atj_filemaker_emma', 'fe')
    ->fields('fe', array('email'))
    ->condition('email', $emails, 'IN')
    ->execute()->fetchCol();

  return $result;
}

/**
 * Get saved data from local db by array of filemaker ids.
 *
 * @param $email
 * @return mixed
 */
function atj_filemaker_emma_db_get_data_by_multiple_ids($ids) {
  $result =  db_select('atj_filemaker_emma', 'fe')
    ->fields('fe')
    ->condition('fm_id', $ids, 'IN')
    ->execute()->fetchAllAssoc('fm_id', PDO::FETCH_ASSOC);

    foreach ($result as &$row) {
      _atj_filemaker_emma_db_unserialize($row);
    }

  return $result;
}

function atj_filemaker_emma_db_get_all_data() {
  $result = db_select('atj_filemaker_emma', 'fe')
    ->fields('fe')
    ->execute()->fetchAllAssoc('fm_id', PDO::FETCH_ASSOC);

  foreach ($result as &$row) {
    _atj_filemaker_emma_db_unserialize($row);
  }

  return $result;
}

function atj_filemaker_emma_db_count_all() {
 return db_select('atj_filemaker_emma', 'fe')
    ->countQuery()
    ->execute()->fetchField();
}

function atj_filemaker_emma_db_count_all_not_processed_changes() {
  return db_select('atj_filemaker_emma_not_processed_changes', 'fe')
    ->countQuery()
    ->execute()->fetchField();
}

function atj_filemaker_emma_db_get_all_not_processed_changes() {
  $result = db_select('atj_filemaker_emma_not_processed_changes', 'fn')
    ->fields('fn')
    ->execute()->fetchAllAssoc('id', PDO::FETCH_ASSOC);
  return $result;
}

/**
 * Get saved not processed data from local db.
 *
 * @param $fm_id string
 *  Filemaker ContactID
 * @return mixed
 */
function atj_filemaker_emma_db_get_not_processed_data($id) {
  $result = db_select('atj_filemaker_emma_not_processed_changes', 'fn')
    ->fields('fn')
    ->condition('id', $id)
    ->execute()->fetchAssoc();

  if(!empty($result['data'])) {
    $result['data'] = unserialize($result['data']);
  }

  return $result;
}

function atj_filemaker_emma_db_clear_all() {
  db_delete('atj_filemaker_emma')->execute();
}

/**
 * Delete all records that match any param.
 *
 * @param $fm_id
 * @param $em_id
 * @param $email
 * @return $this|\QueryConditionInterface
 */
function atj_filemaker_emma_db_delete_records_by_any_match($fm_id, $em_id = '', $email = '') {
  $query = db_delete('atj_filemaker_emma');
  $db_or = db_or();
  $db_or->condition('fm_id', $fm_id);
  if(!empty($em_id)) {
    $db_or->condition('em_id', $em_id);
  }
  if(!empty($email)) {
    $db_or->condition('email', $email);
  }

  $query->condition($db_or)->execute();
}