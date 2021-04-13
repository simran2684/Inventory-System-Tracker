<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/Inventory.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Create new inventory object
    $inventory = new Inventory($db);

    // Get the raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //Make sure id is here
    $inventory->inventoryNum = $data->inventoryNum;

    $inventory->storeNum = $data->storeNum;
    $inventory->capacity = $data->capacity;


    //Create the inventory
    if ($inventory->updateInventory()) {
        echo json_encode(
            array('message' => 'Inventory Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Unable to update inventory')
        );
    }