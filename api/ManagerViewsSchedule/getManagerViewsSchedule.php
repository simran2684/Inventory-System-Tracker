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


    //Get mvs query
    $result = $mvs->getManagerViewsSchedule();

    //Get row count
    $num = $result->rowCount();

    // Check if any cvs
    if ($num > 0) {
        $mvs_array = array();
        $mvs_array['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            
            $mvs_item = array(
                'mgrSSN' => $mgrSSN,
                'scheduleNum' => $scheduleNum
                
            );
            
            // Push to "data"
            array_push($mvs_array['data'], $mvs_item);
        }


        //Turn to JSON format
        echo json_encode($mvs_array);
    } else {
        echo json_encode(array('message' => 'No Data Found'));
    }