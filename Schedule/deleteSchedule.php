<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
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

    // Set id
    $schedule->scheduleNum = $data->scheduleNum;

    // Delete schedule
    if ($schedule->deleteSchedule()) {
        echo json_encode(
            array('message' => 'Schedule Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Unable to delete schedule')
        );
    }