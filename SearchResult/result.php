<html lang="en">
    <head>
	<meta charset="UTF-8" />
       <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
       <title>Database management course project</title>
       <link rel="stylesheet" type="text/css" href="css/style.css" />
	<script src="js/modernizr.custom.63321.js"></script>
	<!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
    </head>
    <body>
        <div class="container">
            <div class="codrops-top">
                <a href="../index.php">
                    <strong>&laquo; back to Main Page </strong>
                </a>                
            </div>
        </div>
	
	
	<?php
		##show the attribute and value passed by GET method
		$field = $_GET["attribute"];
		$searchvalue = $_GET["info"];
		//echo "value pass by GET success"."<br>";
		//echo "Results for searching all the Movies by ".$field.": ".$searchvalue."  ";
		##connect databse
		require_once 'login_jz337.php';
		$db_server = mysql_connect($db_hostname, $db_username, $db_password);
		if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
		mysql_select_db($db_database) or die("Unable to select database: " . mysql_error());
		##server and database connect success
		//echo "<br>"." database connect success";
		//echo '</div>';

		if (strcmp($field,"MovieName")==0) {
			$query = "Select MovieName,ReleaseDate,Language,Rating,MovieID from movie where ((MovieName like '%$searchvalue%')
            or (Plot like '%$searchvalue%')) order by Rating";
			echo'<table cellspacing="0">';
    		echo'<tr><th>Movie Name</th><th>ReleaseDate</th><th>Language</th><th>Rating</th></tr>';
    		
    	
				$result = mysql_query($query);
				$rows = mysql_num_rows($result);
				for ($i=0; $i < $rows; $i++) { 
					$row = mysql_fetch_row($result);
					echo '<tr>';
					echo '<td>'.'<a href="../movie.php?movieid='.$row[4].'">'.$row[0].'</a></td>';
					echo '<td>'.$row[1].'</td>';
					echo '<td>'.$row[2].'</td>';
					echo '<td>'.$row[3].'</td>';
					echo '</tr>';
				
				
			}
			echo '</table>';
				
		} elseif (strcmp($field,"year")==0) {
			$query = "Select MovieName,ReleaseDate,Language,Rating,MovieID from movie where ReleaseDate > '$searchvalue-01-01' AND ReleaseDate < '$searchvalue-12-31' order by ReleaseDate";
			echo'<table cellspacing="0">';
    		echo'<tr><th>Movie Name</th><th>ReleaseDate</th><th>Language</th><th>Rating</th></tr>';
    		$result = mysql_query($query);
				$rows = mysql_num_rows($result);
				for ($i=0; $i < $rows; $i++) { 
					$row = mysql_fetch_row($result);
					echo '<tr>';
					echo '<td>'.'<a href="../movie.php?movieid='.$row[4].'">'.$row[0].'</a></td>';
					echo '<td>'.$row[1].'</td>';
					echo '<td>'.$row[2].'</td>';
					echo '<td>'.$row[3].'</td>';
					echo '</tr>';
				
				
			}
			echo '</table>';
		} elseif (strcmp($field,"Language")==0) {
			$query = "Select MovieName,ReleaseDate,Language,Rating,MovieID from movie where Language Like '%$searchvalue%'";
			echo'<table cellspacing="0">';
    		echo'<tr><th>Movie Name</th><th>ReleaseDate</th><th>Language</th><th>Rating</th></tr>';
    		$result = mysql_query($query);
				$rows = mysql_num_rows($result);
				for ($i=0; $i < $rows; $i++) { 
					$row = mysql_fetch_row($result);
					echo '<tr>';
					echo '<td>'.'<a href="../movie.php?movieid='.$row[4].'">'.$row[0].'</a></td>';
					echo '<td>'.$row[1].'</td>';
					echo '<td>'.$row[2].'</td>';
					echo '<td>'.$row[3].'</td>';
					echo '</tr>';
				}
			echo '</table>';

		} elseif (strcmp($field,"Director")==0) {
			$Name = explode(" ", $searchvalue);
			$Name[0] = strtolower($Name[0]);
			$Name[1] = strtolower($Name[1]);
			$query = "SELECT MovieName,ReleaseDate,Language,Rating,MovieID FROM showmoviedirector WHERE getname(DirectorFirstName,DirectorMiddleName,DirectorLastName) Like '%$searchvalue%'  ;";
			echo'<table cellspacing="0">';
    		echo'<tr><th>Movie Name</th><th>ReleaseDate</th><th>Language</th><th>Rating</th></tr>';
    		$result = mysql_query($query);
				$rows = mysql_num_rows($result);
				for ($i=0; $i < $rows; $i++) { 
					$row = mysql_fetch_row($result);
					echo '<tr>';
					echo '<td>'.'<a href="../movie.php?movieid='.$row[4].'">'.$row[0].'</a></td>';
					echo '<td>'.$row[1].'</td>';
					echo '<td>'.$row[2].'</td>';
					echo '<td>'.$row[3].'</td>';
					echo '</tr>';
				}
			echo '</table>';

		} elseif (strcmp($field,"Actor")==0) {
			$Name = explode(" ", $searchvalue);
			$Name[0] = strtolower($Name[0]);
			$Name[1] = strtolower($Name[1]);
			$query = "SELECT MovieName,ReleaseDate,Language,Rating,MovieID FROM showmovieactor
WHERE getname(ActorFirstName,ActorMiddleName,ActorLastName) Like '%$searchvalue%'";
			echo'<table cellspacing="0">';
    		echo'<tr><th>Movie Name</th><th>ReleaseDate</th><th>Language</th><th>Rating</th></tr>';
    		$result = mysql_query($query);
				$rows = mysql_num_rows($result);
				for ($i=0; $i < $rows; $i++) { 
					$row = mysql_fetch_row($result);
					echo '<tr>';
					echo '<td>'.'<a href="../movie.php?movieid='.$row[4].'">'.$row[0].'</a></td>';
					echo '<td>'.$row[1].'</td>';
					echo '<td>'.$row[2].'</td>';
					echo '<td>'.$row[3].'</td>';
					echo '</tr>';
				}
			echo '</table>';

		} elseif (strcmp($field,"GenreName")==0) {
			$number = 1000;
			if (isset($_GET['limit'])) {
				$number = $_GET['limit'];
			}
			$query = "SELECT MovieName,ReleaseDate,Language,Rating,MovieID FROM showmoviegenre WHERE GenreName = '$searchvalue' ORDER BY Rating DESC LIMIT $number";
			if (strcmp($searchvalue,"All")==0) {
				$query = "SELECT DISTINCT MovieName,ReleaseDate,Language,Rating,MovieID FROM showmoviegenre ORDER BY Rating DESC LIMIT $number";
			}
			echo'<table cellspacing="0">';
    		echo'<tr><th>Movie Name</th><th>ReleaseDate</th><th>Language</th><th>Rating</th></tr>';
    		$result = mysql_query($query);
				$rows = mysql_num_rows($result);
				for ($i=0; $i < $rows; $i++) { 
					$row = mysql_fetch_row($result);
					echo '<tr>';
					echo '<td>'.'<a href="../movie.php?movieid='.$row[4].'">'.$row[0].'</a></td>';
					echo '<td>'.$row[1].'</td>';
					echo '<td>'.$row[2].'</td>';
					echo '<td>'.$row[3].'</td>';
					echo '</tr>';
				}
			echo '</table>';

		}
		
		
		/*
		$query = "Select * from Movie";
		$result = mysql_query($query);
		$rows = mysql_num_rows($result);
		for ($i=0; $i < $rows; $i++) { 
			# code...
			$row = mysql_fetch_row($result);
			foreach ($row as $k) {
				echo $k." ";
				# code...
			}
			echo "<br>";
		}
		*/

/*		##an example to retrieve data from Movie table table and display. ONLY work after you set up the connection to your database server
		$query = "SELECT * FROM Movie as S WHERE S.$field='$searchvalue'";	
		$result = mysql_query($query);
		if (!$result) die ("Database access failed: " . mysql_error());
		$rows = mysql_num_rows($result);
		echo'<table cellspacing="0">';
		echo'<tr><th>Movie Name</th><th>Genre</th><th>Director</th><th>Release Time</th><th>Run Time</th><th>Rating</th></tr>';
		for ($j = 0 ; $j < $rows ; ++$j){
		$row = mysql_fetch_row($result);
		## need to consult table to identify correct index for field
      		  	echo '<tr>';
			echo '<td>'.$row[0].'</td>';
			echo '<td>'.$row[1].'</td>';
			echo '<td>'.$row[2].'</td>';
			echo '<td>'.$row[3].'</td>';
			echo '<td>'.$row[4].'</td>';
			echo '<td>'.$row[5].'</td>';
   		       echo '</tr>';
  		  }
    		echo '</table>';  	
*/
	?>
	
	<!--static example table to show CSS style.--> 
	
 	   
    </body>
</html>