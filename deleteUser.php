<?php
  session_start();
  include "db_conn.php";
  $username=   $_POST['userName'];
  echo $_POST['userName'];
  $sql = "DELETE FROM users WHERE userName='$username';";
  $result=mysqli_query($conn,$sql);
?>