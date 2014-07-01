<?php
session_start();
$content = $_POST["reviewcontent"];
$uid = $_SESSION['login'];
$mid = $_GET["movieid"];
require_once 'login_jz337.php';
$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
mysql_select_db($db_database) or die("Unable to select database: " . mysql_error());
echo "login success";

	
if(isset($_POST['title'])) {
	# code...
	$t = $_POST['title'];

	echo "long review userid:$uid title:$t content:$content movieid:$mid";
	$query = sprintf("insert into review(USER_UserID,MOVIE_MovieID,ReviewTime,IsLong) 
            values ('%s','%s',NOW(),1)",
                 mysql_real_escape_string($uid),
                 mysql_real_escape_string($mid)
                 );

	$insert = mysql_query($query);
	if(!$insert) {
    echo"Invalid query:".mysql_error()."\n";
    }

    $query = "Select max(ReviewID) from review";
    $insert = mysql_query($query);
    if(!$insert) {
    echo"Invalid query:".mysql_error()."\n";
    }
    $rid = mysql_fetch_row($insert);

    $query = sprintf("insert into longreview(Review_ReviewID,ReviewTitle,ReviewContent) 
            values ('%s','%s','%s')",
            	mysql_real_escape_string($rid[0]),
                 mysql_real_escape_string($t),
                 mysql_real_escape_string($content)
                 );
    $insert = mysql_query($query);
	if(!$insert) {
    echo"Invalid query:".mysql_error()."\n";
    }
    
    header( 'Location: movie.php?movieid='.$mid ) ;
	
    }  else {
	echo "short review userid:$uid content:$content movieid:$mid";
	echo "long review userid:$uid title:$t content:$content movieid:$mid";
	$query = sprintf("insert into review(USER_UserID,MOVIE_MovieID,ReviewTime,IsLong) 
            values ('%s','%s',NOW(),0)",
                 mysql_real_escape_string($uid),
                 mysql_real_escape_string($mid)
                 );

	$insert = mysql_query($query);
	if(!$insert) {
    echo"Invalid query:".mysql_error()."\n";
    }

    $query = "Select max(ReviewID) from review";
    $insert = mysql_query($query);
    if(!$insert) {
    echo"Invalid query:".mysql_error()."\n";
    }
    $rid = mysql_fetch_row($insert);

     $query = sprintf("insert into shortreview(Review_ReviewID,SummaryContent) 
            values ('%s','%s')",
            	mysql_real_escape_string($rid[0]),
                 mysql_real_escape_string($content)
                 );
    $insert = mysql_query($query);
	if(!$insert) {
    echo"Invalid query:".mysql_error()."\n";
    }

    header( 'Location: movie.php?movieid='.$mid ) ;

	}	


?>