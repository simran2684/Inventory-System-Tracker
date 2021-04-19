<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Content-Type: text/html');

  include_once '../config/Database.php';
  include_once '../models/Deliveries.php';

  $database = new Database();
  $db = $database->connect();

  // Instantiate schedule object
  $schedule = new Deliveries($db);

  // Get employee query
  $result = $schedule->getDeliveries();

  //$row = $result->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <link href="style.css" rel="stylesheet" type="text/css" />
  <h1>Schedule</h1>
</head>

<body>
  <!-- <h3> June 9 - June 15</h3> -->
  <div>
    <button class = "backButton" onclick="window.location.href = 'scheduleMain.php'">Back</button>
  </div>
  <div id = 'table'>
    <table class="scheduleTable">
      <thead>
        <tr>
          <th>Invoice Number</th>
          <th>Date Ordered</th>
          <th>Time Ordered</th>
          <th>Date Scheduled</th>
          <th>Time Scheduled</th>
        </tr>
      </thead>
      <tbody>
        <?php
         while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            //extract($row);
        ?>
        <tr>
          <td class="attribute"><?php echo $row['invoiceNum'];?></td>
           <td class="attribute"><?php echo $row['dateOrdered'];?></td>
           <td class="attribute"><?php echo $row['timeOrdered'];?></td>
           <td class="attribute"><?php echo $row['dateScheduled'];?></td>
           <td class="attribute"><?php echo $row['timeScheduled'];?></td>
          <td> 
            <div>
            <a href="updatedDelivery.php?invoiceNum=<?php echo $row["invoiceNum"];?>"?>Update</a>
            </div>
          </td>
          <td> 
            <div>
            <a href="deleteDelivery.php?invoiceNum=<?php echo $row["invoiceNum"];?>"?>Delete</a>
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
