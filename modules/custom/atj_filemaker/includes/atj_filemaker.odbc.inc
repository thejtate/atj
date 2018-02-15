<?php
/**
 * Created by PhpStorm.
 * User: dimateus
 * Date: 20/09/16
 * Time: 14:05
 */

/**
 * Class AtjFilemakerRecord.
 * Helper class for working with field names and field values in queries.
 */
class AtjFilemakerRecord {

  private $fields = array();

  /**
   * @var int WEbform nid.
   */
  private $webformNid;

  /**
   * @var int WEbform submission id.
   */
  private $webformSid;

  /**
   * @return int
   */
  public function getWebformNid() {
    return !empty($this->webformNid) ? $this->webformNid : '';
  }

  /**
   * @param int $nid
   */
  public function setWebformNid($nid) {
    $this->webformNid = $nid;
  }

  /**
   * @return int
   */
  public function getWebformSid() {
    return !empty($this->webformSid) ? $this->webformSid : '';
  }

  /**
   * @param int $sid
   */
  public function setWebformSid($sid) {
    $this->webformSid = $sid;
  }

  /**
   * Helper function to attach webform data to filemaker record.
   * @param array $form
   * @param array $form_state
   */
  public function setWebformData($form, $form_state) {
    if(!empty($form['#node']->nid)) {
      $this->setWebformNid($form['#node']->nid);
    }
    if(!empty($form_state['values']['details']['sid'])) {
      $this->setWebformSid($form_state['values']['details']['sid']);
    }
  }

  /**
   * Add text field
   *
   * @param string$fieldName
   * @param string $value
   */
  public function addText($fieldName, $value) {
    $this->fields["\"$fieldName\""] = "'" . str_replace("'", "''", $value) . "'";
  }

  /**
   * Add date field
   *
   * @param string $fieldName
   * @param string $value date string in Y-m-d format
   */
  public function addDate($fieldName, $value) {
    $this->fields["\"$fieldName\""] = "{d '$value'}";
  }

  /**
   * Add image file field
   *
   * @param string $fieldName
   * @param string $value absolute path to file
   */
  public function addImage($fieldName, $value) {
    $type = atj_filemaker_get_file_type($value);
    $output = atj_filemaker_prepare_image_db_string($value);
    $this->fields["\"$fieldName\""] = "PutAs(X'{$output}', '$type')";

  }

  /**
   * Add date field
   *
   * @param string $fieldName
   * @param int $value
   */
  public function addInt($fieldName, $value) {
    $this->fields["\"$fieldName\""] = intval($value);
  }

  public function getFieldsNames() {
    return array_keys($this->fields);
  }

  public function getFields() {
    return $this->fields;
  }
}

/**
 * Connect to the server. Return pdo object.
 * @param array $connection
 *  If null get default connection
 *  have 2 ways
 *  first - setup host, database
 *  ['host' => , 'database' => , 'user' => ,  'password' => ]
 *  second - create dsn connection in "ODBC Data Source Administrator" application and use created "dsn_name"
 *  ['dsn_name' => , 'user' => ,  'password' => ]
 *
 * @return PDO|bool object or false
 */
function atj_filemaker_pdo($connection = NULL) {

  try {
    if(empty($connection)) {
      $dsn= "odbc:Driver={FileMaker ODBC};Server=" . variable_get('atj_filemaker_host', '') . ";Database=" . variable_get('atj_filemaker_database', '') . ";";
      $pdo = new PDO( $dsn, variable_get('atj_filemaker_user', ''), variable_get('atj_filemaker_password', ''));
    } else {
      if(!empty($connection['dsn_name'])) {
        $dsn= "odbc:" . $connection['dsn_name'];
      } else {
        $dsn= "odbc:Driver={FileMaker ODBC};Server=" . $connection['host'] . ";Database=" . $connection['database'] . ";";
      }
      $pdo = new PDO( $dsn, $connection['user'], $connection['password']);
	}

    $pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
    $pdo->setAttribute( PDO::ATTR_CASE, PDO::CASE_NATURAL );

    return $pdo;
  } catch ( PDOException $e ) {
    watchdog('atj_filemaker', 'Error connecting to filemaker: @message', array('@message' => $e->getMessage()));
    return FALSE;
  }
}

/**
 * Insert record to the filemaker layout
 *
 * @param string $table_name Filemaker layout name
 * @param AtjFilemakerRecord $record
 * @param bool $dont_save_not_sent_records set to TRUE if dont need push fail records to "atj_filemaker_not_sent_records" table.
 * @return bool result status true or false
 */
