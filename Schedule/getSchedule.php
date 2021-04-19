<?php 

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Schedule.php';

    // Connect database
    $database = new Database();
    $db = $database->connect();

    //Instantiate schedule object
    $schedule = new Schedule($db);


    //Get schedule query
    $result = $schedule->getSchedule();

    //Get row count
    $num = $result->rowCount();

    // Check if any supplires
    if ($num > 0) {
        $schedule_array = array();
        $schedule_array['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            
            $schedule_item = array(
                'scheduleNum' => $scheduleNum,
                'deliveryInvoiceNum' => $deliveryInvoiceNum
            );
            
            // Push to "data"
            array_push($schedule_array['data'], $schedule_item);
        }
    

        //Turn to JSON format
        echo json_encode($schedule_array);
    } else {
        echo json_encode(array('message' => 'No Suppliers Found'));
    }