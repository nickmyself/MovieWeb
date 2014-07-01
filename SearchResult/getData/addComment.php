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
      


      function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
      }




    function make_seed() {
        list($usec, $sec) = explode(' ', microtime());
        return (float) $sec + ((float) $usec * 100000);
    }

    mt_srand(make_seed());
    
    function randchar($string = 'abcdefghijklmnopqrstuvwxyz0123456789'){
        return $string{rand(0,strlen($string)-1)};
    }

    function randstring($minlength = 1,$maxlength = 10,$characters =
        'abcdefghijklmnopqrstuvwxyz0123456789'){
        $result = ' ';
        $length = mt_rand($minlength,$maxlength)-1;
        for($i = 0; $i <= $length; $i++){
        $result{$i} = randchar($characters);
        }
    return $result;
    }

    function randemail(){
        $preext = array('rutgers','google','blizzard','zust','heat','hotdog','eden','hashtable','linklist');
        $extensions = array('com','net','org','biz','gov');
        shuffle($extensions);
        shuffle($preext);
    return randstring(5,8) . '@' . $preext[mt_rand(0,sizeof($preext) - 1)] . '.' .
    $extensions[mt_rand(0,sizeof($extensions) - 1)];
    }

    function randconts(){
        $contents = array('Good!','Awesome','I like it','Not bad.','Too bad','Boring');
        shuffle($contents);
        return $contents[mt_rand(0,sizeof($contents) - 1)];

    }








    for ($i=1; $i < 200; $i++) { 
          $ReviewID = mt_rand(10113,10142);
          $UserID = mt_rand(93,152);
          $Likes = 0;
          $Dislikes = 0;
          $content = randconts();

          $int= mt_rand(1362000000,1372060000);
          $writetime = date("Y-m-d H:i:s",$int);
          

          echo $ReviewID." ".$UserID." ".$content." ".$writetime." <br>";
          //echo $username." ".$password." ".$email." ".$nickname." <br>";
          
          $query = sprintf("insert into COMMENT(USER_UserID,REVIEW_ReviewID,Content,CommentTime,Likes,Dislikes) 
            values ('%s','%s','%s','%s','%s','%s')",
                 mysql_real_escape_string($UserID),
                 mysql_real_escape_string($ReviewID),
                 mysql_real_escape_string($content),
                 mysql_real_escape_string($writetime),
                 mysql_real_escape_string($Likes),
                 mysql_real_escape_string($Dislikes)
                 );

             $insert = mysql_query($query);


             if(!$insert)
             {
                echo"Invalid query:".mysql_error()."\n";
            }
          # code...
          
          
      }
      
      

      


    ?>

    </body>
    </html>