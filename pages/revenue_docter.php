<?php
include '../include/config_new.php';
include '../include/MysqliDb.php';
include '../include/config.php';
    
    $a= new crud();
 

  
    
                                           

?>

                                        



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Doctor  |  Doctor Fee Revenue</title>

   <?php
     include 'lib.php';
     include '../include/auth.php';
     ?>
     
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css"/>
   
   
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php
       include 'sidebardoc.php';
       ?>
       
      

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Doctor Fee Revenue</h1>
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
            
             <div class="col-md-2" style="float:right;">
                        <button class="btn"  name="get_pdf" id="get_pdf" ><i class="fa fa-file-pdf-o"></i> Get Pdf</button>
                    
                     
                    </div>
            </div>
                    
            </form>
            <!-- /.row -->
            
            <!---->
           

            <!-- /.row ////-->
            <div class="row" style="margin-top: 40px;">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="color: white;     background: linear-gradient(120deg, #5983e8, #5983e8);">
                            Revenue Detail Table
                        </div>
                        
            
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Patient Name</th>
                                            <th>Address</th>
                                            <th>Date</th>
                                            <th>Charity</th>
                                            <th>Fee</th>
                                            
                                          
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                       <?php
                           $a= new crud();
                            if(isset($_POST['submit']))
                            {  
                            $grand_total=0;
                            $charity=0;
                             $frm = $_POST["From"];
                             $to  = $_POST["to"];
                             $expense=0;
                             
                             $exp_dur=$a->select('expense_detail','price',"date BETWEEN  '".$frm."' AND  '".$to."'",'');  
                             while ($exp_d =$exp_dur->fetch_array())  
                             
                             {
                              $expense+=$exp_d['price'];   
                             }
                             
                             
                             $all_exp=$a->select('total_patient tp INNER JOIN total_checkup tc ON(tp.p_id=tc.p_id)','tp.p_name,tp.address,tc.checkup_date,tc.rec_fee,tc.charity',"checkup_date BETWEEN  '".$frm."' AND  '".$to."'",'');  
                             while ($data =$all_exp->fetch_array())  
                             
                             {
                                 $grand_total+=$data['rec_fee'];
                                 $charity+=$data['charity'];
                            ?><tr class="odd gradeX">
                                    <td><?php  echo $data['p_name']; ?></td>
                                    <td><?php  echo $data['address']; ?></td>
                                    
                                    <td><?php  echo $data['checkup_date']; ?></td>
                                    <td><?php  echo $data['charity']; ?></td>
                                    <td><?php  echo $data['rec_fee']; ?></td>
                                    
                                 </tr>
                                 
                                 
                           
                        <?php         
                            
                             }
                             }
                            
                        else {          
                           $grand_total=0;
                           $charity=0;
                           $expense=0;
                           
                           
                            $exp_recored=$a->select('expense_detail','price','','');
                                    
                            while ($exp =$exp_recored->fetch_array()) {
                              $expense+=$exp['price'];  
                            }
                           
                            $recored=$a->select('total_patient tp INNER JOIN total_checkup tc ON(tp.p_id=tc.p_id)','tp.p_name,tp.address,tc.checkup_date,tc.rec_fee,tc.charity','','');
                                    
                              while ($exp_data =$recored->fetch_array()) {
                                  
                             ?>
                            <tr class="odd gradeX">
                                         

                                            <td><?php  echo $exp_data['p_name']; ?></td>
                                            <td><?php  echo $exp_data['address']; ?></td>
                                            <td><?php  echo $exp_data['checkup_date']; ?></td>
                                            <td><?php  if ($exp_data['charity'] == NULL) { echo "0";} else { echo $exp_data['charity']; } ?></td>
                                            <td><?php  echo $exp_data['rec_fee']; ?></td>
                                            
                                            </tr>
                                             
                                       <?php
                                       $grand_total+=$exp_data['rec_fee'];
                                       $charity+=$exp_data['charity'];
                                       } 
                            }
                                       ?>
                                         <tr class="odd gradeX">
                                <td> Grand Total</td>
                                <td></td>
                                <td></td>
                                <td><?php echo $charity;  ?></td>
                                <td><?php echo $grand_total; ?></td>
                            </tr>
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
            
            <div class="row">
            <div class="col-md-4">
                <labale><b>Grand Total</b></labale>
                <input type="text" value="<?php echo $grand_total; ?>" class="form-control" readonly> 
            </div>
            <div class="col-md-4">
                  <labale><b>Grand Charity</b></labale>
                <input type="text" value="<?php echo $charity; ?>" class="form-control" readonly>
            </div> 
            
            <div class="col-md-4">
            <labale><b>Total Expense</b></labale>
            <input type="text" value="<?php echo $expense; ?>" class="form-control" readonly>
            </div>
            <div class="col-md-4">
            <labale><b>Net Profit</b></labale>
            <input type="text" value="<?php echo $pro=$grand_total- $charity-$expense; ?>" class="form-control" readonly>
            </div>
                
            </div>

            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
<script src="https://unpkg.com/jspdf@1.5.3/dist/jspdf.min.js"></script>
<script src="https://unpkg.com/jspdf-autotable@3.0.13/dist/jspdf.plugin.autotable.js"></script>
 
  <?php
 include 'jslib.php';
 ?>
   <script>
    var doc = new jsPDF();
    // You can use html:
    doc.autoTable({
        html: '#dataTables-example',
        margin: {top: 25},
        didDrawPage: function(data) {
            doc.setFontSize(20);
            doc.text('Revenue From Doctor Fee', data.settings.margin.left, 20);
        }
    });
    $("#get_pdf").click(function(){
     doc.save('docter_revenue.pdf');
    });
    
   
</script>   
    
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
                "filter": true,
                "order": []
            });
            
        });
    </script>
</body>

</html>