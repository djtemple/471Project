<?php
session_start();
?>
<!DOCTYPE html>

<html>
  <head>
      <meta charset="UTF-8">
      <title>Welcome</title>
    </head>
  <body>
    <h1>Your Home Page</h1>
    <?php
      echo $_SESSION['uname'] . " is posting";
      if (!isset($_SESSION['uname'])) {
        header("Location: login.php");
      }
     ?>
    Welcome <?php echo $_SESSION["uname"]; ?><br>

    <FORM METHOD="LINK" ACTION="search.php">     <!-- navigation buttons-->
    <INPUT TYPE="submit" VALUE="View other users' ads">
    </FORM>

    <FORM METHOD="LINK" ACTION="post.php">
    <INPUT TYPE="submit" VALUE="Post a new ad">
    </FORM>

    <FORM METHOD="LINK" ACTION="message.php">
    <INPUT TYPE="submit" VALUE="View and send message">
    </FORM>

    <FORM METHOD="LINK" ACTION="edit.php">
    <INPUT TYPE="submit" VALUE="Edit an existing ad">
    </FORM>

    <FORM METHOD="LINK" ACTION="logout.php">
    <INPUT TYPE="submit" VALUE="Logout of your profile">
    </FORM>

  </body>
</html>
