<?php
  session_start();
  include "db_conn.php";
  $username=   $_POST['username'];
  $password=   $_POST['password'];
  $admin=   $_POST['admin'];

if(empty($username)){
  header("Location:addUser.php?error=User name is required");
  exit();
}

if(empty($password)){
  header("Location:addUser.php?error=password is required");
  exit();
}
if(is_null($admin)){
  header("Location:addUser.php?error=admin is required");
  exit();
}
try{
$result="";
$sql = "INSERT INTO users (user_name, password, admin)VALUES ( '$username', '$password', '$admin');";
$result=mysqli_query($conn,$sql);
}catch(Exception $e){
  echo '<script>alert("exception occured")</script>'; 
  //echo "exception occured '$result'".$e;
}


header("Location:home.php");
exit();
?>