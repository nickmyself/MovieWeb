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
      $url="http://api.themoviedb.org/3/movie/".$i."/credits?api_key=196d309a66ce12e25e524b48342b2927";
      $json =file_get_contents($url);
      $data=json_decode($json);
      foreach ($data->cast as $cast ) {
				//echo $cast->character." <br>";

        
            
					# code...
           echo $cast->id." ";
           echo $cast->name." <br>";

           $name = explode(" ", $cast->name);
           if (count($name) == 2) {
			# code...
            
             echo $name[0]." ".$name[1];
             $query = sprintf("insert into ACTOR(ActorID,ActorFirstName,ActorLastName) values ('%s','%s','%s')",
                 mysql_real_escape_string($cast->id),
                 mysql_real_escape_string($name[0]),
                 mysql_real_escape_string($name[1])
                 );
             $insert = mysql_query($query);


             if(!$insert)
             {
                echo"Invalid query:".mysql_error()."\n";
            }
            
            echo $name[0]." ".$name[1];

        } 

        else  {
       //echo $key->name;
         
         $query = sprintf("insert into ACTOR(ActorID,ActorFirstName,ActorMiddleName,ActorLastName) values ('%s','%s','%s','%s')",
             mysql_real_escape_string($cast->id),
             mysql_real_escape_string($name[0]),
             mysql_real_escape_string($name[1]),
             mysql_real_escape_string($name[2])
             );
         $insert = mysql_query($query);


         if(!$insert)
         {
            echo"Invalid query:".mysql_error()."\n";
        } 
        echo $name[0]." ".$name[1]." ".$name[2];
    }
    echo " <br>";

    # char Movie_Actor
    
   $queryMD = sprintf("insert into MOVIE_ACTOR(MOVIE_MovieID,Actor_ActorID) values ('%s','%s')",
             mysql_real_escape_string($data->id),
             mysql_real_escape_string($cast->id)
             );
         $insertMD = mysql_query($queryMD);


         if(!$insertMD)
         {
            echo"Invalid query:".mysql_error()."\n";
        }
    
   // echo "haha";
    
    

  #end if Actor 

			# code...


}

usleep(400000);



}




?>

</body>
</html>