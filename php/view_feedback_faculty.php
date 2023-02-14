<?php   
session_start();
?>
        <?php 
        require('connection.php');
        $directions=(json_decode(file_get_contents('php://input'), true));
        $email=$directions['email'];
        $course=$directions['course'];
            $sql = "select * from feedback where feedback_id in (select feedback_id from gives natural join (select distinct(enroll_no) as student_id from (select * from teaches where email='$email') e3 inner join student on (e3.sec=student.sec)) e1 where gives.course_id= '$course') ";
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