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
     
     foreach ($data->production_countries as $key) {
     	# code...
     	echo $data->id." ";
     	echo $key->name." <br>";
     	$queryMD = sprintf("insert into release_country(MOVIE_MovieID,Country) values ('%s','%s')",
             mysql_real_escape_string($data->id),
             mysql_real_escape_string($key->name)
             );
        
        $insertMD = mysql_query($queryMD);
         if(!$insertMD)
         {
            echo"Invalid query:".mysql_error()."\n";
        }
     }

    
	usleep(400000);



}




?>

</body>
</html>