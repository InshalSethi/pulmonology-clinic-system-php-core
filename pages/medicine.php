<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Add Medicine</title>
    <script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
    <script src="../js/yauk.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notonaskharabic.css" media="screen, print">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

<?php
include 'lib.php';
include '../include/auth.php';
?> 
<style>
    @media print{
   .noprint{
       visibility: hidden;
      
   }
}
</style>
</head>

<body>
    <div id="wrapper" >
        
      
        
        <?php
      include 'sidebardoc.php';
      ?>
   
   
        <div id="page-wrapper" style="padding-top: 28px;">
               <div class="noprint">
                    <button onclick="goBack()" class="btn "  style="float: right;margin-right: 16px; margin-top: 4%;"> <i class="fa fa-arrow-circle-left" style="font-size:30px;   color:red;"></i></button>
               </div>
            <div class="container">
                
                <div class="text-center">
                   
                    <img src="../img/logo.png" style="width: 570px;height: 220px;"></div>
            </div>
            <div class="row">
                 
                <div class="col-md-12">
                    <div>
                        <h4>Date</h4>
                        <p>03/09/18</p>
                        <h4>Name</h4>
                        <p>Ali</p>
                        <h4>Phone No#</h4>
                        <p>0300-0000000</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h3>Covaltec</h3>
                </div>
                <div class="col-md-6">
                    <h3>ایک گولی صبح کھانے کے بعد</h3>
                </div>



            </div>
            <div class="text-center noprint" style="padding-top: 30px;"> <button class="btn btn-primary">Print</button></div>

        </div>
    </div>

    <script>
        var row = $('#row-container .row:eq(0)').clone(true);
        $('#addButton').data('row', row);
        $('#addButton').click(function() {
            $('#row-container').append($(this).data('row').clone(true));
            myFunction();
        });
        $('#removeButton').click(function() {
            $('#row-container .row').eq($('#row-container .row').length - 1).remove();
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
    </script>


   <?php
   include 'jslib.php'; 
   ?>
 <script src="back.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>
</body>

</html>
<!--var x = $('textarea').get(1);
            $(x).text(x.innerHTML);-->