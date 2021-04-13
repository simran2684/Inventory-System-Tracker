<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/Store.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Create new store object
    $store = new Store($db);

    // Get the raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set storeNum
    $store->storeNum = $data->storeNum;

    // Delete store
    if ($store->deleteStore()) {
        echo json_encode(
            array('message' => 'Store Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Unable to delete store')
        );
    }