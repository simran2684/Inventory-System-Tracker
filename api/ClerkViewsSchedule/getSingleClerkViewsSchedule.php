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
    $cvs->clerkId = isset($_GET['clerkId']) ? $_GET['clerkId'] : die();
    $cvs->scheduleNum = isset($_GET['scheduleNum']) ? $_GET['scheduleNum'] : die();
  
    //Call getSingleClerkViewsSchedule method
    $cvs->getSingleClerkViewsSchedule();

    // Create array
    $cvs_array = array(
        'clerkId' => $cvs->clerkId,
        'scheduleNum' => $cvs->scheduleNum
    );

    //Turn into JSON code
    print_r(json_encode($cvs_array));