<?php
  session_start();
  include "db_conn.php";
  $sku = $_GET["sku"];
  $sql = "Select * from products WHERE SKU='$sku'";
  $products=mysqli_query($conn,$sql);
  foreach ($products as $i => $product) {
    $sku = $product['SKU'];
    $productName = $product['Product_Name'];
    $price = $product['Price'];
    $stockQty = $product['Stock_Qty'];
    $image = $product['Image'];
    $category = $product['Category'];

  }
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
<form  action="home.php">
<div class="container">
<label for="sku"><b>SKU</b></label>
<input type="text" value="<?PHP echo $sku; ?>" name="sku"readonly>
<label for="productName"><b>Product Name</b></label>
<input type="text" value="<?PHP echo $productName; ?>"name="productName"readonly>
<label for="price"><b>price </b></label>
<input type="text" value="<?PHP echo $price; ?>" name="price" readonly>
<label for="category"><b>category </b></label>
<input type="text" value="<?PHP echo $category; ?>" name="category" readonly>
<label for="image"><b>Image </b></label>
<input type="text" value="<?PHP echo $image; ?>" name="image" readonly>
<label for="stockQty"><b>QTY </b></label>
<input type="text" value="<?PHP echo $stockQty; ?>" name="stockQty" readonly>
<input type="submit" >
</div>
</form>
