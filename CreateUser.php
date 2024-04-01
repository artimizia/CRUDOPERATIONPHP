<?php
  session_start();
  include "db_conn.php";
  $username=   $_POST['username'];
  $password=   $_POST['password'];

if(empty($username)){
  //test git
  header("Location:addUser.php?error=User name is required");
  exit();
}

if(empty($password)){
  header("Location:addUser.php?error=password is required");
  exit();
}
if(isset( $_POST['admin'])){

  $admin="1";
}else{
  $admin="0";
}

try{
$result="";
$sql = "INSERT INTO users (user_name, password, admin)VALUES ( '$username', '$password', '$admin');";
$result=mysqli_query($conn,$sql);
}catch(Exception $e){
  echo '<script>alert("exception occured")</script>'; 
}
header("Location:home.php");
exit();
?>