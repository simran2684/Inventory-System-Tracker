<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Clerk.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate clerk object
    $clerk = new Clerk($db);

    // Get ID
    $clerk->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Call getSingleClerk method
    $clerk->getSingleClerk();

    // Create array
    $clerk_arr = array(
        'MgrSSN' => $clerk->mgrSSN,
        'ID' => $clerk->id,
        'YearsEmployed' => $clerk->yearsEmployed,
        'HourlyWage' => $clerk->hourlyWage
        
    );

    // Make JSON
    print_r(json_encode($clerk_arr));
