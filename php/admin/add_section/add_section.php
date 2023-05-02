<?php
session_start();
?>
<!DOCTYPE html>
<html>

<body>
    <?php
    session_start();
    require('../../connection.php');
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800*6)) {
        session_unset();
        session_destroy();
        echo "
        <script>
        function logout() {
            alert('You have been logged in for more than 3 hours, Timeout!');
            window.location.replace('http://localhost/DBMS-Project/');
        };
        logout();
        </script>";
        return;
    }
    ?>
    <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['userid'] != 'admin') : echo "<script> alert('You are not authorised to this page'); window.location.replace('../../')</script>";
    endif; ?>
    <?php

    $id = $_POST['course_id'];
    $sec_id = $_POST['sec_id'];
    $semester = $_POST['semester'];
    //to prevent from mysqli injection  
    $id = stripcslashes($id);
    $sec_id = stripcslashes($sec_id);
    $semester = stripcslashes($semester);
    $id = mysqli_real_escape_string($con, $id);
    $sec_id = mysqli_real_escape_string($con, $sec_id);
    $semester = mysqli_real_escape_string($con, $semester);
    $sql = "insert into section values('$id','$sec_id','$semester');";
    try {
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo "<script>alert('Success!');setTimeout(()=>{window.location.replace('../../../html/admin/add_section/');},700);</script>";
        } else
            echo '<script>alert("There was some error deleting this record");setTimeout(()=>{window.location.replace("../../../html/admin/add_section/");},700);</script>';
    } catch (mysqli_sql_exception $e) {
        echo "<script>alert('Erroreneous entry of data!');setTimeout(()=>{window.location.replace('../../../html/admin/add_section/');},700);</script>";
    }
    ?>
</body>

</html>