<?php 
include '../include/config_new.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Doctor | Patient Checkups</title>

    <?php
 include 'lib.php';
 include '../include/auth.php';
 ?>
<style>
.btn-dark{
    color: #fff;
    background-color: #424964;
    border-color: #424964;
}
.btn.btn-fw{
    min-width: 120px;
    
}
.zoom {
  color: white;
  transition: transform .2s; /* Animation */

  margin: 0 auto;
}

.zoom:hover {
    color:white;
  transform: scale(1.1); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}
.flip-box {
  background-color: transparent;
  width: 100%;
  height: 100px;
  border: 1px solid #f1f1f1;
  perspective: 1000px;
}

.flip-box-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.8s;
  transform-style: preserve-3d;
}

.flip-box:hover .flip-box-inner {
  transform: rotateY(180deg);
}

.flip-box-front, .flip-box-back {
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
}

.flip-box-front {
  background-color: #424964;
  color: white;
  display: flex; 
  align-items: center;  /*Aligns vertically center */
  justify-content: center;
}

.flip-box-back {
  background-color: #5983e8;
  color: white;
  transform: rotateY(180deg);
  display: flex; 
  align-items: center;  /*Aligns vertically center */
  justify-content: center;
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
</style>


</head>

<body>
    <div class="container-fluid">
        <div id="wrapper">

            <!-- Navigation -->
              <?php
       include 'sidebardoc.php';
       ?>


            <div id="page-wrapper" style="padding-top: 50px;">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Patient Checkups</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div class="row">
                <div class="col-md-12 ">
                        <div class="card cardappoint card-topline-yellow ">
                            <div class="card-head card-headappoint ">
                                <h2 class="text-center">Basic Info</h2>
                            </div>
                            <div class="card-body card-bodystyle">
                                <?php
                                           $a= new crud();
                                           $x=$_REQUEST['pi'];
                                           $pat_id=decode($x);
   $recored=$a->select('total_patient','*',"p_id=$pat_id",'');

                                         while ($data =$recored->fetch_array()) 
                                         
                                          {?>

                                <div class="profile-usertitle">
                                    <div class="profile-usertitle-name"><?php echo $data['p_name']; ?> </div>

                                </div>
                                <ul class="list-group list-group-unbordered">
                                   
                                    <li class="list-group-item">
                                        <b>Contact #</b> <a class="pull-right"><?php echo $data['contact']; ?></a>
                                    </li>
                                   
                                    <li class="list-group-item">
                                        <b>Address</b> <a class="pull-right"> <?php echo $data['address']; ?> </a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Gender</b> <a class="pull-right"> <?php echo $data['gender']; ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b> Age</b> <a class="pull-right"><?php echo $data['age']; ?></a>
                                    </li>
                                </ul>




                            </div>

                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                <div>
                    
                </div>
            <div class="row">
                  <?php 
                  $i=1;
                        $rec=$a->select('total_checkup','checkup_date,checkup_id',"p_id=$pat_id",'');

                                         while ($date =$rec->fetch_array()) 
                                         {?>
                <div class="col-md-4">
                    <div class="card flip-box" >
                      

                           
    <a href="profile.php?pi=<?php echo $x; ?>&ci=<?php echo $date['checkup_id'];  ?>" class="btn btn-dark btn-fw zoom flip-box-inner" style="text-decoration: none;padding:0px;">
    <div class="card-body" style="box-shadow: 0 2px 2px 0 rgba(0,0,0,0.16), 0 0 0 1px rgba(0,0,0,0.08);transition: box-shadow 200ms cubic-bezier(0.4, 0.0, 0.2, 1);border-radius: 3px;padding-bottom: 10px;">
      <h4 class="card-title text-center" style="padding-top: 0px;margin: 0px;"> 
      <div class="flip-box-front">
          <p  style="font-size: 30px;"> Checkup No. <?php echo $i; ?></p>
        </div>
        <div class="flip-box-back">
          <p style="font-size: 30px;">Dated: <?php echo $date['checkup_date']; ?></p>
          </div>
      </h4>
    
     
    </div>
    </a>

  </div>
                </div>
                
                       <?php $i++;   
}
?>         
                 
            </div>

              <?php } 
                                          ?>
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