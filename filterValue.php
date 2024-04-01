<?php 
session_start();
include "db_conn.php";
$category=   $_POST['category'];
if($category==="all"){
	$sql = "SKU,Product_Name,sale_price,regular_price,Stock_Qty,Image,Category FROM products";
}else{
	$sql = "SKU,Product_Name,sale_price,regular_price,Stock_Qty,Image,Category FROM products WHERE Category='$category'";
}

$res=mysqli_query($conn,$sql);
while($r = mysqli_fetch_assoc($res)) {
    $rows[] = $r;
}
$products = json_encode($rows);
echo $products;
?>