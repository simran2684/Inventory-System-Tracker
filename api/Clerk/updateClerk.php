<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/Clerk.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

     // Instantiate clerk object
    $clerk = new Clerk($db);
 
    // decode data
    $data = json_decode(file_get_contents("php://input"));

    // Set the id for the update
    $clerk->id = $data->id;
  
    $clerk->mgrSSN = $data->mgrSSN;
    $clerk->yearsEmployed = $data->yearsEmployed;
    $clerk->hourlyWage = $data->hourlyWage;
    
    // Update clerk
    if ($clerk->updateClerk()) {
        echo json_encode(
            array('message' => 'Clerk Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Clerk Not Updated')
        );
    }
