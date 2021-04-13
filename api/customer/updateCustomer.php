<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/Customer.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate Customer object
    $customer = new Customer($db);

    // decode data
    $data = json_decode(file_get_contents("php://input"));

    // Set the num for the update
    $customer->customerNum = $data->customerNum;
   
    $customer->paymentMethod = $data->paymentMethod;
    
    // Update customer
    if ($customer->updateCustomer()) {
        echo json_encode(
            array('message' => 'Customer Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Customer Not Updated')
        );
    }
