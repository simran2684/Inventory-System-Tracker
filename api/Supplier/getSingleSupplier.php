<?php 

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Supplier.php';

    // Connect database
    $database = new Database();
    $db = $database->connect();

    //Instantiate supplier object
    $supplier = new Supplier($db);

    //Get id of supplier
    $supplier->id = isset($_GET['id']) ? $_GET['id'] : die();

    //Call getSingleSupplier method
    $supplier->getSingleSupplier();

    // Create array for supplier
    $supplier_array = array(
        'id' => $supplier->id,
        'name' => $supplier->name,
        'phoneNumber' => $supplier->phoneNumber,
        'streetName' => $supplier->streetName,
        'country' => $supplier->country,
        'city' => $supplier->city,
        'postalCode' => $supplier->postalCode
    );


    //Turn into JSON code
    print_r(json_encode($supplier_array));