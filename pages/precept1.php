<?php

include '../include/config_new.php'; 
include '../include/MysqliDb.php';
include '../include/config.php'; 
include '../include/functions.php'; 
 $a= new crud();

        $x=$_REQUEST['pd'];
        $pat_id=decode($x);
        $y=$_REQUEST['cd'];
        $checkup_id=decode($y); 
    
    if(isset($_POST['update_medicine'])){
       
          $old_eng_prec = $_POST['old_eng'];
          $old_urdu_prec = $_POST['old_urdu'];
          $old_special_des = $_POST['old_desc'];
          $old_days = $_POST['old_days'];
          $old_day_week = $_POST['old_day_week'];
          
          $old_eng_id=$_POST['old_eng_id'];
          $old_stamp_name=$_POST['old_stamp'];
          
           $cou = count($old_eng_id);
            for ($i=0; $i <$cou ; $i++) 
          { 
            $old_stamp_ids=get_stamp_id($old_stamp_name[$i],$db);
            $old_med_data=Array("med_name"=>$old_eng_prec[$i],"med_disc"=>$old_urdu_prec[$i],"med_special_desc"=>$old_special_des[$i],"time_num"=>$old_days[$i],"time_span"=>$old_day_week[$i],"med_stamp"=>$old_stamp_ids);
            $db->where('med_id',$old_eng_id[$i]);
            $db->update('current_patient_medicine',$old_med_data);
              
              
          }
          
          // if new medicine are added 
           $eng_prec = $_POST['eng'];
          $urdu_prec = $_POST['urdu'];
          $special_des = $_POST['desc'];
          $days = $_POST['days'];
          $day_week = $_POST['day_week'];
          
          $follow_num = $_POST['follow_days'];
          $follow_time = $_POST['follow_day_week'];
          
          $stamp_name=$_POST['stamp'];
         
         
           $cou_new = count($eng_prec);
           
      
         
          for ($i=0; $i <$cou_new ; $i++) 
          { 
              if($eng_prec[$i] != ''){
                  
              
              $stamp_ids=get_stamp_id($stamp_name[$i],$db);
              check_medicine_db($eng_prec[$i],$urdu_prec[$i],$db,$a);

            $med_data=Array("p_id"=>$pat_id,"checkup_id"=>$checkup_id,"med_name"=>$eng_prec[$i],"med_disc"=>$urdu_prec[$i],"med_special_desc"=>$special_des[$i],"time_num"=>$days[$i],"time_span"=>$day_week[$i],"med_stamp"=>$stamp_ids);
            $db->insert('current_patient_medicine',$med_data);        

              }

          }
          
        
        if(isset($_POST['pat_forbear'])){
            
       
        $for_bear=$_POST['pat_forbear'];  
        $cou_for = count($for_bear);
        for ($i=0; $i <$cou_for ; $i++) 
        {
            $final_text[] =$for_bear[$i];
            $final_tx =implode(",", $final_text);
            
              
        }
        $getfor_ids=get_forbear_id($final_tx,$db);
        $up_for=Array('for_bear_id'=>$getfor_ids); 
        $db->where('p_id',$pat_id);
        $db->where('checkup_id',$checkup_id);
        $db->update('current_checkup',$up_for);
        }
        elseif(!isset($_POST['pat_forbear'])){
            $up_for=Array('for_bear_id'=>''); 
        $db->where('p_id',$pat_id);
        $db->where('checkup_id',$checkup_id);
        $db->update('current_checkup',$up_for);
            
        }
        
        $data_follow=Array('follow_num'=>$follow_num,'follow_time'=>$follow_time); 
        $db->where('p_id',$pat_id);
        $db->where('checkup_id',$checkup_id);
        $db->update('current_checkup',$data_follow);
        
        header("LOCATION:print.php?pd=$x");
          
    }

  
   
 if (isset($_POST['add_medicine'])) {
          $a= new crud();
         
          $eng_prec = $_POST['eng'];
          $urdu_prec = $_POST['urdu'];
          $special_des = $_POST['desc'];
          $days = $_POST['days'];
          $day_week = $_POST['day_week'];
          
          $follow_num = $_POST['follow_days'];
          $follow_time = $_POST['follow_day_week'];
          
          $stamp_name=$_POST['stamp'];
         
         
           $cou = count($eng_prec);
      
         
          for ($i=0; $i <$cou ; $i++) 
          { 
              if($eng_prec[$i] != ''){
                  
              
              $stamp_ids=get_stamp_id($stamp_name[$i],$db);
               check_medicine_db($eng_prec[$i],$urdu_prec[$i],$db,$a);
              

            $med_data=Array("p_id"=>$pat_id,"checkup_id"=>$checkup_id,"med_name"=>$eng_prec[$i],"med_disc"=>$urdu_prec[$i],"med_special_desc"=>$special_des[$i],"time_num"=>$days[$i],"time_span"=>$day_week[$i],"med_stamp"=>$stamp_ids);
            $db->insert('current_patient_medicine',$med_data);        
}
        

          }
          
        
        if(isset($_POST['pat_forbear'])){
            
       
        $for_bear=$_POST['pat_forbear'];  
        $cou_for = count($for_bear);
        for ($i=0; $i <$cou_for ; $i++) 
        {
            $final_text[] =$for_bear[$i];
            $final_tx =implode(",", $final_text);
            
              
        }
        $getfor_ids=get_forbear_id($final_tx,$db);
        $up_for=Array('for_bear_id'=>$getfor_ids); 
        $db->where('p_id',$pat_id);
        $db->where('checkup_id',$checkup_id);
        $db->update('current_checkup',$up_for);
        }
         elseif(!isset($_POST['pat_forbear'])){
            $up_for=Array('for_bear_id'=>''); 
        $db->where('p_id',$pat_id);
        $db->where('checkup_id',$checkup_id);
        $db->update('current_checkup',$up_for);
            
        }
        
        $data_follow=Array('follow_num'=>$follow_num,'follow_time'=>$follow_time); 
        $db->where('p_id',$pat_id);
        $db->where('checkup_id',$checkup_id);
        $db->update('current_checkup',$data_follow);

        

        header("LOCATION:print.php?pd=$x");
    }


