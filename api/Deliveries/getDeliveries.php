<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Deliveries.php';

    // Connect database
    $database = new Database();
    $db = $database->connect();

    //Instantiate supplier object
    $deliveries = new Deliveries($db);


    //Get supplier query
    $result = $deliveries->getDeliveries();

    //Get row count
    $num = $result->rowCount();

    // Check if any supplires
    if ($num > 0) {
        $deliveries_array = array();
        $deliveries_array['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            
            $deliveries_item = array(
                'invoiceNum' => $invoiceNum,
                'dateOrdered' => $dateOrdered,
                'timeOrdered' => $timeOrdered,
                'dateScheduled' => $dateScheduled,
                'timeScheduled' => $timeScheduled
            );
            
            // Push to "data"
            array_push($deliveries_array['data'], $deliveries_item);
        }


        //Turn to JSON format
        echo json_encode($deliveries_array);
    } else {
        echo json_encode(array('message' => 'No Deliveries Found'));
    }