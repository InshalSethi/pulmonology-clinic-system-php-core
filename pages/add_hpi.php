<?php
include '../include/config_new.php'; 
include '../include/MysqliDb.php';
include '../include/config.php'; 
 if (isset($_POST['add_hpi'])) {
        $a= new crud();

        $eng_prec = $_POST['eng'];
        $cou = count($eng_prec);

        for ($i=0; $i <$cou ; $i++) 
        { 

        $in_data=Array('hpi'=>$eng_prec[$i]);
        $db->insert('hpi_list',$in_data);

        } 

        header("LOCATION:view_all_hpi.php");
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Doctor | Add HPI </title>
    <script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
    
    

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


   
    <?php
 include 'lib.php';

 include '../include/auth.php';
 ?>



    
    
    


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
            <h1> Add HPI Value </h1>
            
            
            <h1 id="demo">  </h1>
             
                                      
            <div class="select-box" style="padding-bottom: 10px;">
            
                <button class="btn btn-primary" id='addButton'><i class="fa fa-plus" style="padding-right: 3px;"></i>Add More</button>
                <!-- <input type='button' class="btn btn-primary" value='Add Button'> -->
                <button class="btn btn-danger" id='removeButton'><i class="fa fa-trash" style="padding-right: 3px;" aria-hidden="true"></i>Remove</button>

                <!--  <input type='button' class="btn btn-danger" value='Remove Button' id='removeButton'> -->
             
            </div>
       
       
            <form action="" method="POST">
              
                    <div class="new">
                    <div class="prec">
                    <div class="row">
                     
                           
                    <div class="form-group col-md-6" style="padding-left: 14px; ">
                    <input id="" name="eng[]" type="text" class="form-control medicine" cols="50" rows="auto" style="font-weight: bold;color:black;height:auto;font-size: 18px;"></input>
                    </div>
                                
                                    
                                    
                    </div>
                       
                      
                       
                      
                     

                    

                </div>
                </div>

                <button type="submit" name="add_hpi" class="btn btn-success "> Save</button>
            </form>

        </div>
    </div>



 
   


<?php
 include 'jslib.php';
 ?>
  <script src="back.js"></script>
   <script>
    
       
        
  var i=1;
  var d=1;

$(document).ready(function() {
        $('.description').hide();
    

       
        $('#addButton').click(function() {   
            $('.new').append("<div class='prec"+ i +" del'><div class='row'><div class='form-group col-md-6' style='padding-left: 14px; '><input name=eng[] type='text' class='form-control col-md-6 medicine' cols='50' rows='auto' style='font-weight: bold;color:black;height:auto;font-size: 18px;'></input></div></div></div>");
            $('.description'+d+'').hide();
            i++;
            d++;
            
        
         
        });
        
         $('#removeButton').click(function() {
            $('.del ').last().remove();   

        });
        

     });

    </script>

</body>

</html>




             