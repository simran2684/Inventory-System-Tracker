<?php

// Headers 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Dependents.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate dependents object
$dependents = new Dependents($db);

// Dependents query
$result = $dependents->read();        // result from the read function
// Get row count
$num = $result->rowCount();

// Check if any dependents
if($num > 0){
    // Dependents array
    $dep_arr = array();
    $dep_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $dep_item = array(
            'EmployeeID' => $employeeid,
            'Name' => $name,
            'PhoneNumber' => $phoneNum
           );

        // Push to "data"
        array_push($dep_arr['data'], $dep_item);
    }

    // Turn to JSON & output 
    echo json_encode($dep_arr);
} else{
    // No dependents
    echo json_encode(
        array('message' => 'No Dependents Found')
    );
}
