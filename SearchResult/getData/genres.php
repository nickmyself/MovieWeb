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
	//$movieid = 303;
	//$url="https://api.themoviedb.org/3/movie/".$movieid."?api_key=196d309a66ce12e25e524b48342b2927";
	$url="https://api.themoviedb.org/3/genre/list?api_key=196d309a66ce12e25e524b48342b2927";
	$json =file_get_contents($url);
	$data=json_decode($json);
	echo $data->genres[0]->name;

	foreach ($data->genres as $key ) {
		# code...
		$query = sprintf("insert into genre(GenreID,GenreName) values ('%s','%s')",
		mysql_real_escape_string($key->id),
		mysql_real_escape_string($key->name)
		);
		$insert = mysql_query($query);
		
		echo "$key->id  ";
		echo "$key->name <br>";
		if(!$insert)
		{
			echo"Invalid query:".mysql_error()."\n";
		}	
	}
	?>

	</body>
</html>