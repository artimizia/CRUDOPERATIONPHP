<?php
  session_start();
  include "db_conn.php";
  $username=   $_GET['user_name'];
  $sql = "Select * FROM users WHERE user_name='$username'";
  $users=mysqli_query($conn,$sql);
  // header("Location:home.php");
  // exit();
  foreach ($users as $i => $user) {
    $user_name = $user['user_name'];
    $password = $user['password'];
    $admin = $user['admin'];

  }
 
?>
<style>
body {font-family: Arial, Helvetica, sans-serif;}


input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

</style>
<?php if(isset($_SESSION['user_name']) && isset($_SESSION['password'])){?>
<form method="post" action="updateUser.php">
<div class="container">
<label for="username"><b>Username</b></label>
<input type="text" value="<?PHP echo $username; ?>" name="username" readonly>
<label for="password"><b>Password</b></label>
<input type="password" value="<?PHP echo $password; ?>" name="password">
<label for="admin"><b>is it an Admin? </b></label>
<input type="checkbox" name="admin" value="1">
<input type="submit" >
</div>
</form>
<?php } ?>
