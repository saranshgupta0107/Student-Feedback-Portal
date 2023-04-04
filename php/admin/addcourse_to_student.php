<?php   
session_start();
?>
        <?php 
        require('../connection.php');

        $directions=(json_decode(file_get_contents('php://input'), true));
        $name=$directions['name'];
        $course = $directions['course']; 
            //to prevent from mysqli injection  
            $name = stripcslashes($name);  
            $course=stripcslashes($course);
            $name = mysqli_real_escape_string($con, $name);
            $course=mysqli_real_escape_string($con,$course);
            $sql = "select * from takes where student_id = '$name' and course_id= '$course'";  
            $result = mysqli_query($con, $sql);  
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
            $count = mysqli_num_rows($result);  
            if($count == 1){
                echo 'alert("Student already registered");reload();';  
            } 
            else {
                $sql="INSERT INTO takes
                VALUES ('$name','$course')";
                if($con->query($sql)==TRUE)
                echo 'alert("Course successfully added");reload();';  
                else
                echo 'alert("Some error was detected! Please try again later.");reload();';  
                
            }
                ?>  