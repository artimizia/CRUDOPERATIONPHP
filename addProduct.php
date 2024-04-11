<?php
  if( !isset($_SESSION) || session_id() == '' ||session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  if(!isset($_SESSION['userName']) || !isset($_SESSION['password'])){
    header("Location:index.php");
    exit();
}

  include "db_conn.php";
  include "validations.php"; 
  include "dbController.php";
  $functionType = $_GET['type'];
  $sku = $productName = $image='';
  $regularPrice = $salePrice =$stockQty=0;
  try{
    $categories=fetchCategories($conn);
    if($functionType =="update"){
      $sku= $_GET['sku'];
     
       $products=fetchProduct($conn,$sku);
       if(mysqli_num_rows($products)==0){
        throw new Exception();
      }
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
       
    }
}catch(Exception $e){
    echo '<script>
      alert("Error occured");
      window.location.href="home.php";
      </script>'; 
  } 

  function isFunctionAdd(){
    global $functionType;
    return $functionType=="add";
  } 

?>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
input[type=text],[type=number],select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

</style>
<?php if(isFunctionAdd()){ ?>
<form method="post"  enctype="multipart/form-data" action="createProduct.php">
<?php }?>
<?php if(!isFunctionAdd()){ ?>
<form method="post"  enctype="multipart/form-data" action="updateInsertProduct.php">
<?php }?>
<div class="container">
<label for="sku"><b>SKU</b></label>
<input type="text" name="sku" required value=<?php echo $sku;?> >
<label for="productName"><b>Product Name</b></label>
<input type="text" name="productName" value=<?php echo $productName;?> >
<label for="salePrice"><b>Sale price </b></label>
<input type="number" name="salePrice" value=<?php echo $salePrice;?> >
<label for="regularPrice"><b>Regular price</b></label>
<input type="number" name="regularPrice" value=<?php echo $regularPrice;?> >
<label for="category"><b>category </b></label>
<select name="category" id="categoryField">
<?php foreach ($categories as $row){ ?>
      <option value="<?= $row['categoryName'] ?>">
        <?= $row['categoryName']?>
      </option>
      <?php  } ?>
</select>
<label for="image"><b>Image </b></label>
<input type="file" name="uploadedFile" id="uploadedFile">
<?php if(!isFunctionAdd()){ ?>
  <input type="input" name="image" value="<?PHP echo $image; ?>"name="image">
<?php }?>
 <br />
 <br />
<label for="stockQty"><b>QTY </b></label>
<input type="number" name="stockQty" value=<?php echo $stockQty;?> >
<input type="submit" >
</div>
</form>
