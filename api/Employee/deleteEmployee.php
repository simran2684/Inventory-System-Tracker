<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
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

    // Set the id for the delete
    $employee->employeeId = $data->employeeId;

    // Delete employee
    if ($employee->deleteEmployee()) {
        echo json_encode(
            array('message' => 'Employee Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Unable to delete employee')
        );
    }