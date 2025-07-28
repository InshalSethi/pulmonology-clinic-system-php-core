<?php
include '../include/config_new.php';
$a = new crud();
$x=$_REQUEST['pd'];
$y=$_REQUEST['ld'];
$pat_id=decode($x);

$current_checkup=decode($y);
if (isset($_POST['save_data1']))
{
    $dr_fee=$_POST['dr_fee']; 


    $pay1=$a->select('current_patient cp INNER JOIN current_checkup ch ON(cp.p_id=ch.p_id) INNER JOIN current_patient_test ct ON(cp.p_id=ct.p_id) ','cp.*,ch.*,ct.*',"ct.p_id=$pat_id AND ch.checkup_id=$current_checkup AND ct.test_price=0",'');
     while ($yb =$pay1->fetch_array()) {
         
    $test_id=$yb['test_id'];
         
    $array_test_array[] =  $test_id ; 
        

         }
     $cou =  count( $_POST['test_price']);
         
     $test_price = $_POST['test_price'];

  
       for($i=0; $i < $cou ; $i++){
             
        $test_id  =  $array_test_array[$i] ;
        $wh=array("p_id=$pat_id AND test_id=$test_id");
        $upd=array('test_price'=>"$test_price[$i]");
                       
        $a->update('current_patient_test',$upd,$wh);


    }
    
     $where=array("p_id=$pat_id AND checkup_id=$current_checkup");
     $update=array('rec_fee'=>"$dr_fee");
     $a->update('current_checkup',$update,$where);
    
        
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

    <title>Reception | Add Petient</title>

     <?php
     include 'lib.php';
    include '../include/auth.php';
    ?>
<script >
  $(document).ready(function() {
    //this calculates values automatically 
    calculateSum();

    $(".txt").on("keydown keyup", function() {
        calculateSum();
    });
});

function calculateSum() {
    var sum = 0;
    //iterate through each textboxes and add the values
    $(".txt").each(function() {
        //add only if the value is number
        if (!isNaN(this.value) && this.value.length != 0) {
            sum += parseFloat(this.value);
            $(this).css("background-color", "#FEFFB0");
        }
        else if (this.value.length != 0){
            $(this).css("background-color", "red");
        }
    });

    $("input#sum1").val(sum.toFixed(2));
}
</script>

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

                         <input class="form-control txt" onkeyup="calculateSum()" type="text" name="dr_fee" value=" " required/>

                         </div>
                             
                       
                         
                         <?php 
                        
                         $pay=$a->select('current_patient cp INNER JOIN current_checkup ch ON(cp.p_id=ch.p_id) INNER JOIN current_patient_test ct ON(cp.p_id=ct.p_id) ','cp.*,ch.*,ct.*',"ct.p_id=$pat_id",'');
                       
                                 while ($ab =$pay->fetch_array()) {
                                   $hanby = $ab['test_price'];
                                    if($hanby == 0){
                           ?>
                                     <div class="form-group">
                                             <span class="inline">
                                       <input class="inputbold " type="text" name="test_name" value="<?php echo $ab['test_name']; ?>" placeholder="test_name" />     
                                       <input class="inputbold  txt" type="text" onkeyup="calculateSum()" name="test_price[]" placeholder="Price"/>
                                       </span>
                                       </div>
                                   <?php
                                   }   }
                                    ?>
                                 
                               <div class='form-group'>Lab Total <input class='form-control' type='text' id='sum1' name="input" readonly></div>
                                            
                                             
                 <button type="submit" class="btn btn-success" name="save_data1">Save</button>
                    </form>
                </div>
            </div>
            <!-- /#page-wrapper -->

        </div>
        <script src="../js/jquery.min.js"></script>   <!-- jQuery -->

        


            <?php
    include 'jslib.php';
    ?>


</body>

</html>