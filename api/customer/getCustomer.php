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

    // Get customer query
    $result = $customer->read();
    // Get row count
    $num = $result->rowCount();

    // Check if any customers
    if ($num > 0) {
        $customer_arr = array();
        $customer_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $customer_item = array(
                'CustomerNum' => $customerNum,
                'PaymentMethod' => $paymentMethod
            );

            // Push to "data"
            array_push($customer_arr['data'], $customer_item);
        }

        // Turn to JSON and Output
        echo json_encode($customer_arr);
    } else {
        // No customers
        echo json_encode(
            array('message' => 'No Customers Found')
        );
    }
