<?php
session_start();
?>
<!DOCTYPE html>

<html>
  <head>
      <meta charset="UTF-8">
      <title>Ad Creation</title>
    </head>
  <body>

    <h1>Create an ad for your textbook:</h1>
    <?php
      echo $_SESSION['uname'] . " is posting";
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

     // define variables and set to empty values
       $adtitle = $booktitle = $description = $authorname = "";

       if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $adtitle = test_input($_POST["adtitle"]);
         $booktitle = test_input($_POST["booktitle"]);
         $description = test_input($_POST["description"]);
         $authorname = test_input($_POST["authorname"]);

       }
       // cleansing input
       function test_input($data) {
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
         return $data;
       }
     ?>

       <h2>Enter the details of your posting:</h2>
       <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
       Ad title: <input type="text" name="adtitle">
       <br><br>
       Book title: <input type="text" name="booktitle">
       <br><br>
       Description: <textarea name="description" rows="5" cols="40"><?php echo $description;?></textarea>
       <br><br>
       Authors names: <input type="text" name="authorname">
       <br><br>


       <input type="submit" name="submit" value="Submit">
       </form>

    <?php
      $poster = $_SESSION['uname'];
     if($adtitle != ""){
        $sql = "INSERT INTO `TextbookExchange`.`advertisement` (`adTitle`, `bookTitle`, `Description`, `posterUname`, `author`) VALUES ('$adtitle', '$booktitle', '$description', '$poster', '$author')";
        echo "<br><br>Inserting  into db: ";
        if($conn->query($sql)==TRUE){       //try executing the query
            echo "Ad Posted!<br>";
          }
          else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }

       $adtitle = $booktitle = $description = $authorname = ""; //cleaning variables post query
       $conn-> close();            //close the connection to database

     ?>

    <FORM METHOD="LINK" ACTION="edit.php">
    <INPUT TYPE="submit" VALUE="Edit an existing ad">
    </FORM>

    <FORM METHOD="LINK" ACTION="welcome.php">
    <INPUT TYPE="submit" VALUE="Back to menu">
    </FORM>

    <FORM METHOD="LINK" ACTION="logout.php">
    <INPUT TYPE="submit" VALUE="Logout of your profile">
    </FORM>

  </body>
</html>
