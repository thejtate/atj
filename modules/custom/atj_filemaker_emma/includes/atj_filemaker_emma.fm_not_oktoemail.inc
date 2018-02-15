<?php
define('ATJ_FILEMAKER_EMMA_NOT_OKTOEMAIL_CHUNK', 20);

module_load_include('inc', 'atj_filemaker_emma', '/includes/atj_filemaker_emma.fm');
module_load_include('inc', 'atj_filemaker_emma', '/includes/atj_filemaker_emma.test');
module_load_include('inc', 'atj_filemaker_emma', '/includes/atj_filemaker_emma.db');
module_load_include('inc', 'atj_filemaker_emma', '/includes/atj_filemaker_emma.emma');
module_load_include('inc', 'atj_filemaker', '/includes/atj_filemaker.odbc');

function atj_filemaker_emma_not_oktoemail_form($form, &$form_state){

  $form['info'] = array(
    '#markup' => '<div>Last date: ' . variable_get('atj_filemaker_emma_last_fm_changes_contact_oktoemail_date', '') . '</div>',
  );

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('UPdate OkToemail'),
    '#name' => 'send',
  );

  return $form;
}

/**
 * Submit callback for Foo.
 */
function atj_filemaker_emma_not_oktoemail_form_submit(&$form, &$form_state) {

  $last_changes_contact_date = variable_get('atj_filemaker_emma_last_fm_changes_contact_oktoemail_date', '');
  $user_name = trim(variable_get('atj_filemaker_emma_user', ''));

  $query  = 'select count(*) as total from "Contact" as c ';
  $query .= 'WHERE (c."OKtoEmail?" = \'No\' AND c.PrimaryEmail is not null ';
  $query .= !empty($last_changes_contact_date) ? 'and c.aModificationTimestamp > TIMESTAMPVAL(\'' . $last_changes_contact_date . '\')' : '';
  $query .= ') ';
  $records = atj_filemaker_select($query, atj_filemaker_emma_fm_get_connection());

  $count = $records[0]['total'];

  $batch = array(
    'operations' => array(
      array('atj_filemaker_emma_set_oktoemail', array($count)),
    ),
    'finished' => 'atj_filemaker_emma_set_oktoemail_finished',
    'title' => 'Setup relations',
    'init_message' => 'Init',
    'progress_message' => 'Processing',
    'error_message' => 'Some error occurs',
    'file' => drupal_get_path('module', 'atj_filemaker_emma').'/includes/atj_filemaker_emma.fm_not_oktoemail.inc',
  );

  batch_set($batch);

}

function atj_filemaker_emma_set_oktoemail($count, &$context) {

  $last_changes_contact_date = variable_get('atj_filemaker_emma_last_fm_changes_contact_oktoemail_date', '');
  $queue_check_results = DrupalQueue::get('atj_filemaker_emma_oktoemail_check_results');
  $errors_count = 0;

  if (!isset($context['sandbox']['progress'])) {
    $context['sandbox']['progress'] = 0;
    $context['results']['errors'] = 0;
    $context['sandbox']['current_offset'] = 0;
    $context['sandbox']['max'] = ceil($count / ATJ_FILEMAKER_EMMA_NOT_OKTOEMAIL_CHUNK);
  }

  try {

    $query  = 'select c.aModificationTimestamp as contactModified, c.*, c.ContactID from "Contact" as c ';
    $query .= 'WHERE (c."OKtoEmail?" = \'No\' AND c.PrimaryEmail is not null ';
    $query .= !empty($last_changes_contact_date) ? 'and c.aModificationTimestamp > TIMESTAMPVAL(\'' . $last_changes_contact_date . '\')' : '';
    $query .= ') ';
    $query .= 'ORDER BY c.aModificationTimestamp ASC, c.ContactID ASC ';
    $query .= 'OFFSET ' . $context['sandbox']['current_offset'] . ' ROWS ';
    $query .= 'FETCH FIRST ' .  ATJ_FILEMAKER_EMMA_NOT_OKTOEMAIL_CHUNK . ' ROWS ONLY';

    $records = atj_filemaker_select($query, atj_filemaker_emma_fm_get_connection());
    atj_filemaker_emma_fm_fix_encoding($records);

    $emails = array();
    foreach($records as $record) {
      $emails[] = $record['PrimaryEmail'];
    }

    $exist_emails = atj_filemaker_emma_db_get_exist_multiple_emails($emails);

    $emma_records = array();
    foreach ($exist_emails as $email) {
      $emma_records[] = array(
        'email' => $email,
        'fields' => array('fmoktoemail' => 'No')
      );
    }

    $watchdog = array(
      '$emails' => !empty($emails) ? $emails : NULL,
      '$emma_records' => !empty($emma_records) ? $emma_records : NULL,
    );

    if(!empty($emma_records)) {
      $emma = atj_filemaker_emma_ohmyemma_client();
      $response = atj_filemaker_emma_ohmyemma_results($emma->Members->updateAddMember(array('members' => $emma_records)));

      if($response->is_valid) {
        $queue_check_results->createItem(array('emma_records' => $emma_records, 'import_id' => !empty($response->data->import_id) ? $response->data->import_id : ''));
        watchdog('atj_filemaker_emma_oktoemail', $response->getFullResponseAsText() . atj_filemaker_emma_print($watchdog));
      } else {
        watchdog('atj_filemaker_emma_oktoemail_error', $response->getErrorMessageWithFullResponse() .  atj_filemaker_emma_print($watchdog));
        $errors_count += 1;
      }
    } else {
      watchdog('atj_filemaker_emma_oktoemail', 'No local emails.' . atj_filemaker_emma_print($watchdog));
    }

  } catch (Exception $e) {
    $watchdog = array(
    'Exception message' => $e->getMessage(),
    '$emails' => !empty($emails) ? $emails : NULL,
    '$emma_records' => !empty($emma_records) ? $emma_records : NULL,
    );
    watchdog('atj_filemaker_emma_operations_error_unknown', atj_filemaker_emma_print($watchdog));
    $errors_count += 1;
  }

  $context['sandbox']['current_offset'] += ATJ_FILEMAKER_EMMA_NOT_OKTOEMAIL_CHUNK;
  $context['sandbox']['progress']++;
  $context['results']['errors'] += $errors_count;

  if ($context['sandbox']['progress'] < $context['sandbox']['max']) {
    $context['finished'] = $context['sandbox']['progress'] / $context['sandbox']['max'];
  }

}

function atj_filemaker_emma_set_oktoemail_finished($success, $results, $operations) {
  if(!empty($results['errors'])) {
    drupal_set_message('Errors ' . $results['errors'] . 'check watchdog for details', 'error');
  } else {
    variable_set('atj_filemaker_emma_last_fm_changes_contact_oktoemail_date', (new DateObject())->format(DATE_FORMAT_DATETIME));
  }
}

function atj_filemaker_emma_not_oktoemail_check_import_batch() {

    $batch = array(
    'operations' => array(
      array('atj_filemaker_emma_not_oktoemail_check_import', array()),
    ),
    'finished' => 'atj_filemaker_emma_not_oktoemail_check_import_finished',
    'title' => 'Setup relations',
    'init_message' => 'Init',
    'progress_message' => 'Processing',
    'error_message' => 'Some error occurs',
    'file' => drupal_get_path('module', 'atj_filemaker_emma').'/includes/atj_filemaker_emma.fm_not_oktoemail.inc',
  );

  batch_set($batch);

}

function atj_filemaker_emma_not_oktoemail_check_import(&$context) {
  $queue = DrupalQueue::get('atj_filemaker_emma_oktoemail_check_results');
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
      watchdog('atj_filemaker_emma_oktoemail_response_error', atj_filemaker_emma_print($watchdog));
    }
  }

  $queue->deleteItem($item);

  $context['sandbox']['check_progress']++;
  $context['message'] = t('Checking emma import results !number from !max', array('!number' => $context['sandbox']['check_progress'], '!max' => $context['sandbox']['max']));
  if ($context['sandbox']['check_progress'] < $context['sandbox']['max']) {
    $context['finished'] = $context['sandbox']['check_progress'] / $context['sandbox']['max'];
  }
}

function atj_filemaker_emma_not_oktoemail_check_import_finished($success, $results, $operations) {
  if(!empty($results['errors'])) {
    drupal_set_message('Errors ' . $results['errors'] . 'check watchdog for details', 'error');
  }
}