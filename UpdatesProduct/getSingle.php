<?php 

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/UpdatesProduct.php';

    // Connect database
    $database = new Database();
    $db = $database->connect();

    //Instantiate updates_p object
    $updates_p = new UpdatesProduct($db);

    //Get id of updates_p
    $updates_p->mgrSSN = isset($_GET['mgrSSN']) ? $_GET['mgrSSN'] : die();
    $updates_p->productNum = isset($_GET['productNum']) ? $_GET['productNum'] : die();

    //Call getSingleSupplier method
    $updates_p->getSingleUpdate();

    // Create array for updates_p
    $updates_p_array = array(
        'mgrSSN' => $updates_p->mgrSSN,
        'productNum' => $updates_p->productNum       
    );


    //Turn into JSON code
    print_r(json_encode($updates_p_array));