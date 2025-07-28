<?php
    include '../include/config_new.php';
    $a= new crud();
    
    if(!empty($_POST["id"])){
            $recored=$a->select('current_patient cp INNER JOIN token tok ON(cp.p_id=tok.p_id) INNER JOIN current_checkup ch ON(cp.p_id=ch.p_id)','cp.p_id,cp.p_name,cp.checkup_times,tok.token_no,ch.*','',"tok.token_no ASC");

     while ($ab =$recored->fetch_array()) {
                                            $pat_id=$ab['p_id'];
                                            $checkup=$ab['checkup_id'];
                        
                                            $encrypt=encode($pat_id);
                                            $encrypt1=encode($checkup);

//echo '------>'.$ab['p_status'];

                                         ?>
                                        
                                        <tr class="odd gradeX">
                                            
                                            <td><?php  echo $ab['p_id']; ?> </td>
                                            
                                            <td>
                                                   <?php


                                                if ($ab['checkup_times']=='1') {

                                                if ($ab['is_insert']=='1') {
                                                ?>
                                                 <a href="editrecored_sec.php?doc=<?php echo $encrypt;?>&ch=<?php echo $encrypt1;?>"><?php  echo $ab['p_name']; ?></a>

                                        <?php  }
                                            else{
                                                    

                                            ?>
                                                 <a href="dr_checkup_sec.php?pd=<?php echo $encrypt;?>&cd=<?php echo $encrypt1;?>"><?php  echo $ab['p_name']; ?></a>
                                                <?php  
                                                }
                                              

                                               

                                                    
                                        }


                                        else{
                                            if ($ab['is_insert']=='1') { ?>
                                            <a href="editrecored.php?doc=<?php echo $encrypt;?>&ch=<?php echo $encrypt1;?>"><?php  echo $ab['p_name']; ?></a>
                                            
                                           <?php }
                                           else{
                                            ?>
                                             <a href="dr_checkup.php?pd=<?php echo $encrypt;?>&cd=<?php echo $encrypt1;?>"><?php  echo $ab['p_name']; ?></a>
                                            <?php
                                            }

                                            }

                                              ?>

                                            <td><?php  echo $ab['checkup_time']; ?></td>
                                            
                                            
                                            <td class="center text-center">
                                                <?php 
                                                if($ab['p_status']=='1') {
                                                    # code...
                                               

                                                ?>
                                                <button type="button text-center" class="btn btn-secondary" style="border-radius:25px;background-color: #056d1a; color: white; font-weight:600;" disabled>In room</button>

                                            <?php } elseif($ab['p_status']=='2') {

                                             ?> 
                                              <button type="button text-center" class="btn btn-info" style=" color: white;background-color: #6346a5;border-color: #6346a5;border-radius:25px;font-weight:600;" disabled>In Process</button>
                                         <?php } else {


                                          ?>
                                           <button type="button text-center" class="btn btn-danger" style=" color: white; background-color: #a90202;border-radius:25px;font-weight:600;" disabled>Waiting</button>
                                      <?php } ?>
                                            </td>

                                            <td class="center"><div class="text-center">
                                              <?php
                                              if ($ab['checkup_times']=='0') 
                                                {?>
                                                      <form method="POST" action="">

                                                <div class="form-group" style="display: none;">
                                                    
                                <input   class="form-control" name="id_from" value="<?php  echo $encrypt; ?>">
                                                  </div>
                                                  <div class="form-group" style="display: none;">
                                                    
                                <input   class="form-control" name="checkup_from" value="<?php  echo $encrypt1; ?>">
                                                  </div>


                                                <button type="submit" name="send_record" class="btn btn-info btn-circle" title="Save this patient's checkup in permanent record"><i class="fa fa-check"></i></button>


                                                </form>
                                                 
                                             <?php }
                                             else
                                                { ?>

                                                     <form method="POST" action="">

                                                <div class="form-group" style="display: none;">
                                                    
                                <input   class="form-control" name="id_from" value="<?php  echo $encrypt; ?>">
                                                  </div>
                                                  <div class="form-group" style="display: none;">
                                                    
                                <input   class="form-control" name="checkup_from" value="<?php  echo $encrypt1; ?>">
                                                  </div>


                                                <button type="submit" name="update_record" class="btn btn-warning btn-circle" title="Save this patient's checkup in permanent record"><i class="fa fa-check" ></i></button>


                                                </form>











                                        <?php     }



                                               ?>




                                            </div></td>
                                            <td class="text-center">
                                            <div class="text-center"> 
                                         <a class="btn btn-danger btn-circle" onclick="myFunction('<?php echo $pat_id; ?>' )" style="display:inlline-block;" title="Delete this patient record"><i class="fa fa-trash-o"></i> </a>
                                                              
                                        <a class="btn btn-primary btn-circle" href="editrecored.php?doc=<?php echo $encrypt;?>&ch=<?php echo $encrypt1;?>" style="display:inlline-block;" target="_blank" title="Edit patient record"><i class="fa fa-edit"></i> </a>
                                                              
                                                </div>
                                            </td>
                                        </tr>

                                        <?php }
        
    }
                                           

                                        
                                        
?>