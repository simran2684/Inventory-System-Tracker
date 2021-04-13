<?php 

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/AddsProduct.php';

    // Connect database
    $database = new Database();
    $db = $database->connect();

    //Instantiate adds_p object
    $adds_p = new AddsProduct($db);

    //Get id of adds_p
    $adds_p->mgrSSN = isset($_GET['mgrSSN']) ? $_GET['mgrSSN'] : die();
    $adds_p->productNum = isset($_GET['productNum']) ? $_GET['productNum'] : die();

    //Call getSingleSupplier method
    $adds_p->getSingleAdd();

    // Create array for adds_p
    $adds_p_array = array(
        'mgrSSN' => $adds_p->mgrSSN,
        'productNum' => $adds_p->productNum       
    );


    //Turn into JSON code
    print_r(json_encode($adds_p_array));