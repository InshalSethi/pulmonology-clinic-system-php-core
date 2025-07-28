<?php
include '../include/config_new.php';
   $b= new crud();
if (isset($_POST['call_patient'])) {
     $p_id=$_REQUEST['doc'];
     $v=decode($p_id);
    // echo "----------".$p_id;
     
     $where=array("p_id=$v");
    
     $upd=array('p_status'=>"1");
     
     $b->update('current_checkup',$upd,$where);
 }
if(isset($_POST['save_recored']))
{
    $a= new crud();
    
     $pat_id=$_POST['pat_id'];
     $checkup_id=$_POST['checkup_id'];

     $x=encode($pat_id);
     $y=encode($checkup_id);
   
    


    $hpi=$_POST['hpi'];
    $impression=$_POST['impression'];

    
    
    

   
    


     // insert the recored against the checkup_patient
     $where=array("p_id=$pat_id");
    $update = array('hpi'=>"$hpi",'impression'=>"$impression");
    $a->update('current_checkup',$update,$where);
    
    
    
     ////////////////////////insert impression into database///////////////
    
    $impression_insert =explode(",",$_POST['impression']);
    foreach ( $impression_insert  as $new_impression) 
    {    
        $flag_imp = 0;
        $data_imp=$a->select('impression_suggest','impression_word','','');
        $new_impression = trim($new_impression);
        if (empty($new_impression)) {
            continue;
        }
          

          // check duplicate word
           if (mysqli_num_rows($data_imp) > 0)
            {
            
            while($row = mysqli_fetch_assoc($data_imp)) 
            {
            if($new_impression  == $row["impression_word"])
            {
                     $flag_imp = 1;

            } 
            
            }


        } 

 // if the word new enter in table of word sugesstion
        if(  $flag_imp == 0)
        {
            $ins_imp=array('',$new_impression);
            $a->insert('impression_suggest',$ins_imp,null);

             
        }
           


     }



    

   // for indoor lab test auto suggestion of word //////////////////////////////
    $inhouse = $_POST['inhouse_test'];
    if (empty($inhouse)) {
        header("LOCATION:precept1.php?pd=$x&cd=$y");

   
    }
    else{

         $inhouse =explode(",",$_POST['inhouse_test']);
    foreach ( $inhouse  as $lab_test) 
    {    
        $flag = 0;
        $data=$a->select('lab_test','test_name','','');
        $lab_test = trim($lab_test);
        if (empty($lab_test)) {
            continue;
        }

        // insert the data of patient lab test table
        $patient_test=array('',$pat_id,$checkup_id,$lab_test,'','','','','');
        $a->insert('current_patient_test',$patient_test,null);
        
        /////////////////////////////// lab assign to patient////////////
        $lab_assign=array('lab_assign'=>"1");
        $a->update('current_checkup',$lab_assign,$where);
          

          // check duplicate word
           if (mysqli_num_rows($data) > 0)
            {
            
            while($row = mysqli_fetch_assoc($data)) 
            {
            if($lab_test  == $row["test_name"])
            {
                     $flag = 1;

            } 
            
            }


        } 

 // if the word new enter in table of word sugesstion
        if(  $flag == 0)
        {
            $ins=array('',$lab_test);
            $a->insert('lab_test',$ins,null);

             
        }
           


     }
      $where=array("p_id=$pat_id");
     $upd=array('p_status'=>"2");
     $a->update('current_checkup',$upd,$where);

     header("LOCATION:index.php");



    }
   

      // for outdoor lab test auto suggestion of word /////////////////////////////////////
    $outdoor = $_POST['outdoor_test'];
    if (!empty($outdoor)) 
    {
    $outdoor =explode(",",$_POST['outdoor_test']);
    foreach ( $outdoor  as $outdoor_lab_test) 
    {    
        $flag = 0;
        $data=$a->select('outdoor_lab_test','test_name','','');
        $outdoor_lab_test = trim($outdoor_lab_test);
         if (empty($outdoor_lab_test)) {
            continue;
        }

        // insert the data of patient lab test table
        $patient_test=array('',$pat_id,$checkup_id,$outdoor_lab_test);
        $a->insert('current_patient_outdoor_test',$patient_test,null);
          

          // check duplicate word
           if (mysqli_num_rows($data) > 0)
            {
            
            while($row = mysqli_fetch_assoc($data)) 
            {
            if($outdoor_lab_test  == $row["test_name"])
            {
                     $flag = 1;

            } 
            
            }


        } 

 // if the word new enter in table of word sugesstion
        if(  $flag == 0)
        {
            $ins=array('',$outdoor_lab_test);
            $a->insert('outdoor_lab_test',$ins,null);

             
        }
           


     }

}

  // for outdoor lab test auto suggestion of word /////////////////////////////////////
    $rev_pre_med = $_POST['rev_pre_med'];
    if (!empty($rev_pre_med)) 
    {
    $rev_pre_med =explode(",",$_POST['rev_pre_med']);
    foreach ( $rev_pre_med  as $med_term) 
    {    
        $flag = 0;
        $data=$a->select('medication_term','med_term','','');
        $med_term = trim($med_term);
         if (empty($med_term)) {
            continue;
        }
        // check duplicate word
           if (mysqli_num_rows($data) > 0)
            {
            
            while($row = mysqli_fetch_assoc($data)) 
            {
            if($med_term  == $row["med_term"])
            {
                     $flag = 1;

            } 
            
            }


        } 

 // if the word new enter in table of word sugesstion
        if(  $flag == 0)
        {
            $ins=array('',$med_term);
            $a->insert('medication_term',$ins,null);

             
        }
           


     }

}
       
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

    <title>Doctor | Patient Info</title>

    <!-- Bootstrap Core CSS -->
  
    <?php
 include 'lib.php';
 include '../include/auth.php';
 ?>

    <link rel="canonical" href="https://github.com/dbrekalo/fastselect/" />
   

    <!-- For Multipile selector-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="word_suggestion.js"></script>

  





       



       


    <style>
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
        td {
            padding: 15px;
        }
        
        .td-left {
            word-break: break-all;
        }
        
        .textarea {
            width: 460px;
            min-height: 50px;
            
            border: 2px solid #eeeeee;
        }
        /*.fstElement { font-size: 1.2em; }*/
        
        .fstToggleBtn {
            min-width: 16.5em;
        }
        
        .submitBtn {
            display: none;
        }
        
        .fstMultipleMode {
            display: block;
        }
        
        .fstMultipleMode .fstControls {
            width: 100%;
        }
.listening{
    display:none;
    color: white;
    font-size: 17px;
    background-color: #00800099;
    padding: 0px 8px;
    
}

    </style>
  

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'sidebardoc.php'; ?>
     

        <div id="page-wrapper">
            <div class="row">
                  <?php
                                        $crud= new crud();
                                         $x=$_REQUEST['doc'];
                                         $pat_id=decode($x);
                                         $y=$_REQUEST['che'];
                                         $checkup_id=decode($y);

                                     
                                        $recored =$crud->select('current_patient p INNER JOIN current_checkup u ON(p.p_id=u.p_id)','p.*,u.*',"p.p_id=$pat_id",'');
                                       
                                       while($a=$recored->fetch_array())

                                        {?>
                <div class="col-lg-12">
                    <h1 class="page-header"> Patient Checkup</h1>
                    <h3 style="display:inline-block;color:green;"><?php echo $a['p_name'];  ?></h3>
                    <h3 style="float:right; display:inline-block;"><?php echo $a['contact']; ?></h3>
                     <form method="POST" action="">
                        <input type="text" name="paitent_id" value="<?php echo $a['p_id'];?>" style="display: none;">
                    <button type="submit" name="call_patient" type="button" class="btn btn-info">Call Patient</button>
                    </form>
                     <button onclick="goBack()" class="btn"  style="float: right;margin-right: 16px;"> <i class="fa fa-arrow-circle-left" style="font-size:30px;color:red;"></i></button>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
           
           
            <div class="row">
                <form action="" method="POST" name="bmiForm">
                <div class="col-md-4 ">
                    <div class="card cardappoint card-topline-yellow ">
                        <div class="card-head card-headappoint ">
                            <h2 class="text-center" style="margin-top: 11px;margin-bottom: 10px;">Add Patient Info</h2>
                        </div>
                        <div class="card-body card-bodystyle">



                             <div class="row">
                              
                                 
                                <div class="col-lg-12">
                                      

                                            <div action="#" id="form_sample_1" class="form-horizontal" novalidate="novalidate">

                                              <div class="form-group">
                                                <label>Patient name</label>
                                                <input class="form-control" type="text" name="name" value="" id="" placeholder="">

                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Phone No.</label>
                                                <input class="form-control" type="text" name="contact" value="" id="" placeholder="">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input class="form-control" type="text" name="address" value="" id="" placeholder="">
                                            </div>


                                            <div class="form-group">
                                                <label>Gender </label>
                                                <label class="checkbox-inline">
                                                        <input type="radio" name="gender" value="">Male
                                                    </label>
                                                <label class="checkbox-inline">
                                                        <input type="radio" name="gender" value="">Female
                                                    </label>
                                                <label class="checkbox-inline">
                                                  <input type="radio" name="gender" value="" >Other
                                                    </label>

                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Age</label>
                                                <input class="form-control" type="number" name="age" id="" placeholder="" value="">
                                            </div>
                                            <div class="form-group">
                                                <label>Spo2 at rest on RA</label>
                                                <input class="form-control" type="text" name="spo2_rest" id="" placeholder="" value="">
                                            </div>

                                            <div class="form-group">
                                                <label>Spo2 on exertion on RA</label>
                                                <input class="form-control" type="text" name="spo2_exertion" id="" placeholder="" value="">
                                            </div>
                                            <div class="form-group">
                                                <label>Pulse rate</label>
                                                <input class="form-control" type="text" name="pulse_rate" id="" placeholder="" value="">
                                            </div>


                                            <!--//////////////BMI///////////////-->

                                            <div class="form-group">
                                                <label>Weight(kg)</label>
                                                <input class="form-control" type="text" name="weight" value="" size="10" placeholder=""></div>
                                            <div class="form-group">
                                                <label>Height(Feet)</label>
                                                <input class="form-control" type="text" name="height" value="" size="10" onkeyup="calculateBmi()" placeholder=""></div>
                                            
                                            <div class="form-group">
                                                <label>BMI Result</label>
                                                <input class="form-control" type="text" name="bmi" value="" size="10" placeholder=""></div>
                                            <div class="form-group">
                                                <label>Weight situation</label>
                                                <input class="form-control" type="text" name="meaning" value="" placeholder=""></div>

                                            <div id="response"></div>

                                            <!-- BMI End -->
                                            <div class="form-group">
                                                <label>Co-Morbidities</label>
                                                <input class="form-control" type="text" name="co_morbidities" value=""  placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>Occupation</label>
                                                <input class="form-control" type="text" name="occupation" value=""  placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>H|O TB / ATT</label>
                                                <input class="form-control" type="text" name="ho_tb" value=""  placeholder="">
                                            </div>
                                            <!-- blood pressure -->
                                            <div class="form-group">
                                                <label>BP(Blood Pressure)</label>
                                                <input class="form-control" type="text" name="bp" value=""
                                                id="" placeholder="" data-inputmask="'mask': '999/99'">
                                            </div>
                                            <div class="form-group">
                                                <label>Doctor Fee</label>
                                                <input class="form-control" type="text" name="dr_fee" value=""
                                                id="" placeholder="" >
                                            </div>
                                            <?php } ?>
                              

                                    </div>

                                     
                                    


                                </div>
                                 
                                <!-- /.row (nested) -->
                            </div>



                        </div>

                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-md-8">
                    <div class="card cardappoint card-topline-yellow ">
                        <div class="card-head card-headappoint ">
                            <h2 class="text-center" style="width: 50%;display: inline-block;margin-top: 11px;margin-bottom: 5px;">Checkup Info</h2>
                            <button type="button" onclick="recognationstop()" class="btn btn-default" style="float:right; margin-right:5px"><i class="fa fa-microphone-slash" style="font-size:30px;color:red;"></i></button>
                        </div>
                        <div class="card-body card-bodystyle">      
                            <div action="#" id="form_sample_1" class="form-horizontal" novalidate="novalidate">
                                <!-- <form method="POST" action=""> -->
                                    
                                      <div class="form-group">
                                        <label>HPI </label>  
                                        
                                        <div class="listening" id="listening1">  Listening </div>  
                                       <!--  <button type="button" onclick="recognationstop()" class="btn btn-default" style="float:right; margin-right:5px"><i class="fa fa-microphone-slash" style="font-size:30px;color:red;"></i></button> -->
                                         <div>
                                            <span id="interim_span" class="interim"></span>
                                        </div>
                                        <br>
                                        <div class="input-group">
                                        <textarea  id="hpi" class="textarea form-control" name="hpi" contenteditable="true"></textarea>
                                        <span class="input-group-addon">
                                                <a href="#" id="start_button" onclick="startDictation(event)">
                                                     <i class="fa fa-microphone"></i>
                                                </a>
                                        </span>
                                        </div>
                                     </div>
                                     <div class="form-group" style="display: none;">
                                        
                                        <input class="textarea" name="pat_id" value="<?php echo $pat_id; ?>" contenteditable="true"
                                        />

                                    </div>
                                    <div class="form-group" style="display: none;">
                                        
                                        <input class="textarea" name="checkup_id" value="<?php echo $checkup_id; ?>" contenteditable="true"
                                        />

                                    </div>

                                
                                    <div class="form-group">
                                        <label>Impression</label><br>
                                        <input class="textarea" name="impression" id="impression" value="" type="text" autocomplete="off">
                                     </div>
                                  
                                    <!-- <div class="form-group">
                                        <label>In house Tests</label><br>
                                         <input class="textarea" name="inhouse_test" id="inhouse" value="" type="text" autocomplete="off" >
                                        

                                    </div> -->
                                    <div class="form-group">
                                        
                                        <label>In house Tests</label><br>
                                        <div >
                                        <div class="col-md-5 setpad">
                                        <input class="form-control setwid " name="inhouse_test[]" id='inhouse' autocomplete="off" placeholder="example:Blood Test"/>
                                        </div>
                                         <div class="col-md-5 setpad">
                                        <input class="form-control setwid " name="inhouse_text[]" id='inhouse_text' autocomplete="off" placeholder="example:Value of lab test"/>
                                        </div>
                                        <div class="col-md-1 setpad set_btnwid">
                                           <button type="button" onclick="add_inhouse()" class="btn btn-success btn-circle"><i class="fa fa-plus"></i></button>
                                        </div>
                                         <div class="col-md-1 setpad set_btnwid">
                                           <button type="button" onclick="remove_inhouse()" class="btn btn-danger btn-circle"><i class="fa fa-minus"></i></button>
                                        </div>
                                        </div>
                                        <div class="new_lab2"></div>
                                        
                                        
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Test Order At Outside Facility</label><br>
                                        <input class="textarea" name="outdoor_test" id="outdoor" value="" type="text">

                                    </div> -->

                                    <div class="form-group">
                                        
                                        <label>Test Order At Outside Facility</label><br>
                                        <div >
                                        <div class="col-md-5 setpad">
                                        <input class="form-control setwid" name="outdoor_test[]" id='outdoor' autocomplete="off" placeholder="example:Blood Test"/>
                                        </div>
                                         <div class="col-md-5 setpad">
                                        <input class="form-control setwid " name="outdoor_text[]" id='outdoor_text' autocomplete="off" placeholder="example:Agha Khan Lab"/>
                                        </div>
                                        <div class="col-md-1 setpad set_btnwid">
                                           <button type="button" onclick="add_outdoor()" class="btn btn-success btn-circle"><i class="fa fa-plus"></i></button>
                                        </div>
                                         <div class="col-md-1 setpad set_btnwid">
                                           <button type="button" onclick="remove_outdoor()" class="btn btn-danger btn-circle"><i class="fa fa-minus"></i></button>
                                        </div>
                                        </div>
                                        <div class="new_lab1"></div>
                                        
                                        
                                    </div>


                              <!--   </form> -->

                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>

                </div>
                <div class="form-group text-center">
                    <button  type="submit" name="save_recored" class="btn btn-outline btn-primary">Save</button>
                </div>
              </form>
            </div>
         

            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
   

 <script>
            function recognationstop(){
                     document.getElementById('listening1').style.display = 'none' ;
                      
                             
                     if ('webkitSpeechRecognition' in window) {
                    
                          var recognitionar= new webkitSpeechRecognition();
                        
                          recognitionar.continuous = true;
                          recognitionar.interimResults = true;
                        
                           
                              console.log(" we are in Remove section") ;
                             recognizing = false;
                                 recognitionar.start();
                     }
                     
          
              
            }
            
 
 </script>
 
                  <script type="text/javascript">
                    
                    var firstTIme = true;
                var final_transcript = '';
                var recognizing = false;
                
                  var two_line = /\n\n/g;
                var one_line = /\n/g;
                function linebreak(s) {
                  return s.replace(two_line, '<p></p>').replace(one_line, '<br>');
                }
                
                function capitalize(s) {
                  return s.replace(s.substr(0,1), function(m) { return m.toUpperCase(); });
                }
                
                function startDictation(event) {
                    
                    
                if ('webkitSpeechRecognition' in window) {
                    firstTIme = true;
                  var recognition = new webkitSpeechRecognition();
                
                  recognition.continuous = true;
                  recognition.interimResults = true;
                
                  recognition.onstart = function() {
                      document.getElementById('listening1').style.display = 'inline-block'
                    recognizing = true;
                  };
                
                  recognition.onerror = function(event) {
                    console.log(event.error);
                  };
                
                  recognition.onend = function() {
                         recognition.stop();
                    recognizing = false;
                  };
                
                  recognition.onresult = function(event) {
                    var interim_transcript = '';
                    for (var i = event.resultIndex; i < event.results.length; ++i) {
                        
                         if(firstTIme == true){
                            final_transcript = hpi.value +' ' ;
                            firstTIme = false;
                        }
                        
        
                      if (event.results[i].isFinal) {
                        final_transcript += event.results[i][0].transcript;
                      } else {
                        interim_transcript += event.results[i][0].transcript;
                      }
                    }
                   final_transcript = capitalize(final_transcript);
             // hpi.innerHTML = linebreak(final_transcript);
            
             //document.getElementById("hpi").value =linebreak(final_transcript);
             hpi.value =linebreak(final_transcript);
             
            interim_span.innerHTML = linebreak(interim_transcript);
                    
                  };
                }
                
               
                
                
                
                         
                      if (recognizing) {
                        
                        recognition.stop();
                        return;
                      }
                      final_transcript = '';
                       
                      recognition.lang = 'en-US';
                      recognition.start();
                      //hpi.innerHTML = '';
                      interim_span.innerHTML = '';
                      
            
              }
                </script>
                <script>
                        function add_outdoor()
     {
    
    $(".new_lab1").append("<div class='lab1'><div class='col-md-5 setpad'><input class='form-control setwid add_mar' name='outdoor_lab[]' id='outdoor' type='text' autocomplete='off' placeholder='example:Blood Test'></div><div class='col-md-5 setpad'><input class='form-control setwid add_mar' name='outdoor_text[]' id='outdoor_text' type='text' autocomplete='off' placeholder='example:Agha Khan Lab'></div></div> ");
    autocompletelab();
   
         
     }
     function remove_outdoor(){
          $('.lab1').last().remove();
         
     }

     function add_inhouse()
     {
    
    $(".new_lab2").append("<div class='lab2'><div class='col-md-5 setpad'><input class='form-control setwid add_mar' name='inhouse_lab[]' id='inhouse' type='text' autocomplete='off' placeholder='example:Blood Test'></div><div class='col-md-5 setpad'><input class='form-control setwid add_mar' name='inhouse_text[]' id='inhouse_text' type='text' autocomplete='off' placeholder='example:Value of lab test'></div></div> ");
    autocompletelab();
   
         
     }
     function remove_inhouse(){
          $('.lab2').last().remove();
         
     }
                </script>
  
    <?php
 include 'jslib.php';
 ?>
 <script>
     var txt = $('#hpi'),
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
  <script src="bmi.js"></script>
  <script src="back.js"></script>
  
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
   <script>
    $(":input").inputmask();

   </script>
   


</body>

</html>