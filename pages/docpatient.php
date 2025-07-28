<?php
include '../include/config_new.php';
$a=new crud();
if (isset($_POST['call_patient'])) {
     $p_id=$_POST['paitent_id'];
    // echo "----------".$p_id;
     
     $where=array("p_id=$p_id");
     $upd=array('p_status'=>"1");
     $a->update('current_checkup',$upd,$where);
 } 
if(isset($_POST['save_recored']))
{
    $x=$_REQUEST['doc'];
    $pat_id=decode($x);
    $y=$_REQUEST['che'];
    $checkup_id=decode($y);
    


    $hpi=$_POST['hpi'];
    $impression=$_POST['impression'];

    
    $past_history=$_POST['past_history'];
    $family_history=$_POST['family_history'];
    $per_history=$_POST['per_history'];
    $review_lab=$_POST['rev_pre_lab'];
    $review_lab_text=$_POST['rev_pre_lab_text'];
    $review_med=$_POST['rev_pre_med'];
    $review_med_text=$_POST['rev_pre_med_text'];
    $cou_lab=count($review_lab);
     //lab_review_suggest.php
     for ($i=0; $i <$cou_lab ; $i++) 
          { 
            $flag_lab=0;
            $test_data=$a->select('review_lab','lab_test','','');
            // check duplicate word
            if (mysqli_num_rows($test_data) > 0)
            {
            while($row_test = mysqli_fetch_assoc($test_data)) 
            {
            if($review_lab[$i]  == $row_test["lab_test"])
            {
                     $flag_lab = 1;

            } 
            
            }


            } 
            // if the word new enter in table of word sugesstion
            if(  $flag_lab == 0)
            {
            $ins_test=array('',$review_lab[$i]);
            $a->insert('review_lab',$ins_test,null);

             
            }
            
            $final_lab[] = $review_lab[$i]." ".$review_lab_text[$i] ;
            $final_text_tab =implode(",", $final_lab);
              
          }
          //echo "---------".$final_text_tab;
         
     
     
     
            $cou=count($review_med);
    
    
    
    for ($i=0; $i <$cou ; $i++) 
          { 
             $flag=0;
              
            $data=$a->select('medication_term','med_term','','');
            // check duplicate word
            if (mysqli_num_rows($data) > 0)
            {
            
            while($row = mysqli_fetch_assoc($data)) 
            {
            if($review_med[$i]  == $row["med_term"])
            {
                     $flag = 1;

            } 
            
            }


            } 
            // if the word new enter in table of word sugesstion
            if(  $flag == 0)
            {
            $ins=array('',$review_med[$i]);
            $a->insert('medication_term',$ins,null);

             
            }
            
            $final[] = $review_med[$i]." ".$review_med_text[$i] ;
            $final_text =implode(",", $final);
              
          }
          
    // insert the recored against the patient
    $where=array("p_id=$pat_id");
    $update = array('past_history'=>"$past_history",'f_history'=>"$family_history",'per_history'=>"$per_history",'review_pre_lab'=>"$final_text_tab",'review_pre_med'=>"$final_text");
    $a->update('current_patient',$update,$where);
    


     // insert the recored against the checkup_patient
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
          

        


           


     }
      $where=array("p_id=$pat_id");
     $upd=array('p_status'=>"2",'pre_test'=>"0",'lab_ok'=>"0",'lab_status'=>"0");
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
        
        $med_term = trim($med_term);
         if (empty($med_term)) {
            continue;
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
      .setpad
        {
        padding-right: 0px;
        padding-left: 0px;
        }
       
        .setwid
        {
            width: 98%;
        }
        .set_btnwid
        {
            width: 5.333333%!important;
        }
        .add_mar{
        margin-top: 4px;
        }
        td {
            padding: 15px;
        }
        
        .td-left {
            word-break: break-all;
        }
        
        .textarea {
            /*width: 635px;*/
            min-height: 50px;
            height: auto;
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
        /**/
        
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
        <?php  include 'sidebardoc.php'; ?>
     

        <div id="page-wrapper">
            <div class="row">
                 <?php
        $a= new crud();
         $x=$_REQUEST['doc'];
         $pat_id=decode($x);
         $y=$_REQUEST['che'];
         $checkup_id=decode($y);
     
        $recored =$a->select('current_patient p INNER JOIN current_checkup u ON(p.p_id=u.p_id)','p.*,u.*',"p.p_id=$pat_id",'');
       
        while($a=$recored->fetch_array())

        {
            $pre_test=$a['pre_test'];
                                        
                                        ?>
        <div class="col-lg-12">
        <h1 class="page-header" style="margin-bottom: 0px;margin-top: 22px;"> Add patient Info</h1>
        <h3 style="display:inline-block;color:green;"><?php echo $a['p_name']; ?></h3>
        <h3 style="float:right; display:inline-block;"><?php echo $a['contact']; ?></h3>
        <form method="POST" action="">
        <input type="text" name="paitent_id" value="<?php echo $a['p_id'];?>" style="display: none;">
        
        <button type="submit" name="call_patient" type="button" class="btn btn-info" title="Click here to call patient in room"><i class="fa fa-phone" style="color:green;margin-right:5px;"></i>Call Patient</button>
        </form>
        <button onclick="goBack()" class="btn"  style="float: right;margin-right: 16px;" title="Click here to go back to previous page"> <i class="fa fa-arrow-circle-left" style="font-size:30px;color:red;"></i></button>
        </div>
        <!-- /.col-lg-12 -->
    </div>
            <!-- /.row -->
           
            <div class="row">
                
                <div class="col-md-4 ">
                    <div class="card cardappoint card-topline-yellow ">
                        <div class="card-head card-headappoint ">
                            <h2 class="text-center">By Receptionist</h2>
                        </div>
                        <div class="card-body card-bodystyle">



                            <table class="table-bordered">

                                <tbody>
                                   
                                    <tr>
                                        <td>
                                        Patient Name:
                                    </td>
                                    <td class="">
                                        <?php echo $a['p_name'];?>
                                        </td>
                                    </tr>
                                  
                                    <tr>
                                        <td>
                                            Phone No.
                                        </td>
                                        <td class="td-left">
                                          <?php echo $a['contact'];?>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            Address
                                        </td>
                                        <td class="">
                                          <?php echo $a['address'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Gender
                                        </td>
                                        <td class="td-left">
                                         <?php echo $a['gender'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Age
                                        </td>
                                        <td class="td-left">
                                           <?php echo $a['age'];?>
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>
                                            Pulse Rate
                                        </td>
                                        <td class="td-left">
                                           <?php echo $a['pulse_rate'];?>
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>
                                            Oxygen Saturation
                                        </td>
                                        <td class="td-left">
                                           <?php echo $a['oxygen_sit'];?>
                                        </td>
                                    </tr>



                                    <tr>


                                        <td>
                                            Weight
                                        </td>
                                        <td class="td-left">
                                          <?php echo $a['p_weight'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Height
                                        </td>
                                        <td class="td-left">
                                          <?php echo $a['p_height'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            BMI
                                        </td>
                                        <td class="td-left">
                                           <?php echo $a['bmi'];?>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            Weight Situation
                                        </td>
                                        <td class="">
                                           <?php echo $a['weight_sit'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            BP (Right)
                                        </td>
                                        <td class="td-left">
                                          <?php echo $a['bp_r'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            BP (Left)
                                        </td>
                                        <td class="td-left">
                                      <?php echo $a['bp_l'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Fee Status
                                        </td>
                                        <td class="td-left">
                                           <?php echo $a['rec_fee'];?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>

                            </table>



                        </div>

                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-md-8">
                    <div class="card cardappoint card-topline-yellow ">
                        <div class="card-head card-headappoint ">
                            <h2 class="text-center">By Doctor</h2>
                            <button type="button" onclick="recognationstop()" class="btn btn-default" style="float:right; margin-right:5px"><i class="fa fa-microphone-slash" style="font-size:30px;color:red;"></i></button>
                        </div>
                        
                        
                        
                        
                        








                        <div class="card-body card-bodystyle">
                            <div action="#" id="form_sample_1" class="form-horizontal" novalidate="novalidate">
                                <form method="POST" action="">
                                    
                                    <div class="form-group">
                                         
                                        <label>HPI </label>   
                                           <div class="listening" id="listening1">  Listening </div>       <br>
                                                                                
                                        <div>
                                            <span id="interim_span" class="interim"></span>
                                        </div>
                                        <div class="input-group">
                                        <textarea  id="hpi" class="textarea form-control" name="hpi" contenteditable="true"></textarea>
                                        <span class="input-group-addon">
                                                <a href="#" id="start_button" onclick="startDictation(event)">
                                                     <i class="fa fa-microphone"></i>
                                                </a>
                                        </span>
                                        </div>
                                     </div>
                             
                             
                                    <div class="form-group">
                                        <label>Past History </label>
                                         <div class="listening" id="listening2">  Listening </div>
                                         <br>
                                        <div>
                                            <span id="interim_spana" class="interima"></span>
                                        </div>
                                        <div class="input-group">
                                        <textarea  id="hpia" class="textarea form-control" name="past_history" contenteditable="true"></textarea>
                                        <span class="input-group-addon">
                                            <a href="#" id="start_button1" onclick="startDictationa(event)">
                                                <i class="fa fa-microphone"></i>
                                            </a>
                                        </span>
                                        </div>
                                        
                                    </div>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <div class="form-group">
                                        <label>Family History </label>
                                         <div class="listening" id="listening3">  Listening </div>
                                         <br>
                                        <div>
                                            <span id="interim_spana_fam" class="interima"></span> 
                                        </div>
                                        <div class="input-group">
                                        <textarea id="family_history" class="textarea form-control" name="family_history" contenteditable="true"
                                        ></textarea>
                                         <span class="input-group-addon">
                                            <a href="#" id="start_button1" onclick="startDictationa_fam(event)">
                                                <i class="fa fa-microphone"></i>
                                            </a>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Personal History </label>
                                         <div class="listening" id="listening4">  Listening </div>
                                         <br>
                                        <div>
                                            <span id="interim_spana_per" class="interima"></span> 
                                            
                                        </div>
                                        <div class="input-group">
                                        <textarea id="per_history" class="textarea form-control" name="per_history" contenteditable="true"
                                        ></textarea>
                                        <span class="input-group-addon">
                                            <a href="#" id="start_button1" onclick="startDictationa_per(event)">
                                                <i class="fa fa-microphone"></i>
                                            </a>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        
                                        <label>Review of Previous Lab (If Any) </label><br>
                                        <div >
                                        <div class="col-md-5 setpad">
                                        <input class="form-control setwid preview_lab" name="rev_pre_lab[]" id='rev_pre_lab' autocomplete="off" placeholder="example:Blood Test"/>
                                        </div>
                                         <div class="col-md-5 setpad">
                                        <input class="form-control setwid " name="rev_pre_lab_text[]" id='rev_pre_lab_text' autocomplete="off" placeholder="example:On 02 April 2019"/>
                                        </div>
                                        <div class="col-md-1 setpad set_btnwid">
                                           <button type="button" onclick="add_lab()" class="btn btn-success btn-circle"><i class="fa fa-plus"></i></button>
                                        </div>
                                         <div class="col-md-1 setpad set_btnwid">
                                           <button type="button" onclick="remove_lab()" class="btn btn-danger btn-circle"><i class="fa fa-minus"></i></button>
                                        </div>
                                        </div>
                                        <div class="new_lab"></div>
                                        
                                        
                                    </div>
                                  
                                    <div class="form-group">
                                   
                                        <label>Review of Previous Medication (If Any) </label><br>
                                        
                                        <div >
                                        <div class="col-md-5 setpad">
                                          <input class="form-control setwid medicine" name="rev_pre_med[]" id="rev_pre_med" type="text" autocomplete="off" placeholder="example:Panadol">  
                                        </div>
                                        <div class="col-md-5 setpad">
                                          <input class="form-control setwid" name="rev_pre_med_text[]" id="rev_pre_med_text" type="text" autocomplete="off" placeholder="example:From 10 April 2019">  
                                        </div>
                                        <div class="col-md-1 setpad set_btnwid">
                                           <button type="button" onclick="add_med()" class="btn btn-success btn-circle"><i class="fa fa-plus"></i></button>
                                        </div>
                                         <div class="col-md-1 setpad set_btnwid">
                                           <button type="button" onclick="remove_med()" class="btn btn-danger btn-circle"><i class="fa fa-minus"></i></button>
                                        </div>
                                        
                                        </div>
                                        <div class="new_med"></div>
                                        
                                        
                                        
                                        </div>
                                        
                                         
                                    
                                   
                                    <div class="form-group">
                                        <label>Impression</label><br>
                                        <textarea id="impression" class="textarea form-control" name="impression" id="impression" type="text" autocomplete="off"></textarea>
                                       

                                    </div>
                                    <?php 
                                    if($pre_test=='1'){
                                    $obj= new crud();
                                   
                                    $test_data=$obj->select('current_patient_test','*',"p_id='".$pat_id."' and checkup_id='".$checkup_id."'",'');
                                    while($test_name=$test_data->fetch_array()){
                                        $pre_test_array[]=$test_name['test_name'];
                                       
                                        $all_pre_test = implode(",", $pre_test_array);
                                    }
                                    
                                        ?>
                                       
                                         <div class="form-group ">
                                    <label>In-House Test</label><br>
                                    <div class="input-group ">
                                    <input class="textarea form-control" name="pre_inhouse_test" value="<?php echo $all_pre_test; ?>" type="text" readonly >
                                    <span class="input-group-btn">
                                                    <button class="btn btn-success" type="button"  data-toggle="modal" data-target="#exampleModal" style="padding-top: 0px;padding-bottom: 0px;height: 50px;"><i class="fa fa-flask"></i>
                                                    </button>
                                                </span>
                                           
                                      </div>
                                    </div>
                                        
                                <?php    }
                                else{
                                    
                                }
                                    ?>
                                   
                                    <div class="form-group">
                                        <label>Further In house Tests</label><br>
                                         <input class="textarea form-control" name="inhouse_test" id="inhouse" type="text" autocomplete="off" >
                                        

                                    </div>
                                     <div class="form-group">
                                        <label>Test Order At Outside Facility</label><br>
                                        <input class="textarea form-control" name="outdoor_test" id="outdoor" type="text">

                                    </div>
                                
                                

                                    <div class="form-group text-center">
                                        <button  type="submit" name="save_recored" class="btn btn-outline btn-primary">Next</button>                                    </div>
                                </form>

                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>

                </div>
            </div>
            <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Lab Report</h4>
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
        <!--  <span aria-hidden="true">&times;</span>-->
        <!--</button>-->
      </div>
      <div class="modal-body">
          
        
              <table style="width:100%;">
                         <thead>
                              <style>
                                 .set-hd{
                                     font-size: 16px;
                                     padding-top:5px;
                                     padding-bottom:5px;
                                 }
                             </style>
                                   <tr style="border: 1px solid black;">
                             <th class="set-hd" style="padding-left: 10px;">Test Name </th>
                             
                             <th class="set-hd" style="">Result</th>
                             <th class="set-hd" style="">Normal Value</th>
                         </tr>
                          <style>
             .set-test-fnt{
                 font-size: 15px;
                 
             }
         </style>
           <?php 
          $obj= new crud();
          $test_data=$obj->select('current_patient_test','*',"p_id='".$pat_id."' and checkup_id='".$checkup_id."'",'');
           while($test_name=$test_data->fetch_array())
           {
            
            ?>
        <tr>
            <td class="set-test-fnt" style="padding-left: 10px;padding-top: 5px;padding-bottom: 5px;"><?php echo $test_name['test_name']; ?></td>
            <td class="set-test-fnt" style="padding-left: 10px;padding-top: 5px;padding-bottom: 5px;"><?php echo $test_name['result_value']; ?></td>
            <td class="set-test-fnt" style="padding-left: 10px;padding-top: 5px;padding-bottom: 5px;"><?php echo $test_name['normal_value']; ?></td>
        </tr>
          <?php

        }
          ?>
            </thead>
        </table>
          
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <form name="bmiFor">

    </form>


  
    <?php  include 'jslib.php';      ?> 
    <script src="autoheight.js"></script>
 
 
 
 
 
 
 <script>
            function recognationstop(){
                     document.getElementById('listening1').style.display = 'none' ;
                     document.getElementById('listening2').style.display = 'none' ;
                      document.getElementById('listening3').style.display = 'none' ;
                       document.getElementById('listening4').style.display = 'none' ;
                             
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
 
 <script>
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
    //  console.log("ENter into function ");
                 firstTIme = true;
         
  var recognition = new webkitSpeechRecognition();

  recognition.continuous = true;
  recognition.interimResults = true;

  recognition.onstart = function() {
      //   console.log("ENter into onstart ");
         
      
      document.getElementById('listening1').style.display = 'inline-block'
    recognizing = true;
  };

  recognition.onerror = function(event) {
      
      // alert("a 2"); 
         
    console.log(event.error);
  };

 
  recognition.onend = function() {
      
         
       
         recognition.stop();
    recognizing = false;
  };
   

  recognition.onresult = function(event) {
      
      
       
    var interim_transcript =  '';
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
 
 
 
            <!--  2nd code of voice  -->
 
 <script>
 
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
        
        function startDictationa(event) {
            
            
        if ('webkitSpeechRecognition' in window) {
                      firstTIme = true;
          var recognitiona = new webkitSpeechRecognition();
        
          recognitiona.continuous = true;
          recognitiona.interimResults = true;
        
          recognitiona.onstart = function() {
              
                 document.getElementById('listening2').style.display = 'inline-block' ;
            recognizing = true;
          };
        
          recognitiona.onerror = function(event) {
            console.log(event.error);
          };
        
          recognitiona.onend = function() {
             
            recognizing = false;
          };
        
          recognitiona.onresult = function(event) {
            var interim_transcript = '';
            for (var i = event.resultIndex; i < event.results.length; ++i) {
                
                 if(firstTIme == true){
                    final_transcript = hpia.value +' ' ;
                    firstTIme = false;
                }
        
              if (event.results[i].isFinal) {
                final_transcript += event.results[i][0].transcript;
              } else {
                interim_transcript += event.results[i][0].transcript;
              }
            }
            
             
            final_transcript = capitalize(final_transcript);
          //  hpia.innerHTML = linebreak(final_transcript);
            
             hpia.value =linebreak(final_transcript);
             
            interim_spana.innerHTML = linebreak(interim_transcript);
            
          };
        }
        
        
          
          if (recognizing) {
            recognitiona.stop();
            return;
          }
          final_transcript = '';
          recognitiona.lang = 'en-US';
          recognitiona.start();
    //      hpia.innerHTML = '';
          interim_spana.innerHTML = '';
          
   
}

</script>


<!-- third voice -->

 
 <script>
 
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
        
        function startDictationa_fam(event) {
            
            
        if ('webkitSpeechRecognition' in window) {
                      firstTIme = true;
                      
          var recognitiona_fam = new webkitSpeechRecognition();
        
          recognitiona_fam.continuous = true;
          recognitiona_fam.interimResults = true;
        
          recognitiona_fam.onstart = function() {
                 document.getElementById('listening3').style.display = 'inline-block' ;
            recognizing = true;
          };
        
          recognitiona_fam.onerror = function(event) {
            console.log(event.error);
          };
        
          recognitiona_fam.onend = function() {
            recognizing = false;
          };
        
          recognitiona_fam.onresult = function(event) {
            var interim_transcript = '';
            for (var i = event.resultIndex; i < event.results.length; ++i) {
                
                 if(firstTIme == true){
                    final_transcript = family_history.value +' ' ;
                    firstTIme = false;
                }
                
                
              if (event.results[i].isFinal) {
                final_transcript += event.results[i][0].transcript;
              } else {
                interim_transcript += event.results[i][0].transcript;
              }
            }
            
             //  alert("b onresult");
            final_transcript = capitalize(final_transcript);
          //  family_history.innerHTML = linebreak(final_transcript);
          
            family_history.value = linebreak(final_transcript);
            interim_spana_fam.innerHTML = linebreak(interim_transcript);
            
          };
        }
        
        
          //  alert("b");
          if (recognizing) {
            recognitiona_fam.stop();
            return;
          }
          final_transcript = '';
          recognitiona_fam.lang = 'en-US';
          recognitiona_fam.start();
         // family_history.innerHTML = '';
          interim_spana_fam.innerHTML = '';
          
   
}

</script>


<!-- fourth voice -->

 <script>
 
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
        
        function startDictationa_per(event) {
            
            
        if ('webkitSpeechRecognition' in window) {
                      firstTIme = true;
          var recognitiona_per = new webkitSpeechRecognition();
        
          recognitiona_per.continuous = true;
          recognitiona_per.interimResults = true;
        
          recognitiona_per.onstart = function() {
                
                document.getElementById('listening4').style.display = 'inline-block' ;
            recognizing = true;
          };
        
          recognitiona_per.onerror = function(event) {
            console.log(event.error);
          };
        
          recognitiona_per.onend = function() {
            recognizing = false;
          };
        
          recognitiona_per.onresult = function(event) {
            var interim_transcript = '';
            for (var i = event.resultIndex; i < event.results.length; ++i) {
                
                if(firstTIme == true){
                    final_transcript = per_history.value +' ' ;
                    firstTIme = false;
                }
                
                
                
              if (event.results[i].isFinal) {
                final_transcript += event.results[i][0].transcript;
              } else {
                interim_transcript += event.results[i][0].transcript;
              }
            }
            
             //  alert("b onresult");
            final_transcript = capitalize(final_transcript);
           // per_history.innerHTML = linebreak(final_transcript);
           
            per_history.value = linebreak(final_transcript);
            
            interim_spana_per.innerHTML = linebreak(interim_transcript);
            
          };
        }
        
        
          //  alert("b");
          if (recognizing) {
            recognitiona_per.stop();
            return;
          }
          final_transcript = '';
          recognitiona_per.lang = 'en-US';
          recognitiona_per.start();
       //   per_history.innerHTML = '';
          interim_spana_per.innerHTML = '';
          
   
}

</script>


 
 
 
 


  <script src="back.js"></script>
 
    <script>
     function add_med()
     {
    
    $(".new_med").append("<div class='med'><div class='col-md-5 setpad'><input class='form-control setwid add_mar medicine' name='rev_pre_med[]' id='rev_pre_med' type='text' autocomplete='off' placeholder='example:Panadol'></div><div class='col-md-5 setpad'><input class='form-control setwid add_mar' name='rev_pre_med_text[]' id='rev_pre_med_text' type='text' autocomplete='off' placeholder='example:From 10 April 2019'></div></div> ");
    autocompletecall();
   
         
     }
     function remove_med(){
          $('.med').last().remove();
         
     }
     
     function add_lab()
     {
    
    $(".new_lab").append("<div class='lab'><div class='col-md-5 setpad'><input class='form-control setwid add_mar preview_lab' name='rev_pre_lab[]' id='rev_pre_lab' type='text' autocomplete='off' placeholder='example:Blood Test'></div><div class='col-md-5 setpad'><input class='form-control setwid add_mar' name='rev_pre_lab_text[]' id='rev_pre_lab_text' type='text' autocomplete='off' placeholder='example:On 02 April 2019'></div></div> ");
    autocompletelab();
   
         
     }
     function remove_lab(){
          $('.lab').last().remove();
         
     }
     
       
    </script>
     <script>

 $(function() {
    $( ".medicine" ).autocomplete({
        source: 'medication_suggest.php'
    });
 });
 $(function() {
    $( ".preview_lab" ).autocomplete({
        source: 'lab_review_suggest.php'
    });
 });
//   $(function() {
//     $( "#inhouse_test" ).autocomplete({
//         source: 'autocomplete_indoor.php'
//     });
//  });

 function autocompletecall() {
           

        
    $( ".medicine" ).autocomplete({
    source: 'medication_suggest.php'
    });
      


        }
        function autocompletelab() {
           

        
    $( ".preview_lab" ).autocomplete({
    source: 'lab_review_suggest.php'
    });
      


        }

</script>


</body>

</html>