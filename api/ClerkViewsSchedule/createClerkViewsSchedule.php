<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/ClerkViewsSchedule.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

   //Instantiate cvs object
   $cvs = new ClerkViewsSchedule($db);

    // Get the raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $cvs->ScheduleNum = $data->ScheduleNum;
    $cvs->ClerkID = $data->ClerkID;
   


    //Create the buy
    if ($cvs->createClerkViewsSchedule()) {
        echo json_encode(
            array('message' => 'Data Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Unable to create data')
        );
    }