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
    $mvs->mgrSSN = isset($_GET['mgrSSN']) ? $_GET['mgrSSN'] : die();
    $mvs->scheduleNum = isset($_GET['scheduleNum']) ? $_GET['scheduleNum'] : die();
  
    //Call getManagerViewsSchedule method
    $mvs->getManagerViewsSchedule();

    // Create array for mvs
    $mvs_array = array(
        'mgrSSN' => $mvs->mgrSSN,
        'scheduleNum' => $mvs->scheduleNum
 
    );


    //Turn into JSON code
    print_r(json_encode($mvs_array));