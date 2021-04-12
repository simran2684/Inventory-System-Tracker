<?php

// Headers 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Product.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate product object
$post = new Post($db);

// Product query
$result = $post->read();        // result from the read function
// Get row count
$num = $result->rowCount();

// Check if any products
if($num > 0){
    // Product array
    $product_arr = array();
    $product_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $product_item = array(
            'ProductNum' => $productNum,
            'Name' => $name,
            'Brand' => $brand,
            'Category' => $category,
            'Quantity' => $quantity,
            'Weight' => $weight,
            'InventoryNum' => $inventoryNum,
            'Location' => $location,
            'StorageTemp' => $storageTemp
        );

        // Push to "data"
        array_push($product_arr['data'], $product_item);
    }

    // Turn to JSON & output 
    echo json_encode($product_arr);
} else{
    // No products
    echo json_encode(
        array('message' => 'No Posts Found')
    );
}