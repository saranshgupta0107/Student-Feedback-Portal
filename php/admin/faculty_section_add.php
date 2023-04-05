<?php
session_start();
?>
<!DOCTYPE html>
<html>

<body>
    <?php
    require('../connection.php');
    $id = $_POST['id'];
    $semester = $_POST['semester'];
    $sec_id = $_POST['sec_id'];
    $course_id = $_POST['course_id'];
    //to prevent from mysqli injection  
    $id = stripcslashes($id);
    $semester = stripcslashes($semester);
    $sec_id = stripcslashes($sec_id);
    $course_id = stripcslashes($course_id);
    $id = mysqli_real_escape_string($con, $id);
    $semester = mysqli_real_escape_string($con, $semester);
    $course_id = mysqli_real_escape_string($con, $course_id);
    $sec_id = mysqli_real_escape_string($con, $sec_id);
    $sql = "insert into teaches values('$id','$sec_id',$semester,'$course_id');";
    try {
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo "<script>alert('Success!');setTimeout(()=>{window.location.replace('../../html/admin/view_faculty/');},700);</script>";
        } else
            echo '<script>alert("There was some error deleting this record");setTimeout(()=>{window.location.replace("../../html/admin/view_faculty/");},700);</script>';
    } catch (mysqli_sql_exception $e) {
        echo "<script>alert('Erroreneous entry of data!');setTimeout(()=>{window.location.replace('../../html/admin/view_faculty/');},700);</script>";
    }
    ?>
</body>

</html>