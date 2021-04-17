<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/Dependents.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate dependent object
    $dependent = new Dependents($db);

    // Get the raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $dependent->employeeId = $data->employeeId;
    $dependent->name = $data->name;
    $dependent->phoneNumber = $data->phoneNumber;

    // Create dependent
    if ($dependent->createEmployee()) {
        echo json_encode(
            array('message' => 'Dependent Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Dependent Not Created')
        );
    }