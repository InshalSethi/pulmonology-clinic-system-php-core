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
                    <h1 class="page-header">Lab Test Revenue</h1>
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
                                            <th>Test Name</th>
                                            <th>Date</th>
                                            <th>Fee</th>
                                            
                                          
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                       <?php
                          
                            if(isset($_POST['submit']))
                            {  
                            $grand_total=0;
                            $frm = $_POST["From"];
                            $to  = $_POST["to"];
                            $db->join("total_checkup tc", "tc.checkup_id=tp.checkup_id", "LEFT");
                            $db->where ('tp.test_price','', "!=");
                            $db->where('tc.checkup_date', Array ($frm, $to), 'BETWEEN');
                            $testdetail = $db->get ("total_patient_test tp", null, "tp.test_name, tp.test_price,tc.checkup_date");
                            
                            foreach($testdetail as $td) 
                             
                             {
                                 $grand_total+=$td['test_price'];
                            ?><tr class="odd gradeX">
                                    <td><?php  echo $td['test_name']; ?></td>
                                    <td><?php  echo $td['checkup_date']; ?></td>
                                    <td><?php  echo $td['test_price']; ?></td>
                                    
                                    
                                 </tr>
                                 
                                 
                           
                        <?php         
                            
                             }
                             }
                            
                        else {  
                            $grand_total=0;
                            
                            $db->join("total_checkup tc", "tc.checkup_id=tp.checkup_id", "LEFT");
                            $db->where ('tp.test_price','', "!=");
                            $testdetail = $db->get ("total_patient_test tp", null, "tp.test_name, tp.test_price,tc.checkup_date");
                            
                            
                            foreach($testdetail as $td)
                            {
                                  
                             ?>
                            <tr class="odd gradeX">
                            <td><?php  echo $td['test_name']; ?></td>
                            <td><?php  echo $td['checkup_date']; ?></td>
                            <td><?php  echo $td['test_price']; ?></td>
                           
                            </tr>
                                             
                                       <?php
                                       $grand_total+=$td['test_price'];
                            } 
                            }
                                       ?>
                            <tr class="odd gradeX">
                            <td> Grand Total</td>
                            <td></td>
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