<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/AddsProduct.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Create new set_p object
    $adds_p = new AddsProduct($db);

    // Get the raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set id
    $adds_p->mgrSSN = $data->mgrSSN;
    $adds_p->productNum = $data->productNum;
    

    // Delete set_p
    if ($adds_p->deleteData()) {
        echo json_encode(
            array('message' => 'Data Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Unable to delete data')
        );
    }