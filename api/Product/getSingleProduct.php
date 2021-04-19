<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Product.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate product object
    $product = new Product($db);

    // Get productNum
    $product->productNum = isset($_GET['productNum']) ? $_GET['productNum'] : die();

    // Call getSingleProduct method
    $product->getSingleProduct();

    // Create array
    $product_arr = array(
        'productNum' => $product->productNum,
        'name' => $product->name,
        'brand' => $product->brand,
        'category' => $product->category,
        'quantity' => $product->quantity,
        'weight' => $product->weight,
        'inventoryNum' => $product->inventoryNum,
        'location' => $product->location,
        'storageTemp' => $product->storageTemp
    );

    // Make JSON
    print_r(json_encode($product_arr));