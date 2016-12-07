<?php
session_start();
?>
<!DOCTYPE html>

<html>
  <head>
      <meta charset="UTF-8">
      <title>Ad</title>
	  <link rel="shortcut icon" href="images/icon.ico" />
    </head>
  <body>

    <h1 align="center">Ad Details</h1>
    <div class="display">
    <?php
      echo $_SESSION['uname'] . " is searching" . "<br>" ;
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
         $db = "TextbookExchange";                     //your database name

         $conn = new mysqli($servername, $username, $password, $db);

         if($conn->connect_error){
             die("Connection failed".$conn->connect_error);
         }
     ?>

	<h2 align="center">Ad id: <?php echo $_GET["AdvertId"]."<br>"; ?> </h2>
	<br>
	<?php
		$id = $_GET["AdvertId"];
		$sql = "SELECT * FROM `TextbookExchange`.`advertisement` WHERE  adID = '$id'";
		$result = $conn->query($sql);       //execute the query


		if ($result->num_rows > 0) {

			echo "<table border='1' align='center'>
			<tr>
			<th>Ad title</th>
			<th>Book title</th>
			<th>Description</th>
			<th>Poster username</th>
			<th>Author(s)</th>
			</tr>" ;

			while($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo "<td>".$row["adTitle"]."</td>";
				echo "<td>".$row["bookTitle"]."</td>";
				echo "<td>".$row["Description"]."</td>";
				echo "<td>".$row["posterUname"]."</td>";
				echo "<td>".$row["author"]."</td>";
				//echo "<br> Ad title: ". $row["adTitle"]. " - Book Title: ". $row["bookTitle"]. "- Author:". $row["author"]; //prints some details of the ad
				$poster =$row["posterUname"];
			}
			echo "</table>";
			echo "<br>";
			echo "<form target=\"_blank\" action=\"message.php\" method=\"get\"><input type=\"hidden\" name=\"AdvertId\" value=$id><input type=\"hidden\" name=\"AdvertPoster\" value=$poster><input type=\"submit\" value=\"Message poster\"></form>"; //button
		}
		else {
			echo "No results found";
		}
		echo "<br>";
		//cleaning variables post query?????
		$conn-> close();
	?>
		<br><br>
	    <FORM METHOD="LINK" ACTION="welcome.php"> <!-- navigation buttons-->
	    <INPUT TYPE="submit" VALUE="Back to menu">
	    </FORM>
	    <br>
	    <FORM METHOD="LINK" ACTION="logout.php">
	    <INPUT TYPE="submit" VALUE="Logout of your profile">
	    </FORM>
	</div>

    <style type="text/css">
      .display {
        text-align: center;
      }
    </style>
  </body>
</html>
