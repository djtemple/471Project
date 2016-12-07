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
        <title>Register</title>
		<link rel="shortcut icon" href="images/icon.ico" />
    </head>
    <body>
        <h1 align="center">Register for Textbook Trade</h1>
        <?php

            // establish connection to database
            $servername = "aa6tcu7aup59u3.ccuozd0wfara.us-east-1.rds.amazonaws.com:3306";          //should be same for you
            $port = "3306";   //database port number
            $username = "jalalkawash";       
            $password = "leonardmanzara";  
            $db = "TextbookExchange";   //your database name

            $conn = new mysqli($servername, $username, $password, $db);

            if($conn->connect_error){
                die("Connection failed".$conn->connect_error);
            }else{
                echo "Connected<br>";
            }

        // define variables and set to empty values
	$instName = $city = $country = $prov = "";

          if ($_SERVER["REQUEST_METHOD"] == "POST") {   //taking input from html forms
            $instName = test_input($_POST["instName"]);
            $city = test_input($_POST["city"]);
            $country = test_input($_POST["country"]);
            $prov = test_input($_POST["prov"]);
          }
          // cleansing input
          function test_input($data) { //this prevents sql injection 
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }
        ?>

        
        <h2 align="center">Enter Institution Info:</h2>
        <div class="register">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          Institution name: <input type="text" name="instName">
          <br><br>
          City: <input type="text" name="city">
          <br><br>
          Country: <input type="text" name="country">
          <br><br>
          Province/State: <input type="text" name="prov">
          <br><br>

          <input type="submit" name="submit" value="Submit">
          </form>
        </div>

      <style type="text/css">
        .register {
          text-align: center;
        }
      </style>

        <?php

        //Adding univ input to University table
        if($instName != "" && $city != "" && $country != "" && $prov != "") {
          $sql = "INSERT INTO `TextbookExchange`.`University` (`Uname`, `City`, `Country`, `Province`) VALUES ('$instName', '$city', '$country', '$prov')";
          echo "<br><br>Inserting  into db: ";
          if($conn->query($sql)==TRUE){       //try executing the query
              echo "Query executed<br>";
          }
          else{
              echo "Error: " . $sql . "<br>" . $conn->error;
          }
        }

        //cleaning variables post query
        $instName = $city = $country = $prov = "";
        //close the connection to database
          $conn-> close();            

        ?>

        <div class="continueLogin">
          <FORM METHOD="LINK" ACTION="univ.php">  <!-- navigation buttons-->
          <INPUT TYPE="submit" VALUE="Back to institutions welcome page">
          </FORM>
		 <br>
		<FORM METHOD="LINK" ACTION="index.php"> 
        <INPUT TYPE="submit" VALUE="Back to website home page">
        </FORM>
        </div>

        <style type="text/css">
          .continueLogin {
            text-align: center;
          }
        </style>
        
    </body>
</html>
