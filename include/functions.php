<?php 

function update_second_checkup($pat_id,$checkup_id,$db){
    
    $db->where('p_id',$pat_id);
     $pt=$db->getOne('current_patient');
      if($db->count != '0'){
  
    $pat_data_arr=Array('mr_id'=>$pt['mr_id'],'p_name'=>$pt['p_name'],'sr_name'=>$pt['sr_name'],'contact'=>$pt['contact'],'address'=>$pt['address'],'gender'=>$pt['gender'],'age'=>$pt['age'],'spo_rest'=>$pt['spo_rest'],'spo_exertion'=>$pt['spo_exertion'],'pulse_rate'=>$pt['pulse_rate'],'p_weight'=>$pt['p_weight'],'p_height'=>$pt['p_height'],'bmi'=>$pt['bmi'],'weight_sit'=>$pt['weight_sit'],'co_morbidities'=>$pt['co_morbidities'],'occupation'=>$pt['occupation'],'tb_att'=>$pt['tb_att'],'smoke_his'=>$pt['smoke_his'],'bp'=>$pt['bp'],'past_history'=>$pt['past_history'],'f_history'=>$pt['f_history'],'per_history'=>$pt['per_history'],'review_pre_lab'=>$pt['review_pre_lab'],'review_pre_med'=>$pt['review_pre_med'],'checkup_times'=>$pt['checkup_times'],'last_checkup_id'=>$checkup_id,'is_delete'=>'0','spo_6mwt'=>$pt['spo_6mwt'],'spo_6mwd'=>$pt['spo_6mwd']);
    
    $db->where('p_id',$pat_id);
    
    $db->update('total_patient',$pat_data_arr); 
        
        
        
    
    }
    
     $db->where('p_id',$pat_id);
    $db->where('checkup_id',$checkup_id);
    $checkup=$db->getOne('current_checkup');
    
    if($db->count != '0') {
    
    
     $pat_check_arr=Array('checkup_id'=>$checkup_id,'p_id'=>$pat_id,'checkup_time'=>$checkup['checkup_time'],'checkup_date'=>$checkup['checkup_date'],'hpi'=>$checkup['hpi'],'impression'=>$checkup['impression'],'examination'=>$checkup['examination'],'pt_proc'=>$checkup['pt_proc'],'charity'=>$checkup['charity'],'for_bear_id'=>$checkup['for_bear_id'],'follow_num'=>$checkup['follow_num'],'follow_time'=>$checkup['follow_time'],'rec_fee'=>$checkup['rec_fee'],'pat_plan'=>$checkup['pat_plan']);
     
     $db->insert('total_checkup',$pat_check_arr);
    
     
    }
    
    
    $db->where('p_id',$pat_id);
    $db->where('checkup_id',$checkup_id);
    $pt_med=$db->get('current_patient_medicine');
    if($db->count != '0') {
    foreach($pt_med as $pt_m) {
        
        $pat_med_arr=Array('p_id'=>$pat_id,'checkup_id'=>$checkup_id,'med_name'=>$pt_m['med_name'],'med_disc'=>$pt_m['med_disc'],'med_special_desc'=>$pt_m['med_special_desc'],'time_span'=>$pt_m['time_span'],'time_num'=>$pt_m['time_num'],'med_stamp'=>$pt_m['med_stamp']);
        
        $db->insert('total_patient_medicine',$pat_med_arr);
    
     
        
    }
    }
    
    // $db->where('p_id',$pat_id);
    // $db->where('checkup_id',$checkup_id);
    // $pt_in_test=$db->get('current_patient_test');
    
    // if($db->count != '0') {
    
    // foreach($pt_in_test as $pt_in){
        
        
    //     $pat_in_arr=Array('p_id'=>$pat_id,'checkup_id'=>$checkup_id,'test_name'=>$pt_in['test_name'],'result_value'=>$pt_in['result_value'],'test_price'=>$pt_in['test_price']);
    //     $db->insert('total_patient_test',$pat_in_arr);
        
        
    // }
    // }
    
    
    $db->where('p_id',$pat_id);
    $db->where('checkup_id',$checkup_id);
    $pt_out_test=$db->get('current_patient_outdoor_test');
    
    if($db->count != '0') {
    
    foreach($pt_out_test as $pt_out){
        
        $pat_out_arr=Array('p_id'=>$pat_id,'checkup_id'=>$checkup_id,'test_name'=>$pt_out['test_name'],'result_value'=>$pt_out['result_value']);
        
        $db->insert('total_patient_outdoor_test',$pat_out_arr);
        
    }
    }
    
    
    return true;
    
    
    
}

