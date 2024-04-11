<?php
  include "db_conn.php";
  include "validations.php";
  $username= validateInput($_POST['username']);
  $password= validateInput($_POST['password']);
  $admin =  $_POST['userRole'];
  if(password_get_info($password)['algoName'] == "unknown"){
      $password = password_hash($password,  
          PASSWORD_DEFAULT); 
  }
  try{
      $sql = "Update users SET password='$password', admin='$admin' WHERE userName='$username'";
     $users=mysqli_query($conn,$sql);

     if(!$users){
      throw new Exception("error occured");
     }  
    header("Location:home.php");
    exit();
  }catch(Exception $e){
    echo '<script>
      alert("Error occured");
      window.location.href="home.php";
      </script>'; 
  }


?>