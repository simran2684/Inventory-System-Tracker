<?php
     ob_start();
    header('Access-Control-Allow-Origin: *');
    //header('Content-Type: application/json');
    header('Content-Type: text/html');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../config/Database.php';
    include_once '../models/Deliveries.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate deliveries object
    $del = new Deliveries($db);

?>
<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  <link href="style.css" rel="stylesheet" type="text/css" />
  </head>
    <body>
      <h1>Create Delivery</h1>
      <!-- <h2><?php echo "This message is from server side." ?></h2> -->
      <div>
      <button class = "backButton" onclick="window.location.href = 'scheduleMain.php'">Back</button>
      </div>

      <form class="centerText">
        <div>
        <label for = "deliveryNum", class = "form_3"> Invoice Number: </label>
        <input type = "text" name = "invoiceNum"> <br>

        <label for = "d_name", class = "form_3"> Date Ordered: </label>
        <input type = "text" name = "dateOrdered"> <br>

        <label for = "d_phoneNum", class = "form_3"> Time Ordered: </label>
        <input type = "text" name = "timeOrdered"> <br>

        <label for = "date_scheduled", class = "form_3"> Date Scheduled: </label>
        <input type = "text" name = "dateScheduled"> <br>
         
        <label for = "time_scheduled", class = "form_3"> Time Scheduled: </label>
        <input type = "text" name = "timeScheduled"> <br>
         </div>
         <div>
         <input class="btns" type="submit" name="submit" value="Submit Info">
        <?php
        if(array_key_exists("submit", $_GET)){

          $del->invoiceNum = $_GET['invoiceNum'];
          $del->dateOrdered = $_GET['dateOrdered'];
          $del->timeOrdered = $_GET['timeOrdered'];
          $del->dateScheduled = $_GET['dateScheduled'];
          $del->timeScheduled =  $_GET['timeScheduled'];
         
        // Create employee
        if ($del->createDeliveries()) {
          echo "Delivery Created";
        } else {
          echo "Unable to create delivery";
        }
      }
        ?>
    </div>
      </form>
    </body>
</html>