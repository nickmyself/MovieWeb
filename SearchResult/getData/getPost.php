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
	$result_movieid = mysql_query("select MovieID from MOVIE ") or die(mysql_error());
	//$query_movie = mysql_fetch_array($result_movieid, MYSQL_NUM);
	
	while($row = mysql_fetch_array($result_movieid, MYSQL_NUM)){
		
		echo "$row[0] <br>";
		$i = $row[0];
		$url="http://api.themoviedb.org/3/movie/".$i."?api_key=196d309a66ce12e25e524b48342b2927";
		$json =file_get_contents($url);
		$data=json_decode($json);
		$imdbID = $data->imdb_id;

		$imdb_url = "http://www.imdbapi.com/?i=".$imdbID;
		$json1 =file_get_contents($imdb_url);
		$IMDBdata=json_decode($json1);

		echo "$data->title";
		echo " $imdbID";
		echo "$IMDBdata->Poster";
		$Languages = explode(",", $IMDBdata->Language);
		echo "$Languages[0]";

		
		$query = sprintf(
			"UPDATE MOVIE SET ImdbID = '%s', Poster = '%s' , Language = '%s',RunTime = '%s', Plot = '%s'
			WHERE MovieID = '%s'",
		mysql_real_escape_string($data->imdb_id),
		mysql_real_escape_string($IMDBdata->Poster),
		mysql_real_escape_string($Languages[0]),
		mysql_real_escape_string($data->runtime),
		mysql_real_escape_string($data->overview),
		mysql_real_escape_string($i)
		);

		$update = mysql_query($query);
		if(!$update)
		{
			echo"Invalid query:".mysql_error()."\n";
		}	
		

		/*
		echo "$row[0] <br>";
		$i = $row[0];
		$url="http://api.themoviedb.org/3/movie/".$i."?api_key=196d309a66ce12e25e524b48342b2927";
		$json =file_get_contents($url);
		$data=json_decode($json);
		echo "$data->title ";
		echo "$data->overview ";
		echo "Run time:".$data->runtime;
		echo $data->spoken_languages[0]->name;


		$query = sprintf(
			"UPDATE MOVIE SET RunTime = '%s', Plot = '%s' , Language = '%s'
			WHERE MovieID = '%s'",
		mysql_real_escape_string($data->runtime),
		mysql_real_escape_string($data->overview),
		mysql_real_escape_string($data->spoken_languages[0]->name),
		mysql_real_escape_string($i)
		);
		$update = mysql_query($query);
		if(!$update)
		{
			echo"Invalid query:".mysql_error()."\n";
		}	
		*/
		usleep(400000);
		
	}
	
		




	
	//echo $data->results[1]->title;

	/*
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
	*/
	
	?>

	</body>
</html>