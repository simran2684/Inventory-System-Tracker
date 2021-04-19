<?php 

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Buy.php';

    // Connect database
    $database = new Database();
    $db = $database->connect();

    //Instantiate buy object
    $buy = new Buy($db);

    //Get customerNum of buy
    $buy->productNum = isset($_GET['productNum']) ? $_GET['productNum'] : die();
    $buy->customerNum = isset($_GET['customerNum']) ? $_GET['customerNum'] : die();
  
    //Call getSingleSupplier method
    $buy->getSingleBuy();

    // Create array for buy
    $buy_array = array(
        'productNum' => $buy->productNum,
        'customerNum' => $buy->customerNum
    );


    //Turn into JSON code
    print_r(json_encode($buy_array));