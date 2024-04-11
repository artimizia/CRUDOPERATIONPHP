<?php
  include "db_conn.php";
  include "dbController.php";
  if( !isset($_SESSION) || session_id() == '' ||session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  if(!isset($_SESSION['userName']) || !isset($_SESSION['password'])){
    header("Location:index.php");
    exit();
}
  if(!isset($_SESSION['admin']) ||$_SESSION['admin']==0){
    header("Location:home.php");
    exit();
  }
  $username = $_GET['userName'];
  try{
    $users=fetchUser($conn,$username);
  foreach ($users as $i => $user) {
    $userName = $user['userName'];
    $password = $user['password'];
    $admin = $user['admin'];
  }

  
  }catch(Exception $e){
    echo '<script>
      alert("Error occured");
      window.location.href="home.php";
      </script>'; 
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


<form method="post" action="updateUser.php">
<div class="container">
<label for="username"><b>Username</b></label>
<input type="text" value="<?PHP echo $username; ?>" name="username" readonly>
<label for="password"><b>Password</b></label>
<input type="password" value="<?PHP echo $password; ?>" name="password" required>
<label for="userRole"><b>Choose User Role</b></label>
<select name=userRole>
<option value="1" <?php if($admin==1) echo "selected=\"selected\""; ?>>Admin</option>
<option value="0" <?php if($admin==0) echo "selected=\"selected\""; ?>>Store Manager</option>
</select>
<input type="submit" >
</div>
</form>

