<?php
  if( !isset($_SESSION) || session_id() == '' ||session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  if(!isset($_SESSION['userName']) || !isset($_SESSION['password'])){
    header("Location:index.php");
    exit();
 }
  include "db_conn.php";

  try{
     $sku = $_GET["sku"];
     $sql = "SELECT sku,productName,salePrice,regularPrice,stockQty,image,category from products WHERE sku='$sku'";
    $products=mysqli_query($conn,$sql);
    if(mysqli_num_rows($products)==0){
      throw new Exception("Product does not exist");
    }
    foreach ($products as $i => $product) {
      $sku = $product['sku'];
      $productName = $product['productName'];
      $salePrice = $product['salePrice'];
      $regularPrice = $product['regularPrice'];
      $stockQty = $product['stockQty'];
      $image = $product['image'];
      $category = $product['category'];
    }

  }catch(Exception $e){
      echo '<script>
      alert("Error occured");
      window.location.href="home.php";
      </script>'; 

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

<form  action="home.php" method="post">
<div class="container">
<label for="sku"><b>SKU</b></label>
<input type="text" value="<?PHP echo $sku; ?>" name="sku"readonly>
<label for="productName"><b>Product Name</b></label>
<input type="text" value="<?PHP echo $productName; ?>"name="productName"readonly>
<label for="salePrice"><b>sale price </b></label>
<input type="text" value="<?PHP echo $salePrice; ?>" name="salePrice" readonly>
<label for="regularPrice"><b>regular price </b></label>
<input type="text" value="<?PHP echo $regularPrice; ?>" name="regularPrice" readonly>
<label for="category"><b>category </b></label>
<input type="text" value="<?PHP echo $category; ?>" name="category" readonly>
<label for="image"><b>Image </b></label>
<input type="text" value="<?PHP echo $image; ?>" name="image" readonly>
<label for="stockQty"><b>QTY </b></label>
<input type="text" value="<?PHP echo $stockQty; ?>" name="stockQty" readonly>
<input type="submit" value="Done">
</div>
</form>