<?php
include '../include/config_new.php'; 
 $a = new crud();
if (isset($_POST['save_expanses']))

{
    $detail = $_POST['detail'];
    $price = $_POST['price'];
    date_default_timezone_set("Asia/Karachi");
    $today_date=date("Y/m/d");
    $cou=count($detail);
    for ($i=0; $i <$cou ; $i++) 
    {  
        $exp_ins=array('',$detail[$i],$price[$i],$today_date);
        $a->insert('expense_detail',$exp_ins,null);
    }
    header("LOCATION:expanse_detail.php");

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

    <title>Doctor | Add Expenses</title>


     <?php
    include 'lib.php';
    include '../include/auth.php';
    ?>
     <script src="bmi.js"></script>
  


</head>

<body>

    <div id="wrapper">
        

        <!-- Navigation -->
         <?php include 'sidebardoc.php'; ?>
       
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Add Expenses</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
            <div class="col-lg-12 col-sm-12">
            <div class="card cardappoint card-topline-yellow ">
            <!--<div class="card-head card-headappoint ">-->
            <!--<h2 class="text-center">Add Expenses</h2>-->
            <!--</div>-->
            <style>
            .setwidth
            {
                width: 95%;
            }
            .main{
                margin-top: 10px;
            }
                
            </style>
            <div class="card-body card-bodystyle">
                <div class="row">
                    <div class="col-lg-12">
                        <button class="btn btn-primary" id='addButton' onclick="add_expense()"><i class="fa fa-plus" style="padding-right: 3px;"></i>Add More</button>
                <button class="btn btn-danger" onclick="remove_expense()" id='removeButton'><i class="fa fa-trash" style="padding-right: 3px;" aria-hidden="true"></i>Remove</button>
                        <div action="#" id="form_sample_1" class="form-horizontal" novalidate="novalidate">
                            <form action="" method="POST" name="bmiForm">
                    
                    <div class="main">
                        <div class="row">
                            
                        
                        <div class="col-md-6 ">
                    <div class="form-group">
                        <textarea class="form-control setwidth" type="text" name="detail[]" id="" placeholder="Expenses Detail" required></textarea>
                    </div>
                    </div>
                    
                     <div class="col-md-6 ">
                    <div class="form-group">
                        <input class="form-control setwidth" type="text" name="price[]" id="" placeholder="Amount" required>
                    </div>
                    </div>
                    </div>
                    </div>
                    <div class="new_main">
                        
                    </div>
                    <button type="submit" name="save_expanses" class="btn btn-success" >Save Expenses</button>
                    </form>

                </div>


                                </div>
                                <!-- /.row (nested) -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->
        <form name="bmiFor">

        </form>


        <?php
    include 'jslib.php';
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
    <script type="text/javascript">
	

	 function add_expense()
     {
    
    $(".new_main").append(" <div class='main'><div class='row'><div class='col-md-6'><div class='form-group'><textarea class='form-control setwidth' type='text' name='detail[]' id='' placeholder='Expenses Detail' required></textarea></div></div><div class='col-md-6'><div class='form-group'><input class='form-control setwidth' type='text' name='price[]' id='' placeholder='Amount' required></div></div></div></div>");
   
         
     }
      function remove_expense(){
          $('.main').last().remove();
         
     }
</script>
    <script>
    $(":input").inputmask();

   </script>
       


</body>

</html>