<?php
/**
* Create an FX object
*/
function filemaker_connect($database){
	module_load_include('php', 'filemakerform', 'includes/FX/FX');
	$connection = new FX($database->server,"80","FMPro7");
	$connection->SetDBPassword($database->password,$database->username);		
	$connection->SetDBData($database->databaseName,$database->layoutName);
	return $connection;
}
/**
* Add params to the FX object
*/
function filemaker_set_params($fx_object,$keys,$submission,$nid,$database){
	module_load_include('php', 'filemakerform', 'includes/FX/FX');
	
	//We get the fields from the layout so we can confirm that each one exists before adding a param
	$getFields = filemaker_connect($database);
	$fieldNames_ = $getFields->FMView(true,"basic",false);
	if(fmErrorCodes($fieldNames_)){
		watchdog("Filemaker Error","Could not set params.  Error code: " . fmErrorCodes($fieldNames_));
		return $fx_object;
	}
	$fieldNames_ = $fieldNames_['fields'];
	foreach($fieldNames_ as $key => $value){$fieldNames[$value['name']] = $value['type']; }
	
		
	$node = node_load($nid);	
	foreach($keys as $key=>$value){
		//reformat date
		if($value['type'] == "date"){
			$submission->data[$value['cid']]['value'] = explode("-",current($submission->data[$value['cid']]['value']));
			$correct_format = array();
			$correct_format[0] = $submission->data[$value['cid']]['value'][1];
			$correct_format[1] = $submission->data[$value['cid']]['value'][2];
			$correct_format[2] = $submission->data[$value['cid']]['value'][0];	
			$submission->data[$value['cid']]['value'] = array(implode("/",$correct_format));							
		}
		
		if( isset($submission->data[$value['cid']]['value']) && is_array($submission->data[$value['cid']]['value']) ){
			$submitval = implode("\r\n", $submission->data[$value['cid']]['value']);						
			$field_name = $node->filemakercomponenets[$value['cid']]['field'];
			if($field_name != "" &&	array_key_exists($field_name, $fieldNames) ){
				$fx_object->AddDBParam($field_name, $submitval);	
			}
		}
	}
	return $fx_object;
}

/**
* Create a new record in Filemaker
*/
function filemaker_new($database, $keys, $submission, $nid, $sid){
	module_load_include('php', 'filemakerform', 'includes/FX/FX');

	$formSubmission = filemaker_connect($database);	
	$formSubmission = filemaker_set_params($formSubmission,$keys,$submission,$nid,$database);	
	//set the script
	if(isset($database->script) && $database->script != ""){
		$formSubmission->AddDBParam("-script",$database->script);
	}
	$result = $formSubmission->FMNew(true);	
		
	if(is_array($result)){
		$fid_ = key($result['data']);
		$fid = substr ( $fid_ , 0, strpos($fid_, ".") );	
		return array("result" => $result, "fid" => $fid);	
	}
	else{
	  return array("result" => $result, "fid" => 0);	  
	}
	

}
/**
* Update a record that gets edited
*/
function filemaker_update($database, $keys, $submission, $nid, $sid){
	module_load_include('php', 'filemakerform', 'includes/FX/FX');
	$formEdit = filemaker_connect($database);
	$result = db_query("SELECT fid FROM {webform_filemaker_submission} WHERE sid = :sid", array(":sid" => $sid))->fetchObject();
	$fid = $result->fid;
	$formEdit->AddDBParam("-recid",$fid);	
	$formEdit = filemaker_set_params($formEdit,$keys,$submission,$nid,$database);	
	$result = $formEdit->FMEdit(true);		
	return array("result" => $result, "fid" => $fid);
}
/**
* Delete a new record in Filemaker
*/
function filemaker_delete($sid,$database){
	module_load_include('php', 'filemakerform', 'includes/FX/FX');
	$formDelete = filemaker_connect($database);
	$result = db_query("SELECT fid FROM {webform_filemaker_submission} WHERE sid = :sid", array(":sid" => $sid))->fetchObject();
	$fid = $result->fid;
	$formDelete->AddDBParam("-recid",$fid);	
	$result = $formDelete->FMDelete(true);
	return array("result" => $result, "fid" => $fid);
}

?>