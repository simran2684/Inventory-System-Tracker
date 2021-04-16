<?php
    ob_start();
    header('Access-Control-Allow-Origin: *');
    //header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../config/Database.php';
    include_once '../models/Product.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate employee object
    $product = new Product($db);

    // Set the id for the delete
    $product->productNum = $_GET['productNum'];

    // Delete employee
    try {
        $product->deleteProduct(); 
        echo "Product Deleted";
        header('location: viewProducts.php');
    } catch (exception $e) {
        echo "Unable to delete product";
    }