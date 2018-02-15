<?php

/**
 * All old not used functions. Previous version of code.
 * TODO: delete after finish
 */

define('ATJ_FILEMAKER_EMMA_GROUP_CHUNK_SIZE', 50);

/**
 * Get data from fm and emma, and push to db, for next comparsions
 */
function atj_filemaker_emma_db_data_init() {
  module_load_include('inc', 'atj_filemaker_emma', '/includes/atj_filemaker_emma.emma');
  module_load_include('inc', 'atj_filemaker_emma', '/includes/atj_filemaker_emma.fm');

  $emails = array();
  $em_members_by_mail = array();

  try {
    $emma_client = atj_filemaker_emma_get_client();
    $em_members = $emma_client->list_group_members(variable_get('atj_filemaker_emma_group_id', ''));

    foreach ($em_members as $group_member) {
      if (!empty($group_member->email)) {
        $emails[] = $group_member->email;
        $em_members_by_mail[$group_member->email] = $group_member;
      }
    }
    $fm_contacts_by_mail = array();
    if(!empty($emails)) {
      $fm_contacts = atj_filemaker_emma_fm_get_contacts($emails);
      foreach ($fm_contacts as $fm_contact) {
        $fm_contacts_by_mail[strtolower($fm_contact['PrimaryEmail'])] = $fm_contact;
      }
    }

    foreach ($em_members_by_mail as $mail => $em_member) {
      if(!empty($fm_contacts_by_mail[$mail])) {
        atj_filemaker_emma_db_save_data($fm_contacts_by_mail[$mail]['PrimaryEmail'], $em_member, $fm_contacts_by_mail[$mail]);
      } else {
        $em_members_not_found_in_fm[$mail] = $em_member;
      }
    }

    if(!empty($em_members_not_found_in_fm)) {
      drupal_set_message(t('Can\'t sync some members, not found in filemaker, !members', array('!members' => '<pre>' . print_r($em_members_not_found_in_fm, TRUE) . '</pre>')), 'error');
    }

  } catch (Exception $e) {
    drupal_set_message(t('Error connecting to emma api !err', array('!err' => $e->getMessage())));
  }
}

/**
 * Queue worker. Compare Filemaker and Emma records. If find difference, push to other queue, to synhcronize difference.
 *
 * @param $em_members
 */
function atj_filemaker_emma_em_check_group_worker($em_members) {
  module_load_include('inc', 'atj_filemaker_emma', '/includes/atj_filemaker_emma.fm');
  module_load_include('inc', 'atj_filemaker_emma', '/includes/atj_filemaker_emma.db');

  $ids = array();
  $em_members_by_id = array();
  $queue = DrupalQueue::get('atj_filemaker_emma_process_diff');
  foreach ($em_members as $group_member) {
    if (!empty($group_member->fields->fmcontactid)) {
      $ids[] = $group_member->fields->fmcontactid;
      $em_members_by_id[$group_member->fields->fmcontactid] = $group_member;
    }
  }
  $fm_contacts_by_id = array();
  if(!empty($ids)) {
    $fm_contacts = atj_filemaker_emma_fm_get_contacts_by_id($ids);
    foreach ($fm_contacts as $fm_contact) {
      $fm_contacts_by_id[$fm_contact['ContactID']] = $fm_contact;
    }
  }

  $em_members_not_found_in_fm = array();
  $diff = array();
  $count = 0;
  foreach ($em_members_by_id as $id => $em_member) {
    if(!empty($fm_contacts_by_id[$id])) {

      if($member_diff = atj_filemaker_emma_find_diff($em_member, $fm_contacts_by_id[$id])) {
        $diff[$id] = $member_diff;
        $data = array(
          'diff' => $member_diff,
          'emma' => $em_member,
          'filemaker' => $fm_contacts_by_id[$id],
          'local_data_timestamp' => atj_filemaker_emma_db_get_data_timestamp($fm_contacts_by_id[$id]['ContactID']),
        );
        $queue->createItem($data);
        $count++;
      }
    } else {
      $em_members_not_found_in_fm[$id] = $em_member;
    }
  }
  if(!empty($count)) {
    watchdog('atj_filemaker_emma_updated', 'Found !c diffs', array('!c' => $count));
  }
  if(!empty($em_members_not_found_in_fm)) {
    watchdog('atj_filemaker_emma', 'Can\'t sync some members, not found in filemaker, !members', array('!members' => '<pre>' . print_r($em_members_not_found_in_fm, TRUE) . '</pre>'));
  }
}


/**
 * Queue worker. Process differences between filemaker and emma for single user.
 *
 * @param $data
 */
