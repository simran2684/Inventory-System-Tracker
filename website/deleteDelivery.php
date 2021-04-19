<?php
    ob_start();
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../config/Database.php';
    include_once '../models/Deliveries.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate deliveries object
    $schedule = new Deliveries($db);

    $schedule->invoiceNum = $_GET['invoiceNum'];

    try {
        $schedule->deleteDelivery(); 
        echo "Delivery Deleted";
        header('location: viewSchedule.php');
    } catch (exception $e) {
        echo $e->getMessage();
    }