?>
<script type="text/javascript">
    function hidediv(val)
    {
        $('#divid').attr('inshal', '' + val + '').hide();
          event.preventDefault()

    }
          function showdiv(val)
    {
        $('#divid').attr('inshal', '' + val + '').toggle(300);
         event.preventDefault()

    }
    
    
      function showit(val) {
           // alert(val);
        $('.description'+val+'').toggle(300);
        event.preventDefault();
  
} 
    function showold(val){
        $('.description-old'+val+'').toggle(300);
        event.preventDefault();
        
    }
    function showfirst() {
            
        $('.description').toggle(400);
  
} 
</script>

<!DOCTYPE html>
<html lang="en">

<head>
    
   
    <title>Doctor | Add Medication</title>
    <script src="../assets/js/jquery-3.1.0.min.js" ></script>
    <script src="../js/yauk.min.js"></script>
    

    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/jameelkhushkhati-ttf" type="text/css"/>-->
    <link rel="stylesheet" media="print" href="//fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css">
     <link rel="stylesheet" media="screen" href="//fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    
    
    <script src="word_suggestion.js"></script>
    <!--yhann-->
<?php
 include 'lib.php';
 include '../include/auth.php';
 ?>

      <link rel="stylesheet" href="../assets/css/jquery-ui.css">
     <script src="../assets/js/jquery-migrate-3.0.0.min.js"></script>
     <script src="../assets/js/jquery-ui.js"></script>
</head>
<style type="text/css">
   .btn-plus-set{
       margin-top: 0px;
       margin-bottom: 9px;
       padding:2px;
       font-size:12px;
       padding-left: 10px;
       padding-right: 10px;
   }
  .set-parh{
        margin-top: 25px;
    padding-top: 14px;
    margin-bottom: 10px;
    border-top: 1px solid;
    border-color: lightgrey;
  }
 
.dropdown-item {
     
    width: 100%;
    padding: 0.25rem 1.5rem;
    clear: both;
    font-weight: 400;
    color: #212529;
    text-align: inherit;
    white-space: nowrap;
    background-color: transparent;
    border: 0;
}

    .tt{
        font-family: 'Noto Naskh Arabic', serif; 
        font-size: 18px;
        font-weight: bold;
        color:black;

    }
    .txtstuff {
    resize: none; /* remove this if you want the user to be able to resize it in modern browsers */
    overflow: hidden;
}

.hiddendiv {
    display:none;
    white-space: pre-wrap;
    word-wrap: break-word;
    overflow-wrap: break-word; /* future version of deprecated 'word-wrap' */
}

/* the styles for 'commmon' are applied to both the textarea and the hidden clone */
/* these must be the same for both */
.common {
    width: 500px;
    min-height: 50px;
    font-family: Arial, sans-serif;
    font-size: 13px;
    overflow: hidden;
}

.lbr {
    line-height: 3px;
}
  .fnt-stng{
            font-weight:bold;
            font-size:16px;
            margin-right: 8px;
    }
      .mar-bear{
          margin-top: 15px;
  }
    .col-4-set{
      padding-left: 14px;
      padding-right: 5px;
    }
    .eng-input{
      font-weight: bold;
      color:black;
      height:33px;
      font-size: 15px;
    }
    .col-2-set{
      padding-left: 0px;
      padding-right: 5px; 
    }
    .day-input{
      font-weight: bold;
      color:black;
      height:33px;
      font-size: 18px;
    }
    .dy-week{
      padding-left: 0px;
      padding-right: 0px; 
    }
    .day-week-set{
      height:33px;
      font-size: 13px;
      font-weight: 600;
      font-family: 'Noto Nastaliq Urdu Draft', serif;
      padding-bottom: 0px;
      padding-top: 0px;
    }
    .ur-col{
      padding-left: 5px;
    }
    .ur-in-set{
      font-weight: bold;
      color:black;
      height:auto;
      font-size: 14px;
      height: 33px;
      font-weight: 600;
      font-family: 'Noto Nastaliq Urdu Draft', serif;
    }
    .fnt-family{
        font-family: 'Noto Nastaliq Urdu Draft', serif;
    }
    .med-num{
        padding:0px;
        margin-top: 2px;
    }
    
