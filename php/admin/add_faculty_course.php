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
        $course = $_POST['course']; 
        $section =$_POST['section'];

            //to prevent from mysqli injection  
            $name = stripcslashes($name);  
            $course = stripcslashes($course);  
            $email=stripcslashes($email);
            $name = mysqli_real_escape_string($con, $name);
            $email=mysqli_real_escape_string($con,$email);
            $section=mysqli_real_escape_string($con,$section);
            $course = mysqli_real_escape_string($con, $course);  
          
            $sql1 = "select * from instructor where name = '$name' and email= '$email'";  
            $result1 = mysqli_query($con, $sql1);  
            $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);  
            $count1 = mysqli_num_rows($result1);  
            $sql2 = "select * from course where course_id = '$course'";
            $result2= mysqli_query($con,$sql2);
            $count2= mysqli_num_rows($result2);
            if($count1 == 1&&$count2==1){
                $insertq = "insert into teaches values('$name','$email' , '$course','$section');";
                $insert_res= mysqli_query($con,$insertq);
                echo '<script>setTimeout(()=>{window.location.replace("../../html/admin/add_faculty_course.html");},700);</script>';  

            } 
            else if( $count1==0){
                echo '<script>  alert("User does not exist");</script>';
                echo '<script>setTimeout(()=>{window.location.replace("../../html/admin/add_faculty_course.html");},700);</script>';  

            }
            else {
                echo '<script>  alert("User does not exist");</script>';
                echo '<script>setTimeout(()=>{window.location.replace("../../html/admin/add_faculty_course.html");},700);</script>';  

                
            }
                ?>  
                </body>
                </html>