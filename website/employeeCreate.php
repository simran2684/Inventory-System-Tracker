<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  <link href="style.css" rel="stylesheet" type="text/css" />
  </head>
    <body>
      <h1>Create Employee</h1>
      <h2><?php echo "This message is from server side." ?></h2>
      <div>
      <button class = "backButton" onclick="window.location.href = 'employeeMain.php'">Back</button>
      </div>

      <form class="centerText">
        <div>
          <label for = "id", class = "form_l"> EmployeeID: </label>
          <input type = "text"> <br>
         
          <label for = "name", class = "form_l"> Name: </label>
          <input type = "text"> <br>
          
        <label for = "country", class = "form_l"> Country: </label>
        <input type = "text"> <br>
         <label for = "city", class = "form_l"> City: </label>
        <input type = "text"> <br>
         <label for = "postalCode", class = "form_l"> Postal Code: </label>
        <input type = "text"> <br>
         <label for = "streetName", class = "form_l"> Street: </label>
        <input type = "text"> <br>
         <label for = "storeNum", class = "form_l"> Store Number: </label>
        <input type = "number"> <br>
        </div>
         <div>
      <button class="btns">Submit</button>
    </div>
      </form>
    </body>
</html>