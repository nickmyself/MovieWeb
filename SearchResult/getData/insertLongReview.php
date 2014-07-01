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
  	
  	
  	for ($k=10113; $k <10143 ; $k++) { 
  			# code...
  		 
        
        $query = sprintf("insert into LONGREVIEW(Review_ReviewID,ReviewTitle,ReviewContent) 
          values ('%s','%s','%s')",
        mysql_real_escape_string($k),
        mysql_real_escape_string($k),
        mysql_real_escape_string($k
        ));
        $insert = mysql_query($query);
        
        if(!$insert)
        {
          echo"Invalid query:".mysql_error()."\n";
        }
  		

        
    }
        
	








?>

</body>
</html>