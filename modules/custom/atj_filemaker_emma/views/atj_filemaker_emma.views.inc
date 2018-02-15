<?php

/**
 * Implements hook_views_data().
 */
function atj_filemaker_emma_views_data(){
  $data = array();

  $data['atj_filemaker_emma'] = array(
    'table' => array(
      'group' => t('Atj filemaker emma local data'),
      'base' => array(
        'field' => 'fm_id',
        'title' => t('Atj filemaker emma local data'),
        'help' => t('Atj filemaker emma local data'),
        'weight' => -10,
      ),
    ),
  );


  $data['atj_filemaker_emma']['fm_id'] = array(
    'title' => t('FM ContactID'),
    'help' => t('Help'),
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

  $data['atj_filemaker_emma']['em_id'] = array(
    'title' => t('My emma member id'),
    'help' => t('Help'),
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

  $data['atj_filemaker_emma']['email'] = array(
    'title' => t('email'),
    'help' => t('Help'),
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

  $data['atj_filemaker_emma']['contact_values_changed'] = array(
    'title' => t('Contact Changed date'),
    'help' => t('Help'),
    'field' => array(
      'handler' => 'views_handler_field_date',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_date',
      // Note that you can override the field-wide label:
      'label' => t('Changed'),
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

  $data['atj_filemaker_emma']['profile_values_changed'] = array(
    'title' => t('Contact profile Changed date'),
    'help' => t('Help'),
    'field' => array(
      'handler' => 'views_handler_field_date',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_date',
      // Note that you can override the field-wide label:
      'label' => t('Changed'),
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

  $data['atj_filemaker_emma']['profile_values_hash'] = array(
    'title' => t('Profile values hash'),
    'help' => t('Help'),
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

  $data['atj_filemaker_emma']['contact_values_hash'] = array(
    'title' => t('Contact values hash'),
    'help' => t('Help'),
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

  //not processd table

  $data['atj_filemaker_emma_not_processed_changes'] = array(
    'table' => array(
      'group' => t('Atj filemaker emma not processed changes'),
      'base' => array(
        'field' => 'id',
        'title' => t('Atj filemaker emma not processed changes'),
        'help' => t('Atj filemaker emma not processed changes'),
        'weight' => -10,
      ),
    ),
  );

  $data['atj_filemaker_emma_not_processed_changes']['id'] = array(
    'title' => t('Id'),
    'help' => t('Help'),
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

  $data['atj_filemaker_emma_not_processed_changes']['fm_id'] = array(
    'title' => t('FM ContactID'),
    'help' => t('Help'),
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

  $data['atj_filemaker_emma_not_processed_changes']['em_id'] = array(
    'title' => t('My emma member id'),
    'help' => t('Help'),
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

  $data['atj_filemaker_emma_not_processed_changes']['email'] = array(
    'title' => t('email'),
    'help' => t('Help'),
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

  $data['atj_filemaker_emma_not_processed_changes']['source'] = array(
    'title' => t('Source (function name)'),
    'help' => t('Help'),
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

  $data['atj_filemaker_emma_not_processed_changes']['error'] = array(
    'title' => t('Error'),
    'help' => t('Help'),
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

  $data['atj_filemaker_emma_not_processed_changes']['changed'] = array(
    'title' => t('Changed date'),
    'help' => t('Help'),
    'field' => array(
      'handler' => 'views_handler_field_date',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_date',
      // Note that you can override the field-wide label:
      'label' => t('Changed'),
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

  // hook_views_data_item_field_

  // hook_views_data_item_table

  return $data;
}