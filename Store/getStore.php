<?php 

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Store.php';

    // Connect database
    $database = new Database();
    $db = $database->connect();

    //Instantiate store object
    $store = new Store($db);


    //Get store query
    $result = $store->getStore();

    //Get row count
    $num = $result->rowCount();

    // Check if any stores
    if ($num > 0) {
        $store_array = array();
        $store_array['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            
            $store_item = array(
                'storeNum' => $storeNum,
                'name' => $name,
                'streetName' => $streetName,
                'country' => $country,
                'city' => $city,
                'postalCode' => $postalCode
            );
            
            // Push to "data"
            array_push($store_array['data'], $store_item);
        }


        //Turn to JSON format
        echo json_encode($store_array);
    } else {
        echo json_encode(array('message' => 'No Suppliers Found'));
    }