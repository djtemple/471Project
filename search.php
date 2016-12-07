<?php
session_start();
?>
<!DOCTYPE html>

<html>
  <head>
      <meta charset="UTF-8">
      <title>Search</title>
	  <link rel="shortcut icon" href="images/icon.ico" />
    </head>
  <body>

    <h1 align="center">Search for a used textbook!</h1>
    <?php
      echo $_SESSION['uname'] . " is searching";
      if (!isset($_SESSION['uname'])) {
        header("Location: login.php");
      }
     ?>
     <br>
     <?php

         // establish connection to database
         $servername = "aa6tcu7aup59u3.ccuozd0wfara.us-east-1.rds.amazonaws.com:3306"; 
         $port = "3306";   //database port number
         $username = "jalalkawash";                 
         $password = "leonardmanzara";              
         $db = "TextbookExchange";                     //database name

         $conn = new mysqli($servername, $username, $password, $db);

         if($conn->connect_error){
             die("Connection failed".$conn->connect_error);
         }


     // define variables and set to empty values
       $queryBook = $queryAd = $queryAuthor = $searchAuthor = $searchBookTitle = $searchAdTitle = $isbn = "";

       if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $searchBookTitle = test_input($_POST["searchBookTitle"]);
         $searchAdTitle = test_input($_POST["searchAdTitle"]);
         $searchAuthor = test_input($_POST["searchAuthor"]);
         $searchIsbn = test_input($_POST["searchIsbn"]);

       }
       // cleansing input
       function test_input($data) { //this prevents sql injection
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
         return $data;
       }
     ?>

     <div class="search">
       <h2 align="center">Enter your search terms(one field must be complete):</h2>   <!-- html 5 form for taking input-->
       <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
       Title of Book : <input type="text" name="searchBookTitle">
       <br><br>
       Ad title: <input type="text" name="searchAdTitle">
       <br><br>
       Author: <input type="text" name="searchAuthor">
       <br><br>
       ISBN: <input type="text" name="searchIsbn">
       <br><br>
       <input type="submit" name="submit" value="Submit">
       </form>
       <br>

    <?php
	

  $uname = $_SESSION['uname'];
  if($searchBookTitle != "" || $searchAdTitle != "" || $searchAuthor != "" || $searchIsbn != ""){  //searches for books only when user has entered input and pressed submit
        if ($searchBookTitle != ""){
            $sql = "SELECT adID, adTitle, bookTitle, author, posterUname FROM `TextbookExchange`.`advertisement` WHERE bookTitle LIKE '%$searchBookTitle%'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                echo "\nResults: ";
                echo "<br>";
                while($row = $result->fetch_assoc()) {
                   echo "<br> Ad title: ". $row["adTitle"]. " | Book Title: ". $row["bookTitle"]. " | Author: ". $row["author"]. " | Posted By: ". $row["posterUname"]; //prints a list of matching books
                               $advId = $row["adID"];	
                               echo "<form target=\"_blank\" action=\"display.php\" method=\"get\"><input type=\"hidden\" name=\"AdvertId\" value=$advId><input type=\"submit\" value=\"Go to ad\"></form>"; //button
                               // OR:
                               echo "<a href=\"display.php?AdvertId=$advId\" target=\"_blank\">Link to ad</a>"; //underlined 
                               echo "<br><br>";

                }
            } else {
                 echo "No results found";
                 echo "<br><br>";
            }
        }
        else if ($searchAdTitle != ""){
            $sql = "SELECT adID, adTitle, bookTitle, author, posterUname FROM `TextbookExchange`.`advertisement` WHERE adTitle LIKE '%$searchAdTitle%'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                echo "\nResults: ";
                echo "<br>";
                while($row = $result->fetch_assoc()) {
                   echo "<br> Ad title: ". $row["adTitle"]. " | Book Title: ". $row["bookTitle"]. " | Author: ". $row["author"]. " | Posted By: ". $row["posterUname"]; //prints a list of matching books
                               $advId = $row["adID"];	
                               echo "<form target=\"_blank\" action=\"display.php\" method=\"get\"><input type=\"hidden\" name=\"AdvertId\" value=$advId><input type=\"submit\" value=\"Go to ad\"></form>"; //button
                               // OR:
                               echo "<a href=\"display.php?AdvertId=$advId\" target=\"_blank\">Link to ad</a>"; //underlined 
                               echo "<br><br>";

                }
            } else {
                 echo "No results found";
                 echo "<br><br>";
            }
        }
        else if ($searchAuthor != ""){
            $sql = "SELECT adID, adTitle, bookTitle, author, posterUname FROM `TextbookExchange`.`advertisement` WHERE author LIKE '%$searchAuthor%'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                echo "\nResults: ";
                echo "<br>";
                while($row = $result->fetch_assoc()) {
                   echo "<br> Ad title: ". $row["adTitle"]. " | Book Title: ". $row["bookTitle"]. " | Author: ". $row["author"]. " | Posted By: ". $row["posterUname"]; //prints a list of matching books
                               $advId = $row["adID"];	
                               echo "<form target=\"_blank\" action=\"display.php\" method=\"get\"><input type=\"hidden\" name=\"AdvertId\" value=$advId><input type=\"submit\" value=\"Go to ad\"></form>"; //button
                               // OR:
                               echo "<a href=\"display.php?AdvertId=$advId\" target=\"_blank\">Link to ad</a>"; //underlined 
                               echo "<br><br>";

                }
            } else {
                 echo "No results found";
                 echo "<br><br>";
            }
        }
        else if ($searchIsbn != ""){
            $sql = "SELECT adID, adTitle, bookTitle, author, posterUname FROM `TextbookExchange`.`advertisement` WHERE ISBN = '$searchIsbn'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                echo "\nResults: ";
                echo "<br>";
                while($row = $result->fetch_assoc()) {
                   echo "<br> Ad title: ". $row["adTitle"]. " | Book Title: ". $row["bookTitle"]. " | Author: ". $row["author"]. " | Posted By: ". $row["posterUname"]; //prints a list of matching books
                               $advId = $row["adID"];	
                               echo "<br>";
                               echo "<form target=\"_blank\" action=\"display.php\" method=\"get\"><input type=\"hidden\" name=\"AdvertId\" value=$advId><input type=\"submit\" value=\"Go to ad\"></form>"; //button
                               // OR:
                               echo "<a href=\"display.php?AdvertId=$advId\" target=\"_blank\">Go to ad</a>"; //underlined 
                               echo "<br><br>";

                }
            } else {
                 echo "No results found";
                 echo "<br><br>";
            }
        }
  }

    $searchAuthor = $searchBookTitle = $searchAdTitle = $searchIsbn = ""; //cleaning variables post query
       $conn-> close();            //close the connection to database

     ?>
       <br><br><br><br>
      <FORM METHOD="LINK" ACTION="welcome.php"> <!-- navigation buttons-->
      <INPUT TYPE="submit" VALUE="Back to menu">
      </FORM>
      <br>
      <FORM METHOD="LINK" ACTION="logout.php">
      <INPUT TYPE="submit" VALUE="Logout of your profile">
      </FORM>
    </div>

    <style type="text/css">
      .search {
        text-align: center;
      }

    </style>

  </body>
</html>
