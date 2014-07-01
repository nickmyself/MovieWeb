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


  $k = 10000;
  while($row = mysql_fetch_array($result_movieid, MYSQL_NUM)){
      echo "$row[0] <br>";
      $i = $row[0];
      $url="http://api.themoviedb.org/3/movie/".$i."/reviews?api_key=196d309a66ce12e25e524b48342b2927";
      $json =file_get_contents($url);
      $data=json_decode($json);
      
      if($data->total_results>0){
      echo $data->id;
      foreach ($data->results as $review ) {

        $k ++;
        $int= mt_rand(1332055681,1372055681);
        $writetime = date("Y-m-d H:i:s",$int);
        $Rating = 0;
        $Likes = 0;
        $Dislikes = 0;
        $isLong = 0;
        $UserID = mt_rand(93,152);

        
        $query = sprintf("insert into REVIEW(ReviewID,ReviewTime,Rating,Likes,Dislikes,isLong,USER_UserID,MOVIE_MovieID) 
          values ('%s','%s','%s','%s','%s','%s','%s','%s')",
        mysql_real_escape_string($k),
        mysql_real_escape_string($writetime),
        mysql_real_escape_string($Rating),
        mysql_real_escape_string($Likes),
        mysql_real_escape_string($Dislikes),
        mysql_real_escape_string($isLong),
        mysql_real_escape_string($UserID),
        mysql_real_escape_string($data->id)
        );
        $insert = mysql_query($query);
        
        if(!$insert)
        {
          echo"Invalid query:".mysql_error()."\n";
        }
        

        //insert detail
        
        $query = sprintf("insert into shortreview(Review_ReviewID,SummaryContent) 
          values ('%s','%s')",
          mysql_real_escape_string($k),
          mysql_real_escape_string($review->content)
        );
        $insert = mysql_query($query);
    
        if(!$insert)
        {
          echo"Invalid query:".mysql_error()."\n";
        }
        
        echo $review->content;
        
        


      }
      
    }
    
    usleep(400000);



}








?>

</body>
</html>