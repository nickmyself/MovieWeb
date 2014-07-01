<?php
require_once 'login_jz337.php';
    $db_server = mysql_connect($db_hostname, $db_username, $db_password);
    if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
    mysql_select_db($db_database) or die("Unable to select database: " . mysql_error());
    $query = "Select GenreName from genre";
    $result = mysql_query($query);
    $rows = mysql_num_rows($result);
    $GENRES = array();
    for ($i=0; $i < $rows; $i++) { 
      $row = mysql_fetch_row($result);
      array_push($GENRES, $row[0]);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Homepage</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/index.css" rel="stylesheet">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- Fonts -->
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- Custom Theme CSS -->
    <link href="css/grayscale.css" rel="stylesheet">
    </head>
    <body id="page-top" data-spy="scroll" data-target=".navbar-custom">
      <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">MW</a>
          </div>

          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li ><a href="index.php">Home</a></li>
              <li><a href="index.php#search">Search</a></li>
              <li><a href="index.php#about">About</a></li>
              <li><a href="index.php#contact">Contact</a></li>
            </ul>


            <ul class="nav navbar-nav navbar-right">
              <li><a href="javascript:history.back()">Back</a></li>
              <li><a href="logout.php" >logout</a></li>
            </ul>
            



          </div><!--/.nav-collapse -->



        </div>
      </div> <!-- <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">-->



      <div class="container" id = "about">

        <div class="row">
          <div class="col-sm-10 col-md-offset-1">
            <div class="panel panel-info" >
            <div class="panel-heading" style="text-align:center;"><h1>About</h1></div>
            <div class="panel-body">
              <p>This is an online movie fan community. It serves as a platform for movie fan to interact with each other. It’s a “Database-driven” websites and allows users to like, rate, summary or review the movies. Basically, the websites include two functions:</p>
              <ol>
                <li>Website assist user to find movie satisfy their taste:
                    <ol>
                      <li>Search by category (looks like search a book in library), such as genres, actors, directors and ratings</li>
                      <li>Vague search (given the year, actor or key word then find the relative result)</li>
                    </ol>
                    </li>
                <li>Provide user a platform to communicate with other movie fan:
                    <ol>
                      <li>Rate the movie</li>
                      <li>Write the review (long and short) to a given movie</li>
                      <li>View and comment the review written by other people</li>
                      <li>Likes or Dislikes reviews and comments written by other ones</li>
                    </ol>
                </li>
              </ol>
            </div>
            </div>
          </div>
        </div>
      </div> 


      <div class="container" id = "search"> 
        <div class="row">
          <div class="col-sm-10 col-md-offset-1">
            <div class="panel panel-primary" style="background-color:white; text-align:center;">
              <div class="panel-heading"><h1>Search</h1></div>
              <div class="panel-body">
              <h3>Search movies</h3>
              <form class="form-inline" method="get" action="SearchResult/result.php">
                <div class="form-group">
                  <label><input type="radio" name="attribute" value="MovieName">Name</label>
                  <label><input type="radio" name="attribute" value="year">Year</label> 
                  <label><input type="radio" name="attribute" value="Language">Language</label>
                  <label><input type="radio" name="attribute" value="Director">Director</label>
                  <label><input type="radio" name="attribute" value="Actor">Actor</label> 
                  <label><input type="radio" name="attribute" value="GenreName">Genre</label> 
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="info" id="t" placeholder="enter your information">
                  
                </div>              
                <button type="submit" class="btn btn-default">Submit</button>

              </form>
            
                <h3>Search by genre</h3>
                <form class="form-inline" method="get" action="SearchResult/result.php?attribute=GenreName">
                  <div class="form-group">
                  <label>Genre</label>
                  <input type="text" class="form-control" name="attribute" value="GenreName" style="display:none;">
                  <select name="info"  class="form-control"  >
                    <option value="All">All</option>
                    <?php
                    foreach ($GENRES as $key ) {
                      echo '<option value="'.$key.'">'.$key."</option>";
                    }
                    ?>
                  </select> 
                  </div>
                 <button type="submit" class="btn btn-default">Submit</button>
              </form>
              </div>
            </div>
          </div>
        </div>

      </div>

      

      <div class="container" id = "contact">
        <div class="row">
          <div class="col-sm-10 col-md-offset-1">
            <div class="panel panel-success" style="text-align:center;">
            <div class="panel-heading"><h1>Contact Us</h1></div>
            <div class="panel-body">
              <div class="well">
                <p>Junwei Zhao</p>
                <p>Email: zhaojw42@gmail.com</p>
                <p>Homepage: <a href="http://www.nickmyself.com">www.nickmyself.com</a></p>
                </div>
            </div>
            
            </div>
          </div>
        </div>
      </div> 
      
      

      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="js/bootstrap.min.js"></script>
    </body>
    </html>