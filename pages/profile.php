<?php 
include '../include/config_new.php';
include '../include/MysqliDb.php';
include '../include/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/jameelkhushkhati-ttf" type="text/css"/>-->
    <link rel="stylesheet" media="print" href="//fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css">
     <link rel="stylesheet" media="screen" href="//fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css">

    <title>Doctor | Checkup info</title>

    <?php
 include 'lib.php';
 include '../include/auth.php';
 ?>
    <style>
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
    float: right;
    margin: 4px;
    color: red;
    height: 26px;
    
}
.fnt-family{
    font-family: 'Noto Nastaliq Urdu Draft', serif;
}
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
        td {
            padding: 15px;
        }
        
        .td-left {
            word-break: break-all;
        }
        
        .textarea {
            width: 480px;
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
        
        .profile-usertitle {
            text-align: center;
            margin-top: 5px;
        }
        
        .profile-usertitle-name {
            font-size: 20px;
            margin-bottom: 2px;
            font-weight: bold;
            color: #3a405b;
        }
        
        .list-group {
            padding-left: 0;
            margin-bottom: 20px;
        }
        
        .list-group-unbordered>.list-group-item {
            border-left: 0px none;
            border-right: 0px none;
            border-radius: 0px 0px 0px 0px;
            padding-left: 0px;
            padding-right: 0px;
        }
        
        .long-text {
            padding-top: 2%;
        }
.set-fnt-main{
            font-weight:600;
                width: 19%;
        }
.set-td{
                padding: 3px!important;
        }
        /**/
    </style>
    <script>
        $(document).ready(function() {
                var readURL = function(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('.avatar').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
                $(".file-upload").on('change', function() {
                    readURL(this);
                });
            }

        );
    </script>

</head>

<body>
    <div class="container-fluid">
        <div id="wrapper">

            <!-- Navigation -->
         <?php 
         include 'sidebardoc.php';
         ?>
            <div id="page-wrapper">
                
                <div class="row">
                    
                    <div class="col-lg-12">
                        <h1 class="page-header">Check Up Info</h1>
                    </div>
                    <!-- /.col-lg-12 -->

                </div>
                <!-- /.row -->
                <div class="row">
                     <button onclick="goBack()" class="btn"  style="float: right;margin-right: 16px;"> <i class="fa fa-arrow-circle-left" style="font-size:30px;color:red;"></i></button>
                 
                    <!-- /.col-lg-12 -->
                    <div class="col-md-12 ">
                        <?php 
                        // $a= new crud();
                        // $x=$_REQUEST['pi'];
                        // $pat_id=decode($x);
                        // $checkup_id=$_REQUEST['ci'];
                        //  $recored=$a->select('total_patient tp INNER JOIN total_checkup tc ON(tp.p_id=tc.p_id)','tp.*,tc.*',"tc.checkup_id=$checkup_id",'');
                        //   while ($data =$recored->fetch_array()) 
                        //   { 
                        
                        $a= new crud();
                        $x=$_REQUEST['pi'];
                        $pat_id=decode($x);
                        $checkup_id=$_REQUEST['ci'];

                        $db->where("p_id",$pat_id);
                        // $db->where('checkup_id',$checkup_id);
                        $patient=$db->getOne('total_patient ');


                        $db->where("p_id",$pat_id);
                        $db->where('checkup_id',$checkup_id);
                        $checkup=$db->getOne('total_checkup ');
                          
                          ?>


                      
                        <div class="card cardappoint card-topline-yellow ">
                            <!--<div class="card-head card-headappoint ">-->
                            <!--    <h2 class="text-center">Doctor Info</h2>-->
                            <!--</div>-->
                            
                             <div class="profile-usertitle">
                                    <div class="profile-usertitle-name"><?php echo $patient['p_name']; ?> </div>

                                </div>
                            <div class="card-body card-bodystyle">
                                <table class="table table-striped table-bordered table-hover">
                                       
                                        <tbody>
                                            <tr>
                                                <td class="set-fnt-main set-td">Patient Name</td>
                                                <td class="set-td"><?php echo $patient['p_name']; ?></td>
                                                <td class="set-fnt-main set-td">S/O, D/O, W/O</td>
                                                <td class="set-td">Sr name</td>
                                            </tr>
                                           
                                            <tr>
                                                <!--<td class="set-fnt-main set-td">Contact No.#</td>-->
                                                <!--<td class="set-td"><?php echo $patient['contact']; ?></td>-->
                                                <td class="set-fnt-main set-td">Address</td>
                                                <td class="set-td"><?php echo $patient['address']; ?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td class="set-fnt-main set-td">Age</td>
                                                <td class="set-td"><?php echo $patient['age']; ?></td>
                                                <td class="set-fnt-main set-td">Spo2 at rest on RA</td>
                                                <td class="set-td"><?php echo $patient['spo_rest']; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="set-fnt-main set-td">Spo2 Exertion</td>
                                                <td class="set-td"><?php echo $patient['spo_exertion']; ?></td>
                                                
                                            </tr>
                                            <tr>
                                                <td class="set-fnt-main set-td">Spo2 6MWT</td>
                                                <td class="set-td"><?php echo $patient['spo_6mwt']; ?></td>
                                                <td class="set-fnt-main set-td">Spo2 6MWD</td>
                                                <td class="set-td"><?php echo $patient['spo_6mwd']; ?></td>
                                            </tr>
                                            <tr>
                                                
                                                <td class="set-fnt-main set-td">Pulse</td>
                                                <td class="set-td"><?php echo $patient['pulse_rate']; ?></td>
                                                 <td class="set-fnt-main set-td">Weight</td>
                                                <td class="set-td"><?php echo $patient['p_weight']; ?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td class="set-fnt-main set-td">Height</td>
                                                <td class="set-td"><?php echo $patient['p_height']; ?></td>
                                                <td class="set-fnt-main set-td">BMI</td>
                                                <td class="set-td"><?php echo $patient['bmi']; ?></td>
                                            </tr>
                                           
                                            <tr>
                                                <td class="set-fnt-main set-td">Weight Situation</td>
                                                <td class="set-td"><?php echo $patient['weight_sit']; ?></td>
                                                <td class="set-fnt-main set-td">Co-Morbidities</td>
                                                <td class="set-td"><?php echo $patient['co_morbidities']; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="set-fnt-main set-td">Occupation</td>
                                                <td class="set-td"><?php echo $patient['occupation']; ?></td>
                                                <td class="set-fnt-main set-td">H|O ATT</td>
                                                <td class="set-td"><?php echo $patient['tb_att']; ?></td>
                                            </tr>
                                            <tr>
                                                  <td class="set-fnt-main set-td">BP(Blood Pressure)</td>
                                                <td class="set-td"><?php echo $patient['bp']; ?> mm/hg</td>
                                                <td class="set-fnt-main set-td">Fee Status</td>
                                                <td class="set-td"><?php echo $checkup['rec_fee']; ?></td>
                                              
                                            </tr>
                                            
                                            <tr>
                                                <td class="set-fnt-main set-td">HPI</td>
                                                <td class="set-td"><?php echo $checkup['hpi']; ?> </td>
                                                <td class="set-fnt-main set-td">Past History</td>
                                                <td class="set-td"><?php echo $patient['past_history']; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="set-fnt-main set-td">Family History</td>
                                                <td class="set-td"><?php echo $patient['f_history']; ?></td>
                                                <td class="set-fnt-main set-td">Personal History</td>
                                                <td class="set-td"><?php echo $patient['per_history']; ?></td>
                                            </tr>
                                            <tr>
                                                
                                                
                                                <td class="set-fnt-main set-td">Review of Pre-Lab</td>
                                                <td class="set-td"><?php echo $patient['review_pre_lab']; ?></td>
                                        <td class="set-fnt-main set-td">Review of Pre-Medication</td>
                                                <td class="set-td"><?php echo $patient['review_pre_med']; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="set-fnt-main set-td">Dignosis</td>
                                                <td class="set-td"><?php echo $checkup['impression']; ?></td>
                                                <td class="set-fnt-main set-td">Procedure</td>
                                                <td class="set-td"><?php echo $checkup['pt_proc']; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="set-fnt-main set-td">Systemic Examination</td>
                                                <td class="set-td"><?php echo $checkup['examination']; ?></td>
                                                <td class="set-fnt-main set-td"> Next Follow Up</td>
                                                <!--<td class="set-td fnt-family" dir="rtl">1 مہینے کے بعد تشریف لائیں۔ </td>-->
                                                 
                                               <td dir='rtl' class="set-td fnt-family "><?php echo $checkup['follow_num']; ?> <?php
                                            	 if ($checkup['follow_time']=='type1') {
                                            	 	echo "دن ";
                                            	 }
                                            	 elseif ($checkup['follow_time']=='type2') {
                                            	 	echo "ہفتے";
                                            	 }
                                            	  elseif ($checkup['follow_time']=='type3') {
                                            	 	echo "مہینے";
                                            	 }
                                            	  elseif ($checkup['follow_time']=='type4') {
                                            	 	echo "سال";
                                            	 }
                                            	  
                                            
                                            	   ?>کے بعد دوبارہ تشریف لائیں۔</td>
                                                
                                            </tr>
                                    </tbody>
                                    </table>
                               
                                
                                    <table class="table table-striped table-bordered table-hover">
                                       
                                        <tbody>
                                            <tr>
                                                <td class="set-fnt-main set-td">Test Detail</td>
                                                <td class="set-td">
                                                 <?php
                                                 $i=1;
                                                $db->where('p_id',$pat_id);
                                                $db->where('checkup_id',$checkup_id);
                                                $outdoor_test=$db->get('total_patient_outdoor_test');
                                                
                                                foreach($outdoor_test as $out_test){
                                                    
                                                    echo $string_out=$i."- ".$out_test['test_name']." ".$out_test['result_value']."<br>";
                                                    $i++;
                                                }
                                                
                                                ?>
                                                                                                
                                                </td>
                                                </tr>
                                    </tbody>
                                    </table>
                                    <div class="table-responsive ">
                                    <table class="table">
                                        <thead>
                                            <tr></tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                        <td class="set-td fnt-family" dir="rtl">
                                        <?php
                      $for_id=$checkup['for_bear_id'];
                      $fr_id =explode(",",$for_id);
                      foreach( $fr_id as $fi ){
                      $db->where('id_for',$fi);
                      $parh=$db->getOne('forbearance_tbl');
                      echo $parh['bear_desc'];
                      }
                        ?>
                                        </td>
                                        <td class="set-td fnt-family hdyt-fnt" dir="rtl">ہدایت</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                            
                                    <div class="table-responsive ">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="fnt-new1 fnt-family text-center" style="padding: 4px;">دوا کا نام</th>
                                                
                                                <th class="fnt-new1 fnt-family text-center" style="padding: 4px;">مدت</th><th></th>
                                                <th class="fnt-new1 fnt-family text-center" dir="rtl" style="padding: 4px;">طریقہ استعمال </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php 
                                    $xs=1;
                                    $db->where ("p_id",$pat_id);
                                    $db->where('checkup_id',$checkup_id);
                                    $medic = $db->get('total_patient_medicine');
                                    
                                    foreach ($medic as $med) {
                                        $stp=$med['med_stamp'];
                                       
                                       

                                      
                                    ?>
                                            <tr>
                                    <td class="set-td">
                                        <div class="fnt-new">
                                        <?php echo "<span class='set-med-name'>".$xs.' - '.$med['med_name']."</span>"; 
                                        $xs++;
                                        ?>  <?php
                                        
                                        if ($stp != '') { 
                                        $stampp =explode(",",$stp);
                                         foreach ($stampp  as $st) 
                                        {  
                                        if($st != ''){
                                        $db->where('st_id',$st);
                                        $stmp_data=$db->getOne('stamps');
                                        echo "<br>"."<span style='margin-left: 10px;margin-right: 10px;'><img src='../img/goim002.png'  style='width:5px;height:5px;'></span>".$stmp_data['st_name'];    
                                        }
                                        
                                        }
                                         
                                        } 
                                        ?>

                                        </div>
                                            
                                    </td>
                                                <td class="set-td1" style="padding-right: 0px;">
                                                   
                                <p class="set_day fnt-new1 fnt-family" ><?php echo $med['time_span'];?></p>
                                                    
                                                    <?php //echo $med['time_num'].''.$med['time_span'];?>
                                                        
                                                </td>
                                                <td class="set-td1" style="padding-left: 0px;">
                            <p class="fnt-new" style="display: inline-block;padding-right: 0px;margin: 0px;"><?php echo $med['time_num'];?></p></td>
                                                
                                                <td class="set-td">
                                                    <div class="set-med-dec-new">
               <div class="fnt-new1 fnt-family" dir="rtl" style="margin: 3px;   margin-bottom: 6px;margin-top: 6px;"><?php echo "<p class='set-hy-fnt set-ur-med'>". $med['med_disc']."</p>"; ?>  <?php
               if ($stp != '') {
                   $stampp =explode(",",$stp);
                                         foreach ($stampp  as $st) 
                                        {  
                                            if($st != ''){
                                             $db->where('st_id',$st);
                                         $stmp_data=$db->getOne('stamps');
                                          echo "<br>"."<span style='margin-left: 10px;'><img src='../img/goim002.png'  style='width:5px;height:5px;'></span>"."<span class='set-hy-fnt'>".$stmp_data['st_use']."</span>";   
                                            }

                                        }
               
                }  ?> </div>
                                                </div>
                                                    
                                                    <?php
                                        if ($med['med_special_desc']=="") {
                                            continue;
                                        }

                                        elseif ($med['med_special_desc']!="") {
                                           
                                        ?>
                                                </td>
                                            </tr>
                                            <?php } 
                                            
                                            } ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    
                                    

                                </div>





                            </div>

                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                          <?php
                     // }
// first while end
                        ?>
                    </div>
                    <!-- /.col-lg-12 -->

                </div>
                <!--//col-md-12//-->
            </div>

            <!-- /.row -->



        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    </div>
      <?php
      include 'js_min_lib.php';
 include 'jslib.php';

 ?>
 <script src="back.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
  
</body>

</html>