<?php 

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/ClerkViewsSchedule.php';

    // Connect database
    $database = new Database();
    $db = $database->connect();

    //Instantiate cvs object
    $cvs = new ClerkViewsSchedule($db);

    //Get ClerkID of cvs
    $cvs->clerkId = isset($_GET['ClerkID']) ? $_GET['ClerkID'] : die();
    $cvs->scheduleNum = isset($_GET['ScheduleNum']) ? $_GET['ScheduleNum'] : die();
  
    //Call getSingleClerkViewsSchedule method
    $cvs->getSingleClerkViewsSchedule();

    // Create array for buy
    $cvs_array = array(
        'ClerkID' => $cvs->ClerkID,
        'ScheduleNum' => $cvs->ScheduleNum
 
    );


    //Turn into JSON code
    print_r(json_encode($cvs_array));