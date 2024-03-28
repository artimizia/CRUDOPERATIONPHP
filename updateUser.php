<?php
  session_start();
  include "db_conn.php";
  $username=   $_POST['username'];
  $password=   $_POST['password'];
  if(isset($_POST['admin'])){
    $admin="1";
  }else{
    $admin="0";
  }
  $sql = "Update users SET password='$password', admin='$admin' WHERE user_name='$username'";
  $users=mysqli_query($conn,$sql);
  header("Location:home.php");
  exit();
?>