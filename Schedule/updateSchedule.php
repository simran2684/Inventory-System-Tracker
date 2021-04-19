<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/Schedule.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Create new schedule object
    $schedule = new Schedule($db);

    // Get the raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //Make sure id is here
    $schedule->scheduleNum = $data->scheduleNum;
    $schedule->deliveryInvoiceNum = $data->deliveryInvoiceNum;


    //Create the schedule
    if ($schedule->updateSchedule()) {
        echo json_encode(
            array('message' => 'Schedule Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Unable to update schedule')
        );
    }