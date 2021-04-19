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


    //Get cvs query
    $result = $cvs->getClerkViewsSchedule();

    //Get row count
    $num = $result->rowCount();

    // Check if any cvs
    if ($num > 0) {
        $cvs_array = array();
        $cvs_array['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            
            $cvs_item = array(
                'clerkId' => $clerkId,
                'scheduleNum' => $scheduleNum
                
            );
            
            // Push to "data"
            array_push($cvs_array['data'], $cvs_item);
        }


        //Turn to JSON format
        echo json_encode($cvs_array);
    } else {
        echo json_encode(array('message' => 'No Data Found'));
    }