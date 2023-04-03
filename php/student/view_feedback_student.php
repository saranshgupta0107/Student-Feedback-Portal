<?php   
session_start();
?>
        <?php 
        require('../connection.php');

        $directions=(json_decode(file_get_contents('php://input'), true));
        $email=$directions['email'];
        $pass =$directions['pass'];
        $course=$directions['course'];
        $order=$directions['order'];
            $sql = "select * from gives natural join feedback where student_id='$email'";  
            if($course!='none')$sql=$sql." and course_id='$course'";
            if($order=='desc rating')$sql=$sql." order by rating desc";
            elseif($order=='asc rating') $sql=$sql." order by rating asc";
            elseif($order=='asc date') $sql=$sql." order by year asc";
            elseif($order=='desc date') $sql=$sql." order by year desc";
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