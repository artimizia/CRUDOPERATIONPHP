<?php 
  require "db_conn.php";
  require "dbController.php";

  $users= fetchAllUsers($conn);
  while($r = mysqli_fetch_assoc($users)) {
	    $rows[] = $r;
	}
	$users = json_encode($rows);
	echo $users;
  ?>
