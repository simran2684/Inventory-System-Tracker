<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/Buy.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Create new buy object
    $buy = new Buy($db);

    // Get the raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $buy->productNum = $data->productNum;
    $buy->customerNum = $data->customerNum;


    //Create the buy
    if ($buy->createBuy()) {
        echo json_encode(
            array('message' => 'Data Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Unable to create data')
        );
    }