function push_test_place($test_place,$db){
    
    $db->where('place_name',$test_place);
    $db->get('tbl_test_place');
    if($db->count == '0'){
        $in_place=array('place_name'=>$test_place);
        $db->insert('tbl_test_place',$in_place);
       
        
    }
    
    
}


   
function push_all_record($pat_id,$checkup_id,$db){
    
    $db->where('p_id',$pat_id);
    $pt=$db->getOne('current_patient');
    
    if($db->count != '0'){
  
    $pat_data_arr=Array('p_id'=>$pt['p_id'],'mr_id'=>$pt['mr_id'],'p_name'=>$pt['p_name'],'sr_name'=>$pt['sr_name'],'contact'=>$pt['contact'],'address'=>$pt['address'],'gender'=>$pt['gender'],'age'=>$pt['age'],'spo_rest'=>$pt['spo_rest'],'spo_exertion'=>$pt['spo_exertion'],'pulse_rate'=>$pt['pulse_rate'],'p_weight'=>$pt['p_weight'],'p_height'=>$pt['p_height'],'bmi'=>$pt['bmi'],'weight_sit'=>$pt['weight_sit'],'co_morbidities'=>$pt['co_morbidities'],'occupation'=>$pt['occupation'],'tb_att'=>$pt['tb_att'],'smoke_his'=>$pt['smoke_his'],'bp'=>$pt['bp'],'past_history'=>$pt['past_history'],'f_history'=>$pt['f_history'],'per_history'=>$pt['per_history'],'review_pre_lab'=>$pt['review_pre_lab'],'review_pre_med'=>$pt['review_pre_med'],'checkup_times'=>$pt['checkup_times'],'last_checkup_id'=>$checkup_id,'is_delete'=>'0','spo_6mwt'=>$pt['spo_6mwt'],'spo_6mwd'=>$pt['spo_6mwd']);
    
        $db->insert('total_patient',$pat_data_arr); 
        
        
        
    
    }
        
    
    
    
    $db->where('p_id',$pat_id);
    $db->where('checkup_id',$checkup_id);
    $checkup=$db->getOne('current_checkup');
    
    if($db->count != '0') {
    
    
     $pat_check_arr=Array('checkup_id'=>$checkup_id,'p_id'=>$pat_id,'checkup_time'=>$checkup['checkup_time'],'checkup_date'=>$checkup['checkup_date'],'hpi'=>$checkup['hpi'],'impression'=>$checkup['impression'],'examination'=>$checkup['examination'],'pt_proc'=>$checkup['pt_proc'],'charity'=>$checkup['charity'],'for_bear_id'=>$checkup['for_bear_id'],'follow_num'=>$checkup['follow_num'],'follow_time'=>$checkup['follow_time'],'rec_fee'=>$checkup['rec_fee'],'pat_plan'=>$checkup['pat_plan']);
     
     $db->insert('total_checkup',$pat_check_arr);
    
     
    }
     
    
        
    $db->where('p_id',$pat_id);
    $db->where('checkup_id',$checkup_id);
    $pt_med=$db->get('current_patient_medicine');
    if($db->count != '0') {
    foreach($pt_med as $pt_m) {
        
        $pat_med_arr=Array('p_id'=>$pat_id,'checkup_id'=>$checkup_id,'med_name'=>$pt_m['med_name'],'med_disc'=>$pt_m['med_disc'],'med_special_desc'=>$pt_m['med_special_desc'],'time_span'=>$pt_m['time_span'],'time_num'=>$pt_m['time_num'],'med_stamp'=>$pt_m['med_stamp']);
        
        $db->insert('total_patient_medicine',$pat_med_arr);
    
     
        
    }
    }
    
    // $db->where('p_id',$pat_id);
    // $db->where('checkup_id',$checkup_id);
    // $pt_in_test=$db->get('current_patient_test');
    
    // if($db->count != '0') {
    
    // foreach($pt_in_test as $pt_in){
        
        
    //     $pat_in_arr=Array('p_id'=>$pat_id,'checkup_id'=>$checkup_id,'test_name'=>$pt_in['test_name'],'result_value'=>$pt_in['result_value'],'test_price'=>$pt_in['test_price']);
    //     $db->insert('total_patient_test',$pat_in_arr);
        
        
    // }
    
    // }
    
    
    $db->where('p_id',$pat_id);
    $db->where('checkup_id',$checkup_id);
    $pt_out_test=$db->get('current_patient_outdoor_test');
    
    if($db->count != '0') {
    
    foreach($pt_out_test as $pt_out){
        
        $pat_out_arr=Array('p_id'=>$pat_id,'checkup_id'=>$checkup_id,'test_name'=>$pt_out['test_name'],'result_value'=>$pt_out['result_value']);
        
        $db->insert('total_patient_outdoor_test',$pat_out_arr);
        
    }
    }
    
    
    return true;
    
    
    
    
    
       
    
}

