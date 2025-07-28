<?php 
include '../include/MysqliDb.php';
include '../include/config.php';
if(isset($_POST['pat_id'])){
    
    $pat_id=$_POST['pat_id'];
    $checkup_id=$_POST['checkup_id'];
    
    $db->where('p_id',$pat_id);
    $db->where('checkup_id',$checkup_id);
    $checkup=$db->getOne('total_checkup');
    
    $db->where('p_id',$pat_id);
    $patient=$db->getOne('total_patient');
    
    ?>
    <style>
        .modal-section{
    margin-top: 0px;
    background: #5983e8;
    color: white;
    border-radius: 25px;
}
    </style>
    <div id="checkup_detail"> 
    <div>
        <h3 class="text-center modal-section"  >Patient History</h3>
    </div>
        <table class="table table-bordered table-hover">
            <tbody>
                <tr>
                    <td class="set-fnt-main set-td">Past History</td>
                    <td class="set-td"><?php echo $patient['past_history'];  ?></td>
                </tr>
                <tr>
                    <td class="set-fnt-main set-td">Family History</td>
                    <td class="set-td"><?php echo $patient['f_history'];  ?></td>
                </tr>
                <tr>
                    <td class="set-fnt-main set-td">Personal History</td>
                    <td class="set-td"><?php echo $patient['per_history'];  ?></td>
                </tr>
            </tbody>
        </table>
    <div>
        <h3 class="text-center modal-section"  >Checkup Detail ( <?php echo date('d-M-Y',strtotime($checkup['checkup_date'])); ?> )</h3>
    </div>
    <table class="table table-bordered table-hover" style="margin-bottom: 10px;">
            <tbody>
                <tr>
                    <td class="set-fnt-main set-td">HPI</td>
                    <td class="set-td"><?php echo $checkup['hpi'];  ?></td>
                </tr>
                <tr>
                    <td class="set-fnt-main set-td">Procedure</td>
                    <td class="set-td"><?php echo $checkup['pt_proc'];  ?></td>
                </tr>
                <tr>
                    <td class="set-fnt-main set-td">Systemic Examination</td>
                    <td class="set-td"><?php echo $checkup['examination'];  ?></td>
                </tr>
                <tr>
                    <td class="set-fnt-main set-td">Dignosis</td>
                    <td class="set-td"><?php echo $checkup['impression'];  ?></td>
                </tr>
                <tr>
                    <td class="set-fnt-main set-td">Plan</td>
                    <td class="set-td"><?php echo $checkup['pat_plan'];  ?></td>
                </tr>
                <tr>
                    <td class="set-fnt-main set-td">Next FollowUp</td>
                     <td dir='rtl' class="fnt-family "><?php echo $checkup['follow_num']; ?> <?php
                                            	 if ($checkup['follow_time']=='type1') {
                                            	 	echo "دن"; 
                                            	 }
                                            	 elseif ($checkup['follow_time']=='type2') {
                                            	 	echo "ہفتے";
                                            	 }
                                            	  elseif ($checkup['follow_time']=='type3') {
                                            	 	echo "مہینے";
                                            	 }
                                            	  elseif ($checkup['follow_time']=='type4') {
                                            	 	echo "سال";
                                            	 }
                                            	  
                                            
                                            	   ?> کے بعد دوبارہ تشریف لائیں۔ </td>
                                                
                </tr>
            </tbody>
        </table>
        
        <table class="table table-bordered table-hover">
            <tbody>
                <tr>
                    <td class="set-fnt-main set-td">Test Detail</td>
                    <td class="set-td">
                    <?php
                    $i=1;
                    $db->where('p_id',$pat_id);
                    $db->where('checkup_id',$checkup_id);
                    $outdoor_test=$db->get('total_patient_outdoor_test');
                    
                    foreach($outdoor_test as $out_test){
                        
                        echo $string_out=$i."- ".$out_test['test_name']."    ".$out_test['result_value']."<br>";
                        $i++;
                    }
                    
                    ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="table-responsive ">
            <table class="table">
            <thead>
            <tr></tr>
            </thead>
            <tbody>
            <tr>
            <td class="set-td fnt-family" dir="rtl">
            <?php
              $num=1;
              $for_id=$checkup['for_bear_id'];
              $fr_id =explode(",",$for_id);
              foreach( $fr_id as $fi ){
              $db->where('id_for',$fi);
              $parh=$db->getOne('forbearance_tbl');
              
              ?>
              <p class="hdyt-desc"><?php echo $num; ?> - <?php echo $parh['bear_title']; ?> </p>
              
            <?php $num++;  }
                ?>
                                    
            </td>
                                        <td class="set-td fnt-family hdyt-fnt" dir="rtl">ہدایت</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                    <div>
        <h3 class="text-center modal-section">Previous Checkup Medicine</h3>
    </div>
        <div class="table-responsive ">
            <table class="table">
            <thead>
                <tr>
                    <th class="fnt-new1 fnt-family text-center" style="padding: 4px;">دوا کا نام</th>
                    <th class="fnt-new1 fnt-family text-center" style="padding: 4px;">مدت</th><th></th>
                    <th class="fnt-new1 fnt-family text-center" dir="rtl" style="padding: 4px;">طریقہ استعمال </th>
                                            </tr>
            </thead>
              <tbody>
                                            <?php 
                                    $xs=1;
                                    $db->where ("p_id",$pat_id);
                                    $db->where('checkup_id',$checkup_id);
                                    $medic = $db->get('total_patient_medicine');
                                    
                                    foreach ($medic as $med) {
                                        $stp=$med['med_stamp'];
                                       
                                       

                                      
                                    ?>
                                            <tr>
                                    <td class="set-td">
                                        <div class="fnt-new">
                                        <?php echo "<span class='set-med-name'>".$xs.' - '.$med['med_name']."</span>"; 
                                        $xs++;
                                        ?>  <?php
                                        
                                        if ($stp != '') { 
                                        $stampp =explode(",",$stp);
                                         foreach ($stampp  as $st) 
                                        {  
                                        if($st != ''){
                                        $db->where('st_id',$st);
                                        $stmp_data=$db->getOne('stamps');
                                        echo "<br>"."<span style='margin-left: 10px;margin-right: 10px;'><img src='../img/goim002.png'  style='width:5px;height:5px;'></span>".$stmp_data['st_name'];    
                                        }
                                        
                                        }
                                         
                                        } 
                                        ?>

                                        </div>
                                            
                                    </td>
                                                <td class="set-td1" style="padding-right: 0px;">
                                                   
                                <p class="set_day fnt-new1 fnt-family" ><?php echo $med['time_span'];?></p>
                                                    
                                                    <?php //echo $med['time_num'].''.$med['time_span'];?>
                                                        
                                                </td>
                                                <td class="set-td1" style="padding-left: 0px;">
                            <p class="fnt-new" style="display: inline-block;padding-right: 0px;margin: 0px;"><?php echo $med['time_num'];?></p></td>
                                                
                                                <td class="set-td">
                                                    <div class="set-med-dec-new">
               <div class="fnt-new1 fnt-family" dir="rtl" style="margin: 3px;   margin-bottom: 6px;margin-top: 6px;"><?php echo "<p class='set-hy-fnt set-ur-med'>". $med['med_disc']."</p>"; ?>  <?php
               if ($stp != '') {
                   $stampp =explode(",",$stp);
                                         foreach ($stampp  as $st) 
                                        {  
                                            if($st != ''){
                                             $db->where('st_id',$st);
                                         $stmp_data=$db->getOne('stamps');
                                          echo "<br>"."<span style='margin-left: 10px;'><img src='../img/goim002.png'  style='width:5px;height:5px;'></span>"."<span class='set-hy-fnt'>".$stmp_data['st_use']."</span>";   
                                            }

                                        }
               
                }  ?> </div>
                                                </div>
                                                    
                                                    <?php
                                        if ($med['med_special_desc']=="") {
                                            continue;
                                        }

                                        elseif ($med['med_special_desc']!="") {
                                           
                                        ?>
                                                </td>
                                            </tr>
                                            <?php } 
                                            
                                            } ?>
                                            
                                        </tbody>
                </table>
            </div>
            
    </div>
    
    
    
    
<?php }

?>