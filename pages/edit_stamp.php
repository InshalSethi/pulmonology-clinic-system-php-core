<?php
include '../include/config_new.php'; 
include '../include/MysqliDb.php';
include '../include/config.php';    
 if (isset($_POST['edit_stamp'])) {
        
    $st_name = $_POST['st_name'];
    $st_urdu = $_POST['urdu'];
    $st_id = $_POST['st_id'];
    
    $db->where('st_id',$st_id);
    $st_update=array("st_name"=>$st_name,"st_use"=>$st_urdu);
   
    $db->update('stamps',$st_update);
    

       
    }

 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Doctor | Add New Medicine</title>
    <script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
    <script src="../js/yauk.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notonaskharabic.css">
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/jameelkhushkhati-ttf" type="text/css"/>
    <link rel="stylesheet" media="print" href="//fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css">
     <link rel="stylesheet" media="screen" href="//fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css">
    

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


   
    <?php
 include 'lib.php';

 include '../include/auth.php';
 ?>

     <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
     <script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
     <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


    
    
    
<style>
.fnt-family{
    font-family: 'Noto Nastaliq Urdu Draft', serif!important;
}
</style>

</head>

<body>
    <div id="wrapper">
      <?php
       include 'sidebardoc.php';
       ?>
        <div id="page-wrapper" style="padding-top: 28px; overflow-x: hidden;">
             <button onclick="goBack()" class="btn"  style="float: right;margin-right: 16px; margin-top: 4%;"> <i class="fa fa-arrow-circle-left" style="font-size:30px;   color:red;"></i></button>
            <div class="container">
                
            </div>
            <h1> Update Stamp</h1>
            
            
            
             
                                      
            
       
       
            <form action="" method="POST">
              
            <div class="new">
            <div class="prec">
            <div class="row">
            <?php
            $st_id=$_REQUEST['mi'];
            $db->where('st_id',$st_id);
            $st_data=$db->getOne('stamps');
            
            ?>
                     
                           
          <div class="form-group col-md-6" style="padding-left: 14px; ">
          <input id="" name="st_name"type="text" class="form-control medicine" value="<?php echo $st_data['st_name']; ?>" cols="50" rows="auto" style="font-weight: bold;color:black;height:auto;font-size: 18px;"></input>
          </div>
          <input type="text" name="st_id"  value="<?php echo $st_data['st_id']; ?>" style="display:none;" />
                                
          <div class="form-group col-md-6">
          <input  class="test form-control tt fnt-family" name="urdu" type="text" value="<?php echo $st_data['st_use']; ?>" cols="50" rows="auto" dir="rtl" style="font-weight: bold;color:black;height:40px;font-size: 14px;"></input>
          </div>
                                    
          </div>
          </div>
          </div>

                <button type="submit" name="edit_stamp" class="btn btn-success "> Save</button>
            </form>

        </div>
    </div>
 <script>
    
       
        
  var i=1;
  var d=1;

$(document).ready(function() {
       
    

       
       
        
         

        });
        
   


       



       

        function myFunction() {
            $(function() {


                $('.test').setUrduInput();
                $('.test').focus();


            });
        }
        $(function() {


            $('.test').setUrduInput();
            $('.test').focus();


        });

    </script>


 
   


  
    <?php
 include 'jslib.php';
 ?>
  <script src="back.js"></script>
   
</body>

</html>




             