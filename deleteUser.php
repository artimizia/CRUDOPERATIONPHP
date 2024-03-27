<?php
  session_start();
  include "db_conn.php";
  $username=   $_POST['user_name'];
  echo $_POST['user_name'];
    // header('Location: index.php');
    // exit();
  $sql = "DELETE FROM users WHERE user_name='$username';";
  $result=mysqli_query($conn,$sql);
  header('Location: home.php');
?>