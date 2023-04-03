<?php   
session_start();
?>
        <?php 
        require('../connection.php');  
        $directions=(json_decode(file_get_contents('php://input'), true));
        $id= $directions['course_id'];
        $email=$directions['email'];
            //to prevent from mysqli injection  
            $id=stripcslashes($id);
            $id=mysqli_real_escape_string($con,$id); 
            $email=stripcslashes($email);
            $email=mysqli_real_escape_string($con,$email); 
            $sql = "delete from takes where course_id='$id' and student_id='$email';";
            if(mysqli_query($con, $sql)){
                echo "<script>alert('Deleted successfully');";
            }else{
                echo $con->error_log;
            }  
            mysqli_close($con);
                ?>  