</style>
<body>
    <div id="wrapper">
      <?php
       include 'sidebardoc.php';
       ?>
        <div id="page-wrapper" style="margin-top: 50px;padding-top: 0px; overflow-x: hidden;">
            <button onclick="goBack()" class="btn"  style="float: right;margin-right: 16px; margin-top: 4%;" title="Go back to previous page"> <i class="fa fa-arrow-circle-left" style="font-size:30px;   color:red;" ></i></button>
          
            <h1 style="margin-top:15px;"> Prescription </h1>
            <h1 id="demo">  </h1>
            <?php
           $g= new crud();
           $x=$_REQUEST['pd'];
           $pat_id=decode($x);
           $recored =$g->select('current_patient p INNER JOIN current_checkup u ON(p.p_id=u.p_id)','p.*,u.*',"p.p_id=$pat_id",'');
                                       
          while($g=$recored->fetch_array())

          {
          $p_status=$g['p_status'];
          $impression=$g['impression'];
          $co_mar=$g['co_morbidities'];
          $pat_forbear=$g['for_bear_id'];  
          $pat_f_num=$g['follow_num'];
          $pat_f_time=$g['follow_time'];
          ?>
          <h3 style="display:inline-block;color:green;"><?php echo $g['p_name'];  ?></h3>
          <h3 style="float:right; display:inline-block;"><?php echo $g['contact']; ?></h3>
                                        
          <div class="select-box" style="padding-bottom: 10px;">
          
<!--Modal Start-->
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding-bottom: 10px;">
        <h4 class="modal-title" id="exampleModalLongTitle" style="display: inline-block;width: 85%;">Checkup Data</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<?php
    $xi= new crud();
    $newrecored =$xi->select('current_patient cp INNER JOIN current_checkup cc ON(cp.p_id=cc.p_id)','cp.*,cc.*',"cp.p_id=$pat_id",'');
    while($h=$newrecored->fetch_array()){
    ?>

<div class="modal-body">
    <?php if($h['sr_name']!=''){ ?>
 <span class="fnt-stng">S/O,D/O,W/O :</span><?php echo $h['sr_name']; ?><br>
  <?php }else{ ?>
  <span class="fnt-stng">S/O,D/O,W/O :</span> No Data<br>
  <?php } ?>
  <?php if($h['address']!=''){ ?>
 <span class="fnt-stng">Address :</span><?php echo $h['address']; ?><br>
  <?php }else{ ?>
  <span class="fnt-stng">Address :</span> No Data<br>
  <?php } ?>
  <?php if($h['gender']!=''){ ?>
 <span class="fnt-stng">Gender :</span><?php echo $h['gender']; ?><br>
  <?php }else{ ?>
  <span class="fnt-stng">Gender :</span> No Data<br>
  <?php } ?>
  <?php if($h['age']!=''){ ?>
 <span class="fnt-stng">Age :</span><?php echo $h['age']; ?><br>
  <?php }else{ ?>
  <span class="fnt-stng">Age :</span> No Data<br>
  <?php } ?>

   <?php if($h['spo_rest']!=''){ ?>
 <span class="fnt-stng">Spo2 at rest on RA :</span><?php echo $h['spo_rest']; ?><br>
  <?php }else{ ?>
  <span class="fnt-stng">Spo2 at rest on RA :</span> No Data<br>
  <?php } ?>
   
  
   <?php if($h['pulse_rate']!=''){ ?>
  <span class="fnt-stng">Pulse rate :</span> <?php echo $h['pulse_rate']; ?><br>
  <?php }else{ ?>
  <span class="fnt-stng">Pulse rate :</span> No Data<br>
  <?php } ?>

  <?php if($h['p_weight']!=''){ ?>
  <span class="fnt-stng">Weight :</span> <?php echo $h['p_weight']; ?><br>
  <?php }else{ ?>
  <span class="fnt-stng">Weight :</span> No Data<br>
  <?php } ?>
  
  <?php if($h['p_height']!=''){ ?>
 <span class="fnt-stng"> Height :</span> <?php echo $h['p_height']; ?><br>
  <?php }else{ ?>
 <span class="fnt-stng"> Height :</span> No Data<br>
  <?php } ?>
          
  <?php if($h['bmi']!=''){ ?>
 <span class="fnt-stng"> BMI :</span> <?php echo $h['bmi']; ?><br>
  <?php }else{ ?>
 <span class="fnt-stng"> BMI :</span> No Data<br>
  <?php } ?>
  
  <?php if($h['co_morbidities']!=''){  ?>
 <span class="fnt-stng"> Co-Morbidities : </span><?php echo $h['co_morbidities']; ?><br>
  <?php }else{ ?>
  <span class="fnt-stng">Co-Morbidities : </span>No Data<br>
  <?php } ?>
  <?php if($h['occupation']!=''){  ?>
 <span class="fnt-stng"> Occupation : </span><?php echo $h['occupation']; ?><br>
  <?php }else{ ?>
  <span class="fnt-stng">Occupation : </span>No Data<br>
  <?php } ?>
  <?php if($h['smoke_his']!=''){ ?>
 <span class="fnt-stng">H|O Smoking :</span><?php echo $h['smoke_his']; ?><br>
  <?php }else{ ?>
  <span class="fnt-stng">H|O Smoking :</span> No Data<br>
  <?php } ?>
  <?php if($h['tb_att']!=''){  ?>
 <span class="fnt-stng"> H|O TB / ATT : </span><?php echo $h['tb_att']; ?><br>
  <?php }else{ ?>
  <span class="fnt-stng">H|O TB / ATT : </span>No Data<br>
  <?php } ?>
    <?php if($h['bp']!=''){ ?>
  <span class="fnt-stng">BP :</span> <?php echo $h['bp']; ?><br>
  <?php }else{ ?>
  <span class="fnt-stng">BP :</span> No Data<br>
  <?php } ?>
  <?php if($h['rec_fee']!=''){  ?>
 <span class="fnt-stng"> Doctor Fee : </span><?php echo $h['rec_fee']; ?><br>
  <?php }else{ ?>
  <span class="fnt-stng">Doctor Fee : </span>No Data<br>
  <?php } ?>

  <?php if($h['hpi']!=''){  ?>
  <span class="fnt-stng">HPI : </span><?php echo $h['hpi']; ?><br>
  <?php }else{ ?>
  <span class="fnt-stng">HPI : </span>No Data<br>
  <?php } ?>
  
  <?php if($h['impression']!=''){  ?>
  <span class="fnt-stng">Diagnosis : </span> <?php echo $h['impression']; ?><br>
  <?php }else{ ?>
  <span class="fnt-stng">Diagnosis :</span> No Data<br>
  <?php } ?>
  
  <?php if($h['past_history']!=''){  ?>
  <span class="fnt-stng">Past history : </span><?php echo $h['past_history']; ?><br>
  <?php }else{ ?>
  <span class="fnt-stng">Past history :</span>No Data<br>
  <?php } ?>
  
  <?php if($h['f_history']!=''){  ?>
 <span class="fnt-stng"> Family history :</span><?php echo $h['f_history']; ?><br>
  <?php }else{ ?>
 <span class="fnt-stng"> Family history :</span> No Data<br>
  <?php } ?>
  
  <?php if($h['per_history']!=''){  ?>
 <span class="fnt-stng"> Personal history :</span> <?php echo $h['per_history']; ?><br>
  <?php }else{ ?>
 <span class="fnt-stng"> Personal history :</span> No Data<br>
  <?php } ?>
  
  <?php if($h['review_pre_lab']!=''){  ?>
  <span class="fnt-stng">Review of previous lab :</span> <?php echo $h['review_pre_lab']; ?><br>
  <?php }else{ ?>
 <span class="fnt-stng"> Review of previous lab :</span> No Data<br>
  <?php } ?>
  
  <?php if($h['review_pre_med']!=''){  ?>
  <span class="fnt-stng">Review of previous medication :</span> <?php echo $h['review_pre_med']; ?><br>
  <?php }else{ ?>
 <span class="fnt-stng"> Review of previous medication : </span>No Data<br>
  <?php } ?>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
      <?php } ?>
    </div>
  </div>
</div>

 <!--Modal End-->
<!--<button class="btn btn-primary" id='addButton' title="Add more medicine in your medication prescription"><i class="fa fa-plus" style="padding-right: 3px;" ></i>Add More</button>-->
<!-- <input type='button' class="btn btn-primary" value='Add Button'> -->
<!--<button class="btn btn-danger" id='removeButton' title="Remove medicine from below list"><i class="fa fa-trash" style="padding-right: 3px;" aria-hidden="true" ></i>Remove</button>-->
<!--<button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalLong" title="Preview previously entered data e.g HPI, Past History etc">PreView</button>-->
<div style="margin-top:20px;">
    <span><b>Diagnosis:</b></span>
    <span><?php echo  $impression;
          //$co_mar=$g['co_morbidities']; ?></span>
          <br>
    <span><b>Co-Morbidities:</b></span>
     <span><?php echo $co_mar; ?></span>
    
</div>
<?php } ?>
    </div>
