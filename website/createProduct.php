<?php
     ob_start();
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Content-Type: text/html');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');
    include_once '../config/Database.php';
    include_once '../models/Product.php';

     //Connect the Database
     $database = new Database();
     $db = $database->connect();
 
     // Instantiate product object
     $product = new Product($db);
?>
<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  <link href="style.css" rel="stylesheet" type="text/css" />
  </head>
    <body>
      <h1>Add Product</h1>
      <form class="centerText">
        <div>
          <label for = "productNum", class = "form_2"> Product Number: </label>
          <input type = "text" name="productNum"> <br>
          <label for = "name", class = "form_2"> Name: </label>
          <input type = "text" name="name"> <br>
          <label for = "brand", class = "form_2"> Brand: </label>
          <input type = "text" name="brand"> <br> 
          <label for = "category", class = "form_2"> Category: </label>
          <input type = "text" name="category"> <br>
          <label for = "quantity", class = "form_2"> Quantity: </label>
          <input type = "number" name="quantity"> <br>
          <label for = "weight", class = "form_2"> Weight: </label>
          <input type = "number" name="weight"> <br>
          <label for = "inventoryNum", class = "form_2"> Inventory Number: </label>
          <input type = "number" name="inventoryNum"> <br>
          <label for = "location", class = "form_2"> Location: </label>
          <input type = "text" name="location"> <br>
          <label for = "storageTemp", class = "form_2"> Storage Temperature: </label>
          <input type = "number" name="storageTemp"> <br>
          </div>
          <div>
        <input type="submit" name="submit" value="submit Info">
      <?php

if(array_key_exists("submit", $_GET)){

    $product->productNum = $_GET['productNum'];
    $product->name = $_GET['name'];
    $product->brand = $_GET['brand'];
    $product->category =  $_GET['category'];
    $product->quantity =  $_GET['quantity'];
    $product->weight =  $_GET['weight'];
    $product->inventoryNum =  $_GET['inventoryNum'];
    $product->location =  $_GET['location'];
    $product->storageTemp =  $_GET['storageTemp'];

    // Create product
    if ($product->createproduct()) {
        echo json_encode(
            array('message' => 'product Created')
        );
    } else {
        echo json_encode(
            array('message' => 'product Not Created')
        );
    }
  }

    ?>
    </div>
      </form>
    </body>
</html>