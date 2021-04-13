<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/Administrator.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

   // Instantiate admin$admin object
   $admin = new Administrator($db);


    // Get the raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set ssn
    $admin->adminSSN = $data->adminSSN;

    // Delete admin$admin 
    if ($admin->deleteAdministrator()) {
        echo json_encode(
            array('message' => 'Administrator Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Unable to delete Administrator')
        );
    }
