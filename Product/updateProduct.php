<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/Product.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate employee object
    $product = new Product($db);

    // decode data
    $data = json_decode(file_get_contents("php://input"));

    // Set the id for the update
    $product->productNum = $data->productNum;

    $product->name = $data->name;
    $product->brand = $data->brand;
    $product->category = $data->category;
    $product->quantity = $data->quantity;
    $product->weight = $data->weight;
    $product->inventoryNum = $data->inventoryNum;
    $product->location = $data->location;
    $product->storageTemp = $data->storageTemp;

    // Update product
    if ($product->updateProduct()) {
        echo json_encode(
            array('message' => 'Product Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Product Not Updated')
        );
    }