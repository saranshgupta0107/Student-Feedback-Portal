<?php   
session_start();
?>
<!DOCTYPE html>
<html>
    <body>
        <?php 
        require('../connection.php');  
        $username = $_POST['email'];  
        $password = $_POST['pass'];  
          
            //to prevent from mysqli injection  
            $username = stripcslashes($username);  
            $password = stripcslashes($password);  
            $username = mysqli_real_escape_string($con, $username);  
            $password = mysqli_real_escape_string($con, $password);  
          
            $sql = "select *from admin where user = '$username' and passwd = '$password'";  
            $result = mysqli_query($con, $sql);  
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
            $count = mysqli_num_rows($result);  
            if($count == 1){
                echo '<script>
                window.location.replace("../../html/admin/admin.html");
                </script>';  
                $_SESSION['loggedin']=true;
                $_SESSION['userid']=1;
                exit;
            } 
            else 
                echo '<script>alert("Username and password does not match");setTimeout(()=>{window.location.replace("../../html/admin/login_admin.html");},700);</script>';  
                ?>  
                </body>
                </html>