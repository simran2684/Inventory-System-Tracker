<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/Employee.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate employee object
    $employee = new Employee($db);

    // Get the raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $employee->employeeId = $data->employeeId;
    $employee->name = $data->name;
    $employee->position = $data->position;
    $employee->country = $data->country;
    $employee->city = $data->city;
    $employee->postalCode = $data->postalCode;
    $employee->streetName = $data->streetName;
    $employee->storeNum = $data->storeNum;

    // Create employee
    if ($employee->createEmployee()) {
        echo json_encode(
            array('message' => 'Employee Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Employee Not Created')
        );
    }