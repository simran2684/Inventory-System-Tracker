<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/Employee.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate employee object
    $employee = new Employee($db);

    // decode data
    $data = json_decode(file_get_contents("php://input"));

    // Set the id for the update
    $employee->employeeId = $data->employeeId;

    $employee->name = $data->name;
    $employee->position = $data->position;
    $employee->country = $data->country;
    $employee->city = $data->city;
    $employee->postalCode = $data->postalCode;
    $employee->streetName = $data->streetName;
    $employee->storeNum = $data->storeNum;

    // Update employee
    if ($employee->updateEmployee()) {
        echo json_encode(
            array('message' => 'Employee Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Employee Not Updated')
        );
    }