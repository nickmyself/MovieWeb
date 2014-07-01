<?php 
session_start();
$cContent = $_POST["comment"]; 
$cRid = $_GET["reviewid"];
$uid = $_SESSION["login"];
require_once 'login_jz337.php';
$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
mysql_select_db($db_database) or die("Unable to select database: " . mysql_error());
echo "login success";


$Likes = 0;
$Dislikes = 0;
$query = sprintf("insert into comment(USER_UserID,REVIEW_ReviewID,Content,CommentTime,Likes,Dislikes) 
            values ('%s','%s','%s',NOW(),'%s','%s')",
                 mysql_real_escape_string($uid),
                 mysql_real_escape_string($cRid),
                 mysql_real_escape_string($cContent),
                 mysql_real_escape_string($Likes),
                 mysql_real_escape_string($Dislikes)
                 );
$insert = mysql_query($query);


             if(!$insert)
             {
                echo"Invalid query:".mysql_error()."\n";
            } else {
            	echo "Success!";
            	header('Location: ' . $_SERVER['HTTP_REFERER']);
            }


?>