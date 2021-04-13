<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/Customer.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate Customer object
    $customer = new Customer($db);

    // Get the raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $customer->customerNum = $data->customerNum;
    $customer->paymentMethod = $data->paymentMethod;
   

    // Create Customer
    if ($customer->createCustomer()) {
        echo json_encode(
            array('message' => 'Customer Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Customer Not Created')
        );
    }
