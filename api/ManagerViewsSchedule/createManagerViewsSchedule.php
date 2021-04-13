<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/ManagerViewsSchedule.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

   //Instantiate mvs object
   $mvs = new ManagerViewsSchedule($db);

    // Get the raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $mvs->ScheduleNum = $data->ScheduleNum;
    $mvs->MgrSSN = $data->MgrSSN;
   


    //Create the buy
    if ($mvs->createManagerViewsSchedule()) {
        echo json_encode(
            array('message' => 'Data Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Unable to create data')
        );
    }