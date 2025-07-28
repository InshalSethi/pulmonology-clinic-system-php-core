<?php
    //database configuration
   include 'connection.php';
    
    //connect with the database
    $db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
    
    //get search term
    $searchTerm = $_GET['term'];
    
    //get matched data from skills table
    $query = $db->query("SELECT * FROM medication_term WHERE med_term LIKE '%".$searchTerm."%' ORDER BY med_term ASC");
    while ($row = $query->fetch_assoc()) {
        $data[] = $row['med_term'];
    }
    
    //return json data
    echo json_encode($data);
?>