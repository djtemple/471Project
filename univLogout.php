<?php
session_start();
unset($_SESSION["uniname"]);
header("Location: univ.php");
?>
<!DOCTYPE html>

<html>
  <head>
      <meta charset="UTF-8">
      <title>Logout</title>
	  <link rel="shortcut icon" href="images/icon.ico" />
    </head>
  <body>
    <h1 align="center">Logging institution out</h1>


  </body>
</html>
