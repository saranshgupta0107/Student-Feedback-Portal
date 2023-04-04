<?php   
session_start();
?>
<!DOCTYPE html>
<html>
    <body>
        <?php 
        require('../connection.php');  
        $email = $_POST['email'];  
        $name=$_POST['name'];
        $password = $_POST['pass']; 
            //to prevent from mysqli injection  
            $name = stripcslashes($name);  
            $password = stripcslashes($password);  
            $email=stripcslashes($email);
            $name = mysqli_real_escape_string($con, $name);
            $email=mysqli_real_escape_string($con,$email);
            $password = mysqli_real_escape_string($con, $password);  
          
            $sql = "select * from instructor where name = '$name' and email= '$email'";  
            $result = mysqli_query($con, $sql);  
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
            $count = mysqli_num_rows($result);  
            if($count == 1){
                echo '<script>alert("Faculty with this combination already exists");setTimeout(()=>{window.location.replace("../../html/admin/add_faculty.html");},700);</script>';  
            } 
            else {
                $sql="INSERT INTO instructor (name,email,pass)
                VALUES ('$name','$email','$password')";
                if($con->query($sql)==TRUE)
                echo '<script>alert("Faculty successfully added");setTimeout(()=>{window.location.replace("../../html/admin/add_faculty.html");},700);</script>';  
                else
                echo '<script>alert("Some error was detected! Please try again later.");setTimeout(()=>{window.location.replace("../../html/admin/add_faculty.html");},700);</script>';  
                
            }
                ?>  
                </body>
                </html>