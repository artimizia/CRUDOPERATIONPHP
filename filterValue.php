<?php 
include "db_conn.php";
$category=   $_POST['category'];
	try{
	if($category==="all"){
		$sql = "SELECT sku,productName,salePrice,regularPrice,stockQty,image,category FROM products";
	}else{
		$sql = "SELECT sku,productName,salePrice,regularPrice,stockQty,image,category FROM products WHERE Category='$category'";
	}

	$res=mysqli_query($conn,$sql);
	while($r = mysqli_fetch_assoc($res)) {
	    $rows[] = $r;
	}
	$products = json_encode($rows);
	echo $products;
	}catch(Exception $e){
		echo '<script>
	      alert("Error occured");
	      </script>'; 
	}

?>