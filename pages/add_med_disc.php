<?php
include '../include/config_new.php';
include '../include/MysqliDb.php';
include '../include/config.php'; 
   
 if (isset($_POST['add_medicine'])) {
         $a= new crud();
         $med_id = $_POST['medi_id'];
         $urdu_prec = $_POST['urdu'];
         $cou = count($urdu_prec);
         
        for ($i=0; $i <$cou ; $i++) 
        { 
            
            
        $med_des_arr=array("med_id"=>$med_id,"description"=>$urdu_prec[$i] );
        $db->insert('medicine_description',$med_des_arr);

         
        }

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
    <title>Doctor | Add Urdu Description</title>
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
            <h1> Add Medicine Urdu Description</h1>
            
            
            <h1 id="demo">  </h1>
            <?php 
              $a= new crud();
              $med_id=$_REQUEST['mi'];
              $recored=$a->select('medicine_suggestion','medi_name',"med_id=$med_id",'');
              while ($data =$recored->fetch_array())
              {
              ?>
              <h2 style="color: #e10c16;"><?php echo $data['medi_name']; ?></h2>
                
                
                
                  
              <?php
                  
              }
            ?>
             
                                      
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
                        <input name="medi_id" value="<?php echo $med_id; ?>" style="display:none;"></input>
                     
                           
                                   
                                
                        <div class="form-group">
                            <input  class="test form-control tt" name="urdu[]" type="text" cols="50" rows="auto" dir="rtl" style="font-weight: bold;color:black;height:45px;font-size: 14px;"></input>
                        </div>
                                    
                        </div>
                       
                      
                       
                      
                     

                    

                </div>
                </div>

                <button type="submit" name="add_medicine" class="btn btn-success "> Save</button>
            </form>

        </div>
    </div>
 <script>
    
       
        
  var i=1;
  var d=1;

$(document).ready(function() {
        $('.description').hide();
    

       
        $('#addButton').click(function() {   
            $('.new').append("<div class='prec"+ i +" del'><div class='row'><div class='form-group'><input  class='test form-control tt' name='urdu[]' type='text' cols='50' rows='auto' dir='rtl' style='color:black;font-weight:bold;font-size:14px;height:45px;'></input></div></div></div>");
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
  <script>
      var txt = $('#special_dis'),
    hiddenDiv = $(document.createElement('div')),
    content = null;

txt.addClass('txtstuff');
hiddenDiv.addClass('hiddendiv common');

$('body').append(hiddenDiv);

txt.on('keyup', function () {

    content = $(this).val();

    content = content.replace(/\n/g, '<br>');
    hiddenDiv.html(content + '<br class="lbr">');

    $(this).css('height', hiddenDiv.height());

});
  </script>
<script>
 function callarea()
 {
     var txt = $('#special_dis'),
    hiddenDiv = $(document.createElement('div')),
    content = null;

txt.addClass('txtstuff');
hiddenDiv.addClass('hiddendiv common');

$('body').append(hiddenDiv);

txt.on('keyup', function () {

    content = $(this).val();

    content = content.replace(/\n/g, '<br>');
    hiddenDiv.html(content + '<br class="lbr">');

    $(this).css('height', hiddenDiv.height());

});
 }
 
 $(function() {
    $( ".medicine" ).autocomplete({
        source: 'autocomplete.php'
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
</body>

</html>
<!--var x = $('input').get(1);
            $(x).text(x.innerHTML);-->



             