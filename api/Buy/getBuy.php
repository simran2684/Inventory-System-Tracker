<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Buy.php';

    // Connect database
    $database = new Database();
    $db = $database->connect();

    //Instantiate buy object
    $buy = new Buy($db);


    //Get buy query
    $result = $buy->getBuy();

    //Get row count
    $num = $result->rowCount();

    // Check if any supplires
    if ($num > 0) {
        $buy_array = array();
        $buy_array['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            
            $buy_item = array(
                'productNum' => $productNum,
                'customerNum' => $customerNum,
                'price' => $price
            );
            
            // Push to "data"
            array_push($buy_array['data'], $buy_item);
        }


        //Turn to JSON format
        echo json_encode($buy_array);
    } else {
        echo json_encode(array('message' => 'No Data Found'));
    }
