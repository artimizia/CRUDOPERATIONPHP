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
    $sql = "INSERT INTO products (Product_Name,SKU,sale_price,regular_price,Stock_Qty,Image,Category)VALUES ( '$productName','$sku',$salePrice,$regularPrice,'$stockQty','$image','$category');";
    $result=mysqli_query($conn,$sql);
    print_r($result);

  }catch(Exception $e){
    print_r($e);
  }

header("Location:home.php");
exit();
?>