<script>
function setFocusToTextBox(){
    $("#mytext").focus();
}
</script> 
<form action="" method="POST">
    
    <div class="old">
      <?php
      $con=1;
      $checkup_id=decode($y);   
      $db->where('p_id',$pat_id);
      $db->where('checkup_id',$checkup_id);
      $pat_med=$db->get('current_patient_medicine');
      if($db->count>0){
          foreach($pat_med as $p_me){ ?>
      
      
      <div class="prec-old<?php echo $p_me['med_id'];  ?>">
        <div class="row">
        <p style="border-top:1px solid #c7c7c7;">
          <button class="btn btn-warning med-num"><?php echo 'Medicine no.'.$con; ?></button> 
            </p>   
        <div class="form-group col-md-4 col-4-set">
          <input id="mytext" name="old_eng[]"type="text" class="form-control pre-medicine<?php echo $p_me['med_id'];  ?> eng-input" cols="50" rows="auto" placeholder="Write Medicine Name Here" value="<?php echo $p_me['med_name']; ?>" autofocus ></input>
         <input name="old_eng_id[]" class="form-control" value="<?php echo $p_me['med_id'];  ?>" style="display:none;">
        </div>
        <div class="form-group col-md-2 col-2-set">
          <input id="mytext" name="old_days[]" min='0' type="number" class="form-control day-input" cols="50" rows="auto" placeholder="Number" value="<?php echo $p_me['time_num']; ?>" autofocus >
        </div>
        <div class="form-group col-md-2 dy-week">
      <select class="form-control day-week-set" name="old_day_week[]">
      <option value="دن"  <?php if($p_me['time_span']=='دن') { echo "selected"; } ?>    >دن</option>
      <option value="ہفتے"  <?php if($p_me['time_span']=='ہفتے') { echo "selected"; } ?> >ہفتے</option>
      <option value="مہینے" <?php if($p_me['time_span']=='مہینے') { echo "selected"; } ?> >مہینے</option>
      <option value="سال" <?php if($p_me['time_span']=='سال') { echo "selected"; } ?> >سال</option>
      <option value="لگاتار" <?php if($p_me['time_span']=='لگاتار') { echo "selected"; } ?> > لگاتار </option>
     <!--<option value="زندگی بھر" <?php // if($p_me['time_span']=='زندگی بھر') { echo "selected"; } ?> >زندگی بھر</option>-->
     <option value='حسب ضرورت' <?php if($p_me['time_span']=='حسب ضرورت'){ echo "selected"; } ?> >حسب ضرورت</option>
      </select>
      </div>
        <div class="form-group col-md-4 ur-col">
      <input  class="test form-control tt ur-in-set"  id="search<?php echo $p_me['med_id'];  ?>" name="old_urdu[]" type="text" cols="50" rows="auto" dir="rtl" value="<?php echo $p_me['med_disc']; ?>" placeholder="میڈیسن اردو تفصیل یہاں لکھیں">
    <div class="dropdown-menu example<?php echo $p_me['med_id'];  ?>" id="display<?php echo $p_me['med_id'];  ?>" aria-labelledby="dropdownMenuButton" style="padding: 10px;width:100%;">
    </div>
    </div>
        </div>
        
         <div class="stamp" id="stamp">
          <div class="row" id="stamp_row">
          <div class="stamp_inside">
          <div class="form-group col-md-6">
          <?php
          $pt_stamp=get_stamp_name($p_me['med_stamp'],$db);
          
          ?>
          <input type="text" name="old_stamp[]" class="form-control auto-stamp" id="" value="<?php echo $pt_stamp; ?>" >
          </div>
          </div> 
          </div>
          </div>
         <div class="description-old<?php echo $p_me['med_id'];  ?> des-old" id="divid" inshal="ab<?php echo $p_me['med_id']; ?>" >
         <div class="row">
         <div class='form-group col-md-12'>
              <input id="set_special_dis<?php echo $p_me['med_id'];  ?>" class='test form-control special_dis' name='old_desc[]' onclick="AutoDescription(<?php echo $p_me['med_id'];  ?>)" value='<?php echo $p_me['med_special_desc']; ?>' type='text' cols='50' rows='auto' dir='rtl' style='color:black;font-size: 14px;font-weight: 600;font-family: Noto Nastaliq Urdu Draft, serif;'placeholder="یہاں اردو میں میڈیکل خاص تفصیل لکھیں"/>

            <div class="dropdown-menu spcial-example<?php echo $p_me['med_id'];  ?>" id="special_dis<?php echo $p_me['med_id'];  ?>" aria-labelledby="dropdownMenuButton" style="padding: 10px;width:100%;">
            </div>   
            
            
            
         </div>
         </div>
         </div>
    <button  onClick="showold('<?php echo $p_me['med_id']; ?>')" type="button" id='crosss' class="btn btn-primary btn-plus-set"  title="Add optional or special description for this medicine"><i class="fa fa-plus"></i></button>
    <button  onClick="deletemed('<?php echo $p_me['med_id']; ?>')" type="button" id='crosss' class="btn btn-danger btn-plus-set"  title="Delete Medicine of Patient">Delete</button>
    </div>
<?php $con++; 

?>
<script>
 $( ".pre-medicine"+<?php echo $p_me['med_id'];  ?>+"" ).autocomplete({
        source: 'autocomplete.php',
         select: function (event, ui) {
         var label = ui.item.label;
         var value1 = ui.item.value;
         findcontent_new(value1,<?php echo $p_me['med_id'];  ?>);
        }
    });
    
</script>

<?php
} 


?>

     <!--for update section-->
    <div class="new">
      <div class="prec">
          <p style="border-top:1px solid #c7c7c7;">
          <a class="btn btn-success med-num"><?php echo 'New Medicine no. 1' ?></a> 
            </p>
          
       <div class="row">
                  
        <div class="form-group col-md-4 col-4-set">
          <input id="mytext" name="eng[]"type="text" class="form-control medicine-old eng-input" cols="50" rows="auto" placeholder="Write Medicine Name Here" autofocus ></input>
        </div>
        <div class="form-group col-md-2 col-2-set">
          <input id="mytext" name="days[]" min='0' type="number" class="form-control day-input" cols="50" rows="auto" placeholder="Number" autofocus >
        </div>
      <div class="form-group col-md-2 dy-week">
      <select class="form-control day-week-set" name="day_week[]">
      <option value="دن">دن</option>
      <option value="ہفتے">ہفتے</option>
      <option value="مہینے">مہینے</option>
      <option value="سال">سال</option>
      <option value="لگاتار">لگاتار</option>
      <!--<option value="زندگی بھر">زندگی بھر</option>-->
      <option value="حسب ضرورت">حسب ضرورت</option>
      
      </select>
      </div>
    <div class="form-group col-md-4 ur-col">
      <input  class="test form-control tt ur-in-set"  id="search-old0" name="urdu[]" type="text" cols="50" rows="auto" dir="rtl" placeholder="میڈیسن اردو تفصیل یہاں لکھیں">
    <div class="dropdown-menu example0" id="displayold0" aria-labelledby="dropdownMenuButton" style="padding: 10px;width:100%;">
    </div>
    </div>
    </div>
          <div class="stamp" id="stamp">
          <div class="row" id="stamp_row">
          <div class="stamp_inside">
          <div class="form-group col-md-6">
          <input type="text" name="stamp[]" class="form-control auto-stamp" id="" >
          </div>
          </div> 
          </div>
          </div>
     <div class="description" id="divid" inshal="ab" >
           <div class="row">
             <div class='form-group col-md-12'>
                 <input id="set_special_dis0"  class='test form-control special_dis' name='desc[]' type='text' onclick="AutoDescription(0)"  dir='rtl' style='color:black;font-size: 14px;font-weight: 600;font-family: Noto Nastaliq Urdu Draft, serif;'placeholder="یہاں اردو میں میڈیکل خاص تفصیل لکھیں"/>

            <div class="dropdown-menu spcial-example0" id="special_dis0" aria-labelledby="dropdownMenuButton" style="padding: 10px;width:100%;">
            </div>                 
                
             </div>
       </div>
    </div>
    <button  onClick="showfirst()" type="button" id='crosss' class="btn btn-primary" style='margin-top: 0px;margin-bottom: 9px;padding:2px;font-size:12px;padding-left: 10px;padding-right: 10px;' title="Add optional or special description for this medicine"><i class="fa fa-plus"></i></button>
    </div>
    </div>
    <div style="width:100%;margin-bottom: 10px;">
              <a class="btn btn-primary" id='addButton' title="Add more medicine in medication prescription" style="padding: 0px;font-weight: 700;"><i class="fa fa-plus" style="padding-right: 3px;" ></i>Add More</a>
                <!-- <input type='button' class="btn btn-primary" value='Add Button'> -->
            <a class="btn btn-danger" id='removeButton' title="Remove medicine from medication list" style="padding: 0px;font-weight: 700;margin-right: 4px;"><i class="fa fa-trash" style="padding-right: 3px;" aria-hidden="true" ></i>Remove</a>
            <a type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalLong" title="Preview previously entered data e.g HPI, Past History etc" style="padding: 0px;font-weight: 700;margin-right: 4px;">PreView</a>
            </div>
    
    <div class="row set-parh">
    <div class="col-md-8" id="add_forbear"> 
    <?php
    if($pat_forbear != ''){
    $forbear_ids =explode(",",$pat_forbear);
    foreach($forbear_ids as $f_id){
    $db->where('id_for',$f_id);
    $for_data=$db->getOne('forbearance_tbl');
    ?>
    <div id="appned_forbear<?php echo $pat_id; echo $for_data['id_for']; ?>">
    <div class="col-md-10"><input type="text"  name="pat_forbear[]" class="form-control mar-bear day-week-set" value="<?php echo $for_data['bear_title']; ?>" dir="rtl" readonly>
    </div>
    <div class="col-md-2">
    <button type="button" onclick="remove_forbear('<?php echo $pat_id; echo $for_data['id_for']; ?>')" class="btn btn-danger btn-circle mar-bear"><i class="fa fa-trash"></i></button>
    </div>
    </div>    
    
    
        
<?php }
        
    }
    
    ?>
    
    </div>
    <div class="col-md-4">
    <select class="form-control day-week-set" name="for_bear" id="for_bear">
      <option value="" selected >Select Advice</option>
      <?php 
      $parh=$db->get('forbearance_tbl');
      foreach ($parh as $par) { ?>
      <option value="<?php echo $par['bear_title'] ?>" ><?php echo $par['bear_title'] ?></option>
        
  <?php } ?>
    </select>    
    </div> 
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4 col-2-set">
            <?php
             
          
            ?>
          <input id="mytext" name="follow_days" min='0' type="number" class="form-control day-input" cols="50" rows="auto" value="<?php echo $pat_f_num; ?>" placeholder="Number" autofocus >
        </div>
        <div class="form-group col-md-4 dy-week">
         <select class="form-control day-week-set" name="follow_day_week">
             
          <option value="type1" <?php if($pat_f_time=='type1') { echo "selected"; } ?> >دن</option>
          <option value="type2" <?php if($pat_f_time=='type2') { echo "selected"; } ?> >ہفتے</option>
          <option value="type3" <?php if($pat_f_time=='type3') { echo "selected"; } ?> >مہینے</option>
          <option value="type4" <?php if($pat_f_time=='type4') { echo "selected"; } ?> >سال</option>
          <option value="type5" <?php if($pat_f_time=='type5') { echo "selected"; } ?> >زندگی بھر</option>
          
          
         </select>
        </div>
    </div>
    
    
    
    
    <div class="row">
        <div class="col-md-12 text-center" style="margin-top:30px;">
         <button type="submit" name="update_medicine" class="btn btn-success" title="Save these medicine and description" style="padding-left:80px;padding-right:80px;border-radius:25px;font-size: 16px;"> Save</button>
        </div>
      </div>
      
      <!--for update section end-->



<?php  }
      
      else {
        ?>
        <!--for new section-->
    <div class="new">
      <div class="prec">
          <p style="border-top:1px solid #c7c7c7;">
          <a class="btn btn-success med-num"><?php echo 'New Medicine no. 1' ?></a> 
            </p>
       <div class="row">
                  
        <div class="form-group col-md-4 col-4-set">
          <input id="mytext" name="eng[]"type="text" class="form-control medicine eng-input" cols="50" rows="auto" placeholder="Write Medicine Name Here" autofocus ></input>
        </div>
        <div class="form-group col-md-2 col-2-set">
          <input id="mytext" name="days[]" min='0' type="number" class="form-control day-input" cols="50" rows="auto" placeholder="Number" autofocus >
        </div>
      <div class="form-group col-md-2 dy-week">
      <select class="form-control day-week-set" name="day_week[]">
      <option value="دن">دن</option>
      <option value="ہفتے">ہفتے</option>
      <option value="مہینے">مہینے</option>
      <option value="سال">سال</option>
      <option value="لگاتار">لگاتار</option>
      <!--<option value="زندگی بھر">زندگی بھر</option>-->
      <option value="حسب ضرورت">حسب ضرورت</option>
      </select>
      </div>
    <div class="form-group col-md-4 ur-col">
      <input  class="test form-control tt ur-in-set"  id="search0" name="urdu[]" type="text" cols="50" rows="auto" dir="rtl" placeholder="میڈیسن اردو تفصیل یہاں لکھیں">
    <div class="dropdown-menu example0" id="display0" aria-labelledby="dropdownMenuButton" style="padding: 10px;width:100%;">
    </div>
    </div>
    </div>
          <div class="stamp" id="stamp">
          <div class="row" id="stamp_row">
          <div class="stamp_inside">
          <div class="form-group col-md-6">
          <input type="text" name="stamp[]" class="form-control auto-stamp" id="" >
          </div>
          </div> 
          </div>
          </div>
     <div class="description" id="divid" inshal="ab" >
           <div class="row">
             <div class='form-group col-md-12'>
                 <input id="set_special_disab" class='test form-control special_dis' name='desc[]' type='text' onclick="AutoDescription('ab')"  dir='rtl' style='color:black;font-size: 20px;font-weight: 600;font-family: Noto Nastaliq Urdu Draft, serif;'placeholder="یہاں اردو میں میڈیکل خاص تفصیل لکھیں"/>
                 
            <div class="dropdown-menu spcial-exampleab" id="special_disab" aria-labelledby="dropdownMenuButton" style="padding: 10px;width:100%;">
            </div>  
            
            
             </div>
             
             
       </div>
    </div>
    <button  onClick="showfirst()" type="button" id='crosss' class="btn btn-primary" style='margin-top: 0px;margin-bottom: 9px;padding:2px;font-size:12px;padding-left: 10px;padding-right: 10px;' title="Add optional or special description for this medicine"><i class="fa fa-plus"></i></button>
    </div>
    
    </div>
     <div style="width:100%;margin-bottom: 10px;">
              <a class="btn btn-primary" id='addButton' title="Add more medicine in medication prescription" style="padding: 0px;font-weight: 700;"><i class="fa fa-plus" style="padding-right: 3px;" ></i>Add More</a>
                <!-- <input type='button' class="btn btn-primary" value='Add Button'> -->
            <a class="btn btn-danger" id='removeButton' title="Remove medicine from medication list" style="padding: 0px;font-weight: 700;margin-right: 4px;"><i class="fa fa-trash" style="padding-right: 3px;" aria-hidden="true" ></i>Remove</a>
            <a type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalLong" title="Preview previously entered data e.g HPI, Past History etc" style="padding: 0px;font-weight: 700;margin-right: 4px;">PreView</a>
            </div>
    
    <div class="row set-parh">
    <div class="col-md-8" id="add_forbear"> 
     <?php
    if($pat_forbear != ''){
    $forbear_ids =explode(",",$pat_forbear);
    foreach($forbear_ids as $f_id){
    $db->where('id_for',$f_id);
    $for_data=$db->getOne('forbearance_tbl');
    ?>
    <div id="appned_forbear<?php echo $pat_id; echo $for_data['id_for']; ?>">
    <div class="col-md-10"><input type="text"  name="pat_forbear[]" class="form-control mar-bear day-week-set" value="<?php echo $for_data['bear_title']; ?>" dir="rtl" readonly>
    </div>
    <div class="col-md-2">
    <button type="button" onclick="remove_forbear('<?php echo $pat_id; echo $for_data['id_for']; ?>')" class="btn btn-danger btn-circle mar-bear"><i class="fa fa-trash"></i></button>
    </div>
    </div>    
    
    
        
<?php }
        
    }
    
    ?>
    </div>
    <div class="col-md-4">
    <select class="form-control day-week-set" name="for_bear" id="for_bear">
      <option value="" selected >Select Advice</option>
      <?php 
      $parh=$db->get('forbearance_tbl');
      foreach ($parh as $par) { ?>
      <option value="<?php echo $par['bear_title'] ?>" ><?php echo $par['bear_title'] ?></option>
        
  <?php } ?>
    </select>    
    </div> 
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4 col-2-set">
        <?php if( $pat_f_num != '' ){ ?>
         <input id="mytext" name="follow_days" min='0' type="number" class="form-control day-input" cols="50" rows="auto" placeholder="Number" value="<?php echo $pat_f_num; ?>" autofocus >
        <?php
        }
        else{ ?>
         <input id="mytext" name="follow_days" min='0' type="number" class="form-control day-input" cols="50" rows="auto" placeholder="Number" autofocus >
    <?php    }?>
         
        </div>
        <div class="form-group col-md-4 dy-week">
         <select class="form-control day-week-set" name="follow_day_week">
        <?php
        if($pat_f_time != ''){
        ?>
           <option value="" <?php if($pat_f_time=='') { echo "selected"; } ?> > Select Follow Up</option>
          <option value="type1" <?php if($pat_f_time=='type1') { echo "selected"; } ?> >دن</option>
          <option value="type2" <?php if($pat_f_time=='type2') { echo "selected"; } ?> >ہفتے</option>
          <option value="type3" <?php if($pat_f_time=='type3') { echo "selected"; } ?> >مہینے</option>
          <option value="type4" <?php if($pat_f_time=='type4') { echo "selected"; } ?> >سال</option>
          <!--<option value="type5" <?php // if($pat_f_time=='type5') { echo "selected"; } ?> >زندگی بھر</option>    -->
            
<?php   }
        else{ ?>
         <option value="" selected > Select Follow Up</option>
         <option value="type1">دن</option>
          <option value="type2">ہفتے</option>
          <option value="type3">مہینے</option>
          <option value="type4">سال</option>
          <!--<option value="type5">زندگی بھر</option>-->
            
<?php        }
        ?>
         
         </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center" style="margin-top:30px;">
         <button type="submit" name="add_medicine" class="btn btn-success" title="Save these medicine and description" style="padding-left:80px;padding-right:80px;border-radius:25px;font-size: 16px;"> Save</button>
        </div>
      </div>
      
       <!--for new section end-->
        
          
<?php   }
     
      
      
      ?>
    </div>
    
    
    
     
    </form>
        </div>
    </div>
