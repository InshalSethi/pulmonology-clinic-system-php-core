<?php 
include '../include/config_new.php';
include '../include/MysqliDb.php';
include '../include/config.php';  
$a= new crud();
    if (isset($_REQUEST['id'])) {
       $x=$_REQUEST['id'];
       if ($x != '') {
       $a->delete('stamps','st_id="'.$x.'"');
       
         
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
    <link rel="stylesheet" media="print" href="//fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css">
     <link rel="stylesheet" media="screen" href="//fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css">

    <title>Doctor | Stamps </title>

   
    <?php
 include 'lib.php';
 include '../include/auth.php';
 ?>

<style>
.fnt-family{
    font-family: 'Noto Nastaliq Urdu Draft', serif!important;
}
</style>
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
                        <h1 class="page-header">Medicine Stamps List</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div style="padding-bottom: 3px;">
                    
                      <button onclick="goBack()" class="btn"  style="float: right;margin-right: 16px;margin-bottom: 15px;"> <i class="fa fa-arrow-circle-left" style="font-size:30px;color:red;"></i></button>
                </div>
                
                <!-- /.row ////-->
                <button class="btn btn-primary" onclick="window.location.href='add_stamp.php'">Add Stamp</button>
                <div class="row">
                  
                    <div class="col-lg-12">
                        <div class="panel panel-default" >
                            <div class="panel-heading" style="background: linear-gradient(120deg, #5983e8, #5983e8);color:white;">
                                Medication Detail Table
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>

                                            <th>Sr#</th>
                                            <th>Stamp Name</th>
                                            <th>Description</th>
                                            <th>Edit</th>
                                            <th>Actions</th>
 
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $a= new crud();
                                        $stamps=$db->get('stamps');    
                                        $i=1;
                                        
                                        foreach ($stamps as $st)
                                        { 

                                        ?>

                                       
                                        <tr class="odd gradeX">
                                        <td><?php echo $i ; ?></td>
                                                
                                        <td>
                                             
                                        <?php echo $st['st_name']; ?>
                                            
                                        </td>
                                       
                                        <td class="fnt-family">
                                            <?php echo $st['st_use']; ?>
                                           
                                         </td>
                                         <td>
                                        <div class="text-center">
                                                <a class="btn btn-primary btn-circle" href="edit_stamp.php?mi=<?php echo $st['st_id']; ?>" target="_blank"><i class="fa fa-pencil-square-o"></i> </a></div>
                                         </td>
                                         
                                         
                                               <td>
                                                   <div class="text-center">
                                                <a class="btn btn-danger btn-circle" onclick="myFunction('<?php echo $st['st_id']; ?>' )" ><i class="fa fa-trash-o"></i> </a></div>
                                                </td>
                                            </tr>
                                            <?php $i++;  } 
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
function myFunction(clicked_id) {
var txt;
var r = confirm(" Are you sure to delete this Medicine Stamp? ");
if (r == true) { 
txt = "You pressed OK!";

var stateID = clicked_id;


window.location = "view_all_stamps.php?id="+clicked_id; 

} else {


}

}
</script>
</body>

</html>