<?php
include '../include/config_new.php'; 
include '../include/MysqliDb.php';
include '../include/config.php'; 
include '../include/functions.php';

if(isset($_POST['save_recored']))
{  
   
    
    

    $pat_id=$_POST['patient_id'];
    $checkup_id=$_POST['checkup_id'];

    ///////////////// Patient info /////////// 
    $name = $_POST['name'];
    $sr_name = $_POST['sr_name'];
    
    $smoke = $_POST['his_smoke'];
    
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $age_year = $_POST['age_year'];
    
    $age_month = $_POST['age_month'];
    
    $age=$age_year."-".$age_month;
    $spo2_rest = $_POST['spo2_rest'];
    $spo2_exertion = $_POST['spo2_exertion'];
    $spo2_6mwt = $_POST['spo2_6mwt'];
    $spo2_6mwd = $_POST['spo2_6mwd'];
    $pulse_rate = $_POST['pulse_rate'];
   
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $bmi=$_POST['bmi'];
    $we_situation=$_POST['meaning'];
    $co_morbidities=$_POST['co_morbidities'];
    $occupation=$_POST['occupation'];
    $ho_tb=$_POST['ho_tb'];
    $bp=$_POST['bp'];

   
 

    $ins_data=array("smoke_his"=>$smoke,"sr_name"=>$sr_name,"p_name"=>$name,"contact"=>$contact,"address"=>$address,"gender"=>$gender,"age"=>$age,"spo_rest"=>$spo2_rest,"spo_exertion"=>$spo2_exertion,"pulse_rate"=>$pulse_rate,"p_weight"=>$weight,"p_height"=>$height,"bmi"=>$bmi,"weight_sit"=>$we_situation,"co_morbidities"=>$co_morbidities,"occupation"=>$occupation,"tb_att"=>$ho_tb,"bp"=>$bp,'spo_6mwt'=>$spo2_6mwt,'spo_6mwd'=>$spo2_6mwd);
    
    
   
   $db->where('p_id',$pat_id);
   $db->update('current_patient', $ins_data);
  

    $hpi=$_POST['hpi'];
    $impression=$_POST['impression'];
    $exam=$_POST['examination'];
    $dr_fee=$_POST['dr_fee'];
    $pat_pro=$_POST['pro_pat'];
    $pat_plan=$_POST['pat_plan'];
    $charity=$_POST['charity'];
    $up_chk = Array('pt_proc'=>$pat_pro,'charity'=>$charity,'hpi'=>$hpi,'impression'=>$impression,"rec_fee"=> $dr_fee,"examination"=>$exam,'pat_plan'=>$pat_plan);
    
   

    $db->where('p_id',$pat_id);
    $db->where('checkup_id',$checkup_id);
    $db->update('current_checkup', $up_chk);
    
   

    // $pre_inhouse_id = $_POST['pre_inhouse_id'];
    // $pre_inhouse_test = $_POST['pre_inhouse_test'];
    // $pre_inhouse_text = $_POST['pre_inhouse_text'];
    // $pre_inhouse_price = $_POST['pre_inhouse_price'];
    
    $pre_outdoor_id = $_POST['pre_outdoor_id'];
    $pre_outdoor_test = $_POST['pre_outdoor_test'];
    $pre_outdoor_text = $_POST['pre_outdoor_text'];

     // insert indoor test
   //  $pre_in_con=count($pre_inhouse_id);
   //  for ($i=0; $i <$pre_in_con ; $i++) 
   //  {
     
    
   //  $pre_in_data=Array("test_name"=>$pre_inhouse_test[$i],"result_value"=>$pre_inhouse_text[$i],"test_price"=>$pre_inhouse_price[$i]);
   //  $db->where('test_id',$pre_inhouse_id[$i]);
   //  $db->update('current_patient_test',$pre_in_data);
   // // var_dump($pre_in_data);

   //  }

    $pre_out_con=count($pre_outdoor_id);
    for ($i=0; $i <$pre_out_con ; $i++) 
    {


    $pre_out_data=Array("test_name"=>$pre_outdoor_test[$i],"result_value"=>$pre_outdoor_text[$i]);
    $db->where('test_id',$pre_outdoor_id[$i]);
    $db->update('current_patient_outdoor_test',$pre_out_data);

    }


    // $inhouse = $_POST['inhouse_test'];
    // $inhouse_text = $_POST['inhouse_text'];
    // $inhouse_price = $_POST['inhouse_price'];

    $outdoor_test = $_POST['outdoor_test'];
    $outdoor_text = $_POST['outdoor_text'];

    //  // insert indoor test
    // $cou_inhouse=count($inhouse);
    // for ($i=0; $i <$cou_inhouse ; $i++) 
    // {
    // if ($inhouse[$i] != '' ) {
    //      push_inhouse_test($inhouse[$i],$db);
    //      push_test_place($inhouse_text[$i],$db);

    // $in_data=Array("p_id"=>$pat_id,"checkup_id"=>$checkup_id,"test_name"=>$inhouse[$i],"result_value"=>$inhouse_text[$i],"test_price"=>$inhouse_price[$i]);
    //  $db->insert('current_patient_test',$in_data);
    // }

    // }

    // insert out door test
    $cou_outdoor=count($outdoor_test);
    for ($i=0; $i <$cou_outdoor ; $i++) 
    {
    if ($outdoor_test[$i] != '') {
        
         push_outdoor_test($outdoor_test[$i],$db);

    $out_data=Array("p_id"=>$pat_id,"checkup_id"=>$checkup_id,"test_name"=>$outdoor_test[$i],"result_value"=>$outdoor_text[$i]);
     $db->insert('current_patient_outdoor_test',$out_data);

    }



    }
    push_impression($impression,$db);
    push_hpi($hpi,$db);
    push_plan($pat_plan,$db);
    
    

    $x=encode($pat_id);
    $y=encode($checkup_id);
    header("LOCATION:precept1.php?pd=$x&cd=$y");






    
   

       
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

    <title>Doctor | Edit Patient Info</title> 

    <!-- Bootstrap Core CSS -->
  
    <?php
 include 'lib.php';
 include '../include/auth.php';
 ?>

    
   

    <!-- For Multipile selector-->
     <link rel="stylesheet" href="../assets/css/jquery-ui.css">
     <script src="../assets/js/jquery-1.10.2.js"></script>
     <script src="../assets/js/jquery-ui.js"></script>
    
   
    
    <script src="word_suggestion.js"></script>
   
<style>
.fnt-new{
    font-size: 14px;
}
.set-med-name{
    font-size:13px;
    font-weight:600;
}
.set-hy-fnt{
    margin-top:5px;
    height: 9px;
}
.set-ur-med{
    margin:0px;
    font-weight: 600;
}
.set_day{
    display: inline-block;
    margin: 0px;
    float: right;
    margin-right: 2px;
    margin-bottom: 10px;

}
.set-td1{
    padding-right: 0px!important;
    padding-left: 0px !important;
    padding-top: 0px !important;
    padding-bottom: 0px !important;
    min-width:45px;
}
    .hdyt-desc{
    font-family: 'Noto Nastaliq Urdu Draft', serif;
    margin: 4px;
    font-size: 13px;
    font-weight: 600;
    float: right;
    display: inline-block;
    
}
.hdyt-fnt{
    font-family: 'Noto Nastaliq Urdu Draft', serif;
    font-size: 14px;
    font-weight: 600;
    margin: 4px;
    color: red;

    
}
.fnt-family{
    font-family: 'Noto Nastaliq Urdu Draft', serif;
}
.set-fnt-main{
            font-weight:600;
                width: 19%;
        }
.set-td{
                padding: 3px!important;
        }
.make-mar{
        margin-left: 36px;
}
    .setpad
        {
        padding-right: 0px;
        padding-left: 0px;
        }
       
        .setwid
        {
            width: 98%;
        }
        .set_btnwid
        {
            width: 5.333333%!important;
        }
        .add_mar{
        margin-top: 4px;
        }
        td {
            padding: 15px;
        }
        
        .td-left {
            word-break: break-all;
        }
        
        .textarea {
            width: 100%;
            min-height: 50px;
            height: auto;
            border: 2px solid #eeeeee;
        }
        /*.fstElement { font-size: 1.2em; }*/
        
        .fstToggleBtn {
            min-width: 16.5em;
        }
        
        .submitBtn {
            display: none;
        }
        
        .fstMultipleMode {
            display: block;
        }
        
        .fstMultipleMode .fstControls {
            width: 100%;
        }
       .listening{
    display:none;
    color: white;
    font-size: 17px;
    background-color: #00800099;
    padding: 0px 8px;
    
}
    </style>
<script>
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
$(document).ready(function() {
    
    $('.labs-show').hide();
    $('.btn-labs').on('click', function() {
    $('.labs-show').toggle(300);
    });
    $('.info-show-first').hide();
    $('.btn-info-first').on('click', function() {
    $('.info-show-first').toggle(300);
    });
    $('.info-show').hide();
    $('.btn-info').on('click', function() {
    $('.info-show').toggle(300);
    });
    
});
</script>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'sidebardoc.php'; ?>
     

        <div id="page-wrapper">
            <div class="row">
               
                <div class="col-lg-12">
                    <h1 class="page-header"> Edit Patient Checkup</h1>
                   <!--  <h3 style=";color:green;"><?php //echo $a['p_name']; ?></h3>
        <h3 style=" "><?php //echo $a['contact']; ?></h3> -->
        <!---->
        <?php
        $x=$_REQUEST['doc'];
        $y=$_REQUEST['ch'];
        $pat_id=decode($x);
        $checkup_id=decode($y);
        $check_num=1;
        $cols = Array ("checkup_id");
        $db->where('p_id',$pat_id);
        $total_checkup=$db->get ("total_checkup", null, $cols);
        foreach($total_checkup as $tc){
       
    ?>
      <button type="button" onclick="load_previous_checkup(<?php echo $pat_id; ?>,<?php echo $tc['checkup_id']; ?>)" class="btn btn-warning"   style="margin-top:10px;" title="Click here to check previous chekup information">Checkup No.<?php echo $check_num; ?></button>   
<?php  $check_num++;  }
    
    ?>


<!-- Modal -->
<div class="modal fade" id="checkupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="min-width: 870px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Previous Checkup Information</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-body">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
        <!---->
                     <button onclick="goBack()" class="btn"  style="float: right;margin-right: 16px;"> <i class="fa fa-arrow-circle-left" style="font-size:30px;color:red;"></i></button>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
              
           
    <div class="row">
    <form action="" method="POST" name="bmiForm">
    <?php
   

    $db->where('p_id',$pat_id);
    $patient=$db->getOne('current_patient');

    $db->where('p_id',$pat_id);
    $checkup=$db->getOne('current_checkup');

    ?>
    <div class="col-md-4 ">
    <div class="card cardappoint card-topline-yellow ">
    <div class="card-head card-headappoint ">
    <h2 class="text-center" style="margin-top: 11px;margin-bottom: 10px;"> Patient Info</h2>
    </div>
    <div class="card-body card-bodystyle">
    <div class="row">
                 
    <div class="col-lg-12">

    <input class="form-control" type="text" name="patient_id" value="<?php echo $patient['p_id'] ?>" style="display: none;" >
    <input class="form-control" type="text" name="checkup_id" value="<?php echo $checkup['checkup_id'] ?>" style="display: none;">

                      

    <div action="#" id="form_sample_1" class="form-horizontal" novalidate="novalidate">
    <div class="form-group">
    <label>Patient name</label>
    <input class="form-control" type="text" name="name" value="<?php echo $patient['p_name'] ?>" placeholder="">

    </div>

    <div class="info-show-first">
    <div class="form-group hidden">
    <label>S/O D/O W/O </label>
    <input class="form-control" type="text" name="sr_name" value="<?php echo $patient['sr_name'] ?>" placeholder="">

    </div>
     <div class="form-group">
    <label>Gender </label>
    <label class="checkbox-inline">
    <input type="radio" name="gender" value="male" <?php if($patient['gender']=='male'){ echo "checked";} ?> >Male
    </label>
    <label class="checkbox-inline">
    <input type="radio" name="gender" value="Female"  <?php if($patient['gender']=='Female'){ echo "checked";} ?> >Female
    </label>
    <label class="checkbox-inline">
    <input type="radio" name="gender" value="Other"  <?php if($patient['gender']=='Other'){ echo "checked";} ?>  >Other
    </label>

    </div>
<!--New Age Start-->
    <div class="form-group">
        <label>Age </label>
    </div>
    <div style="width:44%;display:inline-block;">
        <div class="form-group input-group" >
        <span class="input-group-addon">Year</span>
            <input type="text" class="form-control" placeholder="Age in Year" name="age_year" value="<?php
            $age_arr=explode("-",$patient['age']);
            echo $age_arr[0]; ?>">
        </div>
    </div>
    <div style="width:44%;display:inline-block;margin-left: 28px;">
        <div class="form-group input-group">
        <span class="input-group-addon">Month</span>
            <input type="text" class="form-control" placeholder="Age in month" name="age_month" value="<?php  echo $age_arr[1]; ?>">
        </div>
    </div>
                                            
    <!--New Age End-->
    <!--<div class="form-group">-->
    <!--<label>Age</label>-->
    <!--<input class="form-control" type="text" name="age" id="" placeholder="" value="<?php //echo $patient['age'] ?>">-->
    <!--</div>-->
    <div class="form-group">
    <label>Occupation</label>
    <input class="form-control" type="text" name="occupation" value="<?php echo $patient['occupation'] ?>"  placeholder="">
    </div>
    <div class="form-group">
    <label>Address</label>
    <input class="form-control" type="text" name="address" value="<?php echo $patient['address'] ?>" id="" placeholder="">
    </div>
    <div class="form-group">
    <label>Phone No.</label>
    <input class="form-control" type="text" name="contact" value="<?php echo $patient['contact'] ?>" id="" placeholder="">
    </div>
    </div>
    <div class="form-group">
         <a class="btn btn-primary btn-info-first">Info</a>
    </div>
    <div class="form-group">
    <label>Co-Morbidities</label>
    <input class="form-control" type="text" name="co_morbidities" value="<?php echo $patient['co_morbidities'] ?>"  placeholder="">
    </div>
    <div class="form-group">
    <label>H|O ATT</label>
   <textarea class="form-control" name="ho_tb"  id="ho_att" ><?php echo $patient['tb_att']; ?></textarea>
    </div>
    <div class="form-group">
    <label>H|O Smoking</label>
    <input class="form-control" type="text" name="his_smoke" value="<?php echo $patient['smoke_his'] ?>"  placeholder="">
    </div>
    <div class="form-group">
    <label>BP(Blood Pressure)</label>
    <input class="form-control" type="text" name="bp" value="<?php echo $patient['bp'] ?>"
        id="" placeholder="" data-inputmask="'mask': '999/999'">
    </div>
    <div class="form-group">
    <label>Pulse rate</label>
    <input class="form-control" type="text" name="pulse_rate" id="" placeholder="" value="<?php echo $patient['pulse_rate'] ?>">
    </div>
    <div class="form-group">
    <label>Spo2 at rest on RA</label>
    <input class="form-control" type="text" name="spo2_rest" id="" placeholder="" value="<?php echo $patient['spo_rest'] ?>">
    </div>
   
   
    <div class="form-group">
    <label>Spo2 on Exertion</label>
    <input class="form-control" type="text" name="spo2_exertion" id="" placeholder="" value="<?php echo $patient['spo_exertion'] ?>">
    </div>
        <div class="form-group">
    <label>SPO2  6MWT </label>
    <input class="form-control" type="text" name="spo2_6mwt" value="<?php echo $patient['spo_6mwt']; ?>" >
    </div>

    <div class="form-group">
    <label>6MWD </label>
    <input class="form-control" type="text" name="spo2_6mwd" value="<?php echo $patient['spo_6mwd']; ?>" >
    </div>
    <!--//////////////BMI///////////////-->
    <div class="form-group">
    <label>Weight(kg)</label>
    <input class="form-control" type="text" name="weight" value="<?php echo $patient['p_weight'] ?>" size="10" placeholder=""></div>
    <div class="info-show">
    <div class="form-group">
    <label>Height (cm) </label>
    <input class="form-control" type="text" name="height" value="<?php echo $patient['p_height'] ?>" size="10" onkeyup="calculateBmi()" placeholder=""></div>
    <div class="form-group">
    <label>BMI Result</label>
    <input class="form-control" type="text" name="bmi" value="<?php echo $patient['bmi'] ?>" size="10" placeholder=""></div>
    <div class="form-group">
    <label>Weight situation</label>
    <input class="form-control" type="text" name="meaning" value="<?php echo $patient['weight_sit'] ?>" placeholder=""></div>
    </div>
    <div class="form-group">
         <a class="btn btn-primary btn-info">BMI</a>
    </div>
    <div id="response"></div>
    <!-- BMI End -->
    <!-- blood pressure -->
    <div class="form-group">
    <label>Doctor Fee</label>
    <input class="form-control" type="text" name="dr_fee" id="dr_fee" value="<?php echo $checkup['rec_fee'] ?>"
        id="" placeholder="" >
    </div>
    <div class="form-group hidden">
    <label>Charity</label>
    <input class="form-control" type="text" name="charity" id="charity" value="<?php echo $checkup['charity'] ?>"
        id="" placeholder="" >
    </div>
           
                                            

                                        </div>

                                     
                                    


                                </div>
                                 
                                <!-- /.row (nested) -->
                            </div>
                        </div>

                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-md-8">
                    <div class="card cardappoint card-topline-yellow ">
                        <div class="card-head card-headappoint ">
                            <h2 class="text-center" style="width: 50%;display: inline-block;margin-top: 11px;margin-bottom: 5px;">Checkup Info</h2>
                            <button type="button" onclick="recognationstop()" class="btn btn-default" style="float:right; margin-right:5px"><i class="fa fa-microphone-slash" style="font-size:30px;color:red;"></i></button>
                        </div>
                        <div class="card-body card-bodystyle">
                            <div action="#" id="form_sample_1" class="form-horizontal" novalidate="novalidate">
                                <!-- <form method="POST" action=""> -->
                                <div class="form-group">
                                        <label>HPI </label>
                                               <div class="listening" id="listening1">  Listening </div>  <br>
                                         <div>
                                            <span id="interim_span" class="interim"></span>
                                        </div>
                                        
                                       
                                             <div class="input-group">
                                         <textarea  id="hpi" class="textarea form-control" name="hpi" contenteditable="true"><?php echo $checkup['hpi'];?></textarea>
                                            <span class="input-group-addon">
                                                <a href="#" id="start_button" onclick="startDictation(event)">
                                                     <i class="fa fa-microphone"></i>
                                                </a>
                                        </span>

                                    </div>
                                    </div>
                                
                                <div class="form-group">
                                    <label>Procedure</label><br>
                                    <textarea  class="textarea form-control" name="pro_pat" type="text" autocomplete="off"><?php echo $checkup['pt_proc'];?></textarea>
                                </div>
                                <div class="form-group">
                                        <label>Systemic Examination</label><br>
                                <textarea  class="textarea form-control" name="examination" type="text" autocomplete="off"><?php echo $checkup['examination'];?></textarea>
                                </div>
                                <div class="form-group">
                                        <label>Diagnosis</label><br>
                                        <input class="textarea" name="impression" id="impression" value="<?php echo $checkup['impression'];?>" type="text" autocomplete="off">
                                </div>

                                 <div class="form-group">
                                <label>Plan</label><br>
                                <textarea id="pat_plan" class="textarea form-control" name="pat_plan"  type="text" autocomplete="off"><?php echo $checkup['pat_plan'];?></textarea>
                                </div>
                                
                                    
 
 
 
 <script>
            function recognationstop(){
                     document.getElementById('listening1').style.display = 'none' ;
                     document.getElementById('listening2').style.display = 'none' ;
                      document.getElementById('listening3').style.display = 'none' ;
                       document.getElementById('listening4').style.display = 'none' ;
                             
                     if ('webkitSpeechRecognition' in window) {
                    
                          var recognitionar= new webkitSpeechRecognition();
                        
                          recognitionar.continuous = true;
                          recognitionar.interimResults = true;
                        
                           
                              console.log(" we are in Remove section") ;
                             recognizing = false;
                                 recognitionar.start();
                     }
                     
          
              
            }
            
 
 </script>
 
 <script>
                 var firstTIme = true;
  
     var final_transcript = '';
    var recognizing = false;



var two_line = /\n\n/g;
var one_line = /\n/g;
function linebreak(s) {
  return s.replace(two_line, '<p></p>').replace(one_line, '<br>');
}

function capitalize(s) {
  return s.replace(s.substr(0,1), function(m) { return m.toUpperCase(); });
}

function startDictation(event) {
    
    document.getElementById('listening1').style.display = 'inline-block'
    
if ('webkitSpeechRecognition' in window) {
    //  console.log("ENter into function ");
                 firstTIme = true;
         
  var recognition = new webkitSpeechRecognition();

  recognition.continuous = true;
  recognition.interimResults = true;

  recognition.onstart = function() {
      //   console.log("ENter into onstart ");
         
      
      
    recognizing = true;
  };

  recognition.onerror = function(event) {
      
      // alert("a 2"); 
         
    console.log(event.error);
  };

 
  recognition.onend = function() {
      
         
       
         recognition.stop();
    recognizing = false;
  };
   

  recognition.onresult = function(event) {
      
      
       
    var interim_transcript =  '';
    for (var i = event.resultIndex; i < event.results.length; ++i) {
        
        if(firstTIme == true){
            final_transcript = hpi.value +' ' ;
            firstTIme = false;
        }
      if (event.results[i].isFinal) {
        final_transcript += event.results[i][0].transcript;
        
      } else {
        interim_transcript += event.results[i][0].transcript;
      }
    }
   
    final_transcript = capitalize(final_transcript);
     // hpi.innerHTML = linebreak(final_transcript);
    
     //document.getElementById("hpi").value =linebreak(final_transcript);
     hpi.value =linebreak(final_transcript);
     
    interim_span.innerHTML = linebreak(interim_transcript);
      
  };
  
  
}




     
  if (recognizing) {
    
    recognition.stop();
    return;
  }
  final_transcript = '';
   
  recognition.lang = 'en-US';
  recognition.start();
  //hpi.innerHTML = '';
  interim_span.innerHTML = '';
  
   
}



</script>
 <!-- 2nd voice -->
  <script>
 
     var final_transcript = '';
    var recognizing = false;

        
        var two_line = /\n\n/g;
        var one_line = /\n/g;
        function linebreak(s) {
          return s.replace(two_line, '<p></p>').replace(one_line, '<br>');
        }
        
        function capitalize(s) {
          return s.replace(s.substr(0,1), function(m) { return m.toUpperCase(); });
        }
        
        function startDictationa(event) {
            
            
        if ('webkitSpeechRecognition' in window) {
                      firstTIme = true;
          var recognitiona = new webkitSpeechRecognition();
        
          recognitiona.continuous = true;
          recognitiona.interimResults = true;
        
          recognitiona.onstart = function() {
              
                 document.getElementById('listening2').style.display = 'inline-block' ;
            recognizing = true;
          };
        
          recognitiona.onerror = function(event) {
            console.log(event.error);
          };
        
          recognitiona.onend = function() {
             
            recognizing = false;
          };
        
          recognitiona.onresult = function(event) {
            var interim_transcript = '';
            for (var i = event.resultIndex; i < event.results.length; ++i) {
                
                 if(firstTIme == true){
                    final_transcript = hpia.value +' ' ;
                    firstTIme = false;
                }
        
              if (event.results[i].isFinal) {
                final_transcript += event.results[i][0].transcript;
              } else {
                interim_transcript += event.results[i][0].transcript;
              }
            }
            
             
            final_transcript = capitalize(final_transcript);
          //  hpia.innerHTML = linebreak(final_transcript);
            
             hpia.value =linebreak(final_transcript);
             
            interim_spana.innerHTML = linebreak(interim_transcript);
            
          };
        }
        
        
          
          if (recognizing) {
            recognitiona.stop();
            return;
          }
          final_transcript = '';
          recognitiona.lang = 'en-US';
          recognitiona.start();
    //      hpia.innerHTML = '';
          interim_spana.innerHTML = '';
          
   
}

</script>


<!-- third voice -->

 
 <script>
 
     var final_transcript = '';
    var recognizing = false;

        
        var two_line = /\n\n/g;
        var one_line = /\n/g;
        function linebreak(s) {
          return s.replace(two_line, '<p></p>').replace(one_line, '<br>');
        }
        
        function capitalize(s) {
          return s.replace(s.substr(0,1), function(m) { return m.toUpperCase(); });
        }
        
        function startDictationa_fam(event) {
            
            
        if ('webkitSpeechRecognition' in window) {
                      firstTIme = true;
                      
          var recognitiona_fam = new webkitSpeechRecognition();
        
          recognitiona_fam.continuous = true;
          recognitiona_fam.interimResults = true;
        
          recognitiona_fam.onstart = function() {
                 document.getElementById('listening3').style.display = 'inline-block' ;
            recognizing = true;
          };
        
          recognitiona_fam.onerror = function(event) {
            console.log(event.error);
          };
        
          recognitiona_fam.onend = function() {
            recognizing = false;
          };
        
          recognitiona_fam.onresult = function(event) {
            var interim_transcript = '';
            for (var i = event.resultIndex; i < event.results.length; ++i) {
                
                 if(firstTIme == true){
                    final_transcript = family_history.value +' ' ;
                    firstTIme = false;
                }
                
                
              if (event.results[i].isFinal) {
                final_transcript += event.results[i][0].transcript;
              } else {
                interim_transcript += event.results[i][0].transcript;
              }
            }
            
             //  alert("b onresult");
            final_transcript = capitalize(final_transcript);
          //  family_history.innerHTML = linebreak(final_transcript);
          
            family_history.value = linebreak(final_transcript);
            interim_spana_fam.innerHTML = linebreak(interim_transcript);
            
          };
        }
        
        
          //  alert("b");
          if (recognizing) {
            recognitiona_fam.stop();
            return;
          }
          final_transcript = '';
          recognitiona_fam.lang = 'en-US';
          recognitiona_fam.start();
         // family_history.innerHTML = '';
          interim_spana_fam.innerHTML = '';
          
   
}

</script>


<!-- fourth voice -->

 <script>
 
     var final_transcript = '';
    var recognizing = false;

        
        var two_line = /\n\n/g;
        var one_line = /\n/g;
        function linebreak(s) {
          return s.replace(two_line, '<p></p>').replace(one_line, '<br>');
        }
        
        function capitalize(s) {
          return s.replace(s.substr(0,1), function(m) { return m.toUpperCase(); });
        }
        
        function startDictationa_per(event) {
            
            
        if ('webkitSpeechRecognition' in window) {
                      firstTIme = true;
          var recognitiona_per = new webkitSpeechRecognition();
        
          recognitiona_per.continuous = true;
          recognitiona_per.interimResults = true;
        
          recognitiona_per.onstart = function() {
                
                document.getElementById('listening4').style.display = 'inline-block' ;
            recognizing = true;
          };
        
          recognitiona_per.onerror = function(event) {
            console.log(event.error);
          };
        
          recognitiona_per.onend = function() {
            recognizing = false;
          };
        
          recognitiona_per.onresult = function(event) {
            var interim_transcript = '';
            for (var i = event.resultIndex; i < event.results.length; ++i) {
                
                if(firstTIme == true){
                    final_transcript = per_history.value +' ' ;
                    firstTIme = false;
                }
                
                
                
              if (event.results[i].isFinal) {
                final_transcript += event.results[i][0].transcript;
              } else {
                interim_transcript += event.results[i][0].transcript;
              }
            }
            
             //  alert("b onresult");
            final_transcript = capitalize(final_transcript);
           // per_history.innerHTML = linebreak(final_transcript);
           
            per_history.value = linebreak(final_transcript);
            
            interim_spana_per.innerHTML = linebreak(interim_transcript);
            
          };
        }
        
        
          //  alert("b");
          if (recognizing) {
            recognitiona_per.stop();
            return;
          }
          final_transcript = '';
          recognitiona_per.lang = 'en-US';
          recognitiona_per.start();
       //   per_history.innerHTML = '';
          interim_spana_per.innerHTML = '';
          
   
}

</script>


        <?php
        $x=$_REQUEST['doc'];
        $pat_id=decode($x);
        $y=$_REQUEST['ch'];
        $checkup_id=decode($y);
                    


            
            
            
        ?>
        <div class="labs-show">
       <!--  <div class="form-group">
                                        
        <label>In house Tests</label><br>
        <div >
        <div class="col-md-1 setpad set_btnwid">
           <button type="button" onclick="add_inhouse()" class="btn btn-success btn-circle"><i class="fa fa-plus"></i></button>
        </div>
         <div class="col-md-1 setpad set_btnwid">
           <button type="button" onclick="remove_inhouse()" class="btn btn-danger btn-circle"><i class="fa fa-minus"></i></button>
        </div>
        <div class="col-md-4 setpad">
        <input class="form-control setwid inhouse " name="inhouse_test[]" id='inhouse' autocomplete="off" placeholder="example:Blood Test"/>
        </div>
         <div class="col-md-4 setpad">
        <input class="form-control setwid " name="inhouse_text[]" id='inhouse_text' autocomplete="off" placeholder="example:Value of lab test"/>
        </div>
        <div class="col-md-2 setpad">
        <input class="form-control setwid " name="inhouse_price[]" id='inhouse_price' autocomplete="off" placeholder="Test Price"/>
        </div>
        
        </div>
        <div class="new_lab2"></div>                           
        </div> -->

        <!-- for previous indoor test -->

      
        <?php 
        // $db->where('p_id',$pat_id);
        // $db->where('checkup_id',$checkup_id);
        // $get_inhouse=$db->get('current_patient_test');
        
        // foreach ($get_inhouse as $get_in) { ?>

      <!--   <div class="form-group" id="remove_in<?php  //echo $get_in['test_id'] ?>" >
        <div class="col-md-2 setpad set_btnwid" style="margin-left:36px;">
           <button type="button" onclick="remove_pre_inhouse('<?php // echo $get_in['test_id'] ?>')" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></button>
        </div>
        <div class="col-md-4 setpad">
        <input type="text" name="pre_inhouse_id[]" value="<?php// echo $get_in['test_id'] ?>" style="display:none;">
        <input class="form-control setwid inhouse " name="pre_inhouse_test[]" id='inhouse' autocomplete="off" value="<?php// echo $get_in['test_name'] ?>" />
        </div>
         <div class="col-md-4 setpad">
        <input class="form-control setwid " name="pre_inhouse_text[]" id='inhouse_text' autocomplete="off" value="<?php// echo $get_in['result_value'] ?>" />
        </div>
        <div class="col-md-2 setpad">
        <input class="form-control setwid " name="pre_inhouse_price[]" id='inhouse_price' autocomplete="off" value="<?php// echo $get_in['test_price'] ?>" />
        </div>
        
         
       
        </div> -->
 <?php //  }

        ?>
       
        



        <div class="form-group">
                                        
        <label>Test Detail</label><br>
        <div >
        <div class="col-md-1 setpad set_btnwid">
           <button type="button" onclick="add_outdoor()" class="btn btn-success btn-circle"><i class="fa fa-plus"></i></button>
        </div>
         <div class="col-md-1 setpad set_btnwid">
           <button type="button" onclick="remove_outdoor()" class="btn btn-danger btn-circle"><i class="fa fa-minus"></i></button>
        </div>
        <div class="col-md-5 setpad">
        <input class="form-control outdoor setwid" name="outdoor_test[]"  autocomplete="off" placeholder="example:Blood Test"/>
        </div>
         <div class="col-md-5 setpad">
        <input class="form-control setwid  " name="outdoor_text[]" autocomplete="off" placeholder="Test Detail"/>
        </div>
        
        </div>
        <div class="new_lab1"></div>
                                        
                                        
        </div>
    <?php 
        $db->where('p_id',$pat_id);
        $db->where('checkup_id',$checkup_id);
        $get_outdoor=$db->get('current_patient_outdoor_test');
        foreach ($get_outdoor as $get_out) { ?>

            


        <div class="form-group" id="remove_out<?php echo $get_out['test_id'] ?>">
        <div class="col-md-2 setpad set_btnwid" style="margin-left:36px;">
           <button type="button" onclick="remove_pre_outdoor('<?php echo $get_out['test_id'] ?>')" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></button>
        </div>
        <div class="col-md-5 setpad">
        <input type="text" name="pre_outdoor_id[]" value="<?php echo $get_out['test_id'] ?>" style="display:none;">
        <input class="form-control outdoor setwid" name="pre_outdoor_test[]"  autocomplete="off" value="<?php echo $get_out['test_name'] ?>" />
        </div>
         <div class="col-md-5 setpad">
        <input class="form-control setwid " name="pre_outdoor_text[]" id='outdoor_text' autocomplete="off" value="<?php echo $get_out['result_value'] ?>" />
        </div>
        
            
        </div>
        <?php   }

    ?>
     </div>
        <div class="form-group">
            <a class="btn btn-primary btn-labs">Lab Tests</a>
        </div>
    <div class="form-group text-center">
        <button  type="submit" name="save_recored" class="btn btn-success">Save Changes</button>
        </div>
                
            
         

           



             

                                              
        </div>
        <!-- </form> -->

        </div>
                            <!-- /.panel-body -->
        </div>
                        <!-- /.panel -->
        </div>

        </div>
        <div>
        
        </form>
        </div>
             
       

            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
       

    </div>
    <!-- /#wrapper -->
    <script>
         $(function() {
        $( ".outdoor" ).autocomplete({
            source: 'autocomplete_outdoor.php'
        });
         });
         $(function() {
        // $( ".test-place" ).autocomplete({
        //     source: 'autocomplete_testplace.php'
        // });
         });
        function remove_pre_inhouse(val){
        var r = confirm(" Are you sure to delete this Test?");
        if (r == true) { 

        if ( val != '' ) {
        var action='done';
        $.ajax({
        type:'POST',
        url:'ajax_indoor_del.php', 
        data:{ ajax_action :action, del_val:val},
        success:function(){

        $('#remove_in'+val+'').remove();

        }

        });

        }
        


        } else {


        }

        
        



        }
        function remove_pre_outdoor(val){

        var r = confirm(" Are you sure to delete this Test?");
        if (r == true) { 

        if ( val != '' ) {
        var out_action='out_done';
        $.ajax({
        type:'POST',
        url:'ajax_indoor_del.php', 
        data:{ ajax_outdoor :out_action, del_val:val},
        success:function(){
         $('#remove_out'+val+'').remove();

       

        }

        });

        }
        
        } else {

        // do nothing


        }
        
       


        }


        function remove_outdoor(){
          $('.lab1').last().remove();
         
     }
    function add_outdoor()
     {
    
    $(".new_lab1").append("<div class='lab1'><div class='col-md-1 setpad set_btnwid '></div><div class='col-md-1 setpad set_btnwid make-mar'></div><div class='col-md-5 setpad'><input class='form-control setwid outdoor add_mar' name='outdoor_test[]' type='text' autocomplete='off' placeholder='example:Blood Test'></div><div class='col-md-5 setpad'><input class='form-control setwid add_mar' name='outdoor_text[]' id='outdoor_text' type='text' autocomplete='off' placeholder='Test Detail'></div></div> ");
    autocompletelab();
   
         
     }
     function add_inhouse()
     {
    
    $(".new_lab2").append("<div class='lab2'><div class='col-md-1 setpad set_btnwid '></div><div class='col-md-1 setpad set_btnwid make-mar'></div><div class='col-md-4 setpad'><input class='form-control setwid add_mar inhouse' name='inhouse_test[]' id='inhouse' type='text' autocomplete='off' placeholder='example:Blood Test'></div><div class='col-md-4 setpad'><input class='form-control setwid add_mar' name='inhouse_text[]' id='inhouse_text' type='text' autocomplete='off' placeholder='example:Value of lab test'></div><div class='col-md-2 setpad'><input class='form-control setwid add_mar' name='inhouse_price[]' id='inhouse_price' autocomplete='off' placeholder='Test Price'/></div></div> ");
    autocompletelab();
   
         
     }
    function autocompletelab() {

    $(function() {
    $( ".inhouse" ).autocomplete({
    source: 'autocomplete_indoor.php'
    });
    });

    $(function() {
    $( ".outdoor" ).autocomplete({
    source: 'autocomplete_outdoor.php'
    });
    });
     $(function() {
    // $( ".test-place" ).autocomplete({
    // source: 'autocomplete_testplace.php'
    // });
    });
 
    
    
    }
    function remove_inhouse(){
          $('.lab2').last().remove();
         
     }
    </script>
   
    <?php
 include 'jslib.php';
 ?>
 <script>
 var dr_fee;
 $("#dr_fee").keyup(function(){
     var dr_per_fee=this.value;
     $('#dr_fee').val(dr_per_fee);
     
       dr_fee=$('#dr_fee').val();
      
      
     
 });
  dr_fee=$('#dr_fee').val();
        
     $("#charity").keyup(function(){
     
     var ch_val=this.value;
     var new_val=dr_fee-ch_val;
    
     
     $('#dr_fee').val(new_val);
    
     });
 </script>
  <script src="bmi.js"></script>
  <script src="back.js"></script>
  
<script src="../assets/js/jquery.inputmask.bundle.js"></script>
   <script>
    $(":input").inputmask();

   </script>
   <script>
    function load_previous_checkup(patient_id,check_id){
    
       
    // AJAX request
    $.ajax({
    url: 'ajax_checkup.php',
    datatype: 'html',
    type: 'post',
    data: {pat_id: patient_id,checkup_id:check_id},
    success: function(html){ 
        
        $('#checkup_detail ').remove();
        
        
        
        // alert(html);
          $('#modal-body').append(html);
      
    //   $('.modal-body').html(response);

    //   // Display Modal
      $('#checkupModal').modal('show'); 
    }
    
    });
        
    }
        
    </script>
   


</body>

</html>