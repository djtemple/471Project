<?php
session_start();
?>
<!DOCTYPE html>

<html>
  <head>
      <meta charset="UTF-8">
      <title>Recommendations</title>
	  <link rel="shortcut icon" href="images/icon.ico" />
    </head>
  <body>

    <h1 align="center">View your institution's recommendations:</h1>
     <br>
    <?php
      echo $_SESSION['uname'] . " is viewing";
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
       $uni = $isbn = $course = "";
		
       if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $uni = test_input($_POST["uni"]);
         $isbn = test_input($_POST["isbn"]);
         $course = test_input($_POST["course"]);
       }
       // cleansing input
       function test_input($data) {
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
         return $data;
       }
     ?>

    <div class="unirec">
       <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
       University: <input type="text" name="uni">
       <br><br>
       <input type="submit" name="view" value="View">
       </form>
       <br>


    <?php
                $uname = $_SESSION['uname'];
		if($uni != ""){  //searches for books only when user has entered input and pressed submit
                    $sql = "SELECT Textbook_ISBN, Course_id FROM `TextbookExchange`.`Recommends` WHERE University = '$uni'";
                    $result = $conn->query($sql);       //execute the query
                    if ($result->num_rows > 0) {

                            echo "<table border='1' align='center'>
                            <tr>
                            <th>Textbook ISBN</th>
                            <th>Course</th>
                            </tr>" ;

                            while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>".$row["Textbook_ISBN"]."</td>";
                                    echo "<td>".$row["Course_id"]."</td>";
                            }
                            echo "</table>";
                            echo "<br>";	
                    }	 
                    else {
                            echo "No recommendations found";
                    }
                }
        echo "<br><br>";
	$uni="";
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
      .unirec {
        text-align: center;
      }
    </style>

  </body>
</html>
