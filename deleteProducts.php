<?php
  include "db_conn.php";
  try{
    $sku=  $_POST['sku'];
    $sql = "DELETE FROM products WHERE sku='$sku';";
    $result=mysqli_query($conn,$sql);
    echo json_encode($result);
  }catch(Exception $e){
     echo json_encode(array(
        'error' => array(
           "Error occured during delete"
        ),
    ));
  }

?>