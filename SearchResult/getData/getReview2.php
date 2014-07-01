<!DOCTYPE html>
<html>
<body>




	<?php
	$con=mysql_connect("localhost","root","iamnick42");
	
	if(!$con){
		die('Could not connect'.mysql_error());
  	}
  	
  	/*
	used to generate random long review  (isLong = 1)

  	*/

  	echo "Successfully connected! <br>";
  	mysql_select_db("class-2014-1-17-610-557-01_jz337",$con);
  	$result_movieid = mysql_query("select MovieID from MOVIE") or die(mysql_error());
	//$query_movie = mysql_fetch_array($result_movieid, MYSQL_NUM);
	$buffer = array();
	$kk = 0;
	while($row = mysql_fetch_array($result_movieid, MYSQL_NUM)){
		$buffer[$kk] = $row[0];
		if ($kk>30) {
			# code..
			break;
		}
		$kk++;
	}
	//echo $buffer[0];
  	
  	
  	for ($k=10113; $k <10143 ; $k++) { 
  			# code...
  		$int= mt_rand(1332055681,1372055681);
        $writetime = date("Y-m-d H:i:s",$int);
        $Rating = 0;
        $Likes = 0;
        $Dislikes = 0;
        $isLong = 1;
        $UserID = mt_rand(93,152);
        $MovieID = $buffer[mt_rand(0,30)];
        

        echo $UserID." ".$MovieID." ".$writetime." <br>";
        
        $query = sprintf("insert into REVIEW(ReviewID,ReviewTime,Rating,Likes,Dislikes,isLong,USER_UserID,MOVIE_MovieID) 
          values ('%s','%s','%s','%s','%s','%s','%s','%s')",
        mysql_real_escape_string($k),
        mysql_real_escape_string($writetime),
        mysql_real_escape_string($Rating),
        mysql_real_escape_string($Likes),
        mysql_real_escape_string($Dislikes),
        mysql_real_escape_string($isLong),
        mysql_real_escape_string($UserID),
        mysql_real_escape_string($MovieID)
        );
        $insert = mysql_query($query);
        
        if(!$insert)
        {
          echo"Invalid query:".mysql_error()."\n";
        }
  		

        
    }
        
	








?>

</body>
</html>