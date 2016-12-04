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

    <h1>Search for a used textbook!</h1>
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


     // define variables and set to empty values
       $searchAuthor = $searchbookTitle = $searchadTitle = "";

       if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $searchbookTitle = test_input($_POST["searchbookTitle"]);
         $searchadTitle = test_input($_POST["searchadTitle"]);
         $searchAuthor = test_input($_POST["searchAuthor"]);


       }
       // cleansing input
       function test_input($data) { //this prevents sql injection
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
         return $data;
       }
     ?>

       <h2>Enter your search terms(one field must be complete):</h2>   <!-- html 5 form for taking input-->
       <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
       Title of Book : <input type="text" name="searchbookTitle">
       <br><br>
       Ad title: <input type="text" name="searchadTitle">
       <br><br>
       Author: <input type="text" name="searchAuthor">
       <br><br>

       <input type="submit" name="submit" value="Submit">
       </form>

    <?php

  $uname = $_SESSION['uname'];
  if($searchbookTitle != "" || $searchadTitle != "" || $searchAuthor != ""){  //searches for books only when user has entered input and pressed submit
    $sql = "SELECT adTitle, bookTitle, author FROM `TextbookExchange`.`advertisement` WHERE bookTitle = '$searchbookTitle' OR adTitle = '$searchadTitle' OR author = '$searchAuthor'";
    $result = $conn->query($sql);       //execute the query

    if ($result->num_rows > 0) {
         // output data of each row
         echo "Results:";
         while($row = $result->fetch_assoc()) {
             echo "<br> Ad title: ". $row["adTitle"]. " - Book Title: ". $row["bookTitle". - "Author:". $row["author"]]; //prints a list of matching books
         }
    } else {
         echo "No results found";
    }
  }
    $searchAuthor = $searchbookTitle = $searchadTitle = ""; //cleaning variables post query
       $conn-> close();            //close the connection to database

     ?>



    <FORM METHOD="LINK" ACTION="welcome.php"> <!-- navigation buttons-->
    <INPUT TYPE="submit" VALUE="Back to menu">
    </FORM>

    <FORM METHOD="LINK" ACTION="logout.php">
    <INPUT TYPE="submit" VALUE="Logout of your profile">
    </FORM>

  </body>
</html>
