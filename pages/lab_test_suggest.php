<?php
    //database configuration
    include 'connection.php';
    
    //connect with the database
    $db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
    
    //get search term
    $searchTerm = $_GET['term'];
    
    //get matched data from skills table
    $query = $db->query("SELECT DISTINCT test_name FROM lab_test WHERE test_name LIKE '%".$searchTerm."%' ORDER BY test_name ASC");
    while ($row = $query->fetch_assoc()) {
        $data[] = $row['test_name'];
    }
    
    //return json data
    echo json_encode($data);
?>