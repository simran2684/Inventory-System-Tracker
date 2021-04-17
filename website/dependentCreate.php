<?php
    
    header('Access-Control-Allow-Origin: *');
    //header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../config/Database.php';
    include_once '../models/Dependents.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate dependent object
    $dependent = new Dependents($db);
?>

<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  <link href="style.css" rel="stylesheet" type="text/css" />
  </head>
    <body>
      <h1>Create Dependent</h1>
      <!-- <h2><?php echo "This message is from server side." ?></h2> -->
      <div>
      <button class = "backButton" onclick="window.location.href = 'dependentsList.php'">Back</button>
      </div>

      <form class="centerText">
        <div>
          <label for = "EmployeeId", class = "form_l"> employeeID: </label>
          <input type = "text" name="employeeId"> <br>

          <label for = "name", class = "form_l"> Name: </label>
          <input type = "text" name="name"> <br>

          <label for = "phoneNum", class = "form_l"> Phone Number </label>
          <input type = "text" name="phoneNum"> <br>
        </div>
         <div>
      <!-- <button class="btns">Submit</button> -->
      <input type="submit" name="submit" value="Submit Info">

      <?php
      if(array_key_exists("submit", $_GET)){

        $dependent->employeeId = $_GET['employeeId'];
        $dependent->name = $_GET['name'];
        $dependent->phoneNumber = $_GET['phoneNum'];

    
  
      // Create dependent
      if ($dependent->createDependent()) {
        echo "Dependent Created";
      } else {
        echo "Unable to create dependent";
      }
    }
    ?>
    </div>
      </form>
    </body>
</html>