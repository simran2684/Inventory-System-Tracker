<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/Clerk.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

   // Instantiate clerk object
   $clerk = new Clerk($db);

    // Get the raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $clerk->mgrSSN = $data->mgrSSN;
    $clerk->id = $data->id;
    $clerk->yearsEmployed = $data->yearsEmployed;
    $clerk->hourlyWage = $data->hourlyWage;
   

    // Create Clerk
    if ($clerk->createClerk()) {
        echo json_encode(
            array('message' => 'Clerk Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Clerk Not Created')
        );
    }
