<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Dependents.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate employee object
    $dp = new Dependents($db);

    // Get id
    $dp->employeeId = isset($_GET['employeId']) ? $_GET['employeeId'] : die();

    // Call getSingleDependents method
    $dp->getSingleDependents();

    // Create array
    $dp_arr = array(
        'EmployeeId' => $dp->employeeId,
        'Name' => $dp->name,
        'PhoneNumber' => $dp->phoneNumber,
      
    );

    // Make JSON
    print_r(json_encode($dp_arr));
