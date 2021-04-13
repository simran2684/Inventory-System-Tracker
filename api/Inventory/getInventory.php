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


    //Get inventory query
    $result = $inventory->getInventory();

    //Get row count
    $num = $result->rowCount();

    // Check if any supplires
    if ($num > 0) {
        $inventory_array = array();
        $inventory_array['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            
            $inventory_item = array(
                'inventoryNum' => $inventoryNum,
                'storeNum' => $storeNum,
                'capacity' => $capacity
            );
            
            // Push to "data"
            array_push($inventory_array['data'], $inventory_item);
        }
    

        //Turn to JSON format
        echo json_encode($inventory_array);
    } else {
        echo json_encode(array('message' => 'No Inventories Found'));
    }