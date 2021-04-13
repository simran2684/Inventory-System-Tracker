<?php 

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Deliveries.php';

    // Connect database
    $database = new Database();
    $db = $database->connect();

    //Instantiate deliveries object
    $deliveries = new Deliveries($db);

    //Get id of deliveries
    $deliveries->id = isset($_GET['invoiceNum']) ? $_GET['invoiceNum'] : die();

    //Call getSingleSupplier method
    $deliveries->getSingleDelivery();

    // Create array for deliveries
    $deliveries_array = array(
        'invoiceNum' => $deliveries->invoiceNum,
        'dateOrdered' => $deliveries->dateOrdered,
        'timeOrdered' => $deliveries->timeOrdered,
        'dateScheduled' => $deliveries->dateScheduled,
        'timeScheduled' => $deliveries->timeScheduled,

    );


    //Turn into JSON code
    print_r(json_encode($deliveries_array));