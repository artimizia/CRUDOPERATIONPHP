<?php
  session_start();
  include "db_conn.php";
  $sku=   $_POST['sku'];
  $productName=   $_POST['productName'];
  $price=   $_POST['price'];
  $category=   $_POST['category'];
  $image=   $_POST['image'];
  $stockQty=   $_POST['stockQty'];
$sql = "INSERT INTO products (Product_Name,SKU,Price,Stock_Qty,Image,Category)VALUES ( '$productName','$sku', '$price','$stockQty','$image','$category');";
$result=mysqli_query($conn,$sql);
header("Location:home.php");
exit();
?>