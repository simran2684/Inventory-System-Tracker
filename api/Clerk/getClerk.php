<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Clerk.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate customer object
    $clerk = new Clerk($db);

    // Get clerk query
    $result = $clerk->readClerk();
    // Get row count
    $num = $result->rowCount();

    // Check if any clerks
    if ($num > 0) {
        $clerk_arr = array();
        $clerk_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $clerk_item = array(
                'MgrSSN' => $mgrSSN,
                'ID' => $id,
                'YearsEmployed' => $yearsEmployed,
                'HourlyWage' => $hourlyWage
            );

            // Push to "data"
            array_push($clerk_arr['data'], $clerk_item);
        }

        // Turn to JSON and Output
        echo json_encode($clerk_arr);
    } else {
        // No clerks
        echo json_encode(
            array('message' => 'No Clerks Found')
        );
    }
