<!DOCTYPE html>
<html>
<body>

	<?php
	$con=mysql_connect("localhost","root","iamnick42");
	if(!$con){
		die('Could not connect'.mysql_error());
  }
  echo "Successfully connected! <br>";
  mysql_select_db("class-2014-1-17-610-557-01_jz337",$con);
  $result_movieid = mysql_query("select MovieID from MOVIE") or die(mysql_error());
	//$query_movie = mysql_fetch_array($result_movieid, MYSQL_NUM);

  
  while($row = mysql_fetch_array($result_movieid, MYSQL_NUM)){
      echo "$row[0] <br>";
      $i = $row[0];
      $url="http://api.themoviedb.org/3/movie/".$i."?api_key=196d309a66ce12e25e524b48342b2927";
      $json =file_get_contents($url);
      $data=json_decode($json);
      foreach ($data->genres as $genre ) {
      	echo $genre->id." ";
      	echo $genre->name." <br>";

      	$query = sprintf("insert into MOVIE_GENRE(MOVIE_MovieID,GENRE_GenreID) values ('%s','%s')",
			mysql_real_escape_string($i),
			mysql_real_escape_string($genre->id)
			);
			$insert = mysql_query($query);
		
		
			if(!$insert)
			{
				echo"Invalid query:".mysql_error()."\n";
			}



      	# code...
      }

		sleep(1);



	}
	

	  



?>

</body>
</html>