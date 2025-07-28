<?php
include '../include/config_new.php'; 

        // $x=$_REQUEST['pd'];
        // $pat_id=decode($x);
        // $y=$_REQUEST['cd'];
        // $checkup_id=decode($y);   

  
   
 if (isset($_POST['add_medicine'])) {
         $a= new crud();
        

       

   
          $eng_prec = $_POST['eng'];
          $urdu_prec = $_POST['urdu'];
         // $special_des = $_POST['desc'];

          //$cou1 = count($special_des);
           $cou = count($eng_prec);
         


       
         
      
         
          for ($i=0; $i <$cou ; $i++) 
          { 
            $flag = 0;

         // $med_rec=array('',$pat_id,$checkup_id,$eng_prec[$i],$urdu_prec[$i],$special_des[$i]);
         // $a->insert('current_patient_medicine',$med_rec,null);

          $data=$a->select('impression_suggest','impression_word','','');

           // check duplicate word
           if (mysqli_num_rows($data) > 0)
            {
            
            while($row = mysqli_fetch_assoc($data)) 
            {
            if($eng_prec[$i]  == $row["impression_word"])
            {
                     $flag = 1;


            } 
            
            }


        } 

 // if the word new enter in table of word sugesstion
        if(  $flag == 0)
        {
            $ins=array('',$eng_prec[$i]);
            $a->insert('impression_suggest',$ins,null);

        }

        }

        header("LOCATION:view_all_impression.php");
    }

// if (isset($_POST['call_patient'])) {
//      $k=new crud();
//      $p_id=$_POST['paitent_id'];
//     // echo "----------".$p_id;
     
//      $where=array("p_id=$p_id");
//      $upd=array('p_status'=>"1");
//      $k->update('current_checkup',$upd,$where);
//  } 
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
    <title>Add New Impression</title>
    <script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
    <script src="../js/yauk.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notonaskharabic.css">
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/jameelkhushkhati-ttf" type="text/css"/>

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
        font-family: 'JameelKhushkhatiRegular'; 
        font-size: 21px;
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
            <h1> Add Impression As Administrator </h1>
            
            
            <h1 id="demo">  </h1>
             
                                      
            <div class="select-box" style="padding-bottom: 10px;">
            
                <button class="btn btn-primary" id='addButton'><i class="fa fa-plus" style="padding-right: 3px;"></i>Add Test</button>
                <!-- <input type='button' class="btn btn-primary" value='Add Button'> -->
                <button class="btn btn-danger" id='removeButton'><i class="fa fa-trash" style="padding-right: 3px;" aria-hidden="true"></i>Delete</button>

                <!--  <input type='button' class="btn btn-danger" value='Remove Button' id='removeButton'> -->
             
            </div>
       
       
            <form action="" method="POST">
              
                    <div class="new">
                    <div class="prec">
                    <div class="row">
                     
                           
                                    <div class="form-group col-md-6" style="padding-left: 14px; ">
                                        <input id="" name="eng[]"type="text" class="form-control medicine" cols="50" rows="auto" style="font-weight: bold;color:black;height:auto;font-size: 18px;"></input>
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
            $('.new').append("<div class='prec"+ i +" del'><div class='row'><div class='form-group col-md-6' style='padding-left: 14px; '><input name=eng[] type='text' class='form-control col-md-6 medicine' cols='50' rows='auto' style='font-weight: bold;color:black;height:auto;font-size: 18px;'></input></div></div></div>");
            $('.description'+d+'').hide();
            i++;
            d++;
            myFunction();
          autocompletecall();
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
        source: 'impression_sugguest.php'
    });
 });


 function autocompletecall() {
           

        
    $( ".medicine" ).autocomplete({
        source: 'impression_sugguest.php'
          });
      


        }

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



             