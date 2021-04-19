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

    // Get ssn
    $manager->mgrSSN = isset($_GET['mgrSSN']) ? $_GET['mgrSSN'] : die();

    // Call getSingleManager method
    $manager->getSingleManager();

    // Create array
    $manager_arr = array(
        'mgrSSN' => $manager->mgrSSN,
        'id' => $manager->id,
        'storeLocation' => $manager->storeLocation
        
    );

    // Make JSON
    print_r(json_encode($manager_arr));
