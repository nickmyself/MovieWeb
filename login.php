<?php
session_start();
$uname = $_POST["username"];
$up = $_POST["password"];
echo "$uname  $up";


?>


<html>
<head>

</head>

<body>
  <?php 
  if(isset($_SESSION['login']))
  {
    echo "Welcome ". $_SESSION['login'] . "! You have logged already.</br>";?> </br> <?php 
    echo "<a href = index.php> click here to continue </a>";
  }
  else {

    require_once 'login_jz337.php';
    $db_server = mysql_connect($db_hostname, $db_username, $db_password);
    if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
    mysql_select_db($db_database) or die("Unable to select database: " . mysql_error());
    echo "login success";
    $username = $_POST["username"];
    $password = $_POST["password"]; 
    $check = 0;
    $query = "Select * from user Where UserName = '$username' AND Password ='$password' ";
    $result = mysql_query($query);
    $rows = mysql_num_rows($result);
    $check = $rows;

    if($check!=0){
      echo "Log in sussess";
      $row = mysql_fetch_row($result);

      if(!isset($_SESSION['login']))
        $_SESSION['login']=$row[0];
        $_SESSION['email']=$row[3];
        $_SESSION['nickname']=$row[4];
      echo "Login success! Welcome ". $_SESSION["nickname"] . "!</br>";?> </br> <?php 
      echo "<a href = index.php> click here to continue </a>";
      


    }

    else {

      echo "Log in Fails !</br> Please check your username and password! !</br> <a href = index.html>Continue</a>";
    }
  }
  ?>

</body>
</html>