<?php
session_start();
?>
<!DOCTYPE html>

<html>
  <head>
      <meta charset="UTF-8">
      <title>Inst status</title>
	  <link rel="shortcut icon" href="images/icon.ico" />
    </head>
  <body>

    <h1 align="center">Your institution's recommendations</h1>
    <div class="status">
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
	
	<h2 align="center">Institution: <?php echo $_SESSION['uniname']."<br>"; ?> </h2>
	
	<?php 
        $uniname = $_SESSION['uniname'];
		$sql = "SELECT * FROM `TextbookExchange`.`University` WHERE  Uname = '$uniname'";
		$result = $conn->query($sql);       //execute the query
		

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo "<br> City: ". $row["City"]. "  -  Country: ". $row["Country"]. "  -  Province: " . $row["Province"] . "<br><br><br>";
			}	
		} 
		else {
			echo "<br>No results found<br>";
		}
		
		$sql2 = "SELECT * FROM `TextbookExchange`.`Recommends` WHERE  University = '$uniname'";
		$result2 = $conn->query($sql2);       //execute the query
		

		if ($result2->num_rows > 0) {
		
			echo "<table border='1' align='center'>
			<tr>
			<th>Textbook ISBN</th>
			<th>Course</th>
			</tr>" ;

			while($row = $result2->fetch_assoc()) {
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
		//cleaning variables post query?
		$conn-> close();
	?>
		<br><br>
<!--
	<FORM METHOD="GET" ACTION="recommend.php">
	<input type="hidden" name="UniName" value=<"<?php //echo $_GET["instName"] ?>">
        <INPUT TYPE="submit" VALUE="Update recommendations">
        </FORM>
-->
        <?php
        $inst = $_GET["instName"];
        $uniname = $_SESSION['uniname'];
        echo "<form target=\"_blank\" action=\"recommend.php\" method=\"get\"><input type=\"hidden\" name=\"UniName\" value=\"$uniname\"><input type=\"submit\" value=\"Update recommendations\"></form>"; //button
        ?>
		
		<br><br><br><br>
        <FORM METHOD="LINK" ACTION="univLogout.php">  <!-- navigation buttons-->
        <INPUT TYPE="submit" VALUE="Back to institutions welcome page">
        </FORM>
		<br>
		<FORM METHOD="LINK" ACTION="index.php"> 
        <INPUT TYPE="submit" VALUE="Back to website home page">
        </FORM>
	</div>

    <style type="text/css">
      .status {
        text-align: center;
      }
    </style>	
  </body>
</html>