<script>
  $(function(){
        var k=1;
        $('#for_bear').change(function(){
        var values = $('#for_bear :selected').val();
        $('#add_forbear').append("<div id='appned_forbear"+ k +"'><div class='col-md-10'><input type='text'  name='pat_forbear[]' class='form-control mar-bear day-week-set' value='"+ values +"' dir='rtl' readonly></div><div class='col-md-2'><button type='button' onclick='remove_forbear("+ k +")' class='btn btn-danger btn-circle mar-bear'><i class='fa fa-trash'></i></button></div></div>");
        });
});
       
        var i=1;
        var d=1;
        var xr=1;
        var co=2;
        $(document).ready(function() {
            
            
        
        
        
        
        
        
        $('.description').hide();
        $('.des-old').hide();
        $('#addButton').click(function() {   
        $('.new').append("<div class='prec"+ i +" del'><p style='border-top:1px solid #c7c7c7;'><a class='btn btn-success med-num'>New Medicine no."+ co +"</a></p><div class='row'><div class='form-group col-md-4' style='padding-left: 14px;padding-right: 5px; '><input name=eng[] type='text' class='form-control col-md-4 medicine"+ d + "' cols='50' rows='auto' style='font-weight: bold;color:black;height:33px;font-size: 18px;' placeholder='Write Medicine Name Here'></input></div><div class='form-group col-md-2' style='padding-left: 0px;padding-right: 5px; '><input id='mytext' name='days[]' min='0' type='number' class='form-control ' cols='50' rows='auto' style='font-weight: bold;color:black;height:33px;font-size: 18px;' placeholder='Number' autofocus ></input></div><div class='form-group col-md-2' style='padding-left: 0px;padding-right: 0px; '><select class='form-control' name='day_week[]' style='height:33px;font-size: 12px;font-weight: 600;font-family:Noto Nastaliq Urdu Draft, serif;    padding-bottom: 0px;padding-top: 0px;'><option value='دن'>دن</option><option value='ہفتے'>ہفتے</option><option value='مہینے'>مہینے</option><option value='سال'>سال</option><option value='لگاتار'>لگاتار</option><option value='حسب ضرورت'>حسب ضرورت</option></select></div><div class='form-group col-md-4' style='padding-left: 5px;'><input  class='test form-control tt' id='search"+ d + "' name='urdu[]' type='text' cols='50' rows='auto' dir='rtl' style='color:black;font-weight:bold;font-size: 14px;height:33px;font-weight: 600;font-family:Noto Nastaliq Urdu Draft, serif;' placeholder='میڈیسن اردو تفصیل یہاں لکھیں'></input><div class='dropdown-menu example"+ d + "' id='display"+ d + "' aria-labelledby='dropdownMenuButton' style='padding: 10px;width:100%;'></div></div></div><div class='stamp' id='stamp"+ d +"'><div class='row' id='stamp_row"+ d + "'><div class='stamp_inside'><div class='form-group col-md-6'><input type='text' name='stamp[]' class='form-control auto-stamp"+ d +"'></div></div></div></div><div class='description"+ d + "' id='divid' inshal='ab"+ d + " '><div class='row '><div class='form-group col-md-12'><input id='set_special_dis"+ d +"' class='test form-control special_dis' onclick='AutoDescription("+ d +")' name='desc[]' type='text' style='    height: 39px!important;color:black;font-size: 14px;font-weight: 600;font-family:Noto Nastaliq Urdu Draft, serif;height:auto;'  dir='rtl' placeholder='یہاں اردو میں میڈیکل خاص تفصیل لکھیں'/><div class='dropdown-menu spcial-example"+d+"' id='special_dis"+d+"' aria-labelledby='dropdownMenuButton' style='padding: 10px;width:100%;'></div></div></div></div><button onclick='showit("+ d + ")' id='crosss'class='btn btn-primary' style='margin-top: 0px;margin-bottom: 9px;padding:2px;font-size:12px;padding-left: 10px;padding-right: 10px;' title='Add optional or special description for this medicine'><i class='fa fa-plus'></i></button ></div>");
        $('.description'+d+'').hide();
        $('.des-old'+xr+'').hide();
           
        myFunction();
        call_stamp_ajax(d);
        autocompletecall(i);
        callarea();
        i++;
        d++;
        co++;
        });
        $('#removeButton').click(function() {
        $('.del ').last().remove();
        co--;
});
function myFunction() {
            $(function() {
            $('.test').setUrduInput();
            $('.test').focus();
});
}
$(function() {
            $('.test').setUrduInput();
            $('.test').focus();
});
});
</script>
<script>
    var txt = $('#special_dis'),
    hiddenDiv = $(document.createElement('div')),
    content = null;
    txt.addClass('txtstuff');
    hiddenDiv.addClass('hiddendiv common');
    $('body').append(hiddenDiv);
    txt.on('keyup', function () {
    content = $(this).val();
    content = content.replace(/\n/g, '<br>');
    hiddenDiv.html(content + '<br class="lbr">');
    $(this).css('height', hiddenDiv.height());
});
</script>
<script>
 function callarea()
 {
     var txt = $('#special_dis'),
    hiddenDiv = $(document.createElement('div')),
    content = null;

txt.addClass('txtstuff');
hiddenDiv.addClass('hiddendiv common');

$('body').append(hiddenDiv);

txt.on('keyup', function () {

    content = $(this).val();

    content = content.replace(/\n/g, '<br>');
    hiddenDiv.html(content + '<br class="lbr">');

    $(this).css('height', hiddenDiv.height());

});
 }
