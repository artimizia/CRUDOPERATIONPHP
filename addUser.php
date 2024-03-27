<?php
  session_start();
  include "db_conn.php";
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
<form method="post" action="CreateUser.php">
<div class="container">
<label for="username"><b>Username</b></label>
<input type="text" name="username">
<label for="password"><b>Password</b></label>
<input type="text" name="password">
<label for="admin"><b>Admin or not </b></label>
<input type="text" name="admin">
<input type="submit" >
</div>
</form>
<?php } ?>
