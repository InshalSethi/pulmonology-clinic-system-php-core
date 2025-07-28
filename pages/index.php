<?php

include '../include/config_new.php';
include '../include/MysqliDb.php';
include '../include/config.php';
include '../include/functions.php';
    $a= new crud();
    if (isset($_REQUEST['pi'])) {
    $x=$_REQUEST['pi'];
    if ( $x != '') {
    $a->delete('current_patient',"p_id=$x");
    $a->delete('current_checkup',"p_id=$x");
     $a->delete('token',"p_id=$x");
     $a->delete('current_patient_medicine',"p_id=$x");
     $a->delete('current_patient_outdoor_test',"p_id=$x");
     $a->delete('current_patient_test',"p_id=$x");
       
    }
    
        
    }
    
    
if (isset($_POST['update_record'])) {
    $a= new crud();
    $x=$_POST['id_from'];
    $y=$_POST['checkup_from'];
    $pat_id=decode($x);
    $checkup_id=decode($y);
    
    $responce=update_second_checkup($pat_id,$checkup_id,$db);
    
    if($responce== '1'){
    $db->where('p_id',$pat_id);
    $db->delete('current_patient');
    
    $db->where('p_id',$pat_id);
    $db->delete('token');
    
    $db->where('p_id',$pat_id);
    $db->where('checkup_id',$checkup_id);
    $db->delete('current_checkup');
    
    $db->where('p_id',$pat_id);
    $db->where('checkup_id',$checkup_id);
    $db->delete('current_patient_medicine');
    
    $db->where('p_id',$pat_id);
    $db->where('checkup_id',$checkup_id);
    $db->delete('current_patient_outdoor_test');
    
    $db->where('p_id',$pat_id);
    $db->where('checkup_id',$checkup_id);
    $db->delete('current_patient_test');
    
    
}
else{
    // do nothing
}
    
    
    

    
   
 



    
}

