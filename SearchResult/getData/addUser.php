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
    return randstring(5,8) . '@' . $preext[mt_rand(0,sizeof($extensions) - 1)] . '.' .
    $extensions[mt_rand(0,sizeof($extensions) - 1)];
    }










    for ($i=0; $i < 30; $i++) { 
          $username = randstring(5,6);
          $password = $username;
          $email = randemail();
          $nickname = randstring(3,5);

          echo $username." ".$password." ".$email." ".$nickname." <br>";

          $queryMD = sprintf("insert into user(UserName,Password,Email,Nickname) values ('%s','%s','%s','%s')",
                 mysql_real_escape_string($username),
                 mysql_real_escape_string($password),
                 mysql_real_escape_string($email),
                 mysql_real_escape_string($nickname)
                 );

             $insertMD = mysql_query($queryMD);


             if(!$insertMD)
             {
                echo"Invalid query:".mysql_error()."\n";
            }
          # code...
      }
      /*
      

      */


    ?>

    </body>
    </html>