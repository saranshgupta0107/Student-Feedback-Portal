<?php
session_start();
?>
<!DOCTYPE html>
<html>

<body>
    <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['userid'] != 'admin') : echo "<script> alert('You are not authorised to this page'); window.location.replace('../../../')</script>";
    endif; ?>
    <?php
    require('../../connection.php');
    $sql = "insert into student values";
    if (isset($_POST['ID'])) {
        $id = $_POST['ID'];
        $id = stripcslashes($id);
        $id = mysqli_real_escape_string($con, $id);
        $name = $_POST['name'];
        $name = stripcslashes($name);
        $name = mysqli_real_escape_string($con, $name);
        $dept_name = $_POST['dept_name'];
        $dept_name = stripcslashes($dept_name);
        $dept_name = mysqli_real_escape_string($con, $dept_name);
        $sql = $sql . "('$id','password','$name','$dept_name');";
        try {
            $result = mysqli_query($con, $sql);
            if ($result) {
                mysqli_commit($con);
                echo "<script>alert('Success!');setTimeout(()=>{window.location.replace('../../../html/admin/drop_add_student/');},700);</script>";
            }
        } catch (mysqli_sql_exception $e) {
            echo "<script>alert('Erroreneous operation!');setTimeout(()=>{window.location.replace('../../../html/admin/drop_add_student/');},700);</script>";
        }
    } else {
        $arr = json_decode($_POST['file_data']);
        mysqli_commit($con);
        foreach ($arr as $row => $val) {
            $val = json_decode(json_encode($val), true);
            $id = $val['Roll Number'] . "@iiita.ac.in";
            $id = stripcslashes($id);
            $id = mysqli_real_escape_string($con, $id);
            $name = $_POST['name'];
            $name = stripcslashes($name);
            $name = mysqli_real_escape_string($con, $name);
            $dept_name = $_POST['dept_name'];
            $dept_name = stripcslashes($dept_name);
            $dept_name = mysqli_real_escape_string($con, $dept_name);
            $sql1 = $sql . "('$id','password','$name','$dept_name');";
            try {
                $result = mysqli_query($con, $sql1);
                if ($result) {;
                }
            } catch (mysqli_sql_exception $e) {
                mysqli_rollback($con);
                echo "<script>alert('Erroreneous operation!');window.location.replace('../../../html/admin/drop_add_student/');;</script>";
            }
        }
        echo "<script>alert('Success!');setTimeout(()=>{window.location.replace('../../../html/admin/drop_add_student/');},700);</script>";
    }
    ?>
</body>

</html>