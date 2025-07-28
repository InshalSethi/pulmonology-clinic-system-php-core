<?php
    //database configuration
    include 'connection.php';
    
    //connect with the database
    $db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
    
    //get search term
    $searchTerm = $_GET['term'];
    
    //get matched data from skills table
    $query = $db->query("SELECT * FROM review_lab WHERE lab_test LIKE '%".$searchTerm."%' ORDER BY lab_test ASC");

    while ($row = $query->fetch_assoc()) {
        $data[] = $row['lab_test'];
    }
    
    //return json data
    echo json_encode($data);
?>