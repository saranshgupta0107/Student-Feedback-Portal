<?php   
session_start();
?>
<!DOCTYPE html>
<html>
    <body>
        <?php 
        if(!isset($_POST['validationCustom01'])||!isset($_POST['validationCustomUsername']))return;
        $name = $_POST['validationCustom01'];  
        $email=$_POST['validationCustomUsername'];
        $pass=$_POST['validationCustom02'];
        $semester=$_POST['validationCustom03'];
        $section=$_POST['validationCustom05'];

            //to prevent from mysqli injection  
            $name = stripcslashes($name);  
            $pass = stripcslashes($pass);  
            $email=stripcslashes($email);
            $semester=stripcslashes($semester);
            $section=stripcslashes($section);
            $name = mysqli_real_escape_string($con, $name);
            $email=mysqli_real_escape_string($con,$email);
            $pass = mysqli_real_escape_string($con, $pass);  
            $semester = mysqli_real_escape_string($con, $semester);
            $section = mysqli_real_escape_string($con, $section); 
            $sql = "select * from student where enroll_no= '$email'";  
            $result = mysqli_query($con, $sql);  
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
            $count = mysqli_num_rows($result);  
            if($count == 1){
                echo '<script>alert("Student with this combination already exists");setTimeout(()=>{window.location.replace("../../html/admin/add_student.html");},700);</script>';  
            } 
            else {
                $int_val=(int)$semester;
                $sql="INSERT INTO student
                VALUES ('$email','$pass','$name','$int_val','$section')";
                if($con->query($sql)==TRUE)
                echo '<script>alert("Student successfully added");setTimeout(()=>{window.location.replace("../../html/admin/add_student.html");},700);</script>';  
                else
                echo '<script>alert("Some error was detected! Please try again later.");setTimeout(()=>{window.location.replace("../../html/admin/add_student.html");},700);</script>';  
                
            }
                ?>  
                </body>
                </html>