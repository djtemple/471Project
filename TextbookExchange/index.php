<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Textbook Exchange</title>
    </head>
    <body>
        <?php
            $servername = "localhost";          //should be same for you
            $username = "root";                 //same here
            $password = "database";             //your localhost root password
            $db = "demodb";                     //your database name
            
            $conn = new mysqli($servername, $username, $password, $db);
            
            if($conn->connect_error){
                die("Connection failed".$conn->connect_error);
            }else{
                echo "Connected<br>";
            }
            
            echo "Textbook Exchange";


            // Database queries
        
        
        ?>
    </body>
</html>
