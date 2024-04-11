v<?php
session_start();
include "db_conn.php";
include "validations.php";
$uname=validateInput($_POST['uname']);
$password=validateInput($_POST['password']);
try{
	$sql = "SELECT userName,password,admin from users WHERE userName='$uname'";
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)===1){
		 $row = mysqli_fetch_assoc($result);
		if($row['userName']===$uname && password_verify($password, $row['password'])){
			 echo "logged In!";
			 $_SESSION['userName']=$row['userName'];
			 $_SESSION['password']=$row['password'];
			 $_SESSION['admin']=$row['admin'];
			 header("Location:home.php");
			 exit();
		 }else{
	    	 echo '<script>
			    alert("Wrong password");
			    window.location.href="index.php";
			    </script>'; 
	    }

}else{
	 echo '<script>
    alert("Wrong credentials");
    window.location.href="index.php";
    </script>'; 

}

}catch(Exception $e){
	    echo '<script>
      alert("Error occured");
      window.location.href="index.php";
      </script>'; 
}


?>