<?php
session_start();
unset($_SESSION["uname"]);
header("Location: login.php");
?>
<!DOCTYPE html>

<html>
  <head>
      <meta charset="UTF-8">
      <title>Logout</title>
	  <link rel="shortcut icon" href="images/icon.ico" />
    </head>
  <body>
    <h1 align="center">Logging User Out</h1>


  </body>
</html>