///////////////////////////////////////////////////////////////////////////////



function check_medicine_db($med_name,$med_des,$db,$a){

    $db->where('medi_name',$med_name);
    $med_data=$db->getOne('medicine_suggestion');
    
    if($db->count=='0'){
        
        
        $new_med=$med_name;
        $arr_med=Array('medi_name'=>$new_med);
        $ls_med_id=$db->insert('medicine_suggestion',$arr_med);
        push_new_urdu($ls_med_id,$med_des,$db,$a);
        
    }
    else{
        if($med_des != ''){
           $med_id=$med_data['med_id'];
             push_new_urdu($med_id,$med_des,$db,$a);

        }
    
        
    }
 
}



function push_new_urdu($med_id,$med_des,$db,$a){
	
	


	$db->where("med_id",$med_id);
	$db->where("description",$med_des);
	$db->getOne('medicine_description');
	
	

	
	
	
	
	
	if ($db->count=='0') {
	    $med_des_arr=array('med_id'=>$med_id,
	                       'description'=>$med_des);
	    
	    $db->insert('medicine_description',$med_des_arr);

		
	}
	

}








///////////////////////////////////////////////////////////////////////////////
function get_stamp_name($id_string,$db){
    $stampp_id = explode(",",$id_string);
    $final = array(); // Initialize the array

    foreach ($stampp_id as $s_id)
    {
        $db->where('st_id',$s_id);
        $stm_id = $db->getOne('stamps');

        // Check if the query returned a result and the required field exists
        if ($stm_id && isset($stm_id['st_name'])) {
            $final[] = $stm_id['st_name'];
        }
    }

    // Create the final text after the loop
    $final_text = implode(",", $final);
    return $final_text;
}
///////////////////////////////////////////////////////////////////////////////
function push_plan($plan_string,$db){
      $plan_insert =explode(",",$plan_string);
    foreach ($plan_insert  as $new_plan) 
    {
    if($new_plan != ''){
    $db->where('plan_name',$new_plan);
    $db->getOne('plan_list');
    if($db->count=='0'){
        $data_plan=Array('plan_name'=>$new_plan);
        $db->insert('plan_list',$data_plan);
        
    }

    }
    
    else{
        // do nothing
    }

        
    }
    
}
///////////////////////////////////////////////////////////////////////////////
function push_hpi($hpi_string,$db){
      $hpi_insert =explode(",",$hpi_string);
    foreach ($hpi_insert  as $new_hpi) 
    {
    if($new_hpi != ''){
    $db->where('hpi',$new_hpi);
    $db->getOne('hpi_list');
    if($db->count=='0'){
        $data_hpi=Array('hpi'=>$new_hpi);
        $db->insert('hpi_list',$data_hpi);
        
    }

    }
    
    else{
        // do nothing
    }

        
    }
    
}

