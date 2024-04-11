<?php
  include "db_conn.php";
  require "validations.php";
  include "uploadFile.php";
  $sku=validateInput($_POST['sku']);
  $productName=validateInput($_POST['productName']);
  $regularPrice=$_POST['regularPrice'];
  $salePrice=$_POST['salePrice'];
  $category=$_POST['category'];
  $image=$_POST['image'];
  $stockQty=$_POST['stockQty'];
 try{
    $fileName = uploadFile($_FILES['uploadedFile']);
    if(empty($sku)){
     throw new Exception("sku is empty");
  }

if($fileName){
    $image =$fileName;
  }
echo $image;
  $sql ="Update products SET productName='$productName', regularPrice='$regularPrice',salePrice='$salePrice',category='$category',image='$image',stockQty='$stockQty' WHERE sku='$sku'";
  $product=mysqli_query($conn,$sql);
  if(!$product){
    throw new Exception();
  }
  header("Location:home.php");
  exit(); 
}catch(Exception $e){
   echo '<script>
    alert("Error occured");
    window.location.href="updateProduct.php";
    </script>'; 
}
?>