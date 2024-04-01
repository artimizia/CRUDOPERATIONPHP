<?php
session_start();
include "db_conn.php";
$uname=$_POST['uname'];
$password=$_POST['password'];

if(empty($uname)){
	header("Location:index.php?error=User name is required");
	exit();
}

if(empty($password)){
	header("Location:index.php?error=password is required");
	exit();
}
$sql = "SELECT user_name,password,admin from  users WHERE user_name='$uname' AND password='$password'";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)===1){
    $row = mysqli_fetch_assoc($result);
    if($row['user_name']===$uname && $row['password']===$password){
    	echo "logged In!";
    	$_SESSION['user_name']=$row['user_name'];
    	$_SESSION['password']=$row['password'];
    	$_SESSION['admin']=$row['admin'];
    	header("Location:home.php");
    	exit();

    }else{
    	header("Location:index.php?error=Password or username is incorrect");
	    exit();
    }
}else{
	header("Location:index.php");
	exit();
}
?>