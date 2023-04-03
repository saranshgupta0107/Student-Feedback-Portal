<?php   
session_start();
?>
        <?php 
        require('../connection.php');  
        $directions=(json_decode(file_get_contents('php://input'), true));
        $id= $directions['feedback_id'];
            //to prevent from mysqli injection  
            $id=stripcslashes($id);
            $id=mysqli_real_escape_string($con,$id); 
            $sql = "delete from feedback where feedback_id='$id';";
            if(mysqli_query($con, $sql)){
                echo "<script>alert('Deleted successfully');";
            }else{
                echo $con->error_log;
            }  
            mysqli_close($con);
                ?>  