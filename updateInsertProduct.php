<?php
  session_start();
  include "db_conn.php";
  $sku=$_POST['sku'];
  $productName=$_POST['productName'];
  $regularPrice=$_POST['regularPrice'];
  $salePrice=$_POST['salePrice'];
  $category=$_POST['category'];
  $image=$_POST['image'];
  $stockQty=$_POST['stockQty'];
  $sql ="Update products SET productName='$productName', regularPrice='$regularPrice',salePrice='$salePrice',category='$category',image='$image',stockQty='$stockQty' WHERE sku='$sku'";
  $product=mysqli_query($conn,$sql);
  echo $product;
  header("Location:home.php");
  exit(); 
?>