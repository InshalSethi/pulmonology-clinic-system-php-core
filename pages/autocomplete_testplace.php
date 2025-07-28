<?php
    //database configuration
   include_once 'connection.php';
    
    //connect with the database
    $db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
    
    //get search term
    $searchTerm = $_GET['term'];
    
    //get matched data from skills table
    $query = $db->query("SELECT * FROM tbl_test_place WHERE place_name LIKE '%".$searchTerm."%' ORDER BY place_name ASC");

    while ($row = $query->fetch_assoc()) {
        $data[] = $row['place_name'];
    }
    
    //return json data
    echo json_encode($data);
?>