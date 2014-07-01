<?php
function findByName($name) {
  	$query = "Select MovieName,ReleaseDate,Language,Rating from Movie"+"WHERE ((`MOVIE`.`MovieName` like '%$name%')
            or (`MOVIE`.`Plot` like '%$name%'))"
		return $query;
}


?>