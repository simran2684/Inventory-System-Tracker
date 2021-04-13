<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
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

    //Make sure id is here
    $deliveries->invoiceNum = $data->invoiceNum;

    $deliveries->dateOrdered = $data->dateOrdered;
    $deliveries->timeOrdered = $data->timeOrdered;
    $deliveries->dateScheduled = $data->dateScheduled;
    $deliveries->timeScheduled = $data->timeScheduled;


    //Create the deliveries
    if ($deliveries->updateDelivery()) {
        echo json_encode(
            array('message' => 'Delivery Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Unable to update deliveries')
        );
    }