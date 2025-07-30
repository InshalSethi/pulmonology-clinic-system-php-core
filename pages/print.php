<?php
include '../include/config_new.php';
include '../include/MysqliDb.php';
include '../include/config.php';
$a= new crud();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
     
     <link rel="stylesheet" media="print" href="//fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css">
     <link rel="stylesheet" media="screen" href="//fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css">
    

    <meta name="author" content="">

    <title>Doctor | Prescription</title>
  <link
<?php
  include 'lib.php'; 
  include '../include/auth.php'; 
  include 'printfile.php'; 
  
  ?>
</head>

<body>
    <div class="container-fluid" style="overflow-x:hidden;">
        <div id="wrapper">

            <!-- Navigation -->
            <?php include 'sidebardoc.php'; ?>
             <?php 
                    $x=$_REQUEST['pd'];
                    $pat_id=decode($x);

                    $db->where ("p_id",$pat_id);
                    $checkup = $db->getOne('current_checkup');

                    $checkup_id=$checkup ['checkup_id']; 
                    $y=encode($checkup_id);

                    $db->where ("p_id",$pat_id);
                    $patient = $db->getOne('current_patient');

                    ?>
        

            <div id="page-wrapper" style="overflow-y:hidden;">
                <div class="container" style="width: 100%;padding-left:0px;padding-right:0px;">
                    <div class="text-center set-logo-abv">
                        <!--<img class="set-logo" src="../img/drimran_header.jpg">-->
                        <div class="set-logo"></div>
                    </div>
                </div>
                <div class="pull-right1 noprint" style="margin-right: 16px;">
                    <a class="btn btn-primary" href="precept1.php?pd=<?php echo $x; ?>&cd=<?php echo $y; ?>">Edit Medicine</a>
                   <button onclick="myFunction()" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
                </div>
                
                <div class="containner-fluid">
                    <div class="row">
                        <div class="table-responsive tbl-sides1">
                                <table class="table no-mr-btm">
                                        <thead>
                                            <tr></tr>
                                        </thead>
                                        <tbody>
                <tr>
                <td class="st-width no-paddig set-width-date">
                    <h4 class="set-top-fnts" >Date:</h4>
                    <h4 class="fnt-info-set"><?php echo $checkup['checkup_date']; ?></h4>
                </td>
                <td class="st-width no-paddig">
                    <h4 class="set-top-fnts">MR:</h4>
                    <h4 class="fnt-info-set"><?php echo $pat_id; ?></h4> 
                </td>
                <td class="st-width no-paddig">
                    <h4 class="set-top-fnts">Name:</h4>
                    <h4 class="fnt-info-set"><?php echo $patient['p_name']; ?></h4> 
                </td>
                <?php if($patient['age']!='-0'){ ?>
                <td class="st-width">
                    <h4 class="set-top-fnts">Age:</h4>
                    <h4 class="fnt-info-set"><?php
                     $age_arr=explode("-",$patient['age']);
                    echo $age_arr[0]." Years  ";
                    if( $age_arr[1] != '0'  ){
                        if($age_arr[1] == '1'){
                           echo $age_arr[1]." Month"; 
                        }
                        else{
                          echo $age_arr[1]." Months";    
                        }
                        
                        
                    }
                    ?></h4>
                    </td>
                    <?php }if($patient['p_weight']!=''){ ?>
                    <td class="st-width">
                    <h4 class="set-top-fnts">Weight:</h4>
                    <h4 class="fnt-info-set"><?php echo $patient['p_weight']; ?> KG</h4>
                    </td>
                    <?php } ?>
                </tr>

                                          
                                        </tbody>
                                </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive tbl-sides1">
                        <table class="table no-mr-btm">
                        <thead>
                        <tr></tr>
                        </thead>
                        <tbody>
                        <tr>
                        <?php if($patient['bp']!=''){ ?>
                        <td class="st-width no-paddig">
                            <h4 class="set-top-fnts">BP:</h4>
                            <h4 class="fnt-info-set"><?php echo $patient['bp']; ?></h4>
                        </td>
                        <?php }if($patient['tb_att']!=''){ ?>
                        <td class="st-width no-paddig">
                            <h4 class="set-top-fnts">H|O TB / ATT:</h4>
                            <h4 class="fnt-info-set"><?php echo $patient['tb_att']; ?></h4>
                        </td>
                        <?php }if($patient['smoke_his']!=''){ ?>
                        <td class="st-width no-paddig">
                            <h4 class="set-top-fnts">H|O Smoking:</h4>
                            <h4 class="fnt-info-set"><?php echo $patient['smoke_his']; ?> Pack/Year</h4>
                        </td>
                        <?php } ?>
                        <!--<td class="st-width no-paddig">
                            <h4 class="set-top-fnts"></h4>
                            <h4 dir='rtl' class="fnt-info-set fnt-family no-paddig1 no-pad">
                            <?php 
                                        // echo $checkup['follow_num']; 
                                        //             	 if ($checkup['follow_time']=='type1') {
                                        //             	 	echo "دن";
                                        //             	 }
                                        //             	 elseif ($checkup['follow_time']=='type2') {
                                        //             	 	echo "ہفتے";
                                        //             	 }
                                        //             	  elseif ($checkup['follow_time']=='type3') {
                                        //             	 	echo "مہینے";
                                        //             	 }
                                        //             	  elseif ($checkup['follow_time']=='type4') {
                                        //             	 	echo "سال";
                                        //             	 }
                                                    	  
                                                    
                                                      	  ?> بعد دوبارہ تشریف لائیں۔ </h4>
                        </td>-->
                        </tr>
                                                  
                                                </tbody>
                                        </table>
                                </div>
                    </div>
                    <div class="row">
                                <div class="table-responsive tbl-sides1">
                                        <table class="table no-mr-btm">
                                                <thead>
                                                    <tr></tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                            <?php if($patient['co_morbidities']!=''){ ?>
                            <td class="no-paddig">
                                <h4 class="set-top-fnts" >Co-Morbidities:</h4>
                                <h4 class="fnt-info-set"><?php echo $patient['co_morbidities']; ?></h4>
                            </td>
                            <?php }if($patient['address']!=''){ ?>
                            <td class="no-paddig">
                                <h4 class="set-top-fnts">Address:</h4>
                                <h4 class="fnt-info-set"><?php echo $patient['address']; ?></h4>
                            </td>
                            <?php } ?>
                                                    </tr>
                                                </tbody>
                                        </table>
                                </div>
                    </div>
                    <?php if($checkup['impression']!=''){ ?>
                    <div class="row">
                                <div class="table-responsive tbl-sides1">
                                        <table class="table no-mr-btm">
                                                <thead>
                                                    <tr></tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        
                                                        <td class="no-paddig">
                                                            <h4 class="set-top-fnts" >Diagnosis:</h4>
                            <h4 class="fnt-info-set"><?php echo $checkup['impression']; ?></h4>
                                                        </td>
                                                        <td class="no-paddig">
                                                            <h4 class="set-top-fnts" >VCO:</h4>
                                                            <h4 class="fnt-info-set"></h4>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                        </table>
                                </div>
                    </div>
                    <?php  } ?>
                </div>
            <div class="container-fluid">
                <!-- /.row -->
                <div class="row set-hit">
                    <div class="col-md-3 set-col4" style="padding-left: 0px;padding-right: 0px;">
                        
                        <!--HPI-->
                        <?php if($checkup['hpi']!=''){ ?>
                        <div class="set-col4-box4">
                            <h5 class="text-center lab-fnt brd-btm">HOPI</h5>
                            <div class="table-responsive tbl-sides" style="overflow-y: hidden;">
                                <table class="table no-mr-btm">
                                        <thead>
                                            <tr></tr>
                                        </thead>
                                        <tbody>
                                            
                                        <tr>
                                        <td class="no-paddig no-pad brd-non">
                                        <h4 class="fnt-info-set"><?php echo $checkup['hpi']; ?></h4>
                                        </td>
                                        </tr>    
                                        </tbody>
                                </table>
                        </div>
                        </div>
                        <?php  } ?>
                        <!--Systematic Examination-->
                        <?php if($checkup['examination']!=''){ ?>
                        <div class="set-col4-box3">
                            <h5 class="text-center lab-fnt brd-btm">Systematic Examination</h5>
                            <div class="table-responsive tbl-sides" style="overflow-y: hidden;">
                                <table class="table no-mr-btm">
                                        <thead>
                                            <tr></tr>
                                        </thead>
                                        <tbody>
                                            
                                        <tr>
                                        <td class="no-paddig no-pad brd-non">
                                        <h4 class="fnt-info-set"><?php echo $checkup['examination']; ?></h4>
                                        </td>
                                        </tr>    
                                        </tbody>
                                </table>
                        </div>
                        </div>
                        <?php } ?>
                        <!--Procedure-->
                        <?php if($checkup['pt_proc']!=''){ ?>
                        <div class="set-col4-box2">
                            <h5 class="text-center lab-fnt brd-btm">Procedure</h5>
                            <div class="table-responsive tbl-sides" style="overflow-y: hidden;">
                                <table class="table no-mr-btm">
                                        <thead>
                                            <tr></tr>
                                        </thead>
                                        <tbody>
                                            
                                        <tr>
                                        <td class="no-paddig no-pad brd-non">
                                        <h4 class="fnt-info-set"><?php echo $checkup['pt_proc']; ?></h4>
                                        </td>
                                        </tr>    
                                        </tbody>
                                </table>
                        </div>
                        </div>
                        <?php } ?>
                        
                        <!--SPO2-->
                        <?php if($patient['spo_rest']!='' || $patient['spo_exertion']!='' || $patient['spo_6mwt']!='' || $patient['spo_6mwd']!=''){ ?>
                        <div class="set-col4-box">
                            <h5 class="text-center lab-fnt brd-btm">SPO2</h5>
                            <div class="table-responsive tbl-sides" style="overflow-y: hidden;">
                                <table class="table no-mr-btm">
                                        <thead>
                                            <tr></tr>
                                        </thead>
                                        <tbody>
                                            <?php if($patient['spo_rest']!=''){ ?>
                                            <tr>
                                            <td class="no-paddig no-pad brd-non">
                                            <h4 class="set-top-fnts">At Rest On RA:</h4>
                                            <h4 class="fnt-info-set fl-mr"><?php echo $patient['spo_rest']; ?></h4>
                                            </td>
                                            </tr>
                                            <?php }if($patient['spo_exertion']!=''){ ?>
                                            <tr>
                                            <td class="no-paddig no-pad brd-non">
                                            <h4 class="set-top-fnts">Exertion:</h4>
                                            <h4 class="fnt-info-set fl-mr"><?php echo $patient['spo_exertion']; ?></h4>
                                            </td>
                                            </tr>
                                            <?php }if($patient['spo_6mwt']!=''){ ?>
                                            <tr>
                                            <td class="no-paddig no-pad brd-non">
                                            <h4 class="set-top-fnts">6 MWT:</h4>
                                            <h4 class="fnt-info-set fl-mr"><?php echo $patient['spo_6mwt']; ?></h4>
                                            </td>
                                            </tr>
                                            <?php }if($patient['spo_6mwd']!=''){ ?>
                                            <tr>
                                            <td class="no-paddig no-pad brd-non">
                                            <h4 class="set-top-fnts">6 MWD:</h4>
                                            <h4 class="fnt-info-set fl-mr"><?php echo $patient['spo_6mwd']; ?></h4>
                                            </td>
                                            </tr>
                                            <?php  } ?>
                                        </tbody>
                                </table>
                        </div>
                        </div>
                        <?php  }  ?>
                        <!--Lab test-->
                        <?php
                        $db->where('p_id',$pat_id);
                        $db->where('checkup_id',$checkup_id);
                        $inhouse=$db->get('current_patient_test');
                        if($db->count >= 0){ ?>
                        
                        
                        <div class="set-col4-box1">
                            <h5 class="text-center lab-fnt brd-btm">Lab Tests</h5>
                            <div class="set-fnt" >
                                
                                <?php
                                $i=1; 
                                
                                foreach ($inhouse as $in) {
                                ?>
                                <p class="lab-test-font">
                                <?php 
                                echo $i."-";
                                echo $in['test_name']."  ";
                                echo $in['result_value'].","; 
                                ?>
                                </p>
                            <?php 
                                $i++;    }
                                $db->where('p_id',$pat_id);
                                $db->where('checkup_id',$checkup_id);
                                $outdoor=$db->get('current_patient_outdoor_test');
                                foreach ($outdoor as $out) {
                                ?>
                                <p class="lab-test-font"><?php echo $i."-";
                                echo $out['test_name']."  ";
                                echo $out['result_value'].","; 
                                $i++;   }
                                ?>
                               
                              
                            </div>
                        </div>
                        
                        <?php    
                        }
                        
                        ?>
                        
                        <!--Plan-->
                        <?php  if($checkup['pat_plan']!=''){ ?>
                        <div class="set-col4-box5">
                            <h5 class="text-center lab-fnt brd-btm">Plan</h5>
                            <div class="table-responsive tbl-sides" style="overflow-y: hidden;">
                                <table class="table no-mr-btm">
                                        <thead>
                                            <tr></tr>
                                        </thead>
                                        <tbody>
                                            
                                        <tr>
                                        <td class="no-paddig no-pad brd-non">
                                        <h4 class="fnt-info-set"><?php echo $checkup['pat_plan']; ?></h4>
                                        </td>
                                        </tr>    
                                        </tbody>
                                </table>
                        </div>
                        </div>
                        <?php } ?>
                        
                    </div>
                    <div class="col-md-9  set-col8" style="padding-left: 5px;padding-right: 0px;">
                        <div class="set-col8-box">

                            <div class="set-fnt" >
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
                                    $medic = $db->get('current_patient_medicine');
                                    
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
                                        echo "<br>"."<span style='margin-left: 10px;margin-right: 10px;'><img src='../img/goim002.png'  style='width:5px;height:5px;'></span>"."<span class='fnt-med-clr'>".$stmp_data['st_name']."</span>";    
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
               <div class="fnt-new1 fnt-family" dir="rtl" style="margin: 3px;   margin-bottom: 6px;margin-top: 6px;"><?php echo "<p class='set-hy-fnt set-ur-med'>". $med['med_disc']."</p>"; 
               if($med['med_special_desc']!=''){
                   echo "<p class='set-special'>".$med['med_special_desc']."</p>" ;
               }
               ?>  <?php
               if ($stp != '') {
                   $stampp =explode(",",$stp);
                                         foreach ($stampp  as $st) 
                                        {  
                                            if($st != ''){
                                             $db->where('st_id',$st);
                                         $stmp_data=$db->getOne('stamps');
                                          echo "<br>"."<span style='margin-left: 10px;'><img src='../img/goim002.png'  style='width:5px;height:5px;'></span>"."<span class='set-hy-fnt fnt-med-clr'>".$stmp_data['st_use']."</span>";   
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




                            </div>

                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->


                </div>
              
                     
<style>
    .set-hyd-col{
        padding-left: 2px;
        padding-right: 2px;
        float: right;

    }
</style>
            <?php //if($parh['for_bear_id']!=''){ ?>
                <div class="row set-hit1">
                    <div class="col-md-12 precations-box">
                            <div class="col-md-12" style="padding-right: 0px;">
                                <p class="hdyt-fnt" dir="rtl">:ہدایات</p>
                            </div>
                        <div class="col-md-12 set-hyd-col">
                       <?php
                      $for_id=$checkup['for_bear_id'];
                      $fr_id =explode(",",$for_id);
                      foreach( $fr_id as $fi ){
                      $db->where('id_for',$fi);
                      $parh=$db->getOne('forbearance_tbl');
                      if($parh && isset($parh['bear_desc'])){
                          echo $parh['bear_desc'];
                      }
                      }
                        ?>
                        </div>
                    </div>
                </div>
                <?php if($checkup['follow_num']!=''){ ?>
                <div class="row">
                        <div class="table-responsive tbl-sides">
                                <table class="table no-mr-btm">
                                        <thead>
                                            <tr></tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="set-blw no-br-tp"></td>
                                               <td dir='rtl' class="fnt-family no-br-tp"><?php echo $checkup['follow_num']; ?> <?php
                                            	 if ($checkup['follow_time']=='type1') {
                                            	 	echo "دن";
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
                                            	  
                                            
                                              	   ?> کے بعد دوبارہ تشریف لائیں۔ </td>
                                                
                                            </tr>
                                        </tbody>
                                </table>
                        </div>
                    </div>
                <?php } ?>
                <div class="row set-footer">
                    <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                        <!--<img class="set-foot" src="../img/drimran_footer.jpg" style="">-->
                        <div class="set-foot"></div>
                    </div>
                </div>
                <!--<div class="row">-->
                <!--        <div class="table-responsive">-->
                <!--                <table class="table no-mr-btm">-->
                <!--                        <thead>-->
                <!--                            <tr></tr>-->
                <!--                        </thead>-->
                <!--                        <tbody>-->
                <!--                            <tr>-->
                <!--                                <td class="no-paddig" style="color: red!important;">Software Developed by www.zedtech.co</td>-->
                <!--                                <td dir="rtl" class="no-paddig"></td>-->
                <!--                            </tr>-->
                <!--                        </tbody>-->
                <!--                </table>-->
                <!--        </div>-->
                <!--    </div>-->
                <div class="row" style="display:none;">
                        <div class="table-responsive tbl-sides">
                                <table class="table no-mr-btm">
                                        <thead>
                                            <tr></tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="set-blw ">Next Follow Up</td>
                                               <td dir='rtl' class="fnt-family "><?php echo $checkup['follow_num']; ?> <?php
                                            	 if ($checkup['follow_time']=='type1') {
                                            	 	echo "دن";
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
                                            	  
                                            
                                              	   ?> کے بعد دوبارہ تشریف لائیں۔ </td>
                                                
                                            </tr>
                                        </tbody>
                                </table>
                        </div>
                    </div>
                <div class="row" style="display:none;">
                    <div class="col-md-12">
                        
                                   
                                    <div class="table-responsive tbl-sides">
                                        <table class="table">
                                        <thead>
                                            <tr></tr>
                                        </thead>
                                        <tbody>
                                            
                                             <?php
                                            if( $checkup['hpi'] != ''){ ?>
                                            <tr>
                                                <td class="set-blw no-paddig">HPI(History of present illness)</td>
                                                <td class="no-paddig"><?php echo $checkup['hpi']; ?></td>
                                            </tr>
                                                
                                            <?php }
                                            
                                            ?>
                                            
                                             <?php
                                            if( $patient['per_history'] != ''){ ?>
                                            <tr>
                                                <td class="set-blw no-paddig">Past History</td>
                                                <td class="no-paddig"><?php echo $patient['per_history']; ?></td>
                                            </tr>
                                                
                                            <?php }
                                            
                                            ?>
                                            
                                             <?php
                                            if( $patient['f_history'] != ''){ ?>
                                            <tr>
                                                <td class="set-blw no-paddig">Family History</td>
                                                <td class="no-paddig"><?php echo $patient['f_history']; ?></td>
                                            </tr>
                                                
                                            <?php }
                                            
                                            ?>
                                            
                                             <?php
                                            if( $patient['per_history'] != ''){ ?>
                                             <tr>
                                                <td class="set-blw no-paddig">Personal History</td>
                                                <td class="no-paddig no-paddig"><?php echo $patient['per_history']; ?></td>
                                            </tr>
                                                
                                            <?php }
                                            
                                            ?>
                                           
                                             <?php
                                            if( $checkup['pt_proc'] != ''){ ?>
                                            <tr>
                                                <td class="set-blw no-paddig">Procedure</td>
                                                <td class="no-paddig no-paddig"><?php echo $checkup['pt_proc']; ?></td>
                                            </tr>
                                                
                                            <?php }
                                            
                                            ?>
                                            
                                             <?php
                                            if( $patient['review_pre_lab'] != ''){ ?>
                                            <tr>
                                                <td class="set-blw no-paddig">Review of previous lab</td>
                                                <td class="no-paddig"><?php echo $patient['review_pre_lab']; ?></td>
                                            </tr>
                                                
                                            <?php }
                                            
                                            ?>
                                            
                                             <?php
                                            if( $patient['review_pre_med'] != ''){ ?>
                                            <tr>
                                                <td class="set-blw no-paddig">Review of previous med</td>
                                                <td class="no-paddig"><?php echo $patient['review_pre_med']; ?></td>
                                            </tr>
                                                
                                            <?php }
                                            
                                            ?>
                                            
                                            <?php
                                            if( $checkup['examination'] != ''){ ?>
                                             <tr>
                                                <td class="set-blw no-paddig">Systematic Examination</td>
                                                <td class="no-paddig"><?php echo $checkup['examination']; ?></td>
                                            </tr>
                                                
                                            <?php }
                                            
                                            ?>
                                           
                                        </tbody>
                                        </table>
                                    </div>
                    </div>
                </div>
                <div class="row" style="display:none;">
                    <div class="col-md-12 set-col4-box1">
                            <div class="set-fnt" >
                                <h5 class="text-center lab-fnt">Lab Test Recomendations</h5>
                                <?php
                                $i=1; 
                                $db->where('p_id',$pat_id);
                                $db->where('checkup_id',$checkup_id);
                                $inhouse=$db->get('current_patient_test');
                                foreach ($inhouse as $in) {
                                ?>
                                <p class="lab-test-font">
                                <?php 
                                echo $i."-";
                                echo $in['test_name']."  ";
                                echo $in['result_value'].","; 
                                ?>
                                </p>
                            <?php 
                                $i++;    }
                                $db->where('p_id',$pat_id);
                                $db->where('checkup_id',$checkup_id);
                                $outdoor=$db->get('current_patient_outdoor_test');
                                foreach ($outdoor as $out) {
                                ?>
                                <p class="lab-test-font"><?php echo $i."-";
                                echo $out['test_name']."  ";
                                echo $out['result_value'].","; 
                                $i++;   }
                                ?>
                               
                              
                            </div>
                        </div>
                </div>
                </div>
            <?php //} ?>
                <!--//col-md-12//-->
            </div>

            <!-- /.row -->



        </div>
        <!-- /#page-wrapper -->
        

    </div>
    <!-- /#wrapper -->
    </div>
    <!-- jQuery -->
     <?php
    include 'js_min_lib.php';
 include 'jslib.php';
 
 ?>
 <script>
function myFunction() {
    window.print();
}
</script>
 <script src="back.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>
 
</body>

</html>