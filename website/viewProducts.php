<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Content-Type: text/html');

  include_once '../config/Database.php';
  include_once '../models/Product.php';

  $database = new Database();
  $db = $database->connect();

  // Instantiate product object
  $product = new Product($db);

  // product query
  $result = $product->getProducts();
  ?>

<!DOCTYPE html>
<html>
<head>
  <link href="style.css" rel="stylesheet" type="text/css" />
  <h1>Products</h1>
</head>

<body>
  <div>
    <button class = "backButton" onclick="window.location.href = 'productMain.php'">Back</button>
  </div>
  <div id = 'table'>
    <table class="ProductTable">
      <thead>
        <tr>
          <th>Product Number</th>
          <th>Name</th>
          <th>Brand</th>
          <th>Category</th>
          <th>Quantity</th>
          <th>Weight</th>
          <th>Inventory Number</th>
          <th>Location</th>
          <th>Storage Temperature</th>
        </tr>
      </thead>
      <tbody>
        <?php
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr>
          <td class="attribute"><?php echo $row['productNum'];?></td>
           <td class="attribute"><?php echo $row['name'];?></td>
           <td class="attribute"><?php echo $row['brand'];?></td>
           <td class="attribute"><?php echo $row['category'];?></td>
           <td class="attribute"><?php echo $row['quantity'];?></td>
           <td class="attribute"><?php echo $row['weight'];?></td>
           <td class="attribute"><?php echo $row['inventoryNum'];?></td>
           <td class="attribute"><?php echo $row['location'];?></td>
           <td class="attribute"><?php echo $row['storageTemp'];?></td> 
           <td> 
            <div>
              <a class="link_button" href="updateProduct.php?productNum=<?php echo $row["productNum"];?>"?>Update</a>
            </div>
          </td>
          <td> 
           <div>
              <a class="link_button" href="deleteProduct.php?productNum=<?php echo $row["productNum"];?>"?>Delete</a>
            </div>
          </td> 
        </tr>
          <?php
            }
          ?>

      </tbody>
      
    </table>
    
  </div>
</body>


</html>
