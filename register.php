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
        <title>Register</title>
    </head>
    <body>
        <h1>Register for TextbookTrade</h1>
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
            }else{
                echo "Connected<br>";
            }

        // define variables and set to empty values
          $password = $email = $uname = $firstname = $lastname = $universityname = $middleinitial = "";

          if ($_SERVER["REQUEST_METHOD"] == "POST") {   //taking input from html forms
            $uname = test_input($_POST["uname"]);
            $firstname = test_input($_POST["firstname"]);
            $middleinitial = test_input($_POST["middleinitial"]);
            $lastname = test_input($_POST["lastname"]);
            $email = test_input($_POST["email"]);
            $universityname = test_input($_POST["universityname"]);
            $password = test_input($_POST["password"]);


          }
          // cleansing input
          function test_input($data) { //this prevents sql injection 
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }
        ?>

          <h2>Enter User Info:</h2>
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          Desired Username: <input type="text" name="uname">
          <br><br>
          First Name: <input type="text" name="firstname">
          <br><br>
          Middle Initial: <input type="text" name="middleinitial">
          <br><br>
          Last Name: <input type="text" name="lastname">
          <br><br>
          E-mail: <input type="text" name="email">
          <br><br>
          Name of University: <input type="text" name="universityname">
          <br><br>
          Password: <input type="password" name="password">
          <br><br>

          <input type="submit" name="submit" value="Submit">
          </form>

        <?php

        //Adding user input to user table
          $sql = "INSERT INTO `TextbookExchange`.`User` (`Username`, `Fname`, `Minit`, `Lname`, `Email`, `Rating`, `University_name`, `Password`) VALUES ('$uname', '$firstname', '$middleinitial', '$lastname', '$email', '9', '$universityname', '$password')";
          echo "<br><br>Inserting  into db: ";
          if($conn->query($sql)==TRUE){       //try executing the query
              echo "Query executed<br>";
          }
          else{
              echo "Error: " . $sql . "<br>" . $conn->error;
          }


          $password = $email = $uname = $firstname = $lastname = $universityname = $middleinitial = ""; //cleaning variables post query
          $conn-> close();            //close the connection to database

        ?>


        <FORM METHOD="LINK" ACTION="login.php">  <!-- navigation buttons-->
        <INPUT TYPE="submit" VALUE="Continue to Login">
        </FORM>


    </body>
</html>