$(function() {
    $( ".medicine" ).autocomplete({
         source: 'autocomplete.php',
         select: function (event, ui) {
         var label = ui.item.label;
         var value1 = ui.item.value;
         findcontent(value1);
        }
    });
 });
 $(function() {
    $( ".medicine-old" ).autocomplete({
         source: 'autocomplete.php',
         select: function (event, ui) {
         var label = ui.item.label;
         var value1 = ui.item.value;
         findcontent_old(value1);
        }
    });
 });
 function deletemed(value){
     
     var r = confirm(" Are you sure to delete this Medicine?");
        if (r == true) { 
     
    $.ajax({
    type: "POST",
    url: "ajax_del_med.php",
    data: {del_id: value} ,
    success: function(html) {
        
        $(".prec-old"+ value +"").remove();
                       
    }  
});

}
     
     
 }
function findcontent(name){
    
    $.ajax({
                        type: "POST",
                        url: "ajax.php",
                        data: {mydata: name} ,
                        success: function(html) {
                           
                        $("#display0").html(html).show();
    }  
});      
}
function findcontent_old(name){
    
    $.ajax({
                        type: "POST",
                        url: "ajax_old.php",
                        data: {mydata: name} ,
                        success: function(html) {
                           
                        $("#displayold0").html(html).show();
    }  
});      
}
function autocompletecall(id) {
    $( ".medicine"+id+"" ).autocomplete({
        source: 'autocomplete.php',
         select: function (event, ui) {
         var label = ui.item.label;
         var value1 = ui.item.value;
         findcontent_new(value1,id);
        }
    });
}
function findcontent_new(name,id)
        {   
            $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {mydata: name,
            new_id:id
            } ,
            success: function(html) {
            $("#display"+id+"").html(html).show();
            }  
            });
         }
