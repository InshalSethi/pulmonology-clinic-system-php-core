<?php
    session_start();
    include 'include/config_new.php';
    include 'include/functions.php';
    include 'include/MysqliDb.php';
    include 'include/config.php';
    $a= new crud();
     if(isset($_POST['login'])){
        if((isset($_POST['uname']) && $_POST['uname']!='' ) && (isset($_POST['password']) &&  $_POST['password']!='' ) ){
        $name_us = $_POST['uname']; 
        $password = $_POST['password'];
        $username=sanitize_text_input($name_us);
        $db->where("name",$username);
        $db->where("password",$password);
        $login=$db->getOne("user");
        
    if ($db->count>0) {
        if ($login['type']=='doctor') {
             $_SESSION['docter']='1';
             
          header('LOCATION:pages/index.php');
         
         
         
        }
        elseif ($login['type']=='recp') {
            $_SESSION['recp']='1';
          header('LOCATION:Reception/index.php');
          
         
        }
    }
        elseif($db->count==0){
          ?>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script type="text/javascript">
            
                    $(document).ready(function(){
                    $('#show').show()
                  });
            </script>

      <?php  }
    }
        else{
       ?>
            
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script type="text/javascript">
            
                    $(document).ready(function(){
                    $('#show1').show()
                  });
            </script>
            <?php
         
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

        <title>Chest Care Clinic | Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/startmin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/fav.png" type="image/" sizes="16x16">
<style>
  .alert{
    display: none;
}
body {
  background-image: url("img/background.jpg");
    background-size: cover;
    /*background-position: center;*/
}
@media(min-width:319px) and (max-width:420px){
    .set-login-panel{
            margin-right: 2%!important;
            margin-left: 2%!important;
    }
    .shifa-logo{
        width:100%!important;
    }
}
@media(min-width:767px) and (max-width:1024px){
    .set-login-panel{
            margin-top: 20%!important;
            margin-right: 10%!important;
            margin-left: 10%!important;
            
    }
    .shifa-logo{
        width:100%!important;
    }
}
.set-login-panel{
  background: #807c7cd1;
    border-radius: 10px;
    margin-top: 4%;
    margin-left: 71%;
}
.input-set{
  background: transparent;
  border-radius: 25px;
  color: white;
  font-weight: 500;
}
.login-btn-set{
  border-radius: 25px;
  padding: 5px 16px;
  font-family: 'BebasNeueBold';
}
.panel-title{
color: #ef0303bf;
font-family: 'BebasNeueBold'; 
font-size: 20px;
text-align: center;
font-weight: 700;
}
input::-webkit-input-placeholder {
    font-size: 16px;
    color: white!important;
    
    
}
.shifa-logo{
  width: 300px;
}
.login-panel{
      margin-top: 8%!important;
}
</style>
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 set-login-panel">
                    <div class="login-panel panel panel-default" style="background: transparent;border: none;">
                        <div class="panel-heading" style="background: transparent;border: none;">
                          <div class="text-center"> 
                          <img src="img/shifacare-3.png" class="shifa-logo">
                          </div>
                            <h1 class="panel-title">Please Sign In</h1>
                        </div>
                        <div class="panel-body">
                               </div>    
                        <div id="show" class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            No Such A User Found Enter Correct User Name And Password!
                        </div>
                         <div id="show1" class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            Invalid UserName!
                        </div>
                            <form action="" role="form" method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control input-set" autocomplete="off" placeholder="User Name" name="uname" type="text" autofocus required >
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control input-set" autocomplete="off" placeholder="Password" name="password" type="password" value="" required >
                                    </div>
                                    
                                    <!-- Change this to a button or input when using this as a form -->
                                    <button name="login" type="submit" class="btn btn-lg btn-success btn-block login-btn-set" >Login</button>
                                   
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="js/startmin.js"></script>

    </body>
</html>
