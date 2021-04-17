<?php
    ob_start();
    header('Access-Control-Allow-Origin: *');
    //header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../config/Database.php';
    include_once '../models/Employee.php';
    include_once '../models/Clerk.php';
    include_once '../models/Administrator.php';
    include_once '../models/Manager.php';
    include_once '../models/PhoneNumber.php';
    include_once '../models/Dependents.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate employee object
    $employee = new Employee($db);

    $employee->employeeId = $_GET['employeeId'];
    $employee->position = $_GET['position'];

    // Below is the check to delete position, but if we're deleting only clerks, we might not even need the check
    // and we can just delete the clerk from the table.
    if ($employee->position == "Clerk") {
        $clerk = new Clerk($db);
        $clerk->id = $employee->employeeId;
        $clerk->deleteClerk();
    }
    // } else if ($employee->status == "Manager") {
    //     $manager = new Manager($db);
    //     $manager->id = $employee->employeeId;
    //     $manager->deleteManager();
    // } else if ($employee->status = "Admin") {
    //     $admin = new Administrator($db);
    //     $admin->id = $employee->employeeId;
    //     $admin->deleteManager();
    // }
    
    //Get the corresponding dependent, and then delete it.
    // $dependent= new Dependents($db);
    // $dependent->employeeid = $_GET['employeeId'];
    // try {
    //     if($dependent->deleteDependent()){
    //     echo "Dependent number Deleted";
    //     }
    // } catch (exception $e) {
    //     echo $e->getMessage();
    // }

    // // Get the corresponding phonenumber, and then delete it.
    // $p_num = new PhoneNumber($db);
    // $p_num->employeeId = $employee->employeeId;

    // try {
    //     $p_num->deleteNumber();
    //     echo "Phone number Deleted";
    // } catch (exception $e) {
    //     echo $e->getMessage();
    // }

    //Hopefully once these all delete nicely, then we can delete the employee without any trouble.

    // Set the id for the delete
    //$employee->employeeId = $_GET['employeeId'];

    // Delete employee
    try {
        $employee->deleteEmployee(); 
        echo "Employee Deleted";
        header('location: employeeList.php');
    } catch (exception $e) {
        echo $e->getMessage();
    }