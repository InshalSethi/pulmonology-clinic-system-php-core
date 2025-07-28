<?php
    //database configuration
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '12345678';
    $dbName = 'testing';
    
    //connect with the database
    $db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
    
    //get search term
    $searchTerm = $_GET['term'];
    
    //get matched data from skills table
    $query = $db->query("SELECT * FROM word WHERE word LIKE '%".$searchTerm."%' ORDER BY word ASC");
    while ($row = $query->fetch_assoc()) {
        $data[] = $row['word'];
    }
    
    //return json data
    echo json_encode($data);
?>