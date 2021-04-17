<?php
    ob_start();
    header('Access-Control-Allow-Origin: *');
    //header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../config/Database.php';
    include_once '../models/dependent.php';
    include_once '../models/Dependents.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate dependent object
    $dependent = new Dependents($db);

    $dependent->employeeId = $_GET['employeeId'];

    try {
        $dependent->deleteDependent(); 
        echo "Dependent Deleted";
        header('location: dependentsList.php');
    } catch (exception $e) {
        echo $e->getMessage();
    }
