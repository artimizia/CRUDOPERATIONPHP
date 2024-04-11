<?php
  include "db_conn.php";
  $username=  $_POST['userName'];
  Try{
      $sql = "DELETE FROM users WHERE userName='$username';";
      $result=mysqli_query($conn,$sql);
      echo json_encode($result);
  }catch(Exception $e){
    echo json_encode(array(
        'error' => array(
           "Error occured during delete"
        ),
    ));
  }

?>