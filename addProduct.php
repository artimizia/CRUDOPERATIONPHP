<?php
  session_start();
  include "db_conn.php";
?>
<style>
body {font-family: Arial, Helvetica, sans-serif;}


input[type=text] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

</style>
<?php if(isset($_SESSION['user_name']) && isset($_SESSION['password'])){?>
<form method="post" action="CreateProduct.php">
<div class="container">
<label for="sku"><b>SKU</b></label>
<input type="text" name="sku">
<label for="productName"><b>Product Name</b></label>
<input type="text" name="productName">
<label for="price"><b>price </b></label>
<input type="text" name="price">
<label for="category"><b>category </b></label>
<input type="text" name="category">
<label for="image"><b>Image </b></label>
<input type="text" name="image">
<label for="stockQty"><b>QTY </b></label>
<input type="text" name="stockQty">
<input type="submit" >
</div>
</form>
<?php } ?>
