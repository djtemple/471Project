<!DOCTYPE html>
<!--
Manmeet Dhaliwal
471 Sample project to show connection to local database
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Hello</title>
    </head>
    <body>
        <h1>Demo for 471</h1>
        <?php
            // put your code here
            $servername = "aa6tcu7aup59u3.ccuozd0wfara.us-east-1.rds.amazonaws.com:3306";          //should be same for you
            $port = "3306";   //database port number
            $username = "jalalkawash";                 //same here
            $password = "leonardmanzara";              //your localhost root password
            $db = "ebdb";                     //your database name

            $conn = new mysqli($servername, $username, $password, $db);

            if($conn->connect_error){
                die("Connection failed".$conn->connect_error);
            }else{
                echo "Connected<br>";
                echo "Used textooks database";
            }

            //sql query
            $sql = "INSERT INTO names (names) VALUES ('John')";
            echo "<br><br>Inserting  into db: ";
            if($conn->query($sql)==TRUE){       //try executing the query
                echo "Query executed<br>";
            }
            else{
                echo "Query did not execute<br>";
            }

            //sql query
            $sql = "SELECT names FROM names";
            echo "<br><br>Printing names in the (names) table in the (names) column:<br>";
            $result = $conn->query($sql);       //execute the query

            if($result->num_rows >0){           //check if query results in more than 0 rows
                while($row = $result->fetch_assoc()){   //loop until all rows in result are fetched
                    echo "Name: ".$row["names"]."<br>"; //here we are looking at one row, and printing the value in "names" column
                }
            }

            $conn-> close();            //close the connection to database
        ?>
    </body>
</html>