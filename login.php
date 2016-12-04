<?php
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
        <title>Login</title>
    </head>
    <body>
        <h1>Login</h1>
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
            $password = $uname = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $uname = test_input($_POST["uname"]);
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

          <h2>Enter User Info:</h2>  <!-- html 5 form for taking input-->
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          Username: <input type="text" name="uname">
          <br><br>
          Password: <input type="password" name="password">
          <br><br>
          <input type="submit" name="submit" value="Submit">
          </form>

          <FORM METHOD="LINK" ACTION="register.php">
          <INPUT TYPE="submit" VALUE="Create an account">
          </FORM>
        <?php

          if($uname != ""){ //looking for row in user table with matching username and password
            $sql = "SELECT Username FROM `TextbookExchange`.`User` WHERE Password = '$password' AND Username = '$uname'";
            $result = $conn->query($sql);       //execute the query

            if ($result->num_rows == 1){
              $_SESSION['uname'] = $uname; //set session variable to their username
              echo "Test username is " . $uname;
              echo "Successfully validated your password";
              header("Location: welcome.php");

            }else{
                echo "Incorrect login info";
            }
          }

          $password = $uname = ""; //cleaning variables post query
          $conn-> close();            //close the connection to database

        ?>


    </body>
</html>
