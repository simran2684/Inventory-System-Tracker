<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/Clerk.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

   // Instantiate clerk$clerk object
   $clerk = new Clerk($db);


    // Get the raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set id
    $clerk->id = $data->id;

    // Delete clerk$clerk
    if ($clerk->deleteClerk()) {
        echo json_encode(
            array('message' => 'Clerk Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Unable to delete Clerk')
        );
    }