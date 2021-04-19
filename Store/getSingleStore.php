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

    //Get storeNum of store
    $store->storeNum = isset($_GET['storeNum']) ? $_GET['storeNum'] : die();

    //Call getSingleSupplier method
    $store->getSingleStore();

    // Create array for store
    $store_array = array(
        'storeNum' => $store->storeNum,
        'name' => $store->name,
        'streetName' => $store->streetName,
        'country' => $store->country,
        'city' => $store->city,
        'postalCode' => $store->postalCode
    );


    //Turn into JSON code
    print_r(json_encode($store_array));