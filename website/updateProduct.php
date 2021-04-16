<!DOCTYPE html>
<?php
  ob_start();

  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

  include_once '../config/Database.php';
  include_once '../models/Product.php';
  
  //Connect the Database
  $database = new Database();
  $db = $database->connect();

  // Instantiate product object
  $product = new Product($db);

  $product->productNum = isset($_GET['productNum']) ? $_GET['productNum'] : die();

  // Call getSingleProduct method
  $product->getSingleProduct();
?>


<html>
  <head>
  <meta charset="utf-8">
  <link href="style.css" rel="stylesheet" type="text/css" />
  </head>
    <body>
      <h1>Update Product</h1>
      <form class="centerText">
        <div>
          <label for = "productNum", class = "form_2"> Product Number: </label>
          <input type = "text" name="productNum" required="" value=<?php echo $product->productNum?>> <br>
         
          <label for = "name", class = "form_2"> Name: </label>
          <input type = "text" name="name" required="" value=<?php echo $product->name?>> <br>
          
        <label for = "brand", class = "form_2"> Brand: </label>
        <input type = "text" name="brand" required="" value=<?php echo $product->brand?>> <br>

         <label for = "category", class = "form_2"> Category: </label>
        <input type = "text" name="category" required="" value=<?php echo $product->category?>> <br>

         <label for = "quantity", class = "form_2"> Quantity: </label>
        <input type = "text" name="quantity" required="" value=<?php echo $product->quantity?>> <br>

        <label for = "weight", class = "form_2"> Weight: </label>
         <input type = "number" name="weight" required="" value=<?php echo $product->weight?>> <br>

        <label for = "inventoryNum", class = "form_2"> Inventory Number: </label>
        <input type = "number" name="inventoryNum" required="" value=<?php echo $product->inventoryNum?>> <br>
         
        <label for = "location", class = "form_2"> Location: </label>
        <input type = "text" name="location" required="" value=<?php echo $product->location?>> <br>
        
        <label for = "storageTemp", class = "form_2"> Storage Temperature: </label>
        <input type = "text" name="storageTemp" required="" value=<?php echo $product->storageTemp?>> <br>


        </div>
        <div>
          <input type="submit" name="submit" value="Update" class="btns">
           <button type="button" class="btns" onclick="window.location.href = 'viewProducts.php'">Return</button>
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
                if ($product->updateProduct()) {
                    echo "product Updated";
        
                } else {
                    echo "product Not Updated"; 
                }
              }
            ?>
        </div>
      </form>
    </body>
</html>