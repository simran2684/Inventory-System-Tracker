<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Content-Type: text/html');

  include_once '../config/Database.php';
  include_once '../models/Schedule.php';

  $database = new Database();
  $db = $database->connect();

  // Instantiate employee object
  $schedule = new Schedule($db);

  // Get employee query
  $result = $schedule->getSchedule();

  //$row = $result->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <link href="style.css" rel="stylesheet" type="text/css" />
  <h1>Schedule</h1>
</head>

<body>
  <h3> June 9 - June 15</h3>
  <div>
    <button class = "backButton" onclick="window.location.href = 'scheduleMain.php'">Back</button>
  </div>
  <div id = 'table'>
    <table class="scheduleTable">
      <thead>
        <tr>
          <th>Schedule Number</th>
          <th>Delivery Details</th>
        </tr>
      </thead>
      <tbody>
        <?php
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            //extract($row);
        ?>
        <tr>
          <td class="attribute"><?php echo $row['scheduleNum'];?></td>
           <td class="attribute"><?php echo $row['deliveryInvoiceNum'];?></td>
          <td> 
            <div>
               <button class="btns2" onclick="window.location.href = 'productUpdate.php'">Update Quantity</button>
            </div>
          </td>
        </tr>
          <?php
            }
          ?>
      </tbody>
      
    </table>
    
  </div>
</body>


</html>
