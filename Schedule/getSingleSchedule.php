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

    //Get id of schedule
    $schedule->scheduleNum = isset($_GET['scheduleNum']) ? $_GET['scheduleNum'] : die();

    //Call getSingleSupplier method
    $schedule->getSingleSchedule();

    // Create array for schedule
    $schedule_array = array(
        'scheduleNum' => $schedule->scheduleNum,
        'deliveryInvoiceNum' => $schedule->deliveryInvoiceNum,
    );


    //Turn into JSON code
    print_r(json_encode($schedule_array));