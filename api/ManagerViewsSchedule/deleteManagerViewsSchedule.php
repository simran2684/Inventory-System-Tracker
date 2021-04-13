<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/ManagerViewsSchedule.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Create new mvs object
    $mvs = new ManagerViewsSchedule($db);

    // Get the raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set id
    $mvs->ScheduleNum = $data->ScheduleNum;
    $mvs->MgrSSN = $data->MgrSSN;

    // Delete mvs
    if ($mvs->deleteManagerViewsSchedule()) {
        echo json_encode(
            array('message' => 'Data Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Unable to delete data')
        );
    }