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
            // connection code
            $servername = "aa6tcu7aup59u3.ccuozd0wfara.us-east-1.rds.amazonaws.com:3306";          //should be same for you
            $port = "3306";   //database port number
            $username = "jalalkawash";                 //same here
            $password = "leonardmanzara";              //your localhost root password
            $db = "TextbookExchange";                     //your database name

            $conn = new mysqli($servername, $username, $password, $db);

            if($conn->connect_error){
                die("Connection failed".$conn->connect_error);
                echo "Connection Failed"
            }

            $conn-> close();            //close the connection to database

            // define variables and set to empty values
            $name = $email = $gender = $comment = $website = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $name = test_input($_POST["name"]);
              $email = test_input($_POST["email"]);
              $website = test_input($_POST["website"]);
              $comment = test_input($_POST["comment"]);
              $gender = test_input($_POST["gender"]);
            }

            function test_input($data) {
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
              return $data;
            }
          ?>


          <h2>PHP Form Validation Example</h2>
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            Name: <input type="text" name="name">
            <br><br>
            E-mail: <input type="text" name="email">
            <br><br>
            Website: <input type="text" name="website">
            <br><br>
            Comment: <textarea name="comment" rows="5" cols="40"></textarea>
            <br><br>
            Gender:
            <input type="radio" name="gender" value="female">Female
            <input type="radio" name="gender" value="male">Male
            <br><br>
            <input type="submit" name="submit" value="Submit">
          </form>

          <?php
          echo "<h2>Your Input:</h2>";
          echo $name;
          echo "<br>";
          echo $email;
          echo "<br>";
          echo $website;
          echo "<br>";
          echo $comment;
          echo "<br>";
          echo $gender;
          ?>                      



    </body>
</html>
