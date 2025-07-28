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
    $query = $db->query("SELECT impression_word FROM `impression_suggest` WHERE impression_word LIKE '%".$searchTerm."%' ORDER BY impression_word ASC");

    while ($row = $query->fetch_assoc()) {
        $data[] = $row['impression_word'];
    }

    //return json data
    echo json_encode($data);
    }
?>