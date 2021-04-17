<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Employee.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate employee object
    $employee = new Employee($db);

    // Get id
    $employee->employeeId = isset($_GET['employeeId']) ? $_GET['employeeId'] : die();

    // Call getSingleEmployee method
    $employee->getSingleEmployee();

    // Create array
    $employee_arr = array(
        'EmployeeId' => $employee->employeeId,
        'Name' => $employee->name,
        'Position' => $employee->position,
        'Country' => $employee->country,
        'City' => $employee->city,
        'PostalCode' => $employee->postalCode,
        'StreetName' => $employee->streetName,
        'StoreNum' => $employee->storeNum,
    );

    // Make JSON
    print_r(json_encode($employee_arr));