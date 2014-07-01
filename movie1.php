<?php

$movieID =  $_GET["movieid"];
require_once 'login_jz337.php';

function getgenrearray($mid)
{
	$query = "Select GenreName from ShowMovieGenre WHERE MovieId = $mid";
        //echo'<table cellspacing="0">';
       // echo'<tr><th>Movie Name</th><th>ReleaseDate</th><th>Language</th><th>Rating</th></tr>';
    $result = mysql_query($query);
    $genres = array();
    $rows = mysql_num_rows($result);
      for ($i=0; $i < $rows; $i++) { 
        $row = mysql_fetch_row($result);
        array_push($genres,$row[0]);
      }
    return $genres;
}

function getDirectorarray($mid)
{
	$query = "Select getname(DirectorFirstName,DirectorMiddleName,DirectorLastName) from ShowMovieDirector WHERE MovieId = $mid";
        //echo'<table cellspacing="0">';
       // echo'<tr><th>Movie Name</th><th>ReleaseDate</th><th>Language</th><th>Rating</th></tr>';
    $result = mysql_query($query);
    $directors = array();
    $rows = mysql_num_rows($result);
      for ($i=0; $i < $rows; $i++) { 
        $row = mysql_fetch_row($result);
        array_push($directors,$row[0]);
      }
    return $directors;
}


function getActorrarray($mid)
{
	$query = "Select getname(ActorFirstName,ActorMiddleName,ActorLastName) from ShowMovieActor WHERE MovieId = $mid";
        //echo'<table cellspacing="0">';
       // echo'<tr><th>Movie Name</th><th>ReleaseDate</th><th>Language</th><th>Rating</th></tr>';
    $result = mysql_query($query);
    $actors = array();
    $rows = mysql_num_rows($result);
      for ($i=0; $i < $rows; $i++) { 
        $row = mysql_fetch_row($result);
        array_push($actors,$row[0]);
      }
    return $actors;
}



$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
mysql_select_db($db_database) or die("Unable to select database: " . mysql_error());
    ##server and database connect success
//echo "<br>"." database connect success";
$query = "Select * from Movie WHERE MovieId = $movieID";
echo'<table >';
       // echo'<tr><th>Movie Name</th><th>ReleaseDate</th><th>Language</th><th>Rating</th></tr>';
$result = mysql_query($query);
$rows = mysql_num_rows($result);
$row = mysql_fetch_row($result);
$title = $row[1];


?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Movie Details</title>
	
	<link rel="shortcut icon" type="image/x-icon" href="style/images/favicon.png" />
	<link rel="stylesheet" type="text/css" href="styleMovie.css" media="all" />
	<link rel="stylesheet" type="text/css" href="style/css/prettyPhoto.css"  />
	<link rel="stylesheet" type="text/css" href="style/type/classic.css" media="all" />
	<link rel="stylesheet" type="text/css" href="style/type/goudy.css" media="all" />
	<script type="text/javascript" src="style/js/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="style/js/superfish.js"></script>
	<script type="text/javascript" src="style/js/jquery.prettyPhoto.js"></script>
</head>
<body>
	<div id="body-wrapper"> 
		<!-- Begin Header -->
		<div id="header">
			<div class="logo">

			</div>

			<div class="clear"></div>
			<!-- End Menu --> 

		</div>
		<!-- End Header --> 



		<!-- Begin Wrapper -->
		<div id="wrapper">

			<div class="intro">
				<h1> <?php echo "$row[1]"; ?></h1>

			</div>

			<!-- Begin Container -->
			<div class="container">
				<div class="post photo">

					<div class="content">
						<div class="top"></div>
						<div class="middle">
							<img src="<?php echo $row[8];?>" width="395px" alt="" /><!-- Movie post -->

							<div class="meta-wrapper">
								<div class="meta">
									<ul class="post-info">
										<li><span class="post-comment"></span><?php echo "$row[3]";?></li> <!-- Movie date -->
										
										<?php
											$G = getgenrearray($row[0]);
											foreach ($G as $key ) {
												echo '<li><span class="post-tag"></span>'.$key.'</li>';
											}
											//echo '<li><span class="post-tag"></span> Adventure</li>';
										?>
										
									</ul>
									<div class="share"><span class="post-share"></span><a href="#">Share</a></div>
									<div class="clear"></div>
								</div>
							</div>
						</div>
						<div class="bottom"></div>
					</div>
				</div>



			</div> <!-- End Container -->

			<div class="sidebar">

				<div class="sidebox">
					<h3 class="line">Movie Information</h3>
					<p>Title: <?php echo "$row[1]"; ?></p> 
					<br/>
					<p>Director: <?php 
					$DIRECT = getDirectorarray($row[0]);
					echo implode(', ', $DIRECT); 
					?></p>
					<br/>
					<p>Actor: <?php $ACTOR = getActorrarray($row[0]);
					echo implode(',', $ACTOR);
					?></p>
					<br/>
					<p>Ratings: <?php echo "$row[5]"; ?></p>
					<br/>
					<p>Language: <?php echo $row[4]; ?></p>
					<br/>
					<p>Runtime: <?php echo "$row[2]"; ?></p>
					<br/>
					<p>Overview: <?php echo "$row[7]"; ?></p>
					<br/>
				</div>

				<div class="sidebox">
					<h3 class="line">Summary</h3>
					<ul class="popular-posts">
						<?php
						$query = "Select * from ShowUserShortReview WHERE MOVIE_MovieId=$movieID";
						$result = mysql_query($query);
						$rows = mysql_num_rows($result);
						for ($i=0; $i < $rows; $i++) { 
							$row = mysql_fetch_row($result);
							echo "<li><h5>$row[4]</h5>";
							echo "<span>$row[6] | $row[14]</span></li>";
						}

						?>
					</ul>
				</div>

				<div class="sidebox">
					<h3 class="line">LongReview</h3>
					<ul class="popular-posts">
						<?php

						$query = "Select * from ShowUserLongReview WHERE MOVIE_MovieId=$movieID";
      					$result = mysql_query($query);
      					$rows = mysql_num_rows($result);
						for ($i=0; $i < $rows; $i++) { 

							$row = mysql_fetch_row($result);
							echo "<li>".'<a href="showLongreview.php?reviewid='.$row[5].'">'."<h4>$row[14]</h4></a>";
							echo "<span>Written by $row[4] | $row[6]</span></li>";
						}

						?>
					</ul>
				</div>


			</div>

			<div class="clear"></div>

			



		</div>
		<!-- End Wrapper -->

		<div class="push"></div>
	</div>
	<!-- End Body Wrapper -->

	<script type="text/javascript" src="style/js/scripts.js"></script>
</body>
</html>