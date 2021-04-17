<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/Dependents.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate employee object
    $dependent = new Dependents($db);

    // decode data
    $data = json_decode(file_get_contents("php://input"));

    // Set the id for the delete
    $dependent->employeeId = $data->employeeId;

    // Delete dependent
    if ($dependent->deleteDependent()) {
        echo json_encode(
            array('message' => 'Dependent Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Unable to delete dependent')
        );
    }