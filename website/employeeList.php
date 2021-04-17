<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Content-Type: text/html');

  include_once '../config/Database.php';
  include_once '../models/Employee.php';

  $database = new Database();
  $db = $database->connect();

  // Instantiate employee object
  $employee = new Employee($db);

  // Get employee query
  $result = $employee->readEmployee();

  // $row = $result->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <link href="style.css" rel="stylesheet" type="text/css" />
  <h1>Employee List</h1>
</head>

<body>
  <div>
    <button class = "backButton" onclick="window.location.href = 'employeeMain.php'">Back</button>
  </div>

  <div id = 'table'>
    <table class="employeeTable">
      <thead>
        <tr>
          <th>EmployeeId</th>
          <th>Name</th>
          <th>Position</th>
          <th>Country</th>
          <th>City</th>
          <th>Postal Code</th>
          <th>Street</th>
          <th>Store Number</th>
        </tr>
      </thead>
      <tbody>
      <?php
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
          // extract($row);
        
      ?>
        <tr>
          <td class="attribute"><?php echo $row['employeeId'];?></td>
          <td class="attribute"><?php echo $row['name']?></td>
          <td class="attribute"><?php echo $row['position']?></td>
          <td class="attribute"><?php echo $row['country']?></td>
          <td class="attribute"><?php echo $row['city']?></td>
          <td class="attribute"><?php echo $row['postalCode']?></td>
          <td class="attribute"><?php echo $row['streetName']?></td>
          <td class="attribute"><?php echo $row['storeNum']?></td>
          <td> 
            <div>
              <a href="employeeUpdate.php?employeeId=<?php echo $row["employeeId"];?>">Update</a>
               <!-- <button class="btns2" onclick="window.location.href = 'employeeUpdate.php'">Update</button> -->
            </div>
          </td>
          <td> 
           <div>
              <a href="employeeDelete.php?employeeId=<?php echo $row["employeeId"];?>&position=<?php echo $row["position"];?>">Delete</a>
               <!-- <button class="btns2" onclick="window.location.href = 'employeeDelete.php?employeeId='<?php echo['employeeId']?>">Delete</button> -->
            </div>
          </td> 
        </tr>
        <?php } ?>
      </tbody>
      
    </table>
    
  </div>
</body>


</html>