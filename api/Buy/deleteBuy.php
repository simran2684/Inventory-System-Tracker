<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
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

    // Set id
    $buy->productNum = $data->productNum;
    $buy->customerNum = $data->customerNum;

    // Delete buy
    if ($buy->deleteBuy()) {
        echo json_encode(
            array('message' => 'Data Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Unable to delete data')
        );
    }