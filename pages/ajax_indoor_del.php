<?php 
include '../include/MysqliDb.php';
include '../include/config.php'; 
if (isset($_POST['ajax_action'])) {


	$action=$_POST['ajax_action'];
	if ($action=='done') {

	$del_id=$_POST['del_val'];

	$db->where('test_id',$del_id);
	$db->delete('current_patient_test');
	}
	
}

if (isset($_POST['ajax_outdoor'])) {

	$out_action=$_POST['ajax_outdoor'];
	if ($out_action=='out_done') {
	$del_id=$_POST['del_val'];

	$db->where('test_id',$del_id);
	$db->delete('current_patient_outdoor_test');

		
	}
	
}


?>