<?php
  session_start();
	$userID = $_SESSION['login'];
  $movieid = $_GET['movieid'];

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/index.css">

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
  	<form role="form" method="post" action="addreview.php?movieid=<?php echo "$movieid";?>">
      <div class="form-group">
         <label for="Titil">Title</label>
         <input type="text" class="form-control" name ="title" placeholder="Enter title">
      </div>
  		<div class="form-group">
    <textarea class="form-control" name="reviewcontent" rows="10"></textarea>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
	</form>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>