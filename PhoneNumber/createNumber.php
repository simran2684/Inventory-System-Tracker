<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/PhoneNumber.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Create new p_number object
    $p_number = new PhoneNumber($db);

    // Get the raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $p_number->employeeId = $data->employeeId;
    $p_number->phoneNum = $data->phoneNum;


    //Create the p_number
    if ($p_number->createNumber()) {
        echo json_encode(
            array('message' => 'PhoneNumber Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Unable to create Phone Number')
        );
    }