if (isset($_POST['send_record'])) {
   
$x=$_POST['id_from'];
$y=$_POST['checkup_from'];
$pat_id=decode($x);
$checkup_id=decode($y);

$responce=push_all_record($pat_id,$checkup_id,$db);


if($responce== '1'){
    $db->where('p_id',$pat_id);
    $db->delete('current_patient');
    
    $db->where('p_id',$pat_id);
    $db->delete('token');
    
    $db->where('p_id',$pat_id);
    $db->where('checkup_id',$checkup_id);
    $db->delete('current_checkup');
    
    $db->where('p_id',$pat_id);
    $db->where('checkup_id',$checkup_id);
    $db->delete('current_patient_medicine');
    
    $db->where('p_id',$pat_id);
    $db->where('checkup_id',$checkup_id);
    $db->delete('current_patient_outdoor_test');
    
    $db->where('p_id',$pat_id);
    $db->where('checkup_id',$checkup_id);
    $db->delete('current_patient_test');
    
    
}
else{
    // do nothing
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
    <link rel="stylesheet" href="../dist/notifications.css" type="text/css">
    <!--<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">-->

    <title>Doctor | Dashboard</title>

    <?php
 include 'lib.php';
 include '../include/auth.php';
 ?>

<script type="text/javascript">
    function autoRefreshPage()
    {
        var ID=1;
     $.ajax({
            type:'POST',
            url:'ajax_dashboard.php',        
            data:{id :ID},
            success:function(html){
                
            
            $('.gradeX ').remove();
               
             
           $('#all_patient').append(html);
            }
             
        });
        
    }
    
    function autoRefresh_currentPatient()
    {
        var var_id=1;
        
         $.ajax({
                type:'POST',
                url:'ajax_status.php',        
                data:{id_new :var_id},
                success:function(html){
                    
                $('.status_remove ').remove();
              
             
                   $('#status_add').append(html);
               
                   
                 
             
                }
                 
            });
        
    }
    setInterval('autoRefreshPage()', 4000);
    setInterval('autoRefresh_currentPatient()', 4000);
    

</script>



  
</head>
<style>
    .hugee{
    font-size: 20px;
    font-weight: 600;
}
.panel-set{
        margin-bottom: 5px!important;
}
</style>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'sidebardoc.php'; ?>
       

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12" style="margin-bottom:26px;">
                    <!--<h1 class="page-header">Today Statistics</h1>-->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <div class="row" id="status_add">
                 <div class="row status_remove" >
                <div class="col-lg-2 col-md-2">
                    <div class="panel panel-secondary panel-set" style="border-color: #d2cece;">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-reorder fa-2x"></i>
                                </div>
                                <?php
                                $a= new crud();
                                $totalpatient=$a->selectcount('current_patient','*','','');
                                
                                ?>
                                <div class="col-xs-9 text-right">
                                    <div class="hugee"><?php echo $totalpatient ?></div>
                                    
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Listed Patients </span>
                                

                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2">
                    <div class="panel panel-secondary panel-set" style="border-color: #d2cece;">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-2x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                 <?php
                              
                                $totaltest=$a->selectcount('current_checkup','*','p_status IS NULL','');
                                
                                ?>
                                    <div class="hugee"><?php echo $totaltest ?></div>
                                  
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Waiting Patients</span>
                                

                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2">
                    <div class="panel panel-secondary panel-set" style="border-color: #d2cece;">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa-1x" style="font-size:20px;font-weight:bold;font-style-normal">PKR</i>
                                </div>
                                <div class="col-xs-9 text-right">
                                 <?php
                                 date_default_timezone_set("Asia/Karachi");
                              
                                
                                $fee=0;
                                
                                $date=date("Y-m-d");
                                $db->where('checkup_date',$date);
                                $cur_tot=$db->get('current_checkup');
                                foreach($cur_tot as $c_t){
                                    $fee+=$c_t['rec_fee'];
                                    
                                }
                                $db->where('checkup_date',$date);
                                $par_tot=$db->get('total_checkup');
                                foreach($par_tot as $p_t){
                                    $fee+=$p_t['rec_fee'];
                                    
                                }
                                    
                                

                                    
                                ?>
                                    <div class="hugee"><?php echo $fee; ?></div>
                                  
                                </div>
                            </div>
                        </div>
                        <a href="revenue_docter.php" target="_blank">
                            <div class="panel-footer">
                                <span class="pull-left"> Today Revenue</span>
                                

                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2">
                 <div class="panel panel-secondary panel-set" style="border-color: #d2cece;">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-money fa-2x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                 <?php
                              
                                $expenses=0;
                                $date=date("Y/m/d");
                                $db->where ("date",$date);
                                $exp = $db->get('expense_detail');
                                
                                foreach ($exp as $exp_data) {
                                    
                                    $expenses +=$exp_data['price'];
                                   
                                    } 
                                
                                ?>
                                    <div class="hugee"><?php echo $expenses; ?></div>
                                  
                                </div>
                            </div>
                        </div>
                        <a href="expanse_detail.php" target="_blank">
                            <div class="panel-footer">
                                <span class="pull-left"> Today Expenses</span>
                                

                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2">
                    <div class="panel panel-secondary panel-set" style="border-color: #d2cece;">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-clock-o fa-2x"></i>
                                </div>
                                <?php
                                
                                $todaydate=date("Y/m/d");
                                $db->where ("checkup_date",$todaydate);
                                $today = $db->get('total_checkup');
                                $checkups =$db->count;
                                    
                                ?>
                                <div class="col-xs-9 text-right">
                                    <div class="hugee"><?php echo $checkups; ?></div>
                                    
                                </div>
                            </div>
                        </div>
                        <a href="todaycheckup.php">
                            <div class="panel-footer">
                                <span class="pull-left">Today Checkup's </span>
                                

                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-2">
                    <div class="panel panel-secondary panel-set" style="border-color: #d2cece;">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-clock-o fa-2x"></i>
                                </div>
                                <?php
                                
                            $todaydate=date("Y/m/d");
                            $test_total=0;
                            $db->join("total_checkup tc", "tc.checkup_id=tp.checkup_id", "LEFT");
                            $db->where ('tp.test_price','', "!=");
                            $db->where('tc.checkup_date',$todaydate );
                            $testdetail = $db->get ("total_patient_test tp", null, " tp.test_price");
                            foreach($testdetail as $td){
                             $test_total+=$td['test_price'];
                            }
                                    
                                ?>
                                <div class="col-xs-9 text-right">
                                    <div class="hugee"><?php echo $test_total; ?></div>
                                    
                                </div>
                            </div>
                        </div>
                        <a href="todaycheckup.php">
                            <div class="panel-footer">
                                <span class="pull-left"> Test Revenue </span>
                                

                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
        
              
              
            </div>
                 
             </div>
            <!---->


            <!-- /.row ////-->
            <div class="row">
                <div class="col-lg-12" style="padding-left: 0px;padding-right: 0px;">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="color: white;     background: linear-gradient(120deg, #5983e8, #5983e8);">
                            Patients Detail Table
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover makeitasc" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <!--<th>ID #</th>-->
                                            <th class="makeitasc">Patient Id.</th>
                                            <th>Name</th>
                                            <th>Checkin</th>
                                            <th>Status</th>
                                            <!-- <th>Lab Status</th>
                                            <th>Lab ok/not</th> -->
                                            <th>Done</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody  id="all_patient">
                                    <div id="old_patient">
                                    <?php
                                                $recored=$a->select('current_patient cp INNER JOIN token tok ON(cp.p_id=tok.p_id) INNER JOIN current_checkup ch ON(cp.p_id=ch.p_id)','cp.p_id,cp.p_name,cp.checkup_times,tok.token_no,ch.*','',"tok.token_no ASC");

                                            while ($ab =$recored->fetch_array()) {
                                            $pat_id=$ab['p_id'];
                                            $checkup=$ab['checkup_id'];
                        
                                            $encrypt=encode($pat_id);
                                            $encrypt1=encode($checkup);



                                         ?>
                                        
                                        <tr class="odd gradeX">
                                            
                                            <td><?php  echo $ab['p_id']; ?> </td>
                                            
                                            <td>
                                                <?php


                                                if ($ab['checkup_times']=='1') {

                                                if ($ab['is_insert']=='1') {
                                                ?>
                                                 <a href="editrecored_sec.php?doc=<?php echo $encrypt;?>&ch=<?php echo $encrypt1;?>"><?php  echo $ab['p_name']; ?></a>

                                        <?php  }
                                            else{
                                                    

                                            ?>
                                                 <a href="dr_checkup_sec.php?pd=<?php echo $encrypt;?>&cd=<?php echo $encrypt1;?>"><?php  echo $ab['p_name']; ?></a>
                                                <?php  
                                                }
                                              

                                               

                                                    
                                        }


                                        else{
                                            if ($ab['is_insert']=='1') { ?>
                                            <a href="editrecored.php?doc=<?php echo $encrypt;?>&ch=<?php echo $encrypt1;?>"><?php  echo $ab['p_name']; ?></a>
                                            
                                           <?php }
                                           else{
                                            ?>
                                             <a href="dr_checkup.php?pd=<?php echo $encrypt;?>&cd=<?php echo $encrypt1;?>"><?php  echo $ab['p_name']; ?></a>
                                            <?php
                                            }

                                            }

                                              ?>

                                            <td><?php  echo $ab['checkup_time']; ?></td>
                                            
                                            
                                            <td class="center text-center">
                                                <?php 
                                                if($ab['p_status']=='1') {
                                                    # code...
                                               

                                                ?>
                                                <button type="button text-center" class="btn btn-secondary" style="border-radius:25px;background-color: #056d1a; color: white;font-weight:600;" disabled>In room</button>

                                            <?php } elseif($ab['p_status']=='2') {

                                             ?> 
                                              <button type="button text-center" class="btn btn-info" style=" color: white;background-color: #6346a5;border-color: #6346a5;border-radius:25px;font-weight:600;" disabled>In Process</button>
                                         <?php } else {


                                          ?>
                                           <button type="button text-center" class="btn btn-danger" style=" color: white; background-color: #a90202;border-radius:25px;font-weight:600;" disabled>Waiting</button>
                                      <?php } ?>
                                            </td>
                                            <?php
                                             
                                            //if($ab['lab_status']=='1'){

                                            ?>
                                           <!--  <td class="center text-center">
                                                <button type="button" class="btn btn-secondary" style="border-radius:25px;background-color: #056d1a; color: white;font-weight:600;" disabled> In lab</button>
                                            </td> -->
                                            <?php //} else {

                                             ?>
                                             <!--  <td class="center text-center">
                                                <button type="button" class="btn btn-secondary" style="color: white; background-color: #a90202;border-radius:25px;font-weight:600;" disabled>Waiting</button>
                                            </td> -->
                                        <?php //} ?>
                                             <?php

                                           // if($ab['lab_ok']=='1'){

                                            ?>
                                            <!-- <td class="center text-center">
                                                <button type="button" class="btn btn-secondary" style="border-radius:25px;background-color: #056d1a; color: white;font-weight:600;" disabled> done</button>
                                            </td> -->
                                            <?php //} else {

                                             ?>
                                              <!-- <td class="center text-center">
                                                <button type="button" class="btn btn-secondary" style="border-radius:25px;background-color: red; color: white;font-weight:600;" disabled>Not done</button>
                                            </td> -->
                                        <?php //} ?>
                                            <td class="center"><div class="text-center">
                                              <?php
                                              if ($ab['checkup_times']=='0') 
                                                {?>
                                                      <form method="POST" action="">

                                                <div class="form-group" style="display: none;">
                                                    
                                <input   class="form-control" name="id_from" value="<?php  echo $encrypt; ?>">
                                                  </div>
                                                  <div class="form-group" style="display: none;">
                                                    
                                <input   class="form-control" name="checkup_from" value="<?php  echo $encrypt1; ?>">
                                                  </div>


                                        <button type="submit" name="send_record" class="btn btn-info btn-circle" title="Save this patient's checkup in permanent record"><i class="fa fa-check"></i></button>


                                                </form>
                                                 
                                             <?php }
                                             else
                                                { ?>

                                                     <form method="POST" action="">

                                                <div class="form-group" style="display: none;">
                                                    
                                <input   class="form-control" name="id_from" value="<?php  echo $encrypt; ?>">
                                                  </div>
                                                  <div class="form-group" style="display: none;">
                                                    
                                <input   class="form-control" name="checkup_from" value="<?php  echo $encrypt1; ?>">
                                                  </div>


                                                <button type="submit" name="update_record" class="btn btn-warning btn-circle" title="Save this patient's checkup in permanent record"><i class="fa fa-check" ></i></button>


                                                </form>











                                        <?php     }



                                               ?>




                                            </div></td>
                                            <td class="text-center">
                                           <div class="text-center">  
                                        <a class="btn btn-danger btn-circle" onclick="myFunction('<?php echo $pat_id; ?>' )" style="display:inlline-block;" title="Delete this patient record"><i class="fa fa-trash-o"></i> </a>
                                                                     
                                                             
                                        <a class="btn btn-primary btn-circle" href="editrecored.php?doc=<?php echo $encrypt;?>&ch=<?php echo $encrypt1;?>" style="display:inlline-block;" target="_blank" title="Edit patient record"><i class="fa fa-edit"></i> </a>
                                                       
                                                </div>
                                            </td>
                                        </tr>

                                        <?php }
                                    
                                    ?>
                                        
                                    </div>
                                        
                                          
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
            <!-- /.row -->
           
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

  
    <?php
    include 'js_min_lib.php';
 include 'jslib.php';
 
 ?>
 <script src="../dist/notifications.js" type="text/javascript"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
               "order": [],
                responsive: true,
                "filter": true
            });
        });
    </script>
        <script>
function myFunction( clicked_id ) {
var txt;
var r = confirm(" Are you sure to delete this Patient?");
if (r == true) { 
txt = "You pressed OK!";

var stateID = clicked_id;


window.location = "index.php?pi="+clicked_id; 

} else {


}

}
</script>
</body>

</html>