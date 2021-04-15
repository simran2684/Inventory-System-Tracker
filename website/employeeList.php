<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Content-Type: text/html');

  include_once 'config/Database.php';
  include_once 'models/Employee.php';

  $database = new Database();
  $db = $database->connect();

  // Instantiate employee object
  $employee = new Employee($db);

  // Get employee query
  $result = $employee->readEmployee();

  $row = $result->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <link href="style.css" rel="stylesheet" type="text/css" />
  <h1>Employee List</h1>
</head>

<body>
  <div>
    <button class = "backButton" onclick="window.location.href = 'employeeMain.html'">Back</button>
  </div>

  <div id = 'table'>
    <table class="employeeTable">
      <thead>
        <tr>
          <th>EmployeeId</th>
          <th>Name</th>
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
          extract($row);
        
      ?>
        <tr>
          <td class="attribute"><?php echo $row['employeeId'];?></td>
          <td class="attribute"><?php echo $row['name']?></td>
          <td class="attribute"><?php echo $row['country']?></td>
          <td class="attribute"><?php echo $row['city']?></td>
          <td class="attribute"><?php echo $row['postalCode']?></td>
          <td class="attribute"><?php echo $row['streetName']?></td>
          <td class="attribute"><?php echo $row['storeNum']?></td>
          <td> 
            <div>
               <button class="btns2" onclick="window.location.href = 'updateEmployee.html'">Update</button>
            </div>
          </td>
          <td> 
           <div>
               <button class="btns2" onclick="window.location.href = 'test.html'">Delete</button>
            </div>
          </td> 
        </tr>
        <?php } ?>
        <tr>
          <td class="attribute">7654</td>
          <td class="attribute">Mark Jacob</td>
          <td class="attribute">Canada</td>
          <td class="attribute">Ottawa</td>
          <td class="attribute">T5V 7G5</td>
          <td class="attribute">34 Some Street</td>
          <td class="attribute">1</td>
          <td> 
            <div>
               <button class="btns2" onclick="window.location.href = 'updateEmployee.html'">Update</button>
            </div>
          </td>
           <td> 
            <div>
               <button class="btns2" onclick="window.location.href = 'test.html'">Delete</button>
            </div>
          </td>
        </tr>
      </tbody>
      
    </table>
    
  </div>
</body>


</html>