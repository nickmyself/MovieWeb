<?php
$revID = $_GET["reviewid"];
require_once 'login_jz337.php';
$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
mysql_select_db($db_database) or die("Unable to select database: " . mysql_error());
    ##server and database connect success
echo "<br>"." database connect success";



?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Review Detail</title>
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

  	<div class="container">



  		<div class="row">
  			<div class="col-sm-10 col-md-offset-1">
  				<table class="table table-striped">
  					<thead>
  						<td style="width: 200px;"><h3>Review Detail</h3></td>
  					</thead>

  					<tbody>

  						<?php
  						$query = "Select * from showuserlongreview WHERE ReviewId=$revID";
  						$result = mysql_query($query);
  						$rows = mysql_num_rows($result);
  						for ($i=0; $i < $rows; $i++) { 
  							$row = mysql_fetch_row($result);
          //echo "<tr><td>$row[4]</td><td>$row[6]</td><td>$row[8]</td><td>$row[9]</td><td>$row[14]</td></tr>";
          //echo "<tr></tr>";
  							echo "<tr><td>Title</td><td>$row[14]</td></tr>";
  							echo "<tr><td>Content</td><td><p align=justify >$row[15]</p></td></tr>";
  						}

  						?>

  					</tbody>
  				</table>

  			</div>


  		</div>
  		<div class="row">
        <div class="col-sm-10 col-md-offset-1">
        <table class="table table-striped">
            <thead>
              <tr ><td><h3>Comments</h3></td></tr>
              <tr ><td>UserName</td><td>CommentTime</td><td>Content</td><td>Likes</td><td>Disikes</td></tr>
              
            </thead>

            <tbody>

              <?php
              $query = "Select * from showcomment WHERE ReviewId=$revID";
              $result = mysql_query($query);
              $rows = mysql_num_rows($result);
              for ($i=0; $i < $rows; $i++) { 
                $row = mysql_fetch_row($result);
          //echo "<tr><td>$row[4]</td><td>$row[6]</td><td>$row[8]</td><td>$row[9]</td><td>$row[14]</td></tr>";
          //echo "<tr></tr>";
                echo "<tr>";
                echo "<td>$row[9]</td><td>$row[6]</td><td>$row[5]</td><td>$row[7]</td><td>$row[8]</td>";
                echo "</tr>";
              }

              ?>

            </tbody>
          </table>

        </div>
      </div>

      <div class="row">
        <div class="col-sm-10 col-md-offset-1">
          <h2>Your comment</h2>
          <form   class="form" method="post" action="addcomment.php?reviewid=<?php echo $revID; ?>">
          <div class="form-group">
          <input name="comment" type="text" class="form-control" placeholder="Text input">
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
          </form>
        </div>

      </div>

  	</div> <!-- /container -->























  	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  	<!-- Include all compiled plugins (below), or include individual files as needed -->
  	<script src="js/bootstrap.min.js"></script>
  </body>
  </html>