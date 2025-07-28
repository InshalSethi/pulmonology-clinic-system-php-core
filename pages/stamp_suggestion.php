<?php
    //database configuration
    include 'connection.php';
    
    //connect with the database
    $db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
    
    //get search term
    $searchTerm = $_GET['term'];
    if(strlen($searchTerm)>=1){
    //get matched data from skills table
    $query = $db->query("SELECT st_name FROM `stamps` WHERE st_name LIKE '%".$searchTerm."%' ORDER BY st_name ASC");
    
    while ($row = $query->fetch_assoc()) {
        $data[] = $row['st_name'];
    }
    
    //return json data
    echo json_encode($data);
    }
?>