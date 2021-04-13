<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/SetsPrice.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Create new set_p object
    $set_p = new SetsPrice($db);

    // Get the raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $set_p->productNum = $data->productNum;
    $set_p->adminSSN = $data->adminSSN;
    $set_p->price = $data->price;


    //Create the set_p
    if ($set_p->createPrice()) {
        echo json_encode(
            array('message' => 'Data Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Unable to create data')
        );
    }