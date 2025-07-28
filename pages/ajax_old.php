<?php

include '../include/config_new.php';
include '../include/MysqliDb.php';
include '../include/config.php'; 
    $a= new crud();
    //get search term
    
     $value = $_POST['mydata'];
     if (!isset($_POST['new_id'])) {
        $id_class="0";
       
      }
      else
      {
          $id_class = $_POST['new_id'];
      }
     
$ab=$a->select('medicine_suggestion','*',"medi_name='".$value."'",'');
 while($data=$ab->fetch_array())
 {
     $id=$data['med_id'];
 }
    ?>
    
     
         
    <?php
        
        $db->where('med_id',$id);
        $desc_data=$db->get('medicine_description');    
   
            
        foreach( $desc_data as $ur_des )
        {
            
          $content =$ur_des['description']; 
        
        ?>
         
      
           
       <a class="dropdown-item show"  onclick='fill_old("<?php echo  $content; ?>","<?php echo  $id_class; ?>")' style="text-align:right;font-size: 14px;font-weight: 600;font-family: 'Noto Nastaliq Urdu Draft', serif;" >  <?php echo $content; ?> </a>  
         
<?php
    } ?>
    
     
    
    <?php
    

    
             // echo json_encode($data11);
    
  
?>


