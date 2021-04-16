<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Content-Type: text/html');

  include_once '../config/Database.php';
  include_once '../models/Product.php';

  $database = new Database();
  $db = $database->connect();

  // Instantiate inventory object
  $inventory = new Product($db);

  // Get inventory query
  $result = $inventory->getProducts();

 // $row = $result->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <link href="style.css" rel="stylesheet" type="text/css" />
  <h1>Inventory</h1>
</head>

<body>
  <div>
    <button class = "backButton" onclick="window.location.href = 'idex.html'">Back</button>
  </div>

  <div id = 'table'>
    <table class="inventoryTable">
      <thead>
        <tr>
          <th>Product Number</th>
          <th>Name</th>
          <th>Brand</th>
          <th>Quantity</th>
        </tr>
      </thead>
      <tbody>
      <?php
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);
        
      ?>
        <tr>
          <td class="attribute"><?php echo $row['productNum'];?></td>
          <td class="attribute"><?php echo $row['name']?></td>
          <td class="attribute"><?php echo $row['brand']?></td>
          <td class="attribute"><?php echo $row['quantity']?></td>
          <td> 
            <div>
              <a href="updateInventory.php?productNum=<?php echo $row["productNum"];?>">Update</a>
               <!-- <button class="btns2" onclick="window.location.href = 'employeeUpdate.php'">Update</button> -->
            </div>
          </td>
        </tr>
        <?php } ?>
        
      </tbody>
      
    </table>
    
  </div>
</body>


</html>


