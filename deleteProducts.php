<?php
  session_start();
  include "db_conn.php";
  $sku=   $_POST['sku'];
  $sql = "DELETE FROM products WHERE sku='$sku';";
  $result=mysqli_query($conn,$sql);
?>