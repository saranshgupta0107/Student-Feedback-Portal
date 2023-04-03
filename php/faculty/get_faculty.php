<?php   
session_start();
?>
<!DOCTYPE html>
<html>
    <body>
        <?php 
        require('../connection.php');
            $sql = "select * from instructor;";  
            $result = $con->query($sql);
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    echo "Name: " . $row["name"]. " - Email " . $row["email"]. "<br>";
                }
            }
            else
            echo "0 results";
            $con->close();
                ?>  
                </body>
                </html>