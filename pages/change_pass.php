<?php
 
  include '../include/config_new.php';
  
  $a= new crud();

   
      if(isset($_POST['change_pass'])){
       
        $new_password = $_POST['new_password'];
         $where=array("name='docter'");
        $upd=array('password'=>"$new_password");
        $a->update('user',$upd,$where);
        header("LOCATION:index.php");
        

       
  


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

        <title>Admin Docter</title>

      <?php 
        include 'lib.php';
        include '../include/auth.php';?>
             <style>
  .alert{
    display: none;
}
</style>
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <button onclick="goBack()" class="btn" style="float: right;margin-top: 45px;"> <i class="fa fa-arrow-circle-left" style="font-size:30px;color:red;"></i></button>
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Change Password</h3>
                        </div>
                        <div class="panel-body">
                               </div>    
                        <div id="show" class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            Invalid Password!
                        </div>
                         <div id="show1" class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            Invalid UserName!
                        </div>
                            <form action="" role="form" method="POST">
                                <fieldset>
                                    
                                    <div class="form-group">
                                        <input class="form-control" autocomplete="off" placeholder="Enter New Password" name="new_password" type="password" value="" required>
                                    </div>
                                    
                                    <!-- Change this to a button or input when using this as a form -->
                                    <button name="change_pass" type="submit" class="btn btn-lg btn-success btn-block">Save</button>
                                   
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="back.js"></script>
        <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>

    </body>
</html>
