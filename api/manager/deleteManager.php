<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/Manager.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Create new manager$manager object
    $manager = new Manager($db);

    // Get the raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set id
    $manager->mgrSSN = $data->mgrSSN;

    // Delete manager$manager
    if ($manager->deleteManager()) {
        echo json_encode(
            array('message' => 'Manager Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Unable to delete Manager')
        );
    }
