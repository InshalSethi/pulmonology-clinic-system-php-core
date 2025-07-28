<?php 
include '../include/config_new.php';
include '../include/MysqliDb.php';
include '../include/config.php';
include '../include/functions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Doctor | Existing Patients Checkup</title>

       <?php
    include 'lib.php';
    include '../include/auth.php';
    ?>


</head>

<body>
    <div class="container-fluid">
        <div id="wrapper">

            <!-- Navigation -->
          <?php include  'sidebardoc.php'; ?>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Existing Patients Checkup </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                
                <!-- /.row ////-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="background: linear-gradient(120deg, #5983e8, #5983e8);color:white;">
                                Patient's Detail Table
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Patient ID</th>
                                                <th>Name</th>
                                                <th>Phone No#</th>
                                                <th>Address</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $db->where('is_delete','0');
                                            $pat_data=$db->get('total_patient');
                                            
                                            foreach($pat_data as $data)
                                            {
                                                $pat_id=encode($data['p_id']);

                                            ?>


                                            <tr class="odd gradeX">
                                                <td><?php echo $data['p_id']; ?></td>
                                                <td><a href="editsecondtime.php?pi=<?php echo  $pat_id ?>"><?php echo $data['p_name']; ?></a></td>
                                               
                                                <td class="center"><?php echo $data['contact']; ?></td>
                                                <td class="center"><?php echo $data['address']; ?></td>

                                                <td class="text-center">
                                                    
                                              <a class="btn btn-info btn-circle" href="editsecondtime.php?pi=<?php echo  $pat_id ?>" style="display:inline-block"><i class="fa fa-recycle"></i> </a>
                                      
                                        
                                       
                                       
                                               </td>
                                            </tr>
                                             <?php
                                         }
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
    <!-- jQuery -->
      <?php
      include 'js_min_lib.php';
    include 'jslib.php';
    ?>

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