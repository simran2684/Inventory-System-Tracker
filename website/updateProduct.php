<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  <link href="style.css" rel="stylesheet" type="text/css" />
  </head>
    <body>
      <h1>Update Product</h1>
      <form class="centerText">
        <div>
          <label for = "pno", class = "form_2"> Product Number: </label>
          <input type = "text"> <br>
         
          <label for = "name", class = "form_2"> Name: </label>
          <input type = "text"> <br>
          
        <label for = "brand", class = "form_2"> Brand: </label>
        <input type = "text"> <br>
         <label for = "category", class = "form_2"> Category: </label>
        <input type = "text"> <br>
         <label for = "Quantity", class = "form_2"> Quantity: </label>
        <input type = "text"> <br>
         <label for = "weight", class = "form_2"> Weight: </label>
        <input type = "text"> <br>
         <label for = "inventoryNum", class = "form_2"> Inventory Number: </label>
        <input type = "number"> <br>
         <label for = "location", class = "form_2"> Location: </label>
        <input type = "text"> <br>
         <label for = "inventoryNum", class = "form_2"> 
         Storage Temperature: </label>
        <input type = "text"> <br>
        </div>
        <div>
           <button type="button" class="btns" onclick="window.location.href = 'viewProducts.php'">Update</button>
        </div>
      </form>
    </body>
</html>