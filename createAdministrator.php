<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/Administrator.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate admin object
    $admin = new Administrator($db);

    // Get the raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $admin->adminSSN = $data->adminSSN;
    $admin->id = $data->id;
    $admin->storeLocation = $data->storeLocation;
   

    // Create Admin
    if ($admin->createAdministrator()) {
        echo json_encode(
            array('message' => 'Administrator Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Administrator Not Created')
        );
    }
