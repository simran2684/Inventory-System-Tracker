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

    // Get SSN
    $admin->adminSSN = isset($_GET['adminSSN']) ? $_GET['adminSSN'] : die();

    // Call getSingleAdministrator method
    $admin->getSingleAdministrator();

    // Create array
    $admin_arr = array(
        'adminSSN' => $admin->adminSSN,
        'id' => $admin->id,
        'storeLocation' => $admin->storeLocation
        
    );

    // Make JSON
    print_r(json_encode($admin_arr));
