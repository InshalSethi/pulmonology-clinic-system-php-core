<?php 
include '../include/config_new.php';
include '../include/MysqliDb.php';
include '../include/config.php';
$a= new crud();
if (isset($_REQUEST['pi'])) {
    $x=$_REQUEST['pi'];
    $pat_id=decode($x);
    
    $data_up=Array('is_delete'=>'1');
    $db->where('p_id',$pat_id);
    $db->update('total_patient',$data_up); 
    
    
    
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

    <title>Doctor | All Patients</title>

   
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
                        <h1 class="page-header">All Patients</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div style="padding-bottom: 3px;">
                    
                      <button onclick="goBack()" class="btn"  style="float: right;margin-right: 16px;margin-bottom: 15px;"> <i class="fa fa-arrow-circle-left" style="font-size:30px;color:red;"></i></button>
                </div>
                
                <!-- /.row ////-->
                <div class="row">
                  
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Patients Detail Table
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Phone</th>
                                                
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                           $a= new crud();
                                            $db->where('is_delete','0');
                                            $pat_data=$db->get('total_patient');
                                            
                                            foreach($pat_data as $data)
                                            
                                         
                                          { 
                                            $pat_id=encode($data['p_id']);
                                           

                                            ?>

                                       
                                            <tr class="odd gradeX">
                                                <td><?php echo $data['p_id']; ?></td>
                                                
                                                <td><a href="checkups.php?pi=<?php echo $pat_id;?>"><?php echo $data['p_name']; ?></a></td>
                                               
                                                 <td class="center"><?php echo $data['address']; ?></td>
                                                 <td class="center"><?php echo $data['contact']; ?></td>

                                                <td class="text-center">
                                             <div class="text-center">     
                                        <a class="btn btn-danger btn-circle" onclick="myFunction('<?php echo $pat_id; ?>' )" ><i class="fa fa-trash-o"></i> </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } 
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
   <script>
function myFunction( clicked_id ) {
var txt;
var r = confirm(" Are you sure to delete this Patient?");
if (r == true) { 
txt = "You pressed OK!";

var stateID = clicked_id;


window.location = "allpatients.php?pi="+clicked_id; 

} else {


}

}
</script>
 <script src="back.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>
</body>

</html>