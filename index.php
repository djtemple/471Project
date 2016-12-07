<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<!--
Manmeet Dhaliwal
471 Sample project to show connection to local database
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Textbook Trade</title>
        <link rel="shortcut icon" href="images/icon.ico" />
    </head>
    <body>
      <center><img src="/images/textbooktrade_small.png" alt="Textbook Trade"></center>
      <h1 align="center">Welcome!</h1>
      <div class="index">
        <FORM METHOD="LINK" ACTION="register.php">
        <INPUT TYPE="submit" VALUE="Register">
        </FORM>
        <br>
        <FORM METHOD="LINK" ACTION="login.php">
        <INPUT TYPE="submit" VALUE="Login">
        </FORM>
        <br>
        <FORM METHOD="LINK" ACTION="logout.php">
        <INPUT TYPE="submit" VALUE="Logout of your profile">
        </FORM>
        
        <br><br><br><br><br><br>
        <FORM METHOD="LINK" ACTION="univ.php">
        <INPUT TYPE="submit" VALUE="Access as secondary institution">
        </FORM>
      </div>

      <style type="text/css">
        .index {
          text-align: center;
        }
      </style>
    </body>
</html>
