<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/Customer.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Create new customer$customer object
    $customer = new Customer($db);

    // Get the raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set id
    $customer->customerNum = $data->customerNum;

    // Delete customer$customer
    if ($customer->deleteCustomer()) {
        echo json_encode(
            array('message' => 'Customer Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Unable to delete Customer')
        );
    }