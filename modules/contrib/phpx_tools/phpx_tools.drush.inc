<?php
/**
 * @file
 * Drush commands for phpx_tools module.
 */

/**
 * Implements hook_drush_command().
 */
function phpx_tools_drush_command() {
  $items['phpx-tools-codemirror'] = array(
    'description' => dt('Download codemirror plugin for phpx_tools module.'),
    'bootstrap' => DRUSH_BOOTSTRAP_DRUSH,
    'arguments' => array(
      'path' => dt('A path where to download the Codemirror. Drupal will use sites/all/libraries if not presented.'),
    ),
  );

  return $items;
}

/**
 * Drush command callback for phpx-tools-codemirror command.
 *
 * Downloads Codemirror library to the selected path.
 */
function drush_phpx_tools_codemirror($path = NULL) {
  if (empty($path)) {
    $path = 'sites/all/libraries';
  }
  // Save current directory to return to it after script will be finished.
  $current_directory = getcwd();
  chdir($path);

  // Download file
  $file = drush_download_file(PHPX_TOOLS_CODEMIRROR_DOWNLOAD_URL);

  drush_tarball_extract($file);

  foreach (scandir('.') as $dir) {
    if (strpos($dir, 'codemirror') === 0) {
      drush_move_dir($dir, 'codemirror', TRUE);
      break;
    }
  }

  chdir($current_directory);
}
