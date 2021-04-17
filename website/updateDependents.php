<?php
  ob_start();

  header('Access-Control-Allow-Origin: *');
  //header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

  include_once '../config/Database.php';
  include_once '../models/Dependents.php';
  
  //Connect the Database
  $database = new Database();
  $db = $database->connect();

  // Instantiate dependents object
  $dependents = new Dependents($db);

  $dependents->employeeid = isset($_GET['employeeid']) ? $_GET['employeeid'] : die();

  // Call  getSingleDependents method
  $dependents->getSingleDependents();
?>

<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  <link href="style.css" rel="stylesheet" type="text/css" />
  </head>
    <body>
      <h1>Update Dependents</h1>
      <div>
        <button class = "backButton" onclick="window.location.href = 'dependentsList.php'">Back</button>
      </div>

      <form class="centerText">
        <div>
          <label for = "id", class = "form_l" > EmployeeID: </label>
          <input type = "text" name = "employeeid" required="" value=<?php echo $dependents->employeeid?>> <br>

          <label for = "name", class = "form_l" > Name: </label>
          <input type = "text" name = "name" required="" value=<?php echo $dependents->name?>> <br>

          <label for = "country", class = "form_l" > Phone Number: </label>
          <input type = "text" name = "phoneNumber" required="" value=<?php echo $dependents->phoneNumber?>> <br>
        </div>
        <div>
          <input type="submit" name="submit" value="Update" class="btns">
          <button type="button" class="btns" onclick="location.href = 'dependentsList.php'">Return</button>
          <?php
          if(array_key_exists("submit", $_GET)){

            $dependents->employeeid = $_GET['employeeid'];
            $dependents->name = $_GET['name'];
            $dependents->phoneNumber = $_GET['phoneNumber'];
         
        
      
          // Create dependents
          if ($dependents->updateDependents()) {
            echo "Dependent Updated";
          } else {
            echo "Unable to update dependent";
          }
        }
        ?>
        </div>
      </form>
    </body>
</html>