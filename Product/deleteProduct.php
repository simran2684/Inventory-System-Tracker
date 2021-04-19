<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/Product.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate product object
    $product = new Product($db);

    // decode data
    $data = json_decode(file_get_contents("php://input"));

    // Set the id for the delete
    $product->productNum = $data->productNum;

    // Delete product
    if ($product->deleteProduct()) {
        echo json_encode(
            array('message' => 'Product Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Unable to delete product')
        );
    }