<?php   
session_start();
?>
        <?php 
        require('../connection.php');  
        $directions=(json_decode(file_get_contents('php://input'), true));
        $email=$directions['email'];
            //to prevent from mysqli injection  
            $email=stripcslashes($email);
            $email=mysqli_real_escape_string($con,$email); 
            $sql = "delete from instructor where email= '$email'";
            echo $sql;  
            if(mysqli_query($con, $sql)){
                ;
            }else{
                echo $con->error_log;
            }  
            mysqli_close($con);
                ?>  