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
          <label for = "deliveryNum", class = "form_3"> Delivery Number: </label>
        <input type = "text"> <br>
          <label for = "date_scheduled", class = "form_3"> Date Scheduled: </label>
          <input type = "text"> <br>
         
          <label for = "time_scheduled", class = "form_3"> Time Scheduled: </label>
          <input type = "text"> <br>
          
        <label for = "d_name", class = "form_3"> Deliverer Name: </label>
        <input type = "text"> <br>
         <label for = "d_phoneNum", class = "form_3"> Deliverer Phone Number: </label>
        <input type = "text"> <br>
         <div>
      <button class="btns">Submit</button>
    </div>
      </form>
    </body>
</html>