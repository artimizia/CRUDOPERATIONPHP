<?php
    $sname="localhost";
    $uname="root";
    $password="";
    $db_name="test_db";
    //$pdo = new PDO("sqlsrv:Server=$serverName;Database=$db_name", $uname, $password);
    $conn=mysqli_connect($sname,$uname,$password,$db_name);
    if(!$conn){
    	echo"connection failed";
    }