</script>
<script>
    function fill_old(Value,newid) {
    $('#search-old'+newid+'').val(Value);
    $('.example'+newid+'').css('display', 'none');
     }
   function fill(Value,newid) {
    $('#search'+newid+'').val(Value);
    $('.example'+newid+'').css('display', 'none');
     }
     
     function Special_fill(Value,newid) {
         
        $('#set_special_dis'+newid+'').val(Value);
        $('.spcial-example'+newid+'').css('display', 'none');
    
     }
     
</script>
<script>
    function remove_forbear(id_val){
            $("#appned_forbear"+ id_val +"").remove();
        }
    function split( val ) {
        return val.split( /,\s*/ );
    }
    function extractLast( term ) {
        return split( term ).pop();
    }
    function call_stamp_ajax(id){
        $( ".auto-stamp" +id+ "" ).bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
            event.preventDefault();
        }
    })
    .autocomplete({
        minLength: 1,
        source: function( request, response ) {
            // delegate back to autocomplete, but extract the last term
            $.getJSON("stamp_suggestion.php", { term : extractLast( request.term )},response);
        },
        focus: function() {
            // prevent value inserted on focus
            return false;
        },
        select: function( event, ui ) {
            var terms = split( this.value );
            // remove the current input
            terms.pop();
            // add the selected item
            terms.push( ui.item.value );
            // add placeholder to get the comma-and-space at the end
            terms.push( "" );
            this.value = terms.join( "," );
            return false;
        }
    });
    }
</script>
<?php include 'jslib.php'; ?>
<script src="back.js"></script>
</body>
<script>
    function AutoDescription(id){
        
        $.ajax({
            
            type: "POST",
            url: "ajax_spec.php",
            data: {action:'get_special_disc',get_id:id} ,
            success: function(html) {
                
                
                console.log(html);
               
                
             $("#special_dis"+id+"").html(html).show();
            
            }
            
        });
        
        
    }
        
    
    $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
</script>
</html>




             