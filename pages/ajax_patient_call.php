<?php 
include '../include/MysqliDb.php';
include '../include/config.php'; 
if (isset($_POST['patient_id'])) {


	$pat_id=$_POST['patient_id'];
	$checkup_id=$_POST['checkup_id'];
	if ($pat_id !='') {

	$db->where('p_id',$pat_id);
	$db->where('checkup_id',$checkup_id);
	$update_arr=array("p_status"=>'1');
	$db->update('current_checkup',$update_arr);
	}
	
}
?>