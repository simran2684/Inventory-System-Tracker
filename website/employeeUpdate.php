<?php
  ob_start();

  header('Access-Control-Allow-Origin: *');
  //header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

  include_once '../config/Database.php';
  include_once '../models/Employee.php';
  
  //Connect the Database
  $database = new Database();
  $db = $database->connect();

  // Instantiate employee object
  $employee = new Employee($db);

  $employee->employeeId = isset($_GET['employeeId']) ? $_GET['employeeId'] : die();

  // Call getSingleEmployee method
  $employee->getSingleEmployee();
?>

<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  <link href="style.css" rel="stylesheet" type="text/css" />
  </head>
    <body>
      <h1>Update Employee</h1>
      <div>
        <button class = "backButton" onclick="window.location.href = 'employeeList.php'">Back</button>
      </div>

      <form class="centerText">
        <div>
          <label for = "id", class = "form_l" > EmployeeID: </label>
          <input type = "text" name = "employeeId" required="" value=<?php echo $employee->employeeId?>> <br>

          <label for = "name", class = "form_l" > Name: </label>
          <input type = "text" name = "name" required="" value=<?php echo $employee->name?>> <br>

          <label for = "position", class = "form_l" > Position: </label>
          <input type = "text" name = "position" required="" value=<?php echo $employee->position?>> <br>

          <label for = "country", class = "form_l" > Country: </label>
          <input type = "text" name = "country" required="" value=<?php echo $employee->country?>> <br>

          <label for = "city", class = "form_l"> City: </label>
          <input type = "text" name = "city" required="" value=<?php echo $employee->city?>> <br>

          <label for = "postalCode", class = "form_l" > Postal Code: </label>
          <input type = "text" name = "postalCode" required="" value=<?php echo $employee->postalCode?>> <br>

          <label for = "streetName", class = "form_l"> Street: </label>
          <input type = "text" name = "streetName" required="" value=<?php echo $employee->streetName?>> <br>

          <label for = "storeNum", class = "form_l"> Store Number: </label>
          <input type = "number" name="storeNum" required="" value=<?php echo $employee->storeNum?> > <br>
        </div>
        <div>
          <input type="submit" name="submit" value="Update" class="btns">
          <button type="button" class="btns" onclick="location.href = 'employeeList.php'">Return</button>
          <?php
          if(array_key_exists("submit", $_GET)){

            $employee->employeeId = $_GET['employeeId'];
            $employee->name = $_GET['name'];
            $employee->position = $_GET['position'];
            $employee->country = $_GET['country'];
            $employee->city =  $_GET['city'];
            $employee->postalCode =  $_GET['postalCode'];
            $employee->streetName =  $_GET['streetName'];
            $employee->storeNum =  $_GET['storeNum'];
        
      
          // Create employee
          if ($employee->updateEmployee()) {
            echo "Employee Updated";
          } else {
            echo "Unable to update employee";
          }
        }
        ?>
        </div>
      </form>
    </body>
</html>