
<?php
  if( !isset($_SESSION) || session_id() == '' ||session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  if(!isset($_SESSION['userName']) || !isset($_SESSION['password'])){
    header("Location:index.php");
    exit();
}
if(!isset($_SESSION['admin']) ||$_SESSION['admin']==0){
    header("Location:home.php");
    exit();
}
 include "db_conn.php";
 include "validations.php";
 include "dbController.php";
  $sku=   $_GET['sku'];
  try{
   $products=fetchProduct($conn,$sku);
   $categories=fetchCategories($conn);
  foreach ($products as $i => $product) {
    $sku = $product['sku'];
    $productName = $product['productName'];
    $regularPrice = $product['regularPrice'];
    $salePrice = $product['salePrice'];
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

.imageText b{
  font-weight: normal !important;;
  font-size: small;
}
input[type=text], input[type=number] ,select  {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

</style>
<?php if(mysqli_num_rows($products)>0){?>
<form  method="POST" action="updateInsertProduct.php" enctype="multipart/form-data">
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
<?php foreach ($categories as $row){ ?>
      <option value="<?= $row['categoryName'] ?>">
        <?= $row['categoryName'] ?>
      </option>
<?php  } ?>
</select>
<label for="image"><b>Image </b></label>
<input type="file" name="uploadedFile" id="uploadedFile">
<input type="input" name="image" value="<?PHP echo $image; ?>"name="image">
</br>
</br>
<label for="stockQty"><b>QTY </b></label>
<input type="number" value="<?PHP echo $stockQty; ?>" name="stockQty" > 
<input type="submit" >
</div>
</form>
<?php } ?>