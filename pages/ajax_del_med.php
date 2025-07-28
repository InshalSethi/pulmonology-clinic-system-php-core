<?php 
include '../include/MysqliDb.php';
include '../include/config.php'; 
if (isset($_POST['del_id'])) {


	$del_id=$_POST['del_id'];
	if ($del_id !='') {

	$db->where('med_id',$del_id);
	$db->delete('current_patient_medicine');
	}
	
}
?>