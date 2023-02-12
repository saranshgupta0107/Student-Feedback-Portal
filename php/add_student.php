<?php   
session_start();
?>
<!DOCTYPE html>
<html>
    <body>
        <?php 
        $conn=new mysqli("localhost","root","12345","feedback_management");
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
            $name = mysqli_real_escape_string($conn, $name);
            $email=mysqli_real_escape_string($conn,$email);
            $pass = mysqli_real_escape_string($conn, $pass);  
            $semester = mysqli_real_escape_string($conn, $semester);
            $section = mysqli_real_escape_string($conn, $section); 
            $sql = "select * from student where enroll_no= '$email'";  
            $result = mysqli_query($conn, $sql);  
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
            $count = mysqli_num_rows($result);  
            if($count == 1){
                echo '<script>alert("Student with this combination already exists");setTimeout(()=>{window.location.replace("../html/admin/add_student.html");},700);</script>';  
            } 
            else {
                $int_val=(int)$semester;
                $sql="INSERT INTO student
                VALUES ('$email','$pass','$name','$int_val','$section')";
                if($conn->query($sql)==TRUE)
                echo '<script>alert("Student successfully added");setTimeout(()=>{window.location.replace("../html/admin/add_student.html");},700);</script>';  
                else
                echo '<script>alert("Some error was detected! Please try again later.");setTimeout(()=>{window.location.replace("../html/admin/add_student.html");},700);</script>';  
                
            }
                ?>  
                </body>
                </html>