function atj_filemaker_emma_process_diff_worker($data) {
  module_load_include('inc', 'atj_filemaker_emma', '/includes/atj_filemaker_emma.db');
  module_load_include('inc', 'atj_filemaker_emma', '/includes/atj_filemaker_emma.fm');
  $em_updates = array();
  $fm_updates = array();

  $last_saved_data = atj_filemaker_emma_db_get_data($data['filemaker']['ContactID']);
  $current_local_data_timestamp = !empty($last_saved_data['changed']) ? $last_saved_data['changed'] : NULL;

  if($data['local_data_timestamp'] !== $current_local_data_timestamp) {
    watchdog('atj_filemaker_emma', 'Skip Updating record. Coming multiple time. for !email ', array('!email' => $data['emma']->email));
    //protect processing the same changes twice.
    return; //do not process changes, because was updated before our queue comming
  }

  $fields_map = atj_filemaker_emma_fields_map();

  if (empty($last_saved_data)) {
    $em_updates = $data['diff'];
  }
  else {
    foreach ($data['diff'] as $em_field_key => $diff) {

      //if em old, fm old // update em
      //if em new         // update fm
      //if fm new         // update em
      //if em fm new      // update em

      //get saved values for this fields from db
      $fm_old_saved_value = atj_filemaker_emma_fm_get_value($last_saved_data['filemaker'], $em_field_key, $fields_map[$em_field_key]);
      $em_old_saved_value = atj_filemaker_emma_em_get_value($last_saved_data['emma'], $em_field_key, $fields_map[$em_field_key]);

      $field_type = !empty($fields_map[$em_field_key]['type']) ? $fields_map[$em_field_key]['type'] : 'text';

      if($field_type == 'select_multiple') {
        $is_fm_was_changed = atj_filemaker_emma_is_array_values_different($fm_old_saved_value, $diff['fm']);
        $is_em_was_changed = atj_filemaker_emma_is_array_values_different($em_old_saved_value, $diff['em']);
      } else {
        $is_fm_was_changed = ($fm_old_saved_value !== $diff['fm']);
        $is_em_was_changed = ($em_old_saved_value !== $diff['em']);
      }

      //only if em was updated and fm not, update this field in Filemaker (if editable)
      if($is_em_was_changed && !$is_fm_was_changed ) {
        if(!empty($fields_map[$em_field_key]['fm_editable'])) {
          if($field_type == 'email') {
            //check if new email is free in fm
            if(!empty($diff['em'])) {
              $fm_record_form_mail = atj_filemaker_emma_fm_get_contacts(array($diff['em']));
              if(empty($fm_record_form_mail)) {
                $fm_updates[$em_field_key] = $diff;
              } else {
                watchdog('atj_filemaker_emma','Error changing email for Filemaker record, this email already exists !email emma record:', array('!email' => $diff['em'], '!record' => '<pre>' . print_r($last_saved_data['emma'], TRUE) . '</pre>'), WATCHDOG_WARNING);
                $data['filemaker'][$fields_map[$em_field_key]['fm_field']] = $fm_old_saved_value;//keep old value locally.
                $data['emma']->email = $em_old_saved_value;//keep old value locally.
              }
            }
          } else {
            $fm_updates[$em_field_key] = $diff;
          }
        }
      } else {
        //in all other cases update Emma fields
        $em_updates[$em_field_key] = $diff;
      }

    }
  }

  if(!empty($em_updates)) {
    atj_filemaker_emma_em_update_diff($em_updates, $data['emma'], $fields_map, $last_saved_data);
  }

  if(!empty($fm_updates)) {
    atj_filemaker_emma_fm_update_diff($fm_updates, $data['filemaker'], $fields_map);
  }

  //save updated data to db, for next comparisons
  atj_filemaker_emma_db_save_data($data['filemaker']['PrimaryEmail'], $data['emma'], $data['filemaker']);
}

/**
 * Queue worker. Find fm record related to emma member by email, and set ContactID field to emma member. For further working.
 *
 * @param $em_members
 */
