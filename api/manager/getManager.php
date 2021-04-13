<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Manager.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate manager object
    $manager = new Manager($db);

    // Get manager query
    $result = $manager->readManager();
    // Get row count
    $num = $result->rowCount();

    // Check if any mangers
    if ($num > 0) {
        $manager_arr = array();
        $manager_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $manager_item = array(
                'MgrSSN' => $mgrSSN,
                'ID' => $id,
                'StoreLocation' => $storeLocation
            );

            // Push to "data"
            array_push($manager_arr['data'], $manager_item);
        }

        // Turn to JSON and Output
        echo json_encode($manager_arr);
    } else {
        // No managers
        echo json_encode(
            array('message' => 'No Managers Found')
        );
    }
