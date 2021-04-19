<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Administrator.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate admin object
    $admin = new Administrator($db);

    // Get admin query
    $result = $admin->readAdministrator();
    // Get row count
    $num = $result->rowCount();

    // Check if any admins
    if ($num > 0) {
        $admin_arr = array();
        $admin_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $admin_item = array(
                'adminSSN' => $adminSSN,
                'id' => $id,            
                'storeLocation' => $storeLocation
            );

            // Push to "data"
            array_push($admin_arr['data'], $admin_item);
        }

        // Turn to JSON and Output
        echo json_encode($admin_arr);
    } else {
        // No admins
        echo json_encode(
            array('message' => 'No Administrators Found')
        );
    }

