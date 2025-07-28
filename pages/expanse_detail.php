<?php
include '../include/config_new.php';
    
    $a= new crud();
    $x=$_REQUEST['ei'];
    $a->delete('expense_detail',"ex_id=$x");

  
    
                                           

?>

                                        



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Doctor | Expenses Detail</title>

    <?php
    include 'lib.php';
 include '../include/auth.php';
    ?>
     
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css"/>
   
   
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'sidebardoc.php'; ?>
       
      

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Expenses Detail</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <form  method="post" action=""> 
            <div style="margin-top:0px;">
            <div class="col-md-2">
            <input type="text" name="From" id="From" class="form-control" autocomplete="off" placeholder="From Date"/>
            </div>
            
            
            <div class="col-md-2">
            <input type="text" name="to" id="to" class="form-control" autocomplete="off" placeholder="To Date"/>
            </div>
            
            
            <div class="col-md-2">
            <input type="submit" name="submit" value="Check Revenue" class="btn btn-success">
             
            </div>
            </div>
                    
            </form>
            <!-- /.row -->
            
            <!---->
           

            <!-- /.row ////-->
            <div class="row" style="margin-top:40px;">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="color: white; background: linear-gradient(120deg, #5983e8, #5983e8);">
                            Expenses Detail Table
                        </div>
                        
            
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID #</th>
                                            <th>Detail</th>
                                            <th>Price</th>
                                            <th>Date</th>
                                            
                                          
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                       <?php
                           $a= new crud();
                            if(isset($_POST['submit']))
                            {  
                            $grand_total=0;
                             $frm = $_POST["From"];
                             $to  = $_POST["to"];
                             $all_exp=$a->select('expense_detail','*',"date BETWEEN  '".$frm."' AND  '".$to."'",'');  
                             while ($data =$all_exp->fetch_array())  
                             
                             {
                                 $grand_total+=$data['price'];
                            ?><tr class="odd gradeX">
                                    <td><?php  echo $data['ex_id']; ?></td>
                                            <td><?php  echo $data['detail']; ?></td>
                                            <td><?php  echo $data['price']; ?></td>
                                            <td><?php  echo $data['date']; ?></td>
                                            <td>
                                            <a href="expanse_detail.php?ei=<?php  echo $exp_data['ex_id']; ?>"><i class="fa fa-trash-o"></i> </a>
                                            </td>
                                 </tr>
                                 
                                 
                           
                        <?php         
                            
                             }
                             }
                            
                        else {          
                           $grand_total=0;
                            $recored=$a->select('expense_detail','*','','');
                                    
                              while ($exp_data =$recored->fetch_array()) {
                                  
                             ?>
                            <tr class="odd gradeX">
                                         

                                            <td><?php  echo $exp_data['ex_id']; ?></td>
                                            <td><?php  echo $exp_data['detail']; ?></td>
                                            <td><?php  echo $exp_data['price']; ?></td>
                                            <td><?php  echo $exp_data['date']; ?></td>
                                            <td>
                                                <div class="text-center">
                                            <a class="btn btn-danger btn-circle" href="expanse_detail.php?ei=<?php  echo $exp_data['ex_id']; ?>"><i class="fa fa-trash-o"></i> </a>
                                            </div>
                                            </td>
                                            </tr>
                                             
                                       <?php
                                       $grand_total+=$exp_data['price'];
                                       } 
                            }
                                       ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="input-group">
                <labale><b>Grand Total</b></labale>
                <input type="text" value="<?php echo $grand_total; ?>" class="form-control" readonly>
                
                
            </div>
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
 
  <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../js/metisMenu.min.js"></script>


    <!-- Custom Theme JavaScript -->
    <script src="../js/startmin.js"></script>
    <!-- DataTables JavaScript -->
    <script src="../js/dataTables/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables/dataTables.bootstrap.min.js"></script>
    <script>

$(document).ready(function(){
	$.datepicker.setDefaults({
		dateFormat: 'yy-mm-dd'
	});
	$(function(){
		$("#From").datepicker();
		$("#to").datepicker();
	});
	$('#range').click(function(){
		var From = $('#From').val();
		var to = $('#to').val();
		if(From != '' && to != '')
		{
			$.ajax({
				url:"range.php",
				method:"POST",
				data:{From:From, to:to},
				success:function(data)
				{
					$('#purchase_order').html(data);
				}
			});
		}
		else
		{
			alert("Please Select the Date");
		}
	});
});  
</script>
   
    
   
    

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
              
                responsive: true,
                "filter": true
            });
            
        });
    </script>
</body>

</html>