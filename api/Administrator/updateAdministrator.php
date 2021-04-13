<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/Administrator.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate admin object
    $admin = new Administrator($db);
     
    // decode data
    $data = json_decode(file_get_contents("php://input"));

    // Set the ssn for the update
    $admin->adminSSN = $data->adminSSN;
   
    $admin->id = $data->id;
    $admin->storeLocation = $data->storeLocation;
    
    // Update admin
    if ($admin->updateAdministrator()) {
        echo json_encode(
            array('message' => 'Administrator Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Administrator Not Updated')
        );
    }
