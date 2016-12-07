<?php
session_start();
?>
<!DOCTYPE html>

<html>
  <head>
      <meta charset="UTF-8">
      <title>Ad</title>
    </head>
  <body>

    <h1>Ad</h1>
    <?php
      echo $_SESSION['uname'] . " is searching";
      if (!isset($_SESSION['uname'])) {
        header("Location: login.php");
      }
     ?>
     <br>
     <?php

         // establish connection to database
         $servername = "aa6tcu7aup59u3.ccuozd0wfara.us-east-1.rds.amazonaws.com:3306";          //should be same for you
         $port = "3306";   //database port number
         $username = "jalalkawash";                 //same here
         $password = "leonardmanzara";              //your localhost root password
         $db = "TextbookExchange";                     //your database name

         $conn = new mysqli($servername, $username, $password, $db);

         if($conn->connect_error){
             die("Connection failed".$conn->connect_error);
         }
     ?>

<h1>Display ad</h1>
Ad id is: <?php echo $_GET["AdvertId"]; ?>

	
    <FORM METHOD="LINK" ACTION="welcome.php"> <!-- navigation buttons-->
    <INPUT TYPE="submit" VALUE="Back to menu">
    </FORM>

    <FORM METHOD="LINK" ACTION="logout.php">
    <INPUT TYPE="submit" VALUE="Logout of your profile">
    </FORM>

  </body>
</html>