function atj_filemaker_emma_em_check_group_add_contactid_worker($em_members) {
  module_load_include('inc', 'atj_filemaker_emma', '/includes/atj_filemaker_emma.emma');
  module_load_include('inc', 'atj_filemaker_emma', '/includes/atj_filemaker_emma.fm');

  foreach ($em_members as $group_member) {
    if (!empty($group_member->email)) {
      $emails[] = $group_member->email;
      $em_members_by_mail[$group_member->email] = $group_member;
    }
  }
  $fm_contacts_by_mail = array();
  if(!empty($emails)) {
    $fm_contacts = atj_filemaker_emma_fm_get_contacts($emails);
    foreach ($fm_contacts as $fm_contact) {
      $fm_contacts_by_mail[strtolower($fm_contact['PrimaryEmail'])] = $fm_contact;
    }
  }

  try {
    $emma_client = atj_filemaker_emma_get_client();

    foreach ($em_members_by_mail as $mail => $em_member) {
      if(!empty($fm_contacts_by_mail[$mail]['ContactID'])) {
        $status = atj_filemaker_emma_em_get_status_param($em_member->status);
        $res = $emma_client->update_member($em_member->member_id, $em_member->email, $status, array('fmcontactid' => $fm_contacts_by_mail[$mail]['ContactID']));

        if(!empty($res->error)) {
          watchdog('atj_filemaker_emma', 'Error settings contact id for emma member record %email %message', array('%message' => $res->error, '%email' => $mail));
        } else {
          watchdog('atj_filemaker_emma','Set contact id !id for  emma member !mail', array('!id' => $fm_contacts_by_mail[$mail]['ContactID'], '!mail' => $mail));
        }
      } else {
        watchdog('atj_filemaker_emma', 'Error settings contact id for emma member record %email %message', array('%email' => $mail));
      }
    }

  } catch(Exception $e) {
    watchdog('atj_filemaker_emma', 'Error settings contact id for emma member records !rec', array('!rec' => '<pre>' . $em_members .  '</pre>'));
  }
}


/**
 * Process updates for Filemaker.
 *
 * @param $updates
 * @param $filemaker
 * @param $fields_map
 */
function atj_filemaker_emma_fm_update_diff($updates, &$filemaker, $fields_map) {
  module_load_include('inc', 'atj_filemaker', '/includes/atj_filemaker.odbc');
  module_load_include('inc', 'atj_filemaker_emma', '/includes/atj_filemaker_emma.fm');
  $fields_values = array();
  $old_filemaker = $filemaker;
  foreach ($updates as $em_field_key => $update) {
    $field_type = !empty($fields_map[$em_field_key]['type']) ? $fields_map[$em_field_key]['type'] : 'text';
    $field_table = $fields_map[$em_field_key]['fm_table'];
    $field_name = !empty($fields_map[$em_field_key]['fm_field']) ? $fields_map[$em_field_key]['fm_field'] : '';
    switch($field_type) {
      case 'select_multiple':
        foreach ($fields_map[$em_field_key]['fm_field_map'] as $fm_field_name => $related_value) {
          if(!empty($update['em']) && in_array($related_value, $update['em'])) {
            $fields_values[$field_table][$fm_field_name] = 1;
            $filemaker[$fm_field_name] = 1;
          } else {
            $fields_values[$field_table][$fm_field_name] = 'NULL';
            $filemaker[$fm_field_name] = NULL;
          }
        }
        break;
      case 'email':
        //update only if not empty
        if(!empty($update['em'])) {
          $fields_values[$field_table][$field_name] = "'" . str_replace("'", "''", $update['em']) . "'";
          $filemaker[$field_name] = $update['em'];
        }
        break;
      default:
        $fields_values[$field_table][$field_name] = !empty($update['em']) ? "'" . str_replace("'", "''", $update['em']) . "'" : 'NULL';
        $filemaker[$field_name] = $update['em'];
        break;
    }
  }

  $contact_id = $filemaker['ContactID'];
  foreach ($fields_values as $table_name => $table_values) {

    $sql_fields = '';
    foreach ($table_values as $field_name =>  $table_value) {
      $sql_fields .= "\"$field_name\" = $table_value,";
    }
    $sql_fields = rtrim($sql_fields, ", ");//remove last comma

    $sql = "UPDATE \"$table_name\" SET " . $sql_fields;

    $sql .= " WHERE ContactID = '$contact_id'";

    $res = atj_filemaker_emma_fm_sql($sql);
  }

  watchdog('atj_filemaker_emma_updated', 'Filemaker record updated !id fields to update: !fields  filemaker full old record: !fm', array('!id' => $contact_id, '!fields' => '<pre>' . print_r($fields_values, TRUE) .  '</pre>', '!fm' => '<pre>' . print_r($old_filemaker, TRUE) .  '</pre>'));
}

/**
 * Process updates for Emma.
 *
 * @param $updates
 * @param $emma
 * @param $fields_map
 * @return bool
 */