///////////////////////////////////////////////////////////////////////////////
function push_impression($imp_string,$db){
      $impression_insert =explode(",",$imp_string);
    foreach ($impression_insert  as $new_imp) 
    {

    if( $new_imp != ''){    

    $db->where('impression_word',$new_imp);
    $db->getOne('impression_suggest');
    if($db->count=='0'){
        $data_imp=Array('impression_word'=>$new_imp);
        $db->insert('impression_suggest',$data_imp);
        
    }

    }
    
    else{
        // do nothing
    }

        
    }
    
}
////////////////////////////////////////////////////////////////////////////////
function push_outdoor_test($test_name,$db){
    $db->where('test_name',$test_name);
    $db->getOne('outdoor_lab_test');
    if($db->count=='0'){
    $data_in=Array("test_name"=>$test_name);
    $db->insert('outdoor_lab_test',$data_in);
    }
    else
    {
        // do nothing
    }
    
    
}

////////////////////////////////////////////////////////////////////////////////
function push_inhouse_test($test_name,$db){
    $db->where('test_name',$test_name);
    $db->getOne('lab_test');
    if($db->count=='0'){
    $data_in=Array("test_name"=>$test_name);
    $db->insert('lab_test',$data_in);
    }
    else
    {
        // do nothing
    }
    
    
}

////////////////////////////////////////////////////////////////////////////////
function push_med_suggestion($med_name,$db){
    $db->where('med_term',$med_name);
    $db->getOne('medication_term');
    if($db->count=='0'){
    $data_in=Array("med_term"=>$med_name);
    $db->insert('medication_term',$data_in);
    }
    else
    {
        // do nothing
    }
    
    
}

///////////////////////////////////////////////////////////////////////////
function push_review_lab($test_name,$db){
    $db->where('lab_test',$test_name);
    $db->getOne('review_lab');
    if($db->count=='0'){
    $data_in=Array("lab_test"=>$test_name);
    $db->insert('review_lab',$data_in);
    }
    else
    {
        // do nothing
    }
    
}

////////////////////////////////////////////////////////////////////////////
function push_new_description($med_name,$med_des,$db){
	
	$db->where("medi_name",$med_name);
	$medi=$db->getOne('medicine_suggestion');
	$med_id=$medi['med_id'];


	$db->where("med_id",$med_id);
	$db->where("description",$med_des);
	$db->getOne('medicine_description');
	if ($db->count=='0') {
		$data_med=Array("med_id"=>$med_id,"description"=>$med_des);
		$db->insert('medicine_description',$data_med);
		
	}
	

}
///////////////////////////////////////////////////////////////////
function push_new_impression($imp_name,$db){
    $db->where("impression_word",$imp_name);
    $db->getOne("impression_suggest");
    if($db->count>0){
      // do nothing  
    }
    elseif($db->count==0){
        $imp_data=Array("impression_word"=>$imp_name);
        $db->insert('impression_suggest',$imp_data);
        
    }
    
    
}

///////////////////////////////////////////////////////////////////
function sanitize_text_input($str){
    $str=strip_tags($str);
   $newstr = htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    return $newstr;


}

//////////////////////////////////////////////////////////////////

function get_stamp_id($stamp_string,$db){

     $stampp =explode(",",$stamp_string);
     $final = array(); // Initialize the array
         foreach ($stampp  as $st)
        {
         $db->where('st_name',$st);
         $stm_id=$db->getOne('stamps');

         // Check if $stm_id is not null and has the required key
         if ($stm_id && isset($stm_id['st_id'])) {
             $final[] =$stm_id['st_id'];
         }
        }

        // Only implode if we have values
        $final_text = !empty($final) ? implode(",", $final) : '';

        return $final_text;
}
//////////////////////////////////////////////////////////////////

function get_forbear_id($forbear_string,$db){

     $forbear =explode(",",$forbear_string);
     $final = array(); // Initialize the array
         foreach ($forbear  as $fb)
        {

         $db->where('bear_title',$fb);
         $fb_id=$db->getOne('forbearance_tbl');

         // Check if $fb_id is not null and has the required key
         if ($fb_id && isset($fb_id['id_for'])) {
             $final[] =$fb_id['id_for'];
         }
        }

        // Only implode if we have values
        $final_ids = !empty($final) ? implode(",", $final) : '';

        return $final_ids;
}

?>