function atj_filemaker_insert($table_name, $record, $dont_save_not_sent_records = FALSE) {

  try {
    $pdo = atj_filemaker_pdo();
    if(!$pdo) {
      throw new Exception('Pdo not available.');
    }

    $field_names_str = implode(', ' , $record->getFieldsNames());
    $values_str = implode(', ' , $record->getFields());

    $sql = 'INSERT INTO ' . $table_name . ' (' . $field_names_str . ') VALUES ('. $values_str . ')';

    $stmt = $pdo->query($sql);

    if(!$stmt) {
      throw new Exception(t('@message @sql', array('@message' => print_r($pdo->errorInfo(), TRUE), '@sql' => $sql)));
    }

    return TRUE;
  } catch(Exception $e) {
    watchdog('atj_filemaker', 'DB Error on inserting record to  filemaker: @message', array('@message' => $e->getMessage()));

    if(!$dont_save_not_sent_records) {
      atj_filemaker_save_not_sent_record($record, $table_name, $e->getMessage());
    }
  }

  return FALSE;
}

/**
 * Insert not sent records to local queue. For further processing.
 *
 * @param AtjFilemakerRecord $record
 */
function atj_filemaker_save_not_sent_record($record, $table_name, $insert_error_message = '') {

  $item = array(
    'nid' => $record->getWebformNid(),
    'sid' => $record->getWebformSid(),
    'date' => REQUEST_TIME,
    'error_text' => $insert_error_message,
    'fm_table_name' => $table_name,
    'record' => $record,
  );

  drupal_write_record('atj_filemaker_not_sent_records', $item);
}

function atj_filemaker_load_not_sent_record($id) {
  $item = db_select('atj_filemaker_not_sent_records', 'r')
    ->fields('r')
    ->condition('r.id', $id)
    ->execute()
    ->fetchObject();

  if(!empty($item->record)) {
    $item->record = unserialize($item->record);
  }

  return $item;
}

function atj_filemaker_delete_not_sent_record($id) {

  db_delete('atj_filemaker_not_sent_records')
    ->condition('id', $id)
    ->execute();
}

/**
 * Execute select query and return results.
 *
 * @param $sql
 * @param array $connection
 *  If null get default connection
 *  ['host' => , 'database' => , 'user' => ,  'password' => ]
 * @return array|bool Return array of results or FALSE
 */
function atj_filemaker_select($sql, $connection = NULL) {

  try {
    $pdo = atj_filemaker_pdo($connection);
    if(!$pdo) {
      return FALSE;
    }

    $stmt = $pdo->query($sql);
    if(!$stmt) {
      watchdog('atj_filemaker', 'SQL Error on select filemaker: @message @sql', array('@message' => print_r($pdo->errorInfo(), TRUE), '@sql' => $sql), WATCHDOG_ERROR);
      drupal_set_message(t('SQL Error on insert record to filemaker: @message @sql', array('@message' => print_r($pdo->errorInfo(), TRUE), '@sql' => $sql)), 'error');
    }

    return !empty($stmt) ? $stmt->fetchAll(PDO::FETCH_ASSOC) : FALSE;
  } catch(Exception $e) {
    watchdog('atj_filemaker', 'DB Error on select filemaker: @message', array('@message' => $e->getMessage()), WATCHDOG_ERROR);
    drupal_set_message(t('DB Error on insert record to filemaker: @message',  array('@message' => $e->getMessage())), 'error');
  }

  return FALSE;
}



/**
 * Prepeare file query string
 *
 * @param $filepath
 * @return string Available to insert in query string
 */
function atj_filemaker_prepare_image_db_string($filepath) {
  $out = 'null';
  try {
    $handle = fopen($filepath, 'rb');
    if ($handle) {
      $content = fread($handle, filesize($filepath));
      $content = bin2hex($content);
      fclose($handle);
      $out = $content;
    }
  } catch(Exception $e) {
    watchdog('atj_filemaker', 'Error converting file to db string: @message', array('@message' => $e->getMessage()), WATCHDOG_ERROR);
  }
  return $out;
}

/**
 *
 * @param $filepath uri or full disk url
 * @return string
 */
function atj_filemaker_get_file_type($filepath) {

  $map = array(
    'application/pdf' => 'PDF ',
    'image/png' => 'PNGf',
    'image/gif' => 'GIFf',
    'image/jpeg' => 'JPEG',
  );
  $mimetype = file_get_mimetype($filepath);

  return isset($map[$mimetype]) ? $map[$mimetype] : 'FILE';
}