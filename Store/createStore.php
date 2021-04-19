<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/store.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Create new store object
    $store = new store($db);

    // Get the raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $store->storeNum = $data->storeNum;
    $store->name = $data->name;
    $store->streetName = $data->streetName;
    $store->country = $data->country;
    $store->city = $data->city;
    $store->postalCode = $data->postalCode;


    //Create the store
    if ($store->createStore()) {
        echo json_encode(
            array('message' => 'store Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Unable to create store')
        );
    }