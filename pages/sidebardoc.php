 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php" style="display:none">Doctor Professor M.Rafiq Sethi</a>
            </div>

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            <ul class="nav navbar-nav navbar-left navbar-top-links">
                <li><a href="index.php" style="padding: 0px;"><img src="../img/shifacare-new (1).png" style="width: 171px;height: 50px;margin-left: 40px;margin-top: 0px;"></a></li>
            </ul>

            <ul class="nav navbar-right navbar-top-links">
               
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> Your Profile <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                       
                        <li><a href="change_pass.php"><i class="fa fa-gear fa-fw"></i> Change Password</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../include/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- /.navbar-top-links -->
<style>
    .set-scrol{
        height:auto; 
    }
    .set-list{
            padding: 5px!important;
            padding-left: 42px!important;
    }
</style>
            <div class="navbar-default sidebar set-scrol" role="navigation" >
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <!--<div class="input-group custom-search-form">-->
                            <!--    <input type="text" class="form-control" placeholder="Search...">-->
                            <!--    <span class="input-group-btn">-->
                            <!--            <button class="btn btn-primary" type="button">-->
                            <!--                <i class="fa fa-search"></i>-->
                            <!--            </button>-->
                            <!--    </span>-->
                            <!--</div>-->
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="index.php" class="" ><i class="fa fa-clock-o fa-fw"></i> Current checkup</a>
                        </li>
                       
                        <!--<li>-->
                        <!--    <a href="viewappointments.php"> <i class="fa fa-calendar-plus-o" style='padding-right: 5px;'></i>View Appointments</a>-->
                        <!--</li>-->
                        <!--<li>-->
                        <!--    <a href="precept.php"><i class="fa fa-medkit" style='padding-right: 5px;'></i>Add Prescription</a>-->
                        <!--</li>-->
                      
                        <li>
                            <a href="allpatients.php" ><i class="fa fa-users" style='padding-right: 5px;'></i>View All Patients Data</a>
                        </li>
                         <li>
                                <a href="#"><i class="fa fa-wrench fa-fw"></i> Administrative Tools<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level" >
                                   
                                     <li>
                                        <a href="addpatient.php" class="set-list">Add Patient</a>
                                    </li>
                                     <li>
                                        <a href="allpatient.php" class="set-list">Existing Patient checkup</a>
                                    </li>
                                    <li>
                                          <a href="revenue_docter.php" class="set-list">
                                              <!--<i class="fa fa-usd" style='padding-right: 5px;'></i>-->
                                          View Revenue</a>
                                     </li>
                                     <li>
                                    <a href="revenue_lab.php" class="set-list">
                                          View Lab Revenue</a>
                                     </li>
                                     <li>
                                          <a href="add_expense.php" class="set-list">
                                              <!--<i class="fa fa-money" style='padding-right: 5px;'></i>-->
                                             Add Expenses</a>
                                     </li>
                                     <li>
                                          <a href="expanse_detail.php" class="set-list">
                                              <!--<i class="fa fa-money" style='padding-right: 5px;'></i>-->
                                              Expenses Detail</a>
                                     </li>
                                    <li>
                                        <a href="view_all_medicine.php" class="set-list"> Medicine</a>
                                    </li>
                                    <li>
                                        <a href="view_all_hpi.php" class="set-list"> HPI List</a>
                                    </li>
                                    <li>
                                        <a href="view_all_plan.php" class="set-list"> Plans List</a>
                                    </li>
                                    <li>
                                        <a href="view_all_stamps.php" class="set-list"> Stamps</a>
                                    </li>
                                    <li>
                                        <a href="view_all_indoor.php" class="set-list"> Indoor Lab Tests</a>
                                    </li>
                                    <li>
                                        <a href="view_all_outdoor.php" class="set-list"> Outdoor Lab Tests</a>
                                    </li>
                                    <li>
                                        <a href="view_all_impression.php" class="set-list"> Impression</a>
                                    </li>
                                    <!--<li>-->
                                    <!--    <a href="view_all_prev_lab.php" class="set-list">Review of prev lab</a>-->
                                    <!--</li>-->
                                    <!--<li>-->
                                    <!--    <a href="view_all_prev_med.php" class="set-list">Review of prev medication</a>-->
                                    <!--</li>-->
                                   
                            
                                  
                                   
                                   
                                   
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                    </ul>
                </div>
            </div>
        </nav>