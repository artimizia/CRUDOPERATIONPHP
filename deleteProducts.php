<?php
  session_start();
  include "db_conn.php";
  $sku=   $_POST['sku'];
  $sql = "DELETE FROM products WHERE SKU='$sku';";
  $result=mysqli_query($conn,$sql);
?>