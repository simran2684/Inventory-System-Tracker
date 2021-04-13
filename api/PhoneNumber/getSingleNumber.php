<?php 

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/PhoneNumber.php';

    // Connect database
    $database = new Database();
    $db = $database->connect();

    //Instantiate p_number object
    $p_number = new PhoneNumber($db);

    //Get employeeId of p_number
    $p_number->employeeId = isset($_GET['employeeId']) ? $_GET['employeeId'] : die();

    //Call getSingleSupplier method
    $p_number->getSingleNumber();

    // Create array for p_number
    $p_num_array = array(
        'employeeId' => $p_number->employeeId,
        'phoneNum' => $p_number->phoneNum
    );


    //Turn into JSON code
    print_r(json_encode($p_num_array));