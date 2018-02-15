<?php

/**
 * @file
 * PHP X Userscript CRUD.
 */

/**
 * Loads userscript records based on $conditions.
 *
 * @param array $conditions
 *   Array of conditions (field values to filter by).
 *
 * @return mixed
 *   Script array or false.
 */
function phpx_tools_userscript_load(array $conditions = array()) {
  $select = db_select('phpx_scripts', 'ps')->fields('ps');

  foreach ($conditions as $field => $value) {
    $select->condition($field, $value);
  }

  $select->orderBy('executed', 'desc');
  $script = $select->execute()->fetchAll(PDO::FETCH_ASSOC);

  return $script;
}

/**
 * Saves a given userscript into DB.
 *
 * @param array $script
 *   The script to be saved.
 * @param bool $executed
 *   Was the script also executed?
 *
 * @return bool|int
 *   Response from drupal_write_record.
 */
function phpx_tools_userscript_save(array $script = array(), $executed = TRUE) {

  $script += array(
    'id' => NULL,
    'uid' => $GLOBALS['user']->uid,
    'created' => REQUEST_TIME,
    'changed' => REQUEST_TIME,
    'executed' => $executed ? REQUEST_TIME : 0,
  );

  $existing = phpx_tools_get_existing_userscript($script['name']);
  if ($existing) {
    $script['id'] = $existing['id'];
    $script['created'] = $existing['created'];
  }

  // Insert or update the affiliate.
  $status = drupal_write_record('phpx_scripts', $script, (!empty($script['id']) ? 'id' : array()));

  return $status;
}

/**
 * Delete script identified by $conditions.
 *
 * @param array $conditions
 *   Conditions to select the script by.
 *
 * @return bool
 *   Success of the operation.
 */
function phpx_tools_userscript_delete(array $conditions = array()) {
  $query = db_delete('phpx_scripts');
  foreach ($conditions as $field => $value) {
    $query->condition($field, $value);
  }

  return $query->execute();
}

/**
 * Get userscript by name.
 *
 * @param string $name
 *   Script name.
 *
 * @return array|null
 *   The requested user script or NULL if it does not exist.
 */
function phpx_tools_get_existing_userscript($name) {
  $existing = phpx_tools_userscript_load(array('name' => $name));

  return $existing ? $existing[0] : NULL;
}

/**
 * Get all user scripts.
 *
 * @return mixed
 *   Array of users scripts.
 */
function phpx_tools_get_userscript() {
  $userscript = db_select('phpx_scripts', 'ps')
    ->fields('ps')
    ->orderBy('changed', 'DESC')
    ->execute()
    ->fetchAll(PDO::FETCH_ASSOC);

  return $userscript;
}

/**
 * Return the table containing the user script record.
 *
 * @return string
 *   Table HTML
 */
function phpx_tools_build_userscript_table() {
  $head = array(
    t('name'),
    t('PHP'),
    t('Created'),
    t('Changed'),
    t('Operations'),
  );
  $rows = array();

  $userscript = phpx_tools_get_userscript();

  if ($userscript) {
    foreach ($userscript as $s) {
      // Reset row variable.
      $load_link = phpx_tools_load_button($s['id']);
      $delete_link = l(t('Delete'), 'devel/php/delete-script/' . $s['id']);
      $row = array();

      $script_name = l(
        $s['name'],
        '#',
        array(
          'external' => TRUE,
          'attributes' => array(
            'class' => array('script-load'),
            'rel' => "script-{$s['id']}",
          ),
        )
      );
      $row[] = theme('html_tag', array(
        'element' => array(
          '#tag' => 'span',
          '#attributes' => array(
            'id' => "script-{$s['id']}-name",
          ),
          '#value' => $script_name,
        ),
      ));

      $row[] = theme('html_tag', array(
        'element' => array(
          '#tag' => 'span',
          '#attributes' => array('id' => "script-{$s['id']}"),
          '#value' => check_plain($s['script']),
        ),
      ));
      $row[] = format_date($s['created'], 'custom', PHPX_TOOLS_DATE_FORMAT);
      $row[] = format_date($s['changed'], 'custom', PHPX_TOOLS_DATE_FORMAT);
      $row[] = $load_link . ' ' . $delete_link;
      $rows[] = $row;
    }
  }
  else {
    return ' :( ' . t("There are currently no saved scripts. Aren't you curios how this table would look like populated with some data? Start saving your script!");
  }

  return theme('table', array(
    'header' => $head,
    'rows' => $rows,
    'attributes' => array(
      'class' => array('phpx-userscript-table'),
    ),
  ));
}
