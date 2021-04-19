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
        <button class = "backButton" onclick="window.location.href = 'index.html'">Back</button>
      </div>

      <form class="centerText">
        <fieldset>
          <label for = "employeeId", class = "form_l" > EmployeeID: </label>
          <input type = "text" name = "employeeId" required=""> <br>
        </fieldset>
        <fieldset>
          <input type="submit" name="submit" value="Update" class="btns">
        </fieldset>
        <?php
          if(array_key_exists("submit", $_GET)){

           // echo "Employee Updated";
           // $employee->employeeId = $_GET['employeeId'];
            $employee->employeeId = isset($_GET['employeeId']) ? $_GET['employeeId'] : die();
            
            if($employee->getSingleEmployee()){
                
                echo "Valid Updated";
            }



            
            
        //   if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        //     echo "Employee Updated";
        //   } else {
        //     echo "Unable to update employee";
        //   }
        }
        ?>
        </div>
      </form>
    </body>
</html>