<?php 

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Inventory.php';

    // Connect database
    $database = new Database();
    $db = $database->connect();

    //Instantiate inventory object
    $inventory = new Inventory($db);

    //Get id of inventory
    $inventory->inventoryNum = isset($_GET['inventoryNum']) ? $_GET['inventoryNum'] : die();

    //Call getSingleSupplier method
    $inventory->getSingleInventory();

    // Create array for inventory
    $inventory_array = array(
        'inventoryNum' => $inventory->inventoryNum,
        'storeNum' => $inventory->storeNum,
        'capacity' => $inventory->capacity
    );


    //Turn into JSON code
    print_r(json_encode($inventory_array));