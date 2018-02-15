<?php
/**
 * @file
 *  System pages
 */
define('ATJ_FILEMAKER_EMMA_OPERATIONS_EMMA_CHUNK', 50);
define('ATJ_FILEMAKER_EMMA_OPERATIONS_FM_STEP', 1);
define('ATJ_FILEMAKER_EMMA_OPERATIONS_NOT_MIGRATED_SEGMENT_ID', 404833);
define('ATJ_FILEMAKER_EMMA_OPERATIONS_EMMA_NOT_MIGRATED_CHUNK', 300);

module_load_include('inc', 'atj_filemaker_emma', '/includes/atj_filemaker_emma.emma');
module_load_include('inc', 'atj_filemaker_emma', '/includes/atj_filemaker_emma.db');
module_load_include('inc', 'atj_filemaker_emma', '/includes/atj_filemaker_emma.fm');

/**
 * Operations.
 */
function atj_filemaker_emma_operations_form($form, &$form_state) {


  $form['info'] = array(
    '#type' => 'fieldset',
    '#tree' => FALSE,
    '#title' => t('Information'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  $queue = DrupalQueue::get('atj_filemaker_emma_init_relations');

  $form['info']['init_relations_useful_data'] = array(
    '#markup' => '<div> Fm last checked "Contact "date: '
      . variable_get('atj_filemaker_emma_last_fm_changes_contact_date', 'none')
      . '<br><div> Fm last checked "Contact Profile" date: '
      . variable_get('atj_filemaker_emma_last_fm_changes_profile_date', 'none')
      . '<br>Enabled  Emma webhhook events: <br>' . atj_filemaker_emma_operations_get_enabled_webhook_events()
      . '<br>Local records: ' . atj_filemaker_emma_db_count_all()
      . '<br>Not processed changes (errors): ' . atj_filemaker_emma_db_count_all_not_processed_changes()
      . '<br>IN queue: ' . $queue->numberOfItems()
      . '</div>',
  );


  $form['init_relations_info'] = array(
    '#markup' => '<h4>' . t('Use with caution!! It Takes too much time, and breaks existing relations.') . '</h4>',
  );

  $form['init_relations'] = array(
    '#type' => 'submit',
    '#value' => t('Init relations Filemaker and Emma records.'),
    '#name' => 'inint',
    '#submit' => array('atj_filemaker_emma_operations_init_relations'),
  );

  $form['init_not_migrated_relations'] = array(
    '#type' => 'submit',
    '#value' => t('Add not migrated emma records to init relations queue.'),
    '#name' => 'inint_not_migrated',
    '#submit' => array('atj_filemaker_emma_operations_init_not_migrated_relations'),
  );

  $form['continue_processing_queue'] = array(
    '#type' => 'submit',
    '#value' => t('Continue batch if stopped by error.'),
    '#name' => 'inint',
    '#submit' => array('atj_filemaker_emma_operations_continue_processing_queue'),
  );

  $form['batches'] = array(
    '#type' => 'fieldset',
    '#tree' => FALSE,
    '#title' => t('Batch'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  $form['batches']['continue_processing_queue'] = array(
    '#type' => 'submit',
    '#value' => t('Process error records.'),
    '#name' => 'inint',
    '#submit' => array('atj_filemaker_emma_operations_process_errors'),
  );

  $form['webhooks'] = array(
    '#type' => 'fieldset',
    '#tree' => FALSE,
    '#title' => t('Webhooks'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  $form['webhooks']['remove_webhooks'] = array(
    '#type' => 'submit',
    '#value' => t('Remove webhooks.'),
    '#name' => 'remove',
    '#submit' => array('atj_filemaker_emma_operations_remove_webhooks'),
  );

  $form['webhooks']['add_webhooks'] = array(
    '#type' => 'submit',
    '#value' => t('Add webhooks.'),
    '#name' => 'remove',
    '#submit' => array('atj_filemaker_emma_operations_add_webhooks'),
  );

  return $form;
}


/**
 * Submit callback for Operations.
 */
function atj_filemaker_emma_operations_form_submit(&$form, &$form_state) {

}

/**
 * Submit callback, process errors.
 */
function atj_filemaker_emma_operations_process_errors(&$form, &$form_state) {

  $count = atj_filemaker_emma_db_count_all_not_processed_changes();
  if(!empty($count)) {
    $batch = array(
      'operations' => array(
        array('atj_filemaker_emma_operations_process_errors_worker', array($count)),
      ),
      'finished' => 'atj_filemaker_emma_operations_process_finished',
      'title' => 'Re processing error records',
      'init_message' => 'Init',
      'progress_message' => 'Processing',
      'error_message' => 'Some error occurs',
      'file' => drupal_get_path('module', 'atj_filemaker_emma').'/includes/atj_filemaker_emma.pages.inc',
    );
    batch_set($batch);
  }
}

/**
 *
 *
 * @param $count
 * @param $context
 */
function atj_filemaker_emma_operations_process_errors_worker($count, &$context) {

  if (!isset($context['sandbox']['progress'])) {
    $context['sandbox']['progress'] = 0;
    $context['sandbox']['current_id'] = 0;
    $context['sandbox']['max'] = $count;
  }
  $result = db_query_range("SELECT id FROM {atj_filemaker_emma_not_processed_changes} WHERE id > :id ORDER BY id ASC",
    0, 1, array(':id' => $context['sandbox']['current_id']));

  foreach ($result as $row) {
    $item = atj_filemaker_emma_db_get_not_processed_data($row->id);
    call_user_func($item['source'], $item['data']['data']);
    db_delete('atj_filemaker_emma_not_processed_changes')->condition('id', $row->id)->execute();
  }

  $context['sandbox']['progress']++;

  if ($context['sandbox']['progress'] != $context['sandbox']['max']) {
    $context['finished'] = $context['sandbox']['progress'] / $context['sandbox']['max'];
  }
}

function atj_filemaker_emma_operations_process_finished($success, $results, $operations) {

  drupal_set_message('Done');
  //drupal_set_message('Added emma records to queue ' .  (!empty($results['items_in_queue']) ? $results['items_in_queue'] : 0) . '; Found emails in FM and synchronized ' . $results['items_synchronized']);

  if(!empty($results['errors'])) {
    drupal_set_message('Errors ' . $results['errors'] . 'check watchdog for details', 'error');
  }
}

/**
 * Submit callback for Operations.
 */
function atj_filemaker_emma_operations_init_relations(&$form, &$form_state) {

  atj_filemaker_emma_db_clear_all();
  $emma = atj_filemaker_emma_ohmyemma_client();

  if(!variable_get('atj_filemaker_emma_test_mode', FALSE)) {
    $response = atj_filemaker_emma_ohmyemma_results($emma->Members->getMembers('', false, array('count' => 'true')));
    $count = $response->is_valid ? $response->data : NULL;
  } else {
    $response = atj_filemaker_emma_ohmyemma_results($emma->Groups->getGroups(variable_get('atj_filemaker_emma_group_id', ''), TRUE));
    $count = $response->is_valid ? count($response->data) : NULL;
  }


    if($response->is_valid) {

      $batch = array(
          'operations' => array(
            array('atj_filemaker_emma_operations_get_emma_users', array($count)),
            array('atj_filemaker_emma_operations_get_compare_with_filemaker', array()),
            array('atj_filemaker_emma_operations_check_emma_import_results', array()),
          ),
          'finished' => 'atj_filemaker_emma_operations_init_finished',
          'title' => 'Setup relations',
          'init_message' => 'Init',
          'progress_message' => 'Processing',
          'error_message' => 'Some error occurs',
          'file' => drupal_get_path('module', 'atj_filemaker_emma').'/includes/atj_filemaker_emma.pages.inc',
      );
      batch_set($batch);
    } else {
      drupal_set_message($response->getErrorMessageWithFullResponse(), 'error');
    }
}

function atj_filemaker_emma_operations_init_not_migrated_relations() {
  $emma = atj_filemaker_emma_ohmyemma_client();
  $response = atj_filemaker_emma_ohmyemma_results($emma->SearchesOverrided->getSearchesWithFilters(ATJ_FILEMAKER_EMMA_OPERATIONS_NOT_MIGRATED_SEGMENT_ID,  TRUE, FALSE, array('count' => 'true')));
  $count = $response->is_valid ? $response->data : NULL;
  if($response->is_valid) {

    $batch = array(
      'operations' => array(
        array('atj_filemaker_emma_operations_get_not_migrated_emma_users', array($count)),
      ),
      'finished' => 'atj_filemaker_emma_operations_init_finished',
      'title' => 'Add not migrated emma users to Setup relations',
      'init_message' => 'Init',
      'progress_message' => 'Processing',
      'error_message' => 'Some error occurs',
      'file' => drupal_get_path('module', 'atj_filemaker_emma').'/includes/atj_filemaker_emma.pages.inc',
    );
    batch_set($batch);
  } else {
    drupal_set_message($response->getErrorMessageWithFullResponse(), 'error');
  }
}

/**
 * Submit callback for Operations.
 */
function atj_filemaker_emma_operations_continue_processing_queue(&$form, &$form_state) {

    $batch = array(
      'operations' => array(
        array('atj_filemaker_emma_operations_get_compare_with_filemaker', array()),
        array('atj_filemaker_emma_operations_check_emma_import_results', array()),
      ),
      'finished' => 'atj_filemaker_emma_operations_init_finished',
      'title' => 'Setup relations',
      'init_message' => 'Init',
      'progress_message' => 'Processing',
      'error_message' => 'Some error occurs',
      'file' => drupal_get_path('module', 'atj_filemaker_emma').'/includes/atj_filemaker_emma.pages.inc',
    );
    batch_set($batch);
}

function atj_filemaker_emma_operations_get_not_migrated_emma_users($count, &$context) {
  if (!isset($context['sandbox']['progress'])) {
    $context['sandbox']['progress'] = 0;
    $context['results']['items_in_queue'] = 0;
    $context['results']['errors'] = 0;
    $context['sandbox']['current_offset'] = 0;
    $context['sandbox']['max'] = ceil($count / ATJ_FILEMAKER_EMMA_OPERATIONS_EMMA_NOT_MIGRATED_CHUNK);
  }

  $emma = atj_filemaker_emma_ohmyemma_client();

  $response = atj_filemaker_emma_ohmyemma_results($emma->SearchesOverrided->getSearchesWithFilters(ATJ_FILEMAKER_EMMA_OPERATIONS_NOT_MIGRATED_SEGMENT_ID, TRUE, FALSE, array('start' => $context['sandbox']['current_offset'], 'end' => $context['sandbox']['current_offset'] + ATJ_FILEMAKER_EMMA_OPERATIONS_EMMA_NOT_MIGRATED_CHUNK)));

  if($response->is_valid) {
    $members = $response->data;
    $queue = DrupalQueue::get('atj_filemaker_emma_init_relations');

    if(!empty($members) && is_array($members)) {
      foreach ($members as $member) {
        $queue->createItem($member);
        $context['results']['items_in_queue']++;
      }
    } else {
      watchdog('atj_filemaker_emma_operations', 'Empty members array with offset !offset, code !code', array('!offset' => $context['sandbox']['current_offset'], '!code' => $response->getErrorMessageWithFullResponse()));
      $context['results']['errors']++;
    }
  } else {
    watchdog('atj_filemaker_emma_operations', 'error getting members with offset !offset, code !code', array('!offset' => $context['sandbox']['current_offset'], '!code' => $response->getErrorMessageWithFullResponse()));
    $context['results']['errors']++;
  }

  $context['sandbox']['current_offset'] += ATJ_FILEMAKER_EMMA_OPERATIONS_EMMA_CHUNK;
  $context['sandbox']['progress']++;
  $context['message'] = t('Emma records pulled !current of !total total (added to queue !queue)', array('!current' => $context['sandbox']['current_offset'], '!total' => $count, '!queue' => $context['results']['items_in_queue']));

  if ($context['sandbox']['progress'] < $context['sandbox']['max']) {
    $context['finished'] = $context['sandbox']['progress'] / $context['sandbox']['max'];
  }
}

function atj_filemaker_emma_operations_get_emma_users($count, &$context) {
  if (!isset($context['sandbox']['progress'])) {
    $context['sandbox']['progress'] = 0;
    $context['results']['items_in_queue'] = 0;
    $context['results']['errors'] = 0;
    $context['sandbox']['current_offset'] = 0;
    $context['sandbox']['max'] = ceil($count / ATJ_FILEMAKER_EMMA_OPERATIONS_EMMA_CHUNK);
  }

  $emma = atj_filemaker_emma_ohmyemma_client();

  if(!variable_get('atj_filemaker_emma_test_mode', FALSE)) {
    $response = atj_filemaker_emma_ohmyemma_results($emma->Members->getMembers('', false, array('start' => $context['sandbox']['current_offset'], 'end' => $context['sandbox']['current_offset'] + ATJ_FILEMAKER_EMMA_OPERATIONS_EMMA_CHUNK)));
  } else {
    $response = atj_filemaker_emma_ohmyemma_results($emma->Groups->getGroups(variable_get('atj_filemaker_emma_group_id', ''), TRUE));
  }


  if($response->is_valid) {
    $members = $response->data;
    $queue = DrupalQueue::get('atj_filemaker_emma_init_relations');

    if(!empty($members) && is_array($members)) {
      foreach ($members as $member) {
        $queue->createItem($member);
        $context['results']['items_in_queue']++;
      }
    } else {
      watchdog('atj_filemaker_emma_operations', 'Empty members array with offset !offset, code !code', array('!offset' => $context['sandbox']['current_offset'], '!code' => $response->getErrorMessageWithFullResponse()));
      $context['results']['errors']++;
    }
  } else {
    watchdog('atj_filemaker_emma_operations', 'error getting members with offset !offset, code !code', array('!offset' => $context['sandbox']['current_offset'], '!code' => $response->getErrorMessageWithFullResponse()));
    $context['results']['errors']++;
  }

  $context['sandbox']['current_offset'] += ATJ_FILEMAKER_EMMA_OPERATIONS_EMMA_CHUNK;
  $context['sandbox']['progress']++;
  $context['message'] = t('Emma records pulled !current of !total total (added to queue !queue)', array('!current' => $context['sandbox']['current_offset'], '!total' => $count, '!queue' => $context['results']['items_in_queue']));

  if ($context['sandbox']['progress'] < $context['sandbox']['max']) {
    $context['finished'] = $context['sandbox']['progress'] / $context['sandbox']['max'];
  }

}

function atj_filemaker_emma_operations_get_compare_with_filemaker(&$context) {

  $queue = DrupalQueue::get('atj_filemaker_emma_init_relations');
  $queue_check_results = DrupalQueue::get('atj_filemaker_emma_check_results');
  if (!isset($context['sandbox']['fm_progress'])) {
    $context['sandbox']['fm_progress'] = 0;
    $context['sandbox']['max'] = $queue->numberOfItems();
    $context['results']['items_synchronized'] = 0;
    $context['results']['errors'] = !empty($context['results']['errors']) ? $context['results']['errors'] : 0;
  }

  $i = 0;
  $items = array();
  $emails = array();
  $em_members_by_mail = array();
  $errors_count = 0;

  while($i < ATJ_FILEMAKER_EMMA_OPERATIONS_FM_STEP && $item = $queue->claimItem(3600 * 3)) {
    $items[] = $item;
    $emails[] = $item->data->email;
    $em_members_by_mail[$item->data->email] = $item->data;
    //process data
    $context['sandbox']['fm_progress']++;
    $i++;
  }
  try {

    if(!empty($emails)) {
      $fm_contacts = atj_filemaker_emma_fm_get_contacts($emails);
    } else {
      $fm_contacts = array();
    }

    if($fm_contacts !== FALSE) {
      if(empty($fm_contacts)) {
        watchdog('atj_filemaker_emma_operations', 'No emails in filemaker:' . implode(', ', $emails));
      }

      foreach ($fm_contacts as $fm_contact) {
        $fm_contacts_by_mail[strtolower($fm_contact['PrimaryEmail'])] = $fm_contact;
      }

      $em_records_to_update = array();
      foreach ($em_members_by_mail as $mail => $em_member) {
        if(!empty($fm_contacts_by_mail[$mail])) {
          if(!empty($fm_contacts_by_mail[$mail]['ContactID'])) {
            list($emma_values, $profile_values_hash, $contact_values_hash) = atj_filemaker_emma_fm_to_emma_values($fm_contacts_by_mail[$mail]);
            atj_filemaker_emma_db_save_data($fm_contacts_by_mail[$mail]['PrimaryEmail'], $em_member, $fm_contacts_by_mail[$mail], $contact_values_hash, $profile_values_hash);
            $em_records_to_update[] = $emma_values;
          } else {
            watchdog('atj_filemaker_emma_operations_notice', 'Fm contact don\'t have id. ' . atj_filemaker_emma_print($fm_contacts_by_mail[$mail]));
          }
        } else {
          $em_members_not_found_in_fm[$mail] = $em_member;
        }
      }

      if(!empty($em_records_to_update)) {

        $emma = atj_filemaker_emma_ohmyemma_client();

        $data = array('members' => $em_records_to_update);

        $response = atj_filemaker_emma_ohmyemma_results($emma->Members->updateAddMember($data));

        $watchdog = array(
          '$emails' => !empty($emails) ? $emails : NULL,
          '$fm_contacts' => !empty($fm_contacts) ? $fm_contacts : NULL,
          '$em_records_to_update' => !empty($em_records_to_update) ? $em_records_to_update : NULL,
        );

        if($response->is_valid) {
          $context['results']['items_synchronized'] += count($em_records_to_update);
          $queue_check_results->createItem(array('members' => $em_records_to_update, 'import_id' => !empty($response->data->import_id) ? $response->data->import_id : ''));
          watchdog('atj_filemaker_emma_operations', $response->getFullResponseAsText() . atj_filemaker_emma_print($watchdog));
        } else {
          watchdog('atj_filemaker_emma_operations_error', $response->getErrorMessageWithFullResponse() .  atj_filemaker_emma_print($watchdog));
          $errors_count += count($items);
        }
      }

    } else {
      $errors_count += count($items);
      watchdog('atj_filemaker_emma_operations_error', 'Error get info from filemaker:' . implode(', ', $emails));
    }
  } catch (Exception $e) {
      $watchdog = array(
        'Exception message' => $e->getMessage(),
        '$emails' => !empty($emails) ? $emails : NULL,
        '$fm_contacts' => !empty($fm_contacts) ? $fm_contacts : NULL,
        '$em_records_to_update' => !empty($em_records_to_update) ? $em_records_to_update : NULL,
      );
    watchdog('atj_filemaker_emma_operations_error_unknown', atj_filemaker_emma_print($watchdog));
    $errors_count += count($items);
  }


  if(!$errors_count) {
    foreach ($items as $item) {
      $queue->deleteItem($item);
    }
  }

  $context['results']['errors'] += $errors_count;
  $context['message'] = t('Processed records from queue !number', array('!number' => $context['sandbox']['fm_progress']));

  if ($context['sandbox']['fm_progress'] < $context['sandbox']['max']) {
    $context['finished'] = $context['sandbox']['fm_progress'] / $context['sandbox']['max'];
  }
}

function atj_filemaker_emma_operations_check_emma_import_results(&$context) {
  $queue = DrupalQueue::get('atj_filemaker_emma_check_results');
  $queue_errors = DrupalQueue::get('atj_filemaker_emma_items_with_errors');

  if (!isset($context['sandbox']['check_progress'])) {
    $context['sandbox']['check_progress'] = 0;
    $context['sandbox']['max'] = $queue->numberOfItems();
    $context['results']['items_checked'] = 0;
    $context['results']['errors'] = !empty($context['results']['errors']) ? $context['results']['errors'] : 0;
    $context['results']['emma_import_errors'] = array();
  }

  $item = $queue->claimItem();
  if(!empty($item->data['import_id'])) {
    $emma = atj_filemaker_emma_ohmyemma_client();
    $response = atj_filemaker_emma_ohmyemma_results($emma->Members->getImportInformation($item->data['import_id']));
    if($response->is_valid) {
      if(!empty($response->data->error_message)) {
        if(!in_array($response->data->error_message, $context['results']['emma_import_errors'])) {
          $context['results']['emma_import_errors'][] = $response->data->error_message;
        }
        $queue_errors->createItem(array('item' => $item->data, 'error_message' => $response->data->error_message));
      }
    } else {
      $watchdog = array(
        '$item' => !empty($item) ? $item : '',
        '$response' => !empty($response) ? $response : '',
      );
      watchdog('atj_filemaker_emma_operations_validate_response_error', atj_filemaker_emma_print($watchdog));
    }
  }

  $queue->deleteItem($item);

  $context['sandbox']['check_progress']++;
  $context['message'] = t('Checking emma import results !number from !max', array('!number' => $context['sandbox']['check_progress'], '!max' => $context['sandbox']['max']));
  if ($context['sandbox']['check_progress'] < $context['sandbox']['max']) {
    $context['finished'] = $context['sandbox']['check_progress'] / $context['sandbox']['max'];
  }

}

function atj_filemaker_emma_operations_init_finished($success, $results, $operations) {

  drupal_set_message('Added emma records to queue ' .  (!empty($results['items_in_queue']) ? $results['items_in_queue'] : 0) . '; Found emails in FM and synchronized ' . $results['items_synchronized']);

  if(!empty($results['emma_import_errors'])) {
    dsm($results['emma_import_errors'], 'emma_import_errors');
  }
  if(!empty($results['errors'])) {
    drupal_set_message('Errors ' . $results['errors'] . 'check watchdog for details', 'error');
  } else {
    variable_set('atj_filemaker_emma_last_fm_changes_profile_date', (new DateObject())->format(DATE_FORMAT_DATETIME));
    variable_set('atj_filemaker_emma_last_fm_changes_contact_date', (new DateObject())->format(DATE_FORMAT_DATETIME));
  }
}

function atj_filemaker_emma_operations_get_enabled_webhook_events() {

  $webhooks = atj_filemaker_emma_ohmyemma_get_all_webhooks();

  $output = array();
  foreach ($webhooks as $webhook) {
    if(!empty($webhook->url) && strpos($webhook->url, ATJ_FILEMAKER_EMMA_WEBHOOK_URL) !== FALSE) {
      $output[] = $webhook->url . ' (' .  $webhook->event . ')';
    }
  }
  return implode('<br>', $output);
}

function atj_filemaker_emma_operations_remove_webhooks() {
  atj_filemaker_emma_ohmyemma_remove_webhooks(url(ATJ_FILEMAKER_EMMA_WEBHOOK_URL, array('absolute' => TRUE)));
}
function atj_filemaker_emma_operations_add_webhooks() {
  atj_filemaker_emma_ohmyemma_add_webhooks(url(ATJ_FILEMAKER_EMMA_WEBHOOK_URL, array('absolute' => TRUE)));
}

function atj_filemaker_emma_devel_local_data($contact_id) {
  if(function_exists('kpr')) {
    return kpr(atj_filemaker_emma_db_get_data($contact_id), TRUE);
  } else {
    return 'Devel module required.';
  }
}

function atj_filemaker_emma_devel_not_processed_data($id) {
  if(function_exists('kpr')) {
    return kpr(atj_filemaker_emma_db_get_not_processed_data($id), TRUE);
  } else {
    return 'Devel module required.';
  }
}

/**
 * Page callback
 *
 * @param $email
 * @return mixed|string
 */
function atj_filemaker_emma_devel_diff($email) {

  if(!function_exists('kpr')) {
    return 'Devel module required.';
  }

  $out = kpr(atj_filemaker_emma_db_get_data_by_email($email), TRUE, 'Local');
  $fm = atj_filemaker_emma_fm_get_contacts(array($email));
  $out .= kpr($fm, TRUE, 'Fm');

  $emma = atj_filemaker_emma_ohmyemma_client();
  $response = atj_filemaker_emma_ohmyemma_results($emma->Members->getMembers($email));
  $out .= kpr($response, TRUE, 'Em response');
  $em = !empty($response->data) ? $response->data : NULL;

  $out .= kpr($em, TRUE, 'Em');

  if(!empty($fm[0]) && !empty($em)) {
    $out .= kpr(atj_filemaker_emma_find_diff($em, $fm[0]), TRUE, 'diff');
  }

  return $out;
}