<?php 
session_start();
include "db_conn.php";
$category=   $_POST['category'];
if($category==="all"){
	$sql = "Select sku,productName,salePrice,regularPrice,stockQty,image,$category FROM products";
}else{
	$sql = "Select sku,productName,salePrice,regularPrice,stockQty,image,$category FROM products WHERE Category='$category'";
}

$res=mysqli_query($conn,$sql);
while($r = mysqli_fetch_assoc($res)) {
    $rows[] = $r;
}
$products = json_encode($rows);
echo $products;
?>