<?php
/**
 * @file
 *  file_resub module widget for Webforms file elements
 */


function atj_custom_file_resup_process($element, &$form_state, &$form) {

  $path = drupal_get_path('module', 'file_resup');
  $max_files = 1;

  // Get the upload validators and build a new description.

  $description = filter_xss($element['#description']);
  $upload_validators = $element['#upload_validators'];
  $description = theme('file_upload_help', array('description' => $description, 'upload_validators' => ''));

  // Add the resup element.
  $element['resup'] = array(
    '#type' => 'hidden',
    '#value_callback' => 'atj_custom_file_resup_value',
    '#field_name' => $element['#webform_component']['form_key'],
    '#field_parents' => $element['#parents'],
    '#upload_location' => $element['#upload_location'],
    '#file_resup_upload_validators' => $upload_validators,
    '#attributes' => array(
      'class' => array('file-resup'),
      'data-upload-name' => $element['upload']['#name'],
      'data-upload-button-name' => $element['upload_button']['#name'],
      'data-max-filesize' => $upload_validators['file_validate_size'][0],
      'data-description' => $description,
      'data-url' => url('file_resup/upload/' . implode('/', $element['#array_parents']) . '/' . $form['form_build_id']['#value']),
      'data-drop-message' => $max_files > -1 ? format_plural($max_files, 'Drop a file here or click <em>Browse</em> below.', 'Drop up to @count files here or click <em>Browse</em> below.') : t('Drop files here or click <em>Browse</em> below.'),
    ),
    '#prefix' => '<div class="file-resup-wrapper">',
    '#suffix' => '</div>',
    '#attached' => array(
      'css' => array($path . '/file_resup.css'),
      'js' => array(
        $path . '/js/resup.min.js',
        $path . '/file_resup.js',
        array(
          'type' => 'setting',
          'data' => array('file_resup' => array('chunk_size' => file_resup_chunksize())),
        ),
      ),
    ),
  );

  // Add the extension list as a data attribute.
  if (isset($upload_validators['file_validate_extensions'][0])) {
    $extension_list = implode(',', array_filter(explode(' ', $upload_validators['file_validate_extensions'][0])));
    $element['resup']['#attributes']['data-extensions'] = $extension_list;
  }

  // Add the maximum number of files as a data attribute.
  if ($max_files > -1) {
    $element['resup']['#attributes']['data-max-files'] = $max_files;
  }

  // Add autostart as a data attribute.
  $element['resup']['#attributes']['data-autostart'] = 'on';


  $element['upload_button']['#submit'][] = 'atj_custom_file_resup_field_widget_submit';
  //trick, help to ignore client_side_validation before  ajax execute for file upload, just add 'cancel' class
  $element['upload_button']['#attributes']['class'][] = 'cancel';
  if(!empty($element['remove_button'])) {
    $element['remove_button']['#attributes']['class'][] = 'cancel';
  }

  $element['#pre_render'][] = 'file_resup_field_widget_pre_render';

  return $element;
}

/**
 * Element submit. Based on @see
 *
 * @param $form
 * @param $form_state
 */
function atj_custom_file_resup_field_widget_submit($form, &$form_state) {
  $button = $form_state['triggering_element'];
  $element = drupal_array_get_nested_value($form, array_slice($button['#array_parents'], 0, -1));

  // Append our items.
  if (!empty($element['resup']['#value'])) {
    form_set_value($element, $element['resup']['#value'], $form_state);
  }
}

/**
 * Element value callback. Based on @see file_resup_value
 *
 * @param $element
 * @param bool $input
 * @param array $form_state
 * @return string
 */
function atj_custom_file_resup_value($element, $input = FALSE, $form_state = array()) {
  $fids = array();

  if ($input) {
    $resup_file_ids = explode(',', $input);
    if (isset($element['#attributes']['data-max-files'])) {
      $resup_file_ids = array_slice($resup_file_ids, 0, max(0, $element['#attributes']['data-max-files']));
    }
    foreach ($resup_file_ids as $resup_file_id) {
      if ($file = file_resup_save_upload($element, $resup_file_id)) {
        $fids[] = $file->fid;
      }
    }
  }

  return implode(',', $fids);
}