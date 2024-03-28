<?php 
session_start();
include "db_conn.php";
$category=   $_POST['category'];
if($category==="all"){
	$sql = "Select * FROM products";
}else{
	$sql = "Select * FROM products WHERE Category='$category'";
}

$res=mysqli_query($conn,$sql);
while($r = mysqli_fetch_assoc($res)) {
    $rows[] = $r;
}
if(empty($rows)){
	echo "";
	return;
}
$products = json_encode($rows);
echo $products;
?>