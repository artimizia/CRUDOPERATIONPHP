  <?php
    include "db_conn.php";
    include "validations.php";
    $username=   validateInput($_POST['username']);
    $password=   validateInput($_POST['password']);
    $admin =  $_POST['userRole'];
    $passwordHash = password_hash($password,  
            PASSWORD_DEFAULT); 
  try{
    $sql = "INSERT INTO users (userName, password, admin)VALUES ( '$username', '$passwordHash', '$admin');";
    var_dump($sql);
    $result=mysqli_query($conn,$sql);
    echo $result;
  if(!$result){
    throw new Exception("Error Occured");
  }
    header("Location:home.php");
    exit();
  }catch(Exception $e){

    echo '<script>
    alert("Error occured");
    window.location.href="addUser.php";
    </script>'; 

  }


  ?>