<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/Supplier.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Create new supplier object
    $supplier = new Supplier($db);

    // Get the raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $supplier->id = $data->id;
    $supplier->name = $data->name;
    $supplier->phoneNumber = $data->phoneNumber;
    $supplier->streetName = $data->streetName;
    $supplier->country = $data->country;
    $supplier->city = $data->city;
    $supplier->postalCode = $data->postalCode;


    //Create the supplier
    if ($supplier->createSupplier()) {
        echo json_encode(
            array('message' => 'Supplier Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Unable to create supplier')
        );
    }