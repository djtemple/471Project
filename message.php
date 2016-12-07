<?php
session_start();
?>
<!DOCTYPE html>

<html>
  <head>
      <meta charset="UTF-8">
      <title>Messaging</title>
	  <link rel="shortcut icon" href="images/icon.ico" />
    </head>
  <body>

    <h1 align="center">Your Messages</h1>
    <?php
      echo $_SESSION['uname'] . " is viewing messages";
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

      //Let user select which ad to edit

      $uname = $_SESSION['uname'];
      $password = $uname = ""; //cleaning variables post query

      //want to view message here
      $searchAuthor = $searchbookTitle = $searchadTitle = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST") { //repurpose for sending messages
        $recipient_username = test_input($_POST["recipient_username"]);
        $messagebody = test_input($_POST["messagebody"]);


      }
      // cleansing input
      function test_input($data) { //this prevents sql injection
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

    ?>
	

    <h2 align="center">Enter Message Details:</h2>  <!-- html 5 form for taking input-->
	
	<!-- if redirected to message page from an ad page: -->
	<?php
	if (isset($_GET["AdvertId"]) && isset($_GET["AdvertPoster"])) {
		$i= $_GET["AdvertId"];
		$p = $_GET["AdvertPoster"];
		echo "<h2 align='center'>Redirected from: Ad # $i - posted by: $p </h2>";
	}
	?>
	
    <div class="message">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      Recipient Username: <input type="text" name="recipient_username">
      <br><br>
      Message Body: <textarea name="messagebody" rows="5" cols="40"><?php echo $messagebody;?></textarea>
      <br><br>
      <input type="submit" name="send message" value="Send Message">
      <br><br>
      </form>



   <?php

   $uname = $_SESSION['uname'];
     $sql = "SELECT Sender_username, Content, Timestamp1 FROM `TextbookExchange`.`Message` WHERE Recipient_username = '$uname' ORDER BY Timestamp1 DESC";
     $result = $conn->query($sql);       //execute the query
     $count = 0;
     echo "Your messages:<br>";
     if ($result->num_rows > 0 && $count < 10) {
          // output data of each row
          $count++;
          
          while($row = $result->fetch_assoc()) {
              echo "<br> Sent from: " . $row["Sender_username"]. "<br>"; 
              echo $row["Content"] . "<br>";
              echo "Sent at: ". $row["Timestamp1"] . "<br>"; //prints all messages a user has
          }
    } 
    else {
        echo "You have no messages<br>";
      }
      //sending the message
      if($recipient_username != "" && $messagebody != ""){
      $sql = "INSERT INTO `TextbookExchange`.`Message` (`Sender_username`, `Recipient_username`, `Content`) VALUES ('$uname', '$recipient_username', '$messagebody')";
      if($conn->query($sql)==TRUE){       //try executing the query
          echo "<br>Message Sent<br>";
          $messagebody = $recipient_username = "";
		  header("location: message.php"); // testing preventing resend when refresh (exit;???)
        }
        else{
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
      $sql = $messagebody = $recipient_username = "";
    }
      $messagebody = $recipient_username = "";
      $count = "0"; //cleaning variables post query
      $conn-> close();          //close the connection to database

     ?>

	  <br>
      <FORM METHOD="LINK" ACTION="welcome.php">
      <INPUT TYPE="submit" VALUE="Back to menu">
      </FORM>
      <br>
      <FORM METHOD="LINK" ACTION="search.php">
      <INPUT TYPE="submit" VALUE="Create a search">
      </FORM>
      <br>
      <FORM METHOD="LINK" ACTION="logout.php">
      <INPUT TYPE="submit" VALUE="Logout of your profile">
      </FORM>
    </div>

    <style type="text/css">
      .message {
        text-align: center;
      }
    </style>
  </body>
</html>
