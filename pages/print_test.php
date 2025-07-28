<?php
include '../include/config_new.php'; 
$a= new crud();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
     <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/jameelkhushkhati-ttf" type="text/css"/>
    <meta name="author" content="">

    <title>Doctor | Print Lab Test</title>


    <?php
 include 'lib.php';
 include '../include/auth.php';
 ?>
<style>
    @media print{
   .noprint{
       visibility: hidden;
       height:0px;
      
   }
}
.tt{
        font-family: 'JameelKhushkhatiRegular'; 
        font-size:25px;
        font-weight:500
        color:black;
       
}
    .no_border{
        border:none;
    }
th, td {
    width:30%;
}
table {
   
    width: 100%;
}
</style>

</head>

<body>
    <div class="container-fluid">
        <div id="wrapper">

            <!-- Navigation -->
            <?php include 'sidebardoc.php'; ?>
        

            <div id="page-wrapper" style="margin-top: 50px;padding-top: 0px;">
            
                
                <div class="noprint">
                <button onclick="goBack()" class="btn "  style="float: right;margin-right: 16px; margin-top: 4%;" title="Go back to previous page"> <i class="fa fa-arrow-circle-left" style="font-size:30px;   color:red;"></i></button>
               </div>
                <div class="container-fluid">
                    <div class="text-center">
                        <img src="../img/logo.PNG" style="width: 340px;height: 120px;margin-left: 80px;margin-top: 0px;"></div>
                </div>
                <div class="container-fluid">
        <?php   
    
            $x=$_REQUEST['pd'];
            $y=$_REQUEST['cd'];
            $pat_id=decode($x);
            $rec=$a->select('current_patient cp INNER JOIN current_checkup ct ON(cp.p_id=ct.p_id)','cp.p_name,cp.contact,cp.address,ct.checkup_date',"cp.p_id=$pat_id",'');
          

    while ($data =$rec->fetch_array()) {
    ?>
        
 
                <div class="row">
                 <div>
                    <h4 style="display:inline-block;font-size:18px;font-weight:700;margin-top: 5px;margin-bottom: 5px;">Name:</h4>
                    <h4 style="display:inline-block;font-size:18px;font-weight:500;margin-top: 5px;margin-bottom: 5px;"><?php echo $data['p_name']; ?></h4>
                </div>
                 <div>
                    <h4 style="display:inline-block;font-size:18px;font-weight:700;margin-top: 5px;margin-bottom: 5px;">Phone #</h4>
                    <h4 style="display:inline-block;font-size:18px;font-weight:500;margin-top: 5px;margin-bottom: 5px;"><?php echo $data['contact']; ?></h4>
                </div>
                 <div>
                    <h4 style="display:inline-block;font-size:18px;font-weight:700;margin-top: 5px;margin-bottom: 5px;">Address: </h4>
                    <h4 style="display:inline-block;font-size:18px;font-weight:500;margin-top: 5px;margin-bottom: 5px;"><?php echo $data['address']; ?></h4>
                </div>
                <div>
                    <h4 style="display:inline-block;font-size:18px;font-weight:700;margin-top: 5px;margin-bottom: 5px;" >Date:</h4>
                    <h4 style="display:inline-block;font-size:18px;font-weight:500;margin-top: 5px;margin-bottom: 5px;"><?php echo $data['checkup_date']; ?></h4>
                </div>
               
               
                 
                <div class="pull-right noprint" style="margin-right: 16px;">
                   <button onclick="myFunction()" class="btn" title="Get lab test print on pages"><i class="fa fa-print"></i> Print</button>
                </div>
                <form class="pull-right noprint" style="margin-right: 16px;">
                                
                               <a href="precept1.php?pd=<?php echo $x;?>&cd=<?php echo $y;?>" class="btn btn-success noprint"title="Proceed to write medication for patient">Next</a>
                                
                                
                            </form>
                </div>
     <?php  } ?>
                <!-- /.row -->
                 </div>
                 <div class="container-fluid">
                 <div class="row" style="margin-top:2px;min-height: 680px;">
                     <table>
                         <thead>
                             <style>
                                 .set-hd{
                                     font-size: 16px;
                                     padding-top:5px;
                                     padding-bottom:5px;
                                 }
                             </style>
                         <tr style="border: 1px solid black;">
                             <th class="set-hd">Test Name </th>
                             <th class="set-hd">Result </th>
                             <th class="set-hd">Normal Value</th>
                         </tr>
                           </thead>     
                               
                               
                            
                               
        
  
                 
                   <tbody>
    <?php   
    
            $x=$_REQUEST['pd'];
            $pat_id=decode($x);
        $lab_data=$a->select('current_patient_test','*',"p_id=$pat_id",'');

    while ($test_data =$lab_data->fetch_array()) {
        $test_id=$test_data['test_id'];
    
    
    if($test_data['test_group']=='group1' || $test_data['test_group']=='group2' ){ 
    ?>
     <tr>
         <style>
             .set-test-fnt{
                 font-size: 15px;
                 
             }
         </style>
                             <td class="set-test-fnt"><?php echo $test_data['test_name']; ?></td>
                              <td class="set-test-fnt"><?php echo $test_data['result_value']; ?></td>
                               <td class="set-test-fnt"><?php echo $test_data['normal_value']; ?> </td>
                               </tr>
        
  

                        
        <?php }
        else if ($test_data['test_group']=='group3')
        { ?>
        <tr>
                             <td style="font-size:16px">[ <?php echo $test_data['test_name']; ?> ]</td>
                            
        </tr>
            
            
        
        <?php
        $in_data=$a->select('inside_current_patient_test','*',"p_id=$pat_id AND test_id=$test_id",'');
         while ($inside_data =$in_data->fetch_array())
         {?>
         <tr>
               <style>
             .set-test-fnt-blw{
                 font-size: 15px;
                 
             }
         </style>
                             <td class="set-test-fnt-blw" style="padding: 0px 50px;"><?php echo $inside_data['inside_test']; ?></td>
                             <td class="set-test-fnt-blw"><?php echo $inside_data['result_inside']; ?></td>
                             <td class="set-test-fnt-blw"><?php echo $inside_data['normal_value']; ?> </td>
        </tr>
             
             
             
             
    <?php     }
            
        }
        
        } ?>
          
                         </tbody>
                     </table>
                              
                               </div> 
                                
                            </div>  
                <div class="container-fluid">
                    <div class="text-center">
                        <img src="../img/fot_logo.jpg" style="width: 500px;height: auto;">
                    </div>
                </div> 
                            <!--next button here-->
                            
                     </div>
          
           
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