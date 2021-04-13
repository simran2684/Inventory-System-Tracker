<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
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

    // Set id
    $inventory->inventoryNum = $data->inventoryNum;

    // Delete inventory
    if ($inventory->deleteInventory()) {
        echo json_encode(
            array('message' => 'Inventory Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Unable to delete inventory')
        );
    }