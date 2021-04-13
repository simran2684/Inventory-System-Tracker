<?php 

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/ManagerViewsSchedule.php';

    // Connect database
    $database = new Database();
    $db = $database->connect();

    //Instantiate mvs object
    $mvs = new ManagerViewsSchedule($db);

    //Get MgrSSN of mvs
    $mvs->MgrSSN = isset($_GET['MgrSSN']) ? $_GET['MgrSSN'] : die();
    $mvs->ScheduleNum = isset($_GET['ScheduleNum']) ? $_GET['ScheduleNum'] : die();
  
    //Call getManagerViewsSchedule method
    $mvs->getManagerViewsSchedule();

    // Create array for mvs
    $mvs_array = array(
        'MgrSSN' => $mvs->MgrSSN,
        'ScheduleNum' => $mvs->ScheduleNum
 
    );


    //Turn into JSON code
    print_r(json_encode($mvs_array));