<?php
    ob_start();
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../config/Database.php';
    include_once '../models/Employee.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate employee object
    $employee = new Employee($db);

    $employee->employeeId = $_GET['employeeId'];

    try {
        $employee->deleteEmployee(); 
        echo "Employee Deleted";
        header('location: employeeList.php');
    } catch (exception $e) {
        echo $e->getMessage();
    }