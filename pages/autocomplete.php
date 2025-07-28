<?php
    //database configuration
     include 'connection.php';
    
    //connect with the database
    $db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
    
    //get search term
    $searchTerm = $_GET['term'];
    
    //get matched data from skills table
    $query = $db->query("SELECT * FROM medicine_suggestion WHERE medi_name LIKE '%".$searchTerm."%' ORDER BY medi_name ASC");

    while ($row = $query->fetch_assoc()) {
            
          //  $id=$row['med_id']; 
          //  $med_name=$row['medi_name'];
           // $data[] =array('id'=> $id,'med_name'=> $med_name);
              $data[] =$row['medi_name'];;

    }
    
    //return json data
    echo json_encode($data);
?>