<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Customer.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate customer object
    $customer = new Customer($db);

    // Get num
    $customer->customerNum = isset($_GET['customerNum']) ? $_GET['customerNum'] : die();

    // Call getSingleCustomer method
    $customer->getSingleCustomer();

    // Create array
    $customer_arr = array(
        'CustomerNum' => $customer->customerNum,
        'PaymentMethod' => $customer->paymentMethod
        
    );

    // Make JSON
    print_r(json_encode($customer_arr));
