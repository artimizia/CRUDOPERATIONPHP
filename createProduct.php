<?php
  include "db_conn.php";
  include "validations.php";
  include "uploadFile.php";
  echo "createProduct";
  $sku= validateInput($_POST['sku']);
  $productName=  validateInput($_POST['productName']);
  $salePrice=   $_POST['salePrice'];
  $regularPrice=   $_POST['regularPrice'];
  $category=   $_POST['category'];
  $image=   "";
  $stockQty=   $_POST['stockQty'];
   try{
    $fileName = uploadFile($_FILES['uploadedFile']);
    if(empty($sku)){
     throw new Exception("sku is empty");
  }
  if($fileName){
    $image =$fileName;
  }
  $sql = "INSERT INTO products (productName,sku,salePrice,regularPrice,stockQty,image,category)VALUES ( '$productName','$sku',$salePrice,$regularPrice,'$stockQty','$image','$category');";
    $result=mysqli_query($conn,$sql);
    echo($result);
    header("Location:home.php");
    exit();

  }catch(Exception $e){
    echo $e;
    echo '<script>
    alert("Error occured");
    window.location.href="addProduct.php";
    </script>'; 
  }

?>