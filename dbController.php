<?php
  require "db_conn.php";
  function fetchCategories($conn){
    $categoryStmt = "SELECT categoryName from category";
    $data = mysqli_query($conn,$categoryStmt);
    if($data){
          $categories = $data->fetch_all(MYSQLI_ASSOC);
    }
    return $categories;
}

   function fetchProduct($conn,$sku){
	  $sql = "SELECT sku,productName,salePrice,regularPrice,stockQty,image,category FROM products WHERE sku='$sku'";
	  $products=mysqli_query($conn,$sql);
	  if(mysqli_num_rows($products)==0){
	   throw new Exception("Product does not exist");
	  }
	  return $products;
   }

   function fetchAllProducts($conn){
   	$productStmt = "SELECT productName,image,salePrice,regularPrice,sku,category from  products";
   	 $products=mysqli_query($conn,$productStmt);
   	 return $products;
   }

   function fetchAllUsers($conn){
  //  echo "fetchUsers";
   	 $userStmt = "SELECT userName,password,admin from  users";
     $users= mysqli_query($conn,$userStmt); 
    // print(mysqli_num_rows($users));
     // foreach($users as $user){
     //    var_dump($user);
     // }
    //  var_dump($users);
      // while($r = mysqli_query($conn,$userStmt)) {
      //    $rows[] = $r;
      // }
     return $users;
   }

   function fetchUser($conn,$username){
      $sql = "Select userName,password,admin FROM users WHERE userName='$username'";
      $users=mysqli_query($conn,$sql);
    if(!$users || mysqli_num_rows($users)==0){
      throw new Exception();
    }
    return $users;
   }
   
 ?>