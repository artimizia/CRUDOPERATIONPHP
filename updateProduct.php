
<?php
  session_start();
  include "db_conn.php";
  $sku=   $_GET['sku'];
  $sql = "Select * FROM products WHERE SKU='$sku'";
  $products=mysqli_query($conn,$sql);
  foreach ($products as $i => $product) {
    $sku = $product['SKU'];
    $productName = $product['Product_Name'];
    $regularPrice = $product['regular_price'];
    $salePrice = $product['sale_price'];
    $stockQty = $product['Stock_Qty'];
    $image = $product['Image'];
    $category = $product['Category'];
  }

?>
<style>
body {font-family: Arial, Helvetica, sans-serif;}


input[type=text], input[type=number] ,select  {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

</style>
<?php if(isset($_SESSION['user_name']) && isset($_SESSION['password'])){?>
<form  method="POST" action="updateInsertProduct.php">
<div class="container">
<label for="sku"><b>SKU</b></label>
<input type="text" value="<?PHP echo $sku; ?>" name="sku"readonly>
<label for="productName"><b>Product Name</b></label>
<input type="text" value="<?PHP echo $productName; ?>"name="productName">
<label for="salePrice"><b>sale price </b></label>
<input type="number" value="<?PHP echo $salePrice; ?>" name="salePrice" >
<label for="regularPrice"><b>regular Price </b></label>
<input type="number" value="<?PHP echo $regularPrice; ?>" name="regularPrice" >
<label for="category"><b>category </b></label>
<select name="category" id="categoryField">
<option value="grocery">grocery</option>
<option value="toiletries">toiletries</option>
<option value="misc">misc</option>
</select>
<!-- <input type="text" value="<?PHP echo $category; ?>" name="category" > -->
<label for="image"><b>Image </b></label>
<input type="text" value="<?PHP echo $image; ?>" name="image" >
<label for="stockQty"><b>QTY </b></label>
<input type="number" value="<?PHP echo $stockQty; ?>" name="stockQty" > 
<input type="submit" >
</div>
</form>
<?php } ?>