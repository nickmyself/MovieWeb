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
	
	for ($i=20; $i < 25; $i++) { 
		# code...
	
	$url="http://api.themoviedb.org/3/movie/popular?api_key=196d309a66ce12e25e524b48342b2927&page="."$i";
	$json =file_get_contents($url);
	$data=json_decode($json);
	
	//echo $data->results[1]->title;

	
	foreach ($data->results as $key ) {
		echo "$key->id ";
		echo "$key->title ";
		echo "$key->release_date ";
		echo "$key->vote_average ";
		echo "$key->vote_count ";
		echo "<br>";
		# code...
		
		$query = sprintf("insert into MOVIE(MovieID,MovieName,Rating,Vote_count,ReleaseDate) values ('%s','%s','%s','%s','%s')",
		mysql_real_escape_string($key->id),
		mysql_real_escape_string($key->title),
		mysql_real_escape_string($key->vote_average),
		mysql_real_escape_string($key->vote_count),
		mysql_real_escape_string($key->release_date)
		);
		$insert = mysql_query($query);
		

		
		
		if(!$insert)
		{
			echo"Invalid query:".mysql_error()."\n";
		}	
		
	}
	
	}
	?>

	</body>
</html>