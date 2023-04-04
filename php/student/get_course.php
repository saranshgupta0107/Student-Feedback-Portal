<?php   
session_start();
?>
        <?php 
        require('../connection.php');

        $directions=(json_decode(file_get_contents('php://input'), true));
        $email=$directions['email'];
        $pass =$directions['pass'];
        $course=$directions['course'];
            $sql = "select * from takes where student_id='$email';";  
            if($course!='none')$sql=$sql." and course_id='$course'";
            $result = $con->query($sql);
            if($result->num_rows>0){
                $arr=array();
                while($row=$result->fetch_assoc()){
                    $arr[]=$row;
                }
                $myJSON=json_encode($arr);
                echo $myJSON;
            }
            else
            echo "0 results";
            $con->close();
                ?>  