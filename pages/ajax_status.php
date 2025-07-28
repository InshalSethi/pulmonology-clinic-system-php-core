<?php
    include '../include/config_new.php';
    include '../include/MysqliDb.php';
    include '../include/config.php';
    $a= new crud();
    
    if(!empty($_POST["id_new"]))
    {
        ?>
        <div class="row status_remove" >
                <div class="col-lg-2 col-md-2">
                    <div class="panel panel-secondary panel-set" style="border-color: #d2cece;">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-reorder fa-2x"></i>
                                </div>
                                <?php
                                $a= new crud();
                                $totalpatient=$a->selectcount('current_patient','*','','');
                                
                                ?>
                                <div class="col-xs-9 text-right">
                                    <div class="hugee"><?php echo $totalpatient ?></div>
                                    
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Listed Patients</span>
                                

                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2">
                    <div class="panel panel-secondary panel-set" style="border-color: #d2cece;">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-2x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                 <?php
                                
                                $totaltest=$a->selectcount('current_checkup','*','p_status IS NULL','');
                                //  $db->where('p_status=0');
                                //  $totaltest=$db->count;
                                
                                ?>
                                    <div class="hugee"><?php echo $totaltest ?></div>
                                  
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Waiting Patients</span>
                                

                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2">
                    <div class="panel panel-secondary panel-set" style="border-color: #d2cece;">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa-1x" style="font-size:20px;font-weight:bold;font-style-normal">PKR</i>
                                </div>
                                <div class="col-xs-9 text-right">
                                 <?php
                              
                                date_default_timezone_set("Asia/Karachi");
                                $fee=0;
                                
                                $date=date("Y-m-d");
                                $db->where('checkup_date',$date);
                                $cur_tot=$db->get('current_checkup');
                                foreach($cur_tot as $c_t){
                                    $fee+=$c_t['rec_fee'];
                                    
                                }
                                $db->where('checkup_date',$date);
                                $par_tot=$db->get('total_checkup');
                                foreach($par_tot as $p_t){
                                    $fee+=$p_t['rec_fee'];
                                    
                                }
  
                                ?>
                               <div class="hugee"> <?php echo $fee;  ?></div>
                                  
                                </div>
                            </div>
                        </div>
                        <a href="revenue_docter.php" target="_blank">
                            <div class="panel-footer">
                                <span class="pull-left"> Today Revenue</span>
                                

                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2">
                 <div class="panel panel-secondary panel-set" style="border-color: #d2cece;">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-money fa-2x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                 <?php
                              
                               $expenses=0;
                                $date=date("Y/m/d");
                                $db->where ("date",$date);
                                $exp = $db->get('expense_detail');
                                
                                foreach ($exp as $exp_data) {
                                    
                                    $expenses +=$exp_data['price'];
                                   
                                    } 
                                
                                ?>
                                    <div class="hugee"><?php echo $expenses; ?></div>
                                  
                                </div>
                            </div>
                        </div> 
                        <a href="expanse_detail.php" target="_blank">
                            <div class="panel-footer">
                                <span class="pull-left">Today Expenses</span>
                                

                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2">
                    <div class="panel panel-secondary panel-set" style="border-color: #d2cece;">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-clock-o fa-2x"></i>
                                </div>
                                <?php
                                
                                $todaydate=date("Y/m/d");
                                $db->where ("checkup_date",$todaydate);
                                $today = $db->get('total_checkup');
                                $checkups =$db->count;
                                    
                                ?>
                                <div class="col-xs-9 text-right">
                                    <div class="hugee"><?php echo $checkups; ?></div>
                                    
                                </div>
                            </div>
                        </div>
                        <a href="todaycheckup.php">
                            <div class="panel-footer">
                                <span class="pull-left">Today Checkup's </span>
                                

                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-2">
                    <div class="panel panel-secondary panel-set" style="border-color: #d2cece;">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-clock-o fa-2x"></i>
                                </div>
                                <?php
                                
                                $todaydate=date("Y/m/d");
                                $test_total=0;
                                $db->join("total_checkup tc", "tc.checkup_id=tp.checkup_id", "LEFT");
                                $db->where ('tp.test_price','', "!=");
                                $db->where('tc.checkup_date',$todaydate );
                                $testdetail = $db->get ("total_patient_test tp", null, " tp.test_price");
                                foreach($testdetail as $td){
                                $test_total+=$td['test_price'];
                            }
                                    
                                ?>
                                <div class="col-xs-9 text-right">
                                    <div class="hugee"><?php echo $test_total; ?></div>
                                    
                                </div>
                            </div>
                        </div>
                        <a href="todaycheckup.php">
                            <div class="panel-footer">
                                <span class="pull-left"> Test Revenue </span>
                                

                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
              
              
              
            </div>
           
     
<?php     
    }
                                           

                                        
                                        
?>