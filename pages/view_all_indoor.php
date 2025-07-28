<?php 
include '../include/config_new.php';
$a= new crud();
if (isset($_REQUEST['id'])) {
     $x=$_REQUEST['id'];
  
    $a->delete('lab_test','test_name="'.$x.'"');
}
   
   // header('Location:view_all_indoor.php');
   
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Doctor | All Indoor Test</title>

   
    <?php
 include 'lib.php';
 include '../include/auth.php';
 ?>


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
                        <h1 class="page-header">All Indoor Lab Test</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div style="padding-bottom: 3px;">
                    
                      <button onclick="goBack()" class="btn"  style="float: right;margin-right: 16px;margin-bottom: 15px;"> <i class="fa fa-arrow-circle-left" style="font-size:30px;color:red;"></i></button>
                </div>
                
                <!-- /.row ////-->
                <button class="btn btn-primary" onclick="window.location.href='add_indoorlab.php'">Add Indoor Test</button>
              
                
                <div class="row">
                  
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="background: linear-gradient(120deg, #5983e8, #5983e8);color:white;">
                                Indoor Test Detail Table
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Sr#</th>
                                                
                                                <th>Indoor Test Name</th>
                                              
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                           $a= new crud();
   $recored=$a->select('lab_test','DISTINCT test_name','','');
   $i=1;
                                         while ($data =$recored->fetch_array()) 
                                         
                                          { 
                                          
                                           

                                            ?>

                                       
                                            <tr class="odd gradeX">
                                                <td><?php echo $i ; ?></td>
                                                
                                                <td><?php echo $data['test_name']; ?></td>
                                                
                                          
                                                 <td>
                                             <div class="text-center">       
                                        <a class="btn btn-danger btn-circle" onclick="myFunction('<?php echo $data['test_name']; ?>' )"><i class="fa fa-trash-o"></i> </a></div>
                                                                    </td>
                                            </tr>
                                            <?php $i++; } 
                                          ?>

                                            
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
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>
        <script>
function myFunction( clicked_id ) {
var txt;
var r = confirm(" Are you sure to delete this Record?");
if (r == true) { 
txt = "You pressed OK!";

var stateID = clicked_id;


window.location = "view_all_indoor.php?id="+clicked_id; 

} else {


}

}
</script>
    
</body>

</html>