function atj_filemaker_emma_em_update_diff($updates, &$emma, $fields_map, $last_saved_data) {
  module_load_include('inc', 'atj_filemaker_emma', '/includes/atj_filemaker_emma.emma');

  $status = atj_filemaker_emma_em_get_status_param($emma->status);
  $email = $emma->email;
  $emma_before_update = $emma;
  $fields = array();

  foreach ($updates as $em_field_key => $update) {
    $field_type = !empty($fields_map[$em_field_key]['type']) ? $fields_map[$em_field_key]['type'] : 'text';

    switch ($field_type) {
      case 'date':
        $fields[$em_field_key] = !empty($update['fm']) ? '@D:' .  $update['fm'] : NULL ;
        $emma->fields->{$em_field_key} = $fields[$em_field_key];
        break;
      case 'email':
        $email = $update['fm'];
        $emma->email = $email;
        $fields[$em_field_key] = $update['fm'];
        break;
      default:
        $fields[$em_field_key] = $update['fm'];
        $emma->fields->{$em_field_key} = $fields[$em_field_key];
        break;
    }
  }

  try {
    $emma_client = atj_filemaker_emma_get_client();
    $res = $emma_client->update_member($emma->member_id, $email, $status, $fields);
  } catch(Exception $e) {
    watchdog('atj_filemaker_emma', 'Error updating emma member record %email %message !fields', array('%message' => $e->getMessage(), '%email' => $email, '!fields' => '<pre>' . print_r($fields, TRUE) .  '</pre>',), WATCHDOG_WARNING);
    $emma = $last_saved_data['emma'];//keep old value to store locally
    return FALSE;
  }
  if(!empty($res->error)) {
    watchdog('atj_filemaker_emma', 'Error updating emma member  %email %message !fields', array('%message' => $res->error, '%email' => $email, '!fields' => '<pre>' . print_r($fields, TRUE) .  '</pre>',), WATCHDOG_WARNING);
    $emma = $last_saved_data['emma'];//keep old value to store locally
    return FALSE;
  }

  watchdog('atj_filemaker_emma_updated', 'Emma record updated !email fields: !fields full old emma record !em', array('!email' => $email, '!fields' => '<pre>' . print_r($fields, TRUE) .  '</pre>', '!em' => '<pre>' . print_r($emma_before_update, TRUE) .  '</pre>'));
  return TRUE;
}


/**
 * Cron callback. Get all members from Emma group, split to chunks and push to queue to further comparing with filemaker.
 */
function atj_filemaker_emma_em_check_group() {

  if(!variable_get('atj_filemaker_emma_cron_enable', FALSE)) {
    return;//synchronization disabled.
  }

  module_load_include('inc', 'atj_filemaker_emma', '/includes/atj_filemaker_emma.emma');

  $queue_find_diff = DrupalQueue::get('atj_filemaker_emma_em_check_group');
  $queue_contact_id = DrupalQueue::get('atj_filemaker_emma_em_check_group_add_contactid');


  try {
    $emma_client = atj_filemaker_emma_get_client();
    $emma_group = $emma_client->list_group_members(variable_get('atj_filemaker_emma_group_id', ''));
  } catch (Exception $e) {
    watchdog('atj_filemaker_emma','Error connecting to emma api !err', array('!err' => $e->getMessage()), WATCHDOG_ERROR);
  }


  if(!empty($emma_group)) {
    $emma_group_to_check_diff = array();
    $emma_group_to_add_contact_id = array();

    foreach ($emma_group as $emma_member) {
      if(!empty($emma_member->fields->fmcontactid)) {
        $emma_group_to_check_diff[] = $emma_member;
      } else {
        $emma_group_to_add_contact_id[] = $emma_member;
      }
    }

    $number = $queue_find_diff->numberOfItems();
    if(empty($number)) {
      //do not add more queue items
      $group_to_check_diff_chunks = array_chunk($emma_group_to_check_diff, ATJ_FILEMAKER_EMMA_GROUP_CHUNK_SIZE);
      foreach ($group_to_check_diff_chunks as $group_to_check_diff_chunk) {
        $queue_find_diff->createItem($group_to_check_diff_chunk);
      }
    }

    $emma_group_to_add_contact_id_chunks = array_chunk($emma_group_to_add_contact_id, ATJ_FILEMAKER_EMMA_GROUP_CHUNK_SIZE);
    foreach ($emma_group_to_add_contact_id_chunks as $group_to_add_contact_id_chunk) {
      $queue_contact_id->createItem($group_to_add_contact_id_chunk);
    }
  } else {
    watchdog('atj_filemaker_emma', 'New group check can\'t be added, because emma group is empty');
  }
}