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
	//mysql_select_db("test",$con);
	$result_actorid = mysql_query("select ActorID from ACTOR ") or die(mysql_error());

	
	while($row = mysql_fetch_array($result_actorid, MYSQL_NUM)){
		echo "$row[0] <br>";
		$i = $row[0];
		$url="http://api.themoviedb.org/3/person/".$i."?api_key=196d309a66ce12e25e524b48342b2927";
		$json =file_get_contents($url);
		$data=json_decode($json);


		$query = sprintf(
			"UPDATE ACTOR SET Birthday = '%s', Description = '%s' , Nationality = '%s'
			WHERE ActorID = '%s'",
		mysql_real_escape_string($data->birthday),
		mysql_real_escape_string($data->biography),
		mysql_real_escape_string($data->place_of_birth),
		mysql_real_escape_string($i)
		);

		$update = mysql_query($query);

		if(!$update)
		{
			echo"Invalid query:".mysql_error()."\n";
		}	

		usleep(400000);
	}
	

	
	?>

	</body>
</html>