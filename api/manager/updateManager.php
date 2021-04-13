<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/Manager.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate Manager object
    $manager = new Manager($db);

    // decode data
    $data = json_decode(file_get_contents("php://input"));

    // Set the ssn for the update
    $manager->mgrSSN = $data->mgrSSN;
    $manager->ID = $data->ID;
    $manager->storeLocation = $data->storeLocation;
    
    // Update manager
    if ($manager->updateManager()) {
        echo json_encode(
            array('message' => 'Manager Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Manager Not Updated')
        );
    }
