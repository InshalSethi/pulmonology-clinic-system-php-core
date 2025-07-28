<?php
include '../include/config_new.php';
include '../include/MysqliDb.php';
include '../include/config.php'; 
 $a= new crud();
 $del_id=$_REQUEST['di'];
 if($a->delete('medicine_description',"dis_id=$del_id")==true){
     header("LOCATION:view_all_medicine.php");
 }

  
?>
<script type="text/javascript">


    function hidediv(val)
    {
        $('#divid').attr('inshal', '' + val + '').hide();
          event.preventDefault()

    }
          function showdiv(val)
    {
        $('#divid').attr('inshal', '' + val + '').show();
         event.preventDefault()

    }
    
    
      function showit(val) {
           // alert(val);
        $('.description'+val+'').show();
        event.preventDefault();
  
} 
    function showfirst() {
            
        $('.description').show();
  
} 
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Doctor | Edit And Update Desc</title>
    <script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
    <script src="../js/yauk.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notonaskharabic.css">
    <!--<link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/jameelkhushkhati-ttf" type="text/css"/>-->
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


    
    
    


</head>
<style type="text/css">
  .tt{
        font-family: 'Noto Nastaliq Urdu Draft', serif; 
        font-size: 14px;
        font-weight: bold;
        color:black;

    }
    .txtstuff {
    resize: none; /* remove this if you want the user to be able to resize it in modern browsers */
    overflow: hidden;
}

.hiddendiv {
    display:none;
    white-space: pre-wrap;
    word-wrap: break-word;
    overflow-wrap: break-word; /* future version of deprecated 'word-wrap' */
}

/* the styles for 'commmon' are applied to both the textarea and the hidden clone */
/* these must be the same for both */
.common {
    width: 500px;
    min-height: 50px;
    font-family: Arial, sans-serif;
    font-size: 13px;
    overflow: hidden;
}

.lbr {
    line-height: 3px;
}
</style>
<body>
    <div id="wrapper">
      <?php
       include 'sidebardoc.php';
       ?>
       
        <div id="page-wrapper" style="padding-top: 28px; overflow-x: hidden;">
            
             <button onclick="goBack()" class="btn"  style="float: right;margin-right: 16px; margin-top: 4%;"> <i class="fa fa-arrow-circle-left" style="font-size:30px;   color:red;"></i></button>
            <div class="container">
                
            </div>
             <?php 
              $a= new crud();
              $med_id=$_REQUEST['mi'];
              $recored=$a->select('medicine_suggestion','medi_name',"med_id=$med_id",'');
              while ($data =$recored->fetch_array())
              {
              ?>
            <h1><span style="color: #e10c16;"><?php echo $data['medi_name']; ?></span> Urdu Description</h1>
            
            
            <h1 id="demo">  </h1>
           
             
              <?php
                  
              }
            ?>
             
                 <?php 
       if(isset($_POST['update_dis'])){
         $med_id=$_POST['med_id'];
         $med_dis=$_POST['med_dis'];
         $t_num=count($med_id);
         for($i=0; $i<$t_num; $i++){
             
            $db->where('dis_id',$med_id[$i]);
            $up_arr=array("description"=>$med_dis[$i]);
            $db->update('medicine_description',$up_arr);

             
         }
           
       }
       
       ?>
                                      
            <div class="select-box" style="padding-bottom: 10px;">
            
            
             
            </div>
       
       
           
              
                    
        <div class="row">
            
        <form method="POST" action="" >
          <?php 
          $a= new crud();
          $med_id=$_REQUEST['mi'];
          
          $db->where('med_id',$med_id);
          $med_des=$db->get('medicine_description');
          
          
          foreach($med_des as $data1)
          {
          ?>
         <input name="med_id[]" value="<?php echo $data1['dis_id']; ?>" style="display:none;" >
        
        <div class="col-md-2">
        <a onclick="myFunction('<?php echo $data1['dis_id']; ?>' )" class="btn btn-danger" style="height: 34px;"><i class="fa fa-trash" style="margin-top: 4px;"></i></a>
            
        </div>
        
        <div class="col-md-10">
            <div class="form-group">
             <input class="test form-control tt" name="med_dis[]" type="text" cols="50" rows="auto" value="<?php echo $data1['description']; ?>" style="font-weight: bold;color:black;height:40px;font-size: 14px;" dir="rtl">
            </div>
            
        </div>
        
           <?php
                  
              }
            ?>
        <div class="col-md-12">
            <div class="text-center">
              <button type="submit" class="btn btn-success" name="update_dis" >Update Description</button>  
            </div>
            
        </div>
            
        
        
        
        </form>               
            
                           
                                   
                                
                
          
        </div>
       

            
            

        </div>
    </div>
 <script>
    
       
        
  var i=1;
  var d=1;

$(document).ready(function() {
        $('.description').hide();
    

       
        $('#addButton').click(function() {   
            $('.new').append("<div class='prec"+ i +" del'><div class='row'><div class='form-group'><input  class='test form-control tt' name='urdu[]' type='text' cols='50' rows='auto' dir='rtl' style='color:black;font-weight:bold;font-size:18px;font-family: 'Noto Naskh Arabic', serif;height:auto;'></input></div></div></div>");
            $('.description'+d+'').hide();
            i++;
            d++;
            myFunction();
         
          callarea();
        });
        
         $('#removeButton').click(function() {
            $('.del ').last().remove();   

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
     });

    </script>
 
   


  
    <?php
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


window.location = "view_med_description.php?di="+clicked_id; 

} else {


}

}
</script>
</body>

</html>




             