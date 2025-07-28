<?php
include '../include/config_new.php'; 
include '../include/MysqliDb.php';
include '../include/config.php';
    $a = new crud();
    $x=$_REQUEST['pi'];
     $pat_id=decode($x);
if (isset($_POST['change_recored']))

{
    $arrival_num=$_POST['arrival_num'];
    $pat_id=$_POST['pat_id'];
    
    $last_ch_id=$_POST['last_checkup_id'];
    $sr_name=$_POST['sr_name'];
    $smoke_his=$_POST['his_smoke'];
    
    $impression=$_POST['impression'];
   
    
    $mr_id='';
    
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $age_year = $_POST['age_year'];
    
    $age_month = $_POST['age_month'];
    
    $age=$age_year."-".$age_month;
    $spo2_rest = $_POST['spo2_rest'];
    $spo2_exertion = $_POST['spo2_exertion'];
    $pulse_rate = $_POST['pulse_rate'];
   
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $bmi=$_POST['bmi'];
    $we_situation=$_POST['meaning'];
    $co_morbidities=$_POST['co_morbidities'];
    $occupation=$_POST['occupation'];
    $ho_tb=$_POST['ho_tb'];
    $bp=$_POST['bp'];

    $spo2_6mwt = $_POST['spo2_6mwt'];
    $spo2_6mwd = $_POST['spo2_6mwd'];
    
    
    $checkup_times="1";

    $past_history=$_POST['past_history'];
    $family_history=$_POST['f_history'];
    $personal_history=$_POST['per_history'];
    $review_lab=$_POST['review_pre_lab'];
    $review_med=$_POST['review_pre_med'];
    
    date_default_timezone_set("Asia/Karachi");
    $today_date=date("Y/m/d");
    $current_time=date("h:i:s");
  
    

    
    $ins_data=array("p_id"=>$pat_id,"smoke_his"=>$smoke_his,"sr_name"=>$sr_name,"mr_id"=>$mr_id,"p_name"=>$name,"contact"=>$contact,"address"=>$address,"gender"=>$gender,"age"=>$age,"spo_rest"=>$spo2_rest,"spo_exertion"=>$spo2_exertion,"pulse_rate"=>$pulse_rate,"p_weight"=>$weight,"p_height"=>$height,"bmi"=>$bmi,"weight_sit"=>$we_situation,"co_morbidities"=>$co_morbidities,"occupation"=>$occupation,"tb_att"=>$ho_tb,"bp"=>$bp,"past_history"=>$past_history,"f_history"=>$family_history,"per_history"=>$personal_history,"review_pre_lab"=>$review_lab,"review_pre_med"=>$review_med,"checkup_times"=>$checkup_times,'spo_6mwt'=>$spo2_6mwt,'spo_6mwd'=>$spo2_6mwd);
    
        $lastid=$db->insert('current_patient',$ins_data); 
      
        
       
         
         
        
        

        if (!empty($lastid)) {
            $ins=array('',$pat_id);
            $enc=encode($pat_id);

            $last_token=$a->insert('token',$ins,null);
            
             $cur_chk_ins=Array("token_no"=>$last_token,"p_id"=>$pat_id,"arrival_num"=>'0',"checkup_time"=>$current_time,"checkup_date"=>$today_date,"impression"=>$impression);
            
            $checkup_id=$db->insert("current_checkup",$cur_chk_ins);
            
              
        $db->where('p_id',$pat_id);
        $db->where('checkup_id',$last_ch_id);
        $pre_med=$db->get('total_patient_medicine');
        foreach($pre_med as $pm){
            
        $med_arr=Array("p_id"=>$pat_id,"checkup_id"=>$checkup_id,"med_name"=>$pm['med_name'],"med_disc"=>$pm['med_disc'],"med_special_desc"=>$pm['med_special_desc'],"time_span"=>$pm['time_span'],"time_num"=>$pm['time_num'],"med_stamp"=>$pm['med_stamp']);
        
        $db->insert('current_patient_medicine',$med_arr);

        }
           



            
           if (!empty($last_token)) {
            
            $enc1=encode($last_token);
            ?>
              <script>
         window.location ="payment2.php?pd=<?php echo $enc; ?>&ld=<?php echo $enc1; ?>";
            </script>
            

            
           <?php
           }
           else
           {
            echo "recored not inserted";
           }
         } else {
            echo "recored not inserted";
         }
          
     

   
          
      

       
   






}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Doctor | Add Existing Petient</title>

        <?php
    include 'lib.php';
    include '../include/auth.php';
    ?>
<script src="bmi.js"></script>

</head>

<body>

    <div id="wrapper">
      

        <!-- Navigation -->
         <?php include  'sidebardoc.php'; ?>
        
       
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="page-header"> Add Existing patient </h1>
                </div>

            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card cardappoint card-topline-yellow ">
                        <!--<div class="card-head card-headappoint ">-->
                        <!--    <h2 class="text-center">Edit Basic Information</h2>-->
                        <!--</div>-->
                        <div class="card-body card-bodystyle">
                            <div class="row">
                                   <?php
                                    $a= new crud();
                                     $x=$_REQUEST['pi'];
                                     $pat_id=decode($x);
                                 
                                    $db->where('p_id',$pat_id);
                                    $patient=$db->getOne('total_patient');
                                    
                                    $last_chk_id=$patient['last_checkup_id'];
                                    
                                    
                                   
                                    $cols = Array ("impression");
                                     $db->where('p_id',$pat_id);
                                     $db->where('checkup_id',$last_chk_id);
                                      
                                     
                                    
                                     $checkup_detail = $db->getOne ("total_checkup", null, $cols);
                                     
                                    
                                       
                                    ?>
                                <div class="col-lg-6">
                                      

                                            <div action="#" id="form_sample_1" class="form-horizontal" novalidate="novalidate">
                                       <form action="" method="POST" name="bmiForm">
                                           <div class="form-group">
                                                
                                                <input class="form-control" type="text" name="pat_id" value="<?php echo $patient['p_id']; ?>" style="display:none;" >

                                            </div>
                                            <div class="form-group">
                                                
                                                <input class="form-control" type="text" name="last_checkup_id" value="<?php echo $patient['last_checkup_id']; ?>" style="display:none;" >

                                            </div>
                                            <div class="form-group hidden">
                                                <label>Token No.</label><br>
                                                <input class="form-control" type="text" name="arrival_num" id="" autocomplete="off" >

                                            </div>
                                            <div class="form-group">
                                                <label>Patient name</label><br>
                                                <input class="form-control" type="text" name="name" value="<?php echo $patient['p_name']; ?>" required >

                                            </div>
                                            
                                            
                                            <div class="form-group hidden">
                                                <label>S/O D/O</label><br>
                                                <input class="form-control" type="text" name="sr_name" value="<?php echo $patient['sr_name']; ?>"  >

                                            </div>
                                            <!--New Age Start-->
                                            <div class="form-group">
                                                <label>Age </label>
                                            </div>
                                            <div style="width:46%;display:inline-block;">
                                            <div class="form-group input-group" >
                                                <span class="input-group-addon">Year</span>
                                                <input type="text" class="form-control" placeholder="Age in Year" name="age_year" value="<?php
                                                 $age_arr=explode("-",$patient['age']);
                                                echo $age_arr[0]; ?>">
                                            </div>
                                            </div>
                                            <div style="width:46%;display:inline-block;margin-left: 28px;">
                                            <div class="form-group input-group">
                                                
                                                <span class="input-group-addon">Month</span>
                                                <input type="text" class="form-control" placeholder="Age in month" name="age_month" value="<?php if( $age_arr[1] ==NULL ){ echo '0'; } else{ echo $age_arr[1]; }  ?>">
                                            </div>
                                            </div>
                                            
                                            <!--New Age End-->
                                            <!--<div class="form-group">-->
                                            <!--    <label>Age </label><br>-->
                                            <!--    <input class="form-control" type="text" name="age" value="<?php //echo $patient['age']; ?>" >-->
                                            <!--</div>-->
                                            <div class="form-group">
                                                <label>Occupation</label>
                                                <input class="form-control" type="text" name="occupation" value="<?php echo $patient['occupation']; ?>"  placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>Address</label><br>
                                                <input class="form-control" type="text" value="<?php echo $patient['address']; ?>"  name="address">
                                            </div>
                                          
                                            <div class="form-group hidden">
                                                <label>Phone No.</label><br>
                                                <input class="form-control" type="text" value="<?php echo $patient['contact']; ?>" name="contact">
                                            </div>
                                            <!-- <div class="form-group">
                                                <input class="form-control" type="date" name="date" id="" placeholder="Date & Time">
                                            </div> -->
                                            <div class="form-group">
                                                <label>Co-Morbidities</label>
                                                <input class="form-control" type="text" name="co_morbidities" value="<?php echo $patient['co_morbidities']; ?>"  placeholder="">
                                            </div>
                                            
    <div class="form-group">
    <label>H|O  ATT</label>
    <textarea class="form-control" name="ho_tb"  id="ho_att" ><?php echo $patient['tb_att']; ?></textarea>
                                                
    
    </div>
                                            <div class="form-group">
                                                <label>H|O Smoking</label>
                                                <input class="form-control" type="text" name="his_smoke" value="<?php echo $patient['smoke_his']; ?>"  placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>BP(Blood Pressure)</label>
                                                <input class="form-control" type="text" name="bp" 
                                                 placeholder="" data-inputmask="'mask': '999/999'" value="<?php echo $patient['bp']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Pulse</label>
                                                <input class="form-control" type="text" name="pulse_rate" id="" placeholder="" value="<?php echo $patient['pulse_rate']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Spo2 at rest on RA</label>
                                                <input class="form-control" type="text" name="spo2_rest" id="" placeholder="" value="<?php echo $patient['spo_rest']; ?>">
                                            </div>

                                            <div class="form-group">
                                                <label>Spo2 on Exertion</label>
                                                <input class="form-control" type="text" name="spo2_exertion" id="" placeholder="" value="<?php echo $patient['spo_exertion']; ?>">
                                            </div>

    <div class="form-group">
    <label>SPO2  6MWT </label>
    <input class="form-control" type="text" name="spo2_6mwt" value="<?php echo $patient['spo_6mwt']; ?>" >
    </div>

    <div class="form-group">
    <label>6MWD </label>
    <input class="form-control" type="text" name="spo2_6mwd" value="<?php echo $patient['spo_6mwd']; ?>" >
    </div>
                                            


                                            <div class="form-group">
                                                <label>Gender </label>
                                                <label class="checkbox-inline">
                                                        <input type="radio" name="gender" value="male" <?php if($patient['gender']=='male') { echo "checked"; } ?> >Male
                                                    </label>
                                                <label class="checkbox-inline">
                                                        <input type="radio" name="gender" value="Female" <?php if($patient['gender']=='Female') { echo "checked"; } ?> >Female
                                                    </label>
                                                <label class="checkbox-inline">
                                                        <input type="radio" name="gender" value="Other" <?php if($patient['gender']=='Other') { echo "checked"; } ?> >Other
                                                    </label>

                                            </div>
                                            
                                            
                                            
                                             


                                            <!-- BMI Start -->
                                             <div class="form-group">
                                                 <label>Weight(kg)</label><br>
                                                <input class="form-control" type="text" name="weight" size="10" value="<?php echo $patient['p_weight']; ?>"  ></div>
                                                
                                        <div class="bmi-show">
                                            <div class="form-group">
                                                <label>Height (cm) </label><br>
                                                <input class="form-control" type="text" name="height" size="10" onkeyup="calculateBmi()" value="<?php echo $patient['p_height']; ?>" ></div>
                                         
                                            <div class="form-group">
                                                <label>BMI Result</label><br>
                                                <input class="form-control" type="text" name="bmi" size="10" value="<?php echo $patient['bmi']; ?>"  ></div>
                                            <div class="form-group">
                                                <label>Weight situation</label><br>
                                                <input class="form-control" type="text" name="meaning" size="25" value="<?php echo $patient['weight_sit']; ?>" ></div>
                                        </div>
                                        <div class="form-group">
                                            <a class="btn-bmi btn btn-primary" >BMI Section</a>
                                        </div>
                                        <!-- Bmi End -->
                                            <div id="response"></div>
                                    
                                              
                                            <!-- blood pressure -->
                                            
                                            <div style="display:none;">
                                             <div class="form-group">
                                               
                                            <textarea class="form-control" type="text" name="impression" ><?php echo $checkup_detail['impression']; ?></textarea>
                                            </div>
                                            
                                            <div class="form-group">
                                               
                                            <textarea class="form-control" type="text" name="past_history" ><?php echo $patient['past_history']; ?></textarea>
                                            </div>
                                             <div class="form-group">
                                               
                                            <textarea class="form-control" type="text" name="f_history" ><?php echo $patient['f_history']; ?></textarea>
                                            </div>
                                            
                                             <div class="form-group">
                                               
                                            <textarea class="form-control" type="text" name="per_history" ><?php echo $patient['per_history']; ?></textarea>
                                            </div> 
                                            
                                             <div class="form-group">
                                               
                                            <textarea class="form-control" type="text" name="review_pre_lab" ><?php echo $patient['review_pre_lab']; ?></textarea>
                                            </div>
                                            
                                             <div class="form-group">
                                               
                                            <textarea class="form-control" type="text" name="review_pre_med"><?php echo $patient['review_pre_med']; ?></textarea>
                                            </div>
                                            </div>

                                           
                                            
                                            
                                            <div class="form-group text-center">
                                                <button type="submit" name="change_recored" class="btn btn-success">Save</button>
                                            </div>
                                        </form>
                                          
                              

                                    </div>

                                     
                                    


                                </div>
                                 
                                <!-- /.row (nested) -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->
        <form name="bmiFor">

        </form>


      <?php
      include 'js_min_lib.php';
    include 'jslib.php';
    ?>
    <script>

$(document).ready(function() {
    $('.bmi-show').hide();
    $('.btn-bmi').on('click', function() {
            $('.bmi-show').toggle(300);
    });

});
</script>
        <script>
    $(":input").inputmask();

   </script>
        


</body>

</html>