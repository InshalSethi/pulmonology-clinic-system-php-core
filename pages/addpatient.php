<?php
include '../include/config_new.php';
include '../include/MysqliDb.php';
include '../include/config.php'; 
$a = new crud();
if (isset($_POST['save_recp']))

{
    $arrival_num=$_POST['arrival_num'];
    $sr_name=$_POST['sr_name'];
    $smoke_his=$_POST['his_smoke'];
    
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
    $spo2_6mwt = $_POST['spo2_6mwt'];
    $spo2_6mwd = $_POST['spo2_6mwd'];
    //$oxygen = $_POST['oxygen'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $bmi=$_POST['bmi'];
    $we_situation=$_POST['meaning'];
    $co_morbidities=$_POST['co_morbidities'];
    $occupation=$_POST['occupation'];
    $ho_tb=$_POST['ho_tb'];
    $bp=$_POST['bp'];
    
    //$inhouse = $_POST['inhouse_test'];
    date_default_timezone_set("Asia/Karachi");
    $today_date=date("Y/m/d");
    $current_time=date("h:i:s");
    
   
    $ins_data=array("smoke_his"=>$smoke_his,"sr_name"=>$sr_name,"p_name"=>$name,"contact"=>$contact,"address"=>$address,"gender"=>$gender,"age"=>$age,"spo_rest"=>$spo2_rest,"spo_exertion"=>$spo2_exertion,"pulse_rate"=>$pulse_rate,"p_weight"=>$weight,"p_height"=>$height,"bmi"=>$bmi,"weight_sit"=>$we_situation,"co_morbidities"=>$co_morbidities,"occupation"=>$occupation,"tb_att"=>$ho_tb,"bp"=>$bp,"checkup_times"=>'0','spo_6mwt'=>$spo2_6mwt,'spo_6mwd'=>$spo2_6mwd);
    

    $id = $db->insert ('current_patient', $ins_data);
    
   
   


        

            if (!empty($id)) {
            $ins=array('',$id);
            $enc=encode($id);

            $last_token=$a->insert('token',$ins,null);
            $cur_chk_ins=Array("token_no"=>$last_token,"arrival_num"=>'0',"p_id"=>$id,"checkup_time"=>$current_time,"checkup_date"=>$today_date);
            
            $checkup_id=$db->insert("current_checkup",$cur_chk_ins);
            
            
            
            $chec_en=encode($checkup_id);



            
           if (!empty($last_token)) {
            
            $enc1=encode($last_token);
             
               ?>
            <script>
            window.location ="payment.php?pd=<?php echo $enc; ?>&ld=<?php echo $enc1; ?>";
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

    <title>Doctor | Add Petient</title>


      <?php
    include 'lib.php';
    include '../include/auth.php';
    ?>
     <script src="bmi.js"></script>
      <!-- For Multipile selector-->
     <link rel="stylesheet" href="../assets/css/jquery-ui.css">
     <script src="../assets/js/jquery-1.10.2.js"></script>
     <script src="../assets/js/jquery-ui.js"></script>
    <script src="word_suggestion.js"></script>
  
<script>

$(document).ready(function() {
    $('.bmi-show').hide();
    $('.btn-bmi').on('click', function() {
            $('.bmi-show').toggle(300);
    });

});
</script>

</head>

<body>

    <div id="wrapper">
        

        <!-- Navigation -->
        <?php include  'sidebardoc.php'; ?>
       
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="page-header" style="margin-bottom: 0px;margin-top: 22px;"> Add petient</h1>
                </div>
               
                   
               
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card cardappoint card-topline-yellow ">
                        <!--<div class="card-head card-headappoint ">-->
                        <!--    <h2 class="text-center">Basic Information</h2>-->
                        <!--</div>-->
                        <div class="card-body card-bodystyle">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div action="#" id="form_sample_1" class="form-horizontal" novalidate="novalidate">
                                        <form action="" method="POST" name="bmiForm">
                                            <div class="form-group hidden">
                                                <label>Token No.</label><br>
                                                <input class="form-control" type="text" name="arrival_num" id="" autocomplete="off" >

                                            </div>
                                            <div class="form-group">
                                                <label>Patient name</label><br>
                                                <input class="form-control" type="text" name="name" id="" required >

                                            </div>
                                            <div class="form-group hidden">
                                                <label>S/O D/O</label><br>
                                                <input class="form-control" type="text" name="sr_name" id=""  >

                                            </div>
                                            <div class="form-group"  >
                                                <label>Gender </label>
                                                <label class="checkbox-inline">
                                                        <input type="radio" name="gender" value="male" required >Male
                                                    </label>
                                                <label class="checkbox-inline">
                                                        <input type="radio" name="gender" value="Female">Female
                                                    </label>
                                                <label class="checkbox-inline">
                                                        <input type="radio" name="gender" value="Other">Other
                                                    </label>

                                            </div>
                                            <!--New Age Start-->
                                            <div class="form-group">
                                                <label>Age </label>
                                            </div>
                                            <div style="width:46%;display:inline-block;">
                                            <div class="form-group input-group" >
                                                <span class="input-group-addon">Year</span>
                                                <input type="text" class="form-control" placeholder="Age in Year" name="age_year">
                                            </div>
                                            </div>
                                            <div style="width:46%;display:inline-block;margin-left: 28px;">
                                            <div class="form-group input-group">
                                                
                                                <span class="input-group-addon">Month</span>
                                                <input type="text" class="form-control" placeholder="Age in month" name="age_month" value="0">
                                            </div>
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label>Occupation</label>
                                                <input class="form-control" type="text" name="occupation" value=""  placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>Address</label><br>
                                                <input class="form-control" type="text" name="address">
                                            </div>
                                            <div class="form-group ">
                                                <label>Phone No.</label><br>
                                                <input class="form-control" type="text" name="contact">
                                            </div>
                                            <div class="form-group">
                                                <label>Co-Morbidities</label>
                                                <input class="form-control" type="text" name="co_morbidities" value=""  placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>H|O  ATT</label>
                                                <textarea class="form-control" name="ho_tb"  id="ho_att" ></textarea>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label>H|O Smoking</label>
                                                <input class="form-control" type="text" name="his_smoke" value=""  placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>BP(Blood Pressure)</label>
                                                <input class="form-control" type="text" name="bp" value=""
                                                id="" placeholder="" data-inputmask="'mask': '999/999'">
                                            </div>
                                            <div class="form-group">
                                                <label>Pulse</label>
                                                <input class="form-control" type="text" name="pulse_rate" id="" placeholder="" value="">
                                            </div>
                                            <div class="form-group">
                                                <label>Spo2 at rest on RA</label>
                                                <input class="form-control" type="text" name="spo2_rest" id="" placeholder="" value="">
                                            </div>
                                            
                                        
                                            


                                        
                                        <div class="form-group">
                                        <label>SPO2 on Exertion </label>
                                        <input class="form-control" type="text" name="spo2_exertion" id="" placeholder="" value="">
                                        </div>

                                        <div class="form-group">
                                        <label>SPO2  6MWT </label>
                                        <input class="form-control" type="text" name="spo2_6mwt" >
                                        </div>

                                        <div class="form-group">
                                        <label>6MWD </label>
                                        <input class="form-control" type="text" name="spo2_6mwd" >
                                        </div>

                                            <!-- BMI Start -->
                                        <div class="form-group">
                                                 <label>Weight(kg)</label><br>
                                                <input class="form-control" type="text" name="weight" size="10"  ></div>
                                                
                                        <div class="bmi-show">
                                            <div class="form-group">
                                                <label>Height (cm) </label><br>
                                                <input class="form-control" type="text" name="height" size="10" onkeyup="calculateBmi()"  ></div>
                                         
                                            <div class="form-group">
                                                <label>BMI Result</label><br>
                                                <input class="form-control" type="text" name="bmi" size="10"  ></div>
                                            <div class="form-group">
                                                <label>Weight situation</label><br>
                                                <input class="form-control" type="text" name="meaning" size="25" ></div>
                                        </div>
                                        <div class="form-group">
                                            <a class="btn-bmi btn btn-primary" >BMI Section</a>
                                        </div>
                                        <!-- Bmi End -->
                                            <div id="response"></div>
                                    
                                              
                                           
                                           
                                            
                                            <div class="form-group text-center">
                                                <button type="submit" name="save_recp" class="btn btn-success">Save</button>
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


   
    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../js/metisMenu.min.js"></script>


    <!-- Custom Theme JavaScript -->
    <script src="../js/startmin.js"></script>
    <!-- DataTables JavaScript -->
   
    
<script src="../assets/js/jquery.inputmask.bundle.js"></script>
      <script>
    $(":input").inputmask();

   </script>
       


</body>

</html>