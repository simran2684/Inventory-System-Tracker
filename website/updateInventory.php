<?php
     ob_start();
    header('Access-Control-Allow-Origin: *');
    //header('Content-Type: application/json');
    header('Content-Type: text/html');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');
    include_once '../config/Database.php';
    include_once '../models/Product.php';

     //Connect the Database
     $database = new Database();
     $db = $database->connect();
 
     // Instantiate inventory object
     $inventory = new Product($db);
     $inventory->productNum = isset($_GET['productNum']) ? $_GET['productNum'] : die();

     // Call getSingleProduct method
     $inventory->getSingleProduct();
?>
<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  <link href="style.css" rel="stylesheet" type="text/css" />
  </head>
    <body>
      <h1>Update Inventory</h1>
      <div>
        <button class = "backButton" onclick="window.location.href = 'inventoryList.php'">Back</button>
      </div>

      <form class="centerText">
        <div>
          <label for = "productNum", class = "form_2"> Product Number: </label>
          <input type = "text" name="productNum" required="" value=<?php echo $inventory->productNum?>> <br>

          <label for = "name", class = "form_2"> Name: </label>
          <input type = "text" name="name" required="" value=<?php echo $inventory->name?>> <br>

          <label for = "brand", class = "form_2"> Brand: </label>
          <input type = "text" name="brand" required="" value=<?php echo $inventory->brand?>> <br> 

          <label for = "quantity", class = "form_2"> Quantity: </label>
          <input type = "number" name="quantity" required="" value=<?php echo $inventory->quantity?>> <br>
          </div>
          <div>
        <input type="submit" name="submit" value="Update Quantity">
        <button type="button" class="btns" onclick="location.href = 'inventoryList.php'">Return</button>
     <?php

if(array_key_exists("submit", $_GET)){

    $inventory->productNum = $_GET['productNum'];
    $inventory->name = $_GET['name'];
    $inventory->brand = $_GET['brand'];
    $inventory->quantity =  $_GET['quantity'];
   
    // Update Inventory
    if ($inventory->updateProduct()) {
        echo "Inventory Updated";
      } else {
        echo "Unable to update inventory";
      }
    }

    ?>
    </div>
      </form>
    </body>
</html>