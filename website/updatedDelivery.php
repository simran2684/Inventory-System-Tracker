<?php
  ob_start();

  header('Access-Control-Allow-Origin: *');
  //header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

  include_once '../config/Database.php';
  include_once '../models/Deliveries.php';

  $database = new Database();
  $db = $database->connect();

    // Instantiate deliveries object
  $schedule = new Deliveries($db);

  $schedule->invoiceNum = isset($_GET['invoiceNum']) ? $_GET['invoiceNum'] : die();

  // Call getSingleDelivery method
  $schedule->getSingleDelivery();
?>

<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  <link href="style.css" rel="stylesheet" type="text/css" />
  </head>
    <body>
      <h1>Update Schedule</h1>
      <div>
        <button class = "backButton" onclick="window.location.href = 'viewSchedule.php'">Back</button>
      </div>

      <form class="centerText">
        <div>
        <label for = "deliveryNum", class = "form_3"> Invoice Number: </label>
          <input type = "text" name = "invoiceNum" required="" value=<?php echo $schedule->invoiceNum?>> <br>
         
          <label for = "country", class = "form_3" > Date Ordered: </label>
          <input type = "text" name = "dateOrdered" required="" value=<?php echo $schedule->dateOrdered?>> <br>

          <label for = "city", class = "form_3"> Time Ordered: </label>
          <input type = "text" name = "timeOrdered" required="" value=<?php echo $schedule->timeOrdered?>> <br>

          <label for = "date_scheduled", class = "form_3"> Date Scheduled: </label>
          <input type = "text" name = "dateScheduled" required="" value=<?php echo $schedule->dateScheduled?>> <br>

          <label for = "timescheduled", class = "form_3" > Time Scheduled: </label>
          <input type = "text" name = "timeScheduled" required="" value=<?php echo $schedule->timeScheduled?>> <br>

        </div>
        <div>
          <input type="submit" name="submit" value="Update" class="btns">
          <button type="button" class="btns" onclick="location.href = 'viewSchedule.php'">Return</button>
          <?php
          if(array_key_exists("submit", $_GET)){

            $schedule->invoiceNum = $_GET['invoiceNum'];
            $schedule->dateOrdered = $_GET['dateOrdered'];
            $schedule->timeOrdered = $_GET['timeOrdered'];
            $schedule->dateScheduled = $_GET['dateScheduled'];
            $schedule->timeScheduled =  $_GET['timeScheduled'];
         
      
          // Create employee
          if ($schedule->updateDelivery()) {
            echo "Schedule Updated";
          } else {
            echo "Unable to update schedule";
          }
        }
        ?>
        </div>
      </form>
    </body>
</html>