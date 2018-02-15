<?php
/**
 * @file batch processing not sent records. Resend them to filemaker.
 */

function atj_filemaker_batch_process($rows, &$context) {
  if (!isset($context['sandbox']['progress'])) {
    $context['sandbox']['progress'] = 0;
    $context['sandbox']['current_position'] = 0;
    $context['sandbox']['max'] = count($rows);
    $context['sandbox']['batch_max'] = count($rows);
  }

  $rec_id = $rows[$context['sandbox']['current_position']];
  module_load_include('inc', 'atj_filemaker', 'includes/atj_filemaker.odbc');

  $rec_data = atj_filemaker_load_not_sent_record($rec_id);

  if(atj_filemaker_insert($rec_data->fm_table_name, $rec_data->record, TRUE)) {
    $context['results'][] = $rec_id;
    atj_filemaker_delete_not_sent_record($rec_id);
  }



  ++$context['sandbox']['current_position'];

  $context['finished'] = !isset($rows[$context['sandbox']['current_position']]);
  $context['message'] = t('Sending @count of @total records...', array('@count' => $context['sandbox']['current_position'], '@total' => $context['sandbox']['max']));
}

function atj_filemaker_batch_finished($success, $results, $operations) {
  drupal_set_message(t('Successfuly sent @count items', array('@count' => count($results))));
}