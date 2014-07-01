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
	
	for ($i=1; $i <30 ; $i++) { 
		# code...
	
	$url="http://api.themoviedb.org/3/person/popular?api_key=196d309a66ce12e25e524b48342b2927&page=".$i;
	$json =file_get_contents($url);
	$data=json_decode($json);
	
	foreach ($data->results as $key ) {
		echo "$key->id  ";
		$name = explode(" ", $key->name);
		if (count($name) == 2) {
			# code...
			echo $name[0]." ".$name[1];
			$query = sprintf("insert into ACTOR(ActorID,ActorFirstName,ActorLastName) values ('%s','%s','%s')",
			mysql_real_escape_string($key->id),
			mysql_real_escape_string($name[0]),
			mysql_real_escape_string($name[1])
			);
			$insert = mysql_query($query);
		
		
			if(!$insert)
			{
				echo"Invalid query:".mysql_error()."\n";
			}

		} 

		else  {
			echo $key->name;
			$query = sprintf("insert into ACTOR(ActorID,ActorFirstName,ActorMiddleName,ActorLastName) values ('%s','%s','%s','%s')",
			mysql_real_escape_string($key->id),
			mysql_real_escape_string($name[0]),
			mysql_real_escape_string($name[1]),
			mysql_real_escape_string($name[2])
			);
			$insert = mysql_query($query);
		
		
			if(!$insert)
			{
				echo"Invalid query:".mysql_error()."\n";
			}
		}
		echo " <br>";

		
		
			
		}
	}
	?>

	</body>
</html>