<?php
session_start();
?>
<!DOCTYPE html>

<html>
  <head>
      <meta charset="UTF-8">
      <title>Recommending</title>
	  <link rel="shortcut icon" href="images/icon.ico" />
    </head>
  <body>

    <h1 align="center">Update your institution's textbook recommendations:</h1>
     <br>
	 <h2 align="center">Institution: <?php echo $_SESSION['uniname'] ?> </h2>
     <div class="rec">
     <?php
         $uniname = $_SESSION['uniname'];
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
        
         $conn = new mysqli($servername, $username, $password, $db);

         if($conn->connect_error){
             die("Connection failed".$conn->connect_error);
         }
         
// ENTERING NEW RECOMMENDATION
        // define variables and set to empty values
       $isbn = $course = "";			
       if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
            $isbn = test_input($_POST["isbn"]);
            $course = test_input($_POST["course"]);
       }
     ?>
       <h2 align="center">Enter a new recommendation:</h2>
       <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
       Textbook ISBN: <input type="text" name="isbn">
       <br><br>
       Course ID: <input type="text" name="course">
       <br><br>

       <input type="submit" name="post" value="Post">
       </form>
       <br>


    <?php
        $uniname = $_SESSION['uniname'];
	if($isbn != "" && $course != "") {
            $sql1 = "SELECT Title FROM `TextbookExchange`.`Textbook` WHERE ISBN = '$isbn'";
            $result1 = $conn->query($sql1);
            if ($result1->num_rows == 0) { 
                // if textbook is not in the database
                echo "This textbook does not seem to be registered in our database!<br>";
                echo "Please follow the \"Check textbook\" link below before posting this recommendation. <br>";
            }
            else if ($result1->num_rows == 1) {            
                    $sql = "INSERT INTO `TextbookExchange`.`Recommends` (`University`, `Textbook_ISBN`, `Course_id`) VALUES ('$uniname', '$isbn', '$course')";
                    echo "<br><br>Inserting  into db: ";
                    if($conn->query($sql)==TRUE){       //try executing the query
                        echo "Recommendation posted!<br>";
                    }
                    else{
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
            }
        }
  
       $isbn = $course = ""; //cleaning variables post query
       $conn-> close();            //close the connection to database

     ?>
	 
<br><br>

      <FORM METHOD="LINK" ACTION="textbookCheck.php">
      <INPUT TYPE="submit" VALUE="Check textbook">
      </FORM>
<!--	  
	  <FORM METHOD="LINK" ACTION="edit.php">
      <INPUT TYPE="submit" VALUE="Delete an existing recommendation">
      </FORM>
-->
		<br><br><br><br>
        <FORM METHOD="LINK" ACTION="univLogout.php"> 
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
