<?php

$movieID =  $_GET["movieid"];
require_once 'login_jz337.php';

$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
mysql_select_db($db_database) or die("Unable to select database: " . mysql_error());
    ##server and database connect success
echo "<br>"." database connect success";
$query = "Select * from Movie WHERE MovieId = $movieID";
        echo'<table >';
       // echo'<tr><th>Movie Name</th><th>ReleaseDate</th><th>Language</th><th>Rating</th></tr>';
        $result = mysql_query($query);
        $rows = mysql_num_rows($result);
        for ($i=0; $i < $rows; $i++) { 
      # code..

          $row = mysql_fetch_row($result);
          $title = $row[1];


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo "$title";  ?></title>
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>
    <body>
      <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
          </div>

          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
            </ul>

          </div><!--/.nav-collapse -->
        </div>
      </div>  <!--<div class="navbar navbar-inverse navbar-fixed-top" role="navigation"> -->

      <div class="container">
        <div class="row">
         <h1><?php echo "$title";  ?></h1>
       </div>



       <div class="row">

        <div class="col-sm-10 col-md-offset-1">
        <?php


        
          /*
          foreach ($row as $k) {
          echo '<td>'.$k.'</td>';
        } */
        echo '<th><tr>';
        echo '<td class="col-sm-2">Title</td><td>'.$row[1].'</td>';
        echo '</tr></th></tb>';

        echo '<tr>';
        echo '<td class="col-sm-2">Runtime</td><td>'."$row[2] Minutes</td>";
        echo '</tr>';

        echo '<tr>';
        echo '<td class="col-sm-2">Release time</td><td>'."$row[3]</td>";
        echo '</tr>';

        echo '<tr>';
        echo "<td>Language</td><td>$row[4]</td>";
        echo '</tr>';

        echo '<tr>';
        echo "<td>Rating</td><td>$row[5]</td>";
        echo '</tr>';

        echo '<tr>';
        echo '<td>Overview</td><td class="col-sm-6">'."$row[7]</td>";
        echo '</tr>';

        echo '<tr>';
        echo "<td>Poster</td><td> <img src = $row[8]".' class="img-rounded" '."></td>";
        echo '</tr>';


        echo "<tr>";
        echo '<td></td><td></td><td><a class="btn btn-default" href="writeshortreview.php?movieid='.$row[0].'" role="button">write summary</a></td>';
        echo '<td><a class="btn btn-default" href="writelongreview.php?movieid='.$row[0].'" role="button">Write longreview</a></td>';
        echo "<tr>";

        
      }
      echo "<tr><td><h5>Genre</h5></td>";
      $query = "Select GenreName from ShowMovieGenre WHERE MovieId = $movieID";
        //echo'<table cellspacing="0">';
       // echo'<tr><th>Movie Name</th><th>ReleaseDate</th><th>Language</th><th>Rating</th></tr>';
      $result = mysql_query($query);
      $rows = mysql_num_rows($result);
      for ($i=0; $i < $rows; $i++) { 
        $row = mysql_fetch_row($result);
        echo "<td>$row[0]</td> ";
      }

      echo "</tr>";


      echo '</tb></table>';
      ?>
      </div>
    </div>
    <div class="row">
    <div class="col-sm-10">
    <table class="table">
    <thead>
      <tr>
      <td>ShortReview</td>
      </tr>
    </thead>

    <tbody>

      <?php
      $query = "Select * from ShowUserShortReview WHERE MOVIE_MovieId=$movieID";
      $result = mysql_query($query);
      $rows = mysql_num_rows($result);
      for ($i=0; $i < $rows; $i++) { 
        $row = mysql_fetch_row($result);
        echo '<tr><td class="col-sm-1">'."$row[4]</td><td>$row[6]</td><td>$row[8]</td><td>$row[9]</td></tr>";
        echo '<tr><td class="col-sm-10">'."$row[14]</td>";
        echo '<td><a href="http://localhost:8080/MovieWeb/showShortReview.php?reviewid='.$row[5].'"  type="button" class="btn btn-default btn-lg">View</a></td>';
        echo "</tr>";
      }

      ?>

    </tbody>
  </table>


    </div>
    </div>

  </div> <!-- /container -->





  


  <table class="table table-striped table-bordered">
    <thead>
      <tr><td><h2>LongReview</h2></td></tr>
      <td>User:</td><td>Time</td><td>Likes</td><td>Dislikes</td><td>Review Title</td>
    </thead>

    <tbody>

      <?php
      $query = "Select * from ShowUserLongReview WHERE MOVIE_MovieId=$movieID";
      $result = mysql_query($query);
      $rows = mysql_num_rows($result);
      for ($i=0; $i < $rows; $i++) { 
        $row = mysql_fetch_row($result);
        echo "<tr><td>$row[4]</td><td>$row[6]</td><td>$row[8]</td><td>$row[9]</td>";
        echo '<td><a href="http://localhost:8080/MovieWeb/showLongreview.php?reviewid='.$row[5].'">'."$row[14]</a></td></tr>";
          //echo "<tr></tr>";
      }

      ?>

    </tbody>
  </table>














  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
</body>
</html>