<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/Manager.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate Manager object
    $manager = new Manager($db);

    // Get the raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $manager->mgrSSN = $data->mgrSSN;
    $manager->ID = $data->id;
    $manager->storeLocation = $data->storeLocation;
   

    // Create manager
    if ($manager->createManager()) {
        echo json_encode(
            array('message' => 'Manager Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Manager Not Created')
        );
    }
