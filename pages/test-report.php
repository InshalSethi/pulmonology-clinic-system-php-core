<?php
include '../include/config_new.php'; 

        $x=$_REQUEST['pd'];
        $pat_id=decode($x);
        $y=$_REQUEST['cd'];
        $checkup_id=decode($y);   

  
   
 if (isset($_POST['add_medicine'])) {
         $a= new crud();
        

       

   
          $eng_prec = $_POST['eng'];
          $urdu_prec = $_POST['urdu'];
          $special_des = $_POST['desc'];

          //$cou1 = count($special_des);
           $cou = count($eng_prec);
         


       
         
      
         
          for ($i=0; $i <$cou ; $i++) 
          { 
            $flag = 0;

          $med_rec=array('',$pat_id,$checkup_id,$eng_prec[$i],$urdu_prec[$i],$special_des[$i]);
          $a->insert('current_patient_medicine',$med_rec,null);

          $data=$a->select('medicine_suggestion','medi_name','','');

           // check duplicate word
           if (mysqli_num_rows($data) > 0)
            {
            
            while($row = mysqli_fetch_assoc($data)) 
            {
            if($eng_prec[$i]  == $row["medi_name"])
            {
                     $flag = 1;


            } 
            
            }


        } 

 // if the word new enter in table of word sugesstion
        if(  $flag == 0)
        {
            $ins=array('',$eng_prec[$i]);
            $a->insert('medicine_suggestion',$ins,null);

        }


             
          
         
           
           
           

        }

        header("LOCATION:print.php?pd=$x");
    }

if (isset($_POST['call_patient'])) {
     $k=new crud();
     $p_id=$_POST['paitent_id'];
    // echo "----------".$p_id;
     
     $where=array("p_id=$p_id");
     $upd=array('p_status'=>"1");
     $k->update('current_checkup',$upd,$where);
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
    <title>Add Medicine</title>
    <script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
    <script src="../js/yauk.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notonaskharabic.css">

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

<body>
    <div id="wrapper">
      <?php
       include 'sidebardoc.php';
       ?>
        <div id="page-wrapper" style="padding-top: 28px; overflow-x: hidden;">
             <button onclick="goBack()" class="btn"  style="float: right;margin-right: 16px; margin-top: 4%;"> <i class="fa fa-arrow-circle-left" style="font-size:30px;   color:red;"></i></button>
            <div class="container">
                <div class="text-center">
                    <img src="../img/logo.jpg" style="width: 570px;height: 220px;"></div>
            </div>
            <h4> Name : <strong>Rafiq Sethi</strong> </h4>
           
            <h4>Phone : <strong>03346261998</strong></h4> 
           
            <h4>Address : <strong>G-Block, Vehari</strong></h4>
            
            <h4>Date : <strong>17-10-2018</strong></h4>

  <div class="col-md-12">
                    <div class="card cardappoint card-topline-yellow ">
                        
                        <div class="card-body card-bodystyle">
                            <style>
                                /*.ad-inline{*/
                                /*    display:inline;*/
                                /*}*/
                                .ad-left{
                                    float:left;
                                    padding-right:15%;
                                }
                                .ad-right{
                                    float:right;
                                }
                            </style>
                            <div class="row">
                             <div class="col-md-4">
                                 <h4 class="ad-left">Copper </h4>
                             </div>
                              <div class="col-md-4">
                                 <h4 class="text-center">Result</h4> 
                             </div>
                              <div class="col-md-4">
                                 <h4 class="ad-right">70-150 μg/dl</h4>
                             </div>
                            </div>
                             <div class="row">
                             <div class="col-md-4">
                                 <h4 class="ad-left">Copper </h4>
                             </div>
                              <div class="col-md-4">
                                 <h4 class="text-center">Result</h4> 
                             </div>
                              <div class="col-md-4">
                                 <h4 class="ad-right">70-150 μg/dl</h4>
                             </div>
                            </div>
                             <div class="row">
                             <div class="col-md-4">
                                 <h4 class="ad-left">Copper </h4>
                             </div>
                              <div class="col-md-4">
                                 <h4 class="text-center">Result</h4> 
                             </div>
                              <div class="col-md-4">
                                 <h4 class="ad-inline ad-right">70-150 μg/dl</h4>
                             </div>
                            </div>
           
            
            
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>

                </div>
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



             