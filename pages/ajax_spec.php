<?php

include '../include/config_new.php';
include '../include/MysqliDb.php';
include '../include/config.php'; 
   
    //get search term
    
    if( $_POST['action'] ){
        
        $action=$_POST['action'];
        if( $action=='get_special_disc' ){
            
            $id=$_POST['get_id'];
            $spc_data=$db->get('special_discription');
            foreach($spc_data as $sd){ ?>
            
            <a class="dropdown-item show"  onclick='Special_fill("<?php echo  $sd['spc_desc']; ?>","<?php echo  $id; ?>")' style="text-align:right;font-size: 17px;font-weight: 600;font-family: 'Noto Nastaliq Urdu Draft', serif;" >  <?php echo $sd['spc_desc']; ?> </a>  
            <?php
                
                
            }
            
        
            
        }
        
        
        
    }
    
     
     
      
     

    ?>

