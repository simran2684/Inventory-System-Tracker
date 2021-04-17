<?php
    
    header('Access-Control-Allow-Origin: *');
    //header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../config/Database.php';
    include_once '../models/Employee.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate employee object
    $employee = new Employee($db);
?>

<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  <link href="style.css" rel="stylesheet" type="text/css" />
  </head>
    <body>
      <h1>Create Employee</h1>
      <!-- <h2><?php echo "This message is from server side." ?></h2> -->
      <div>
      <button class = "backButton" onclick="window.location.href = 'employeeMain.php'">Back</button>
      </div>

      <form class="centerText">
        <div>
          <label for = "EmployeeId", class = "form_l"> EmployeeID: </label>
          <input type = "text" name="employeeId"> <br>
          <label for = "name", class = "form_l"> Name: </label>
          <input type = "text" name="name"> <br>
          <label for = "position", class = "form_l"> Position: </label>
          <input type = "text" name="position"> <br>
          <label for = "country", class = "form_l"> Country: </label>
          <input type = "text" name="country"> <br>
          <label for = "city", class = "form_l"> City: </label>
          <input type = "text" name="city"> <br>
          <label for = "postalCode", class = "form_l"> Postal Code: </label>
          <input type = "text" name="postalCode"> <br>
          <label for = "streetName", class = "form_l"> Street: </label>
          <input type = "text" name="streetName"> <br>
          <label for = "storeNum", class = "form_l"> Store Number: </label>
          <input type = "number" name ="storeNum"> <br>
        </div>
         <div>
      <!-- <button class="btns">Submit</button> -->
      <input type="submit" name="submit" value="Submit Info">

      <?php
      if(array_key_exists("submit", $_GET)){

        $employee->employeeId = $_GET['employeeId'];
        $employee->name = $_GET['name'];
        $employee->name = $_GET['position'];
        $employee->country = $_GET['country'];
        $employee->city =  $_GET['city'];
        $employee->postalCode =  $_GET['postalCode'];
        $employee->streetName =  $_GET['streetName'];
        $employee->storeNum =  $_GET['storeNum'];
    
  
      // Create employee
      if ($employee->createEmployee()) {
        echo "Employee Created";
      } else {
        echo "Unable to create Employee";
      }
    }
    ?>
    </div>
      </form>
    </body>
</html>