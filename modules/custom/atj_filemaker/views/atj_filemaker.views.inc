<?php
/**
 * @file views integration
 */

/**
 * Implements hook_views_data().
 */
function atj_filemaker_views_data() {
  $data = array();

  $data['atj_filemaker_not_sent_records'] = array(
    'table' => array(
      'group' => t('Atj filemaker not sent records'),
      'base' => array(
        'field' => 'id',
        'title' => t('Atj filemaker not sent records'),
        'help' => t('Atj filemaker not sent records'),
        'weight' => -10,
      ),
      'join' => array(
        'node' => array(
          'left_field' => 'nid',
          'field' => 'nid',
        ),
        'webform_submissions' => array(
          'left_field' => 'sid',
          'field' => 'sid',
        ),
      ),
    ),
  );

  $data['atj_filemaker_not_sent_records']['id'] = array(
    'title' => t('Id'),
    'help' => t('Id'),
    'field' => array(
      'handler' => 'views_handler_field_numeric',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_numeric',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_numeric',
    ),
  );

  $data['atj_filemaker_not_sent_records']['nid'] = array(
    'title' => t('Webform nid'),
    'help' => t('Webform nid'),
    'relationship' => array(
      'base' => 'node',
      'field' => 'nid',
      'handler' => 'views_handler_relationship',
      'label' => t('Node for webform'),
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_numeric',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_node_nid',
      'name field' => 'title', // the field to display in the summary.
      'numeric' => TRUE,
      'validate type' => 'nid',
    ),
  );

  $data['atj_filemaker_not_sent_records']['sid'] = array(
    'title' => t('Webform submission'),
    'help' => t('Webform submission if exists'),
    'relationship' => array(
      'base' => 'webform_submissions',
      'field' => 'sid',
      'handler' => 'views_handler_relationship',
      'label' => t('Webform submission'),
    ),
    'field' => array(
      'handler' => 'views_handler_field_numeric',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_numeric',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_numeric',
    ),
  );

  $data['atj_filemaker_not_sent_records']['fm_table_name'] = array(
    'title' => t('Filemaker table name'),
    'help' => t('Filemaker table name'),
    'field' => array(
      'handler' => 'views_handler_field',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_string',
    ),
  );


  $data['atj_filemaker_not_sent_records']['date'] = array(
    'title' => t('Added'),
    'help' => t('Added date time'),
    'field' => array(
      'handler' => 'views_handler_field_date',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_date',
      // Note that you can override the field-wide label:
      'label' => t('Added'),
      // This setting is used by the boolean filter handler, as possible option.
      'type' => 'yes-no',
      // Use boolean_field = 1 instead of boolean_field <> 0 in WHERE statment.
      'use equal' => TRUE,
    ),
    'sort' => array(
      'handler' => 'views_handler_sort_date',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_date',
    ),
  );

  $data['atj_filemaker_not_sent_records']['error_text'] = array(
    'title' => t('Error text'),
    'help' => t('Inserting error text'),
    'field' => array(
      'handler' => 'views_handler_field',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_string',
    ),
  );

  // hook_views_data_item_field_

  // hook_views_data_item_table

  return $data;
}