<?php 

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/SetsPrice.php';

    // Connect database
    $database = new Database();
    $db = $database->connect();

    //Instantiate set_p object
    $set_p = new SetsPrice($db);

    //Get id of set_p
    $set_p->productNum = isset($_GET['productNum']) ? $_GET['productNum'] : die();
    $set_p->adminSSN = isset($_GET['adminSSN']) ? $_GET['adminSSN'] : die();

    //Call getSingleSupplier method
    $set_p->getSingle();

    // Create array for set_p
    $set_p_array = array(
        'productNum' => $set_p->productNum,
        'adminSSN' => $set_p->adminSSN,
        'price' => $set_p->price
    );


    //Turn into JSON code
    print_r(json_encode($set_p_array));