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
    </head>
  <body>
    <h1>Logging User Out</h1>


  </body>
</html>
