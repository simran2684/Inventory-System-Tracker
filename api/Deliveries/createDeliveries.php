<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/Deliveries.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Create new deliveries object
    $deliveries = new Deliveries($db);

    // Get the raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $deliveries->invoiceNum = $data->invoiceNum;
    $deliveries->dateOrdered = $data->dateOrdered;
    $deliveries->timeOrdered = $data->timeOrdered;
    $deliveries->dateScheduled = $data->dateScheduled;
    $deliveries->timeScheduled = $data->timeScheduled;


    //Create the deliveries
    if ($deliveries->createDeliveries()) {
        echo json_encode(
            array('message' => 'Deliviery Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Unable to create Delivery')
        );
    }