<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/UpdatesProduct.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Create new set_p object
    $updates_p = new UpdatesProduct($db);

    // Get the raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $updates_p->adminSSN = $data->mgrSSN;
    $updates_p->productNum = $data->productNum;
    
    //Create the set_p
    if ($updates_p->createUpdateProduct()) {
        echo json_encode(
            array('message' => 'Data Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Unable to create data')
        );
    }