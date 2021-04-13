<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/Deliveries.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Create new deliveries$deliveries object
    $deliveries = new Deliveries($db);

    // Get the raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set id
    $deliveries->invoiceNum = $data->invoiceNum;

    // Delete deliveries$deliveries
    if ($deliveries->deleteDelivery()) {
        echo json_encode(
            array('message' => 'Delivery Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Unable to delete Delivery')
        );
    }