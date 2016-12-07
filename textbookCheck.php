<?php
session_start();
?>
<!DOCTYPE html>

<html>
  <head>
      <meta charset="UTF-8">
      <title>Textbooks</title>
	  <link rel="shortcut icon" href="images/icon.ico" />
    </head>
  <body>

    <h1 align="center">Textbooks database verification:</h1>
     <br>
	 <h2 align="center">Institution: <?php echo $_GET["UniName"] ?> </h2>
     <?php
         // establish connection to database
         $servername = "aa6tcu7aup59u3.ccuozd0wfara.us-east-1.rds.amazonaws.com:3306";       
         $port = "3306";   //database port number
         $username = "jalalkawash";  
         $password = "leonardmanzara";
         $db = "TextbookExchange";                     //your database name
	
         function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }
//CHECKING IF TEXTBOOK ALREADY IN DB
         $conn = new mysqli($servername, $username, $password, $db);

         if($conn->connect_error){
             die("Connection failed".$conn->connect_error);
         }

        // define variables and set to empty values
	$isbn3 = "";
	// cleansing input	
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $isbn3 = test_input($_POST["isbn3"]);
        }
	?>  
	  <div class="rec">
       
        <h2 align="center">Check for Textbook in database:</h2>
       <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
       ISBN: <input type="text" name="isbn3">
       <br><br>
       <input type="submit" value="Check">
       </form>
       <br>


    <?php
      if ($isbn3 != "") {
          $sql3 = "SELECT Title, Publisher, Edition FROM `TextbookExchange`.`Textbook` WHERE ISBN = '$isbn3'";
          $result3 = $conn->query($sql3); 
          if ($result3->num_rows > 0) {
              echo "<br> Textbook already registered in database<br>"; 
            while($row = $result3->fetch_assoc()) {
                echo "Title: " . $row["Title"] . "  -  Publisher: " . $row["Publisher"] . "  -  Edition: " . $row["Edition"] . "<br>";
            }
          } 
          else {
              echo "Textbook needs to be registered.<br>";
            }
      }
      
       $isbn3 = "";  //cleaning variables post query
	$conn-> close();            //close the connection to database
     ?>
	 
	 <?php	
// ENTERING NEW TEXTBOOK IN DB
         $conn = new mysqli($servername, $username, $password, $db);

         if($conn->connect_error){
             die("Connection failed".$conn->connect_error);
         }
		 
        // define variables and set to empty values
	$isbn2 = $title = $publisher = $ed = "";
		
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $isbn2 = test_input($_POST["isbn2"]);
            $title = test_input($_POST["title"]);
            $publisher = test_input($_POST["publisher"]);
            $ed = test_input($_POST["ed"]);
       }
     ?>
        
       <h2 align="center">Register new textbook in database:</h2>
       <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
       ISBN: <input type="text" name="isbn2">
       <br><br>
       Title: <input type="text" name="title">
       <br><br>
        Publisher: <input type="text" name="publisher">
       <br><br>
	Edition: <input type="text" name="ed">
       <br><br>

       <input type="submit" name="post" value="Post">
       </form>
       <br>


    <?php
	if($isbn2 != "" & $title != "" & $publisher != "" & $ed != "") {
            $sql2 = "INSERT INTO `TextbookExchange`.`Textbook` (`ISBN`, `Title`, `Publisher`, `Edition`) VALUES ('$isbn2', '$title', '$publisher', '$ed')";
            echo "<br><br>Inserting  into db: ";
            if($conn->query($sql2)==TRUE){       //try executing the query
                echo "Textbook details posted!<br>";
            }
            else{
                echo "Error: " . $sql2 . "<br>" . $conn->error;
            }
	}
       $isbn2 = $title = $publisher = $ed = "";  //cleaning variables post query
       $conn-> close();            //close the connection to database

     ?>
	 

<!--
      <FORM METHOD="LINK" ACTION="edit.php">
      <INPUT TYPE="submit" VALUE="Edit an existing recommendation">
      </FORM>
	  
	  <FORM METHOD="LINK" ACTION="edit.php">
      <INPUT TYPE="submit" VALUE="Delete an existing recommendation">
      </FORM>
-->
        <FORM METHOD="LINK" ACTION="recommend.php"> 
        <INPUT TYPE="submit" VALUE="Back to recommendation page">
        </FORM>
		<br><br><br><br>
        <FORM METHOD="LINK" ACTION="univ.php"> 
        <INPUT TYPE="submit" VALUE="Back to institutions welcome page">
        </FORM>
		<br>
		<FORM METHOD="LINK" ACTION="index.php"> 
        <INPUT TYPE="submit" VALUE="Back to website home page">
        </FORM>
    </div>

    <style type="text/css">
      .rec {
        text-align: center;
      }
    </style>

  </body>
</html>
