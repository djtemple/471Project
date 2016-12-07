<?php
session_start();
?>
<!DOCTYPE html>

<html>
  <head>
      <meta charset="UTF-8">
      <title>Welcome</title>
	  <link rel="shortcut icon" href="images/icon.ico" />
    </head>
  <body>
    <h1 align="center"><?php echo $_SESSION["uname"]; ?>'s Home Page</h1>

    <?php
      echo $_SESSION['uname'] . " is posting";
      if (!isset($_SESSION['uname'])) {
        header("Location: login.php");
      }
     ?>
    <br>

    <center><img src="/images/textbooktrade_small.png" alt="Textbook Trade"></center>
    <h2 align="center">Welcome, <?php echo $_SESSION["uname"]; ?><br></h2>
    <div class="welcome">
      <FORM METHOD="LINK" ACTION="search.php">     <!-- navigation buttons-->
      <INPUT TYPE="submit" VALUE="View other users' ads">
      </FORM>
      <br>
      <FORM METHOD="LINK" ACTION="post.php">
      <INPUT TYPE="submit" VALUE="Post a new ad">
      </FORM>
      <br>
      <FORM METHOD="LINK" ACTION="message.php">
      <INPUT TYPE="submit" VALUE="View and send message">
      </FORM>
      <br>
      <FORM METHOD="LINK" ACTION="edit.php">
      <INPUT TYPE="submit" VALUE="Edit an existing ad">
      </FORM>
	  <br>
      <FORM METHOD="LINK" ACTION="uniRec.php">
      <INPUT TYPE="submit" VALUE="View your univerity's recommendations">
      </FORM>
      <br>
      <FORM METHOD="LINK" ACTION="logout.php">
      <INPUT TYPE="submit" VALUE="Logout of your profile">
      </FORM>
    </div>

    <style type="text/css">
      .welcome {
        text-align: center;
       }
    </style>

  </body>
</html>
