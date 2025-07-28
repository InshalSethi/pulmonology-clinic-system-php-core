<?php
include '../include/config_new.php';
$a = new crud();
$x=$_REQUEST['pd'];
$y=$_REQUEST['ld'];
// $z=$_REQUEST['chi'];
$pat_id=decode($x);
$token_id=decode($y);
// $checkup_id=decode($z);

if (isset($_POST['save_data'])){
       $dr_fee=$_POST['dr_fee']; 
       
       $where=array("p_id=$pat_id AND token_no=$token_id");
       
       $update=array('rec_fee'=>"$dr_fee");
     
       $a->update('current_checkup',$update,$where);
?> 
        <script>window.location ="dr_checkup_sec.php?pd=<?php echo $x; ?>&cd=<?php echo $y; ?>";</script>
       
<?php  }  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reception | Add Petient</title>

       <?php
    include 'lib.php';
    include '../include/auth.php';
    ?>


</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include  'sidebardoc.php'; ?>
      
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Payments</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-6">
                    <form method="POST" action="">
                       
                         
                     
                                
                                   
                                     <label>Doctor Fee</label>
                         <div class="form-group">

                         <input class="form-control" type="text" name="dr_fee" value=" " required/>

                         </div>
                             
                                            
                                             
                 <button type="submit" class="btn btn-success" name="save_data">Save</button>
                    </form>
                </div>
            </div>
            <!-- /#page-wrapper -->

        </div>
        


        <?php
    include 'jslib.php';
    ?>


</body>

</html>