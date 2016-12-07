<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<!--
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Universities</title>
        <link rel="shortcut icon" href="images/icon.ico" />
    </head>
    <body>
      <h1 align="center">Welcome secondary institutions!</h1>
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
            $uniname = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $uniname = test_input($_POST["uniname"]);
            }

            // cleansing input
            function test_input($data) { //this prevents sql injection 
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
              return $data;
            }
            ?>
		<br><br>
		<h2 align="center">Already a client? </h2>
		
		<div class="univ">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		  Institution name: <input type="text" name="uniname">
		  <input type="submit" value="See status">
		  <!--<input type="hidden" name="UniName" value=$instName>-->
          </form>
         <?php

          if($uniname != ""){ //looking for row in user table with matching username and password
            $sql = "SELECT Uname FROM `TextbookExchange`.`University` WHERE Uname = '$uniname'";
            $result = $conn->query($sql);       //execute the query

            if ($result->num_rows == 1){
              $_SESSION['uniname'] = $uniname; //set session variable to their username
              echo "Institution is " . $uniname;
              header("Location: univStatus.php");

            }else{
                echo "<br>Please register your intitution.";
            }
          }
          
          $password = $uname = ""; //cleaning variables post query
          $conn-> close();            //close the connection to database

        ?>
        
        <br><br><br><br><br>
		
		<h2 align="center">To register your institution: </h2>
        <FORM METHOD="LINK" ACTION="registerUniv.php">
        <INPUT TYPE="submit" VALUE="First registration">
        </FORM>
        <br><br><br><br><br>
		<FORM METHOD="LINK" ACTION="index.php"> 
        <INPUT TYPE="submit" VALUE="Back to website home page">
        </FORM>
			
      </div>

      <style type="text/css">
        .univ {
          text-align: center;
        }
      </style>
    </body>
</html>
