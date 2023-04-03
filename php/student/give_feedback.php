<?php   
session_start();
?>
        <?php 
        require('../connection.php');
        
            $sql = "select uuid() as id;";  
            $result = $con->query($sql);
            $comment=$_POST['comment'];
            $rating=(int)$_POST['rating'];
            $course=$_POST['course'];
            $date=date("Y-m-d");
            echo $date;
            $username=$_POST['student'];
            $checkQ=mysqli_query($con,"select * from takes where student_id='$username' and course_id='$course'");
            if(mysqli_num_rows($checkQ)==1){
                $sql=$result->fetch_assoc()['id'];
                $query1="insert into feedback values ('$sql','$comment',$rating,'$date' )";
                mysqli_query($con,$query1);
                mysqli_query($con,"insert into gives values ('$username','$sql','$course');");
                echo "<script>alert('Succesful, redirecting');setTimeout(()=>{window.location.replace('../../html/student/give_feedback.html');},700);</script>";
            }
            else{
                echo "<script>alert('unSuccesful, not enrolled in this course, redirecting');setTimeout(()=>{window.location.replace('../../html/student/student.html');},700);</script>";
            }
            $con->close();
                ?>  