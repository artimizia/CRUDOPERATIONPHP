<?php
  session_start();
  include "db_conn.php";
  //var_dump($_POST);
  $sku=$_POST['sku'];
  $productName=$_POST['productName'];
  $regularPrice=$_POST['regularPrice'];
  $salePrice=$_POST['salePrice'];
  $category=$_POST['category'];
  $image=$_POST['image'];
  $stockQty=$_POST['stockQty'];
  $sql ="Update products SET Product_Name='$productName', regular_price='$regularPrice',sale_price='$salePrice',Category='$category',Image='$image',Stock_Qty='$stockQty' WHERE SKU='$sku'";
  $product=mysqli_query($conn,$sql);
  echo $product;
  header("Location:home.php");
  exit(); 
?>