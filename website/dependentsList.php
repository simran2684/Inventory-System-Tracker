<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Content-Type: text/html');

  include_once '../config/Database.php';
  include_once '../models/Dependents.php';

  $database = new Database();
  $db = $database->connect();

  // Instantiate dependents object
  $dependents = new Dependents($db);

  // Get dependents query
  $result = $dependents->getDependents();

  // $row = $result->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <link href="style.css" rel="stylesheet" type="text/css" />
  <h1>Dependents List</h1>
</head>

<body>
  <div>
    <button class = "backButton" onclick="window.location.href = 'employeeList.php'">Back</button>
  </div>

  <div id = 'table'>
    <table class="employeeTable">
      <thead>
        <tr>
          <th>EmployeeId</th>
          <th>Name</th>
          <th>Phone Number</th>
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
          <td class="attribute"><?php echo $row['phoneNumber']?></td>
          <td> 
            <div>
              <a class="link_button" href="updateDependents.php?employeeId=<?php echo $row["employeeId"];?>">Update</a>
            </div>
          </td>
          <td>
           <a href="dependentDelete.php?employeeId=<?php echo $row["employeeId"];?>">Delete</a>
          </td>
      
        </tr>
        <?php } ?>
      </tbody>
      
    </table>
    <button class = "btns_l" width="100px" onclick="window.location.href = 'dependentCreate.php'">Add Dependents</button>
  </div>
</body>


</html>
