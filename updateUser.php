<?php
  session_start();
  include "db_conn.php";
  $username=   $_POST['username'];
  $password=   $_POST['password'];
  $admin=   $_POST['admin'];
  $sql = "Update users SET password='$password', admin='$admin' WHERE user_name='$username'";
  $users=mysqli_query($conn,$sql);
  header("Location:home.php");
  exit();
?>