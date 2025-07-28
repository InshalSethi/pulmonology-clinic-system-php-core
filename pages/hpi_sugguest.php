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
    $query = $db->query("SELECT hpi FROM `hpi_list` WHERE hpi LIKE '%".$searchTerm."%' ORDER BY hpi ASC");

    while ($row = $query->fetch_assoc()) {
        $data[] = $row['hpi'];
    }

    //return json data
    echo json_encode($data);
    }
?>