<?php
  session_start();
  include "db_conn.php";
  $sku=   $_POST['sku'];
  $productName=   $_POST['productName'];
  $salePrice=   $_POST['salePrice'];
  $regularPrice=   $_POST['regularPrice'];
  $category=   $_POST['category'];
  $image=   $_POST['image'];
  $stockQty=   $_POST['stockQty'];
  try{
    if(empty($sku)){
     throw new Exception("sku is empty");
  }
    $sql = "INSERT INTO products (productName,sku,salePrice,regularPrice,stockQty,image,category)VALUES ( '$productName','$sku',$salePrice,$regularPrice,'$stockQty','$image','$category');";
    $result=mysqli_query($conn,$sql);
    print_r($result);

  }catch(Exception $e){
    print_r($e);
  }

header("Location:home.php");
exit();
?>