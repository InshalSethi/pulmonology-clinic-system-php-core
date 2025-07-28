<?php
    //database configuration
    include 'connection.php';
    
    //connect with the database
    $db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
    
    //get search term
    $searchTerm = $_GET['term'];
    if(strlen($searchTerm)>=1){
    //initialize data array
    $data = array();
    //get matched data from skills table
    $query = $db->query("SELECT plan_name FROM `plan_list` WHERE plan_name LIKE '%".$searchTerm."%' ORDER BY plan_name ASC");

    while ($row = $query->fetch_assoc()) {
        $data[] = $row['plan_name'];
    }

    //return json data
    echo json_encode($data);
    }
?>