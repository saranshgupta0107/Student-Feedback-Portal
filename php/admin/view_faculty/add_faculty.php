<?php
session_start();
?>
<!DOCTYPE html>
<html>

<body>
    <?php
    session_start();
    ?>
    <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['userid'] != 'admin') : echo "<script> alert('You are not authorised to this page'); window.location.replace('../../')</script>";
    endif; ?>
    <?php
    require('../../connection.php');
    $id = $_POST['ID'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $dept_name = $_POST['dept_name'];
    //to prevent from mysqli injection  
    $id = stripcslashes($id);
    $password = stripcslashes($password);
    $name = stripcslashes($name);
    $dept_name = stripcslashes($dept_name);
    $id = mysqli_real_escape_string($con, $id);
    $password = mysqli_real_escape_string($con, $password);
    $dept_name = mysqli_real_escape_string($con, $dept_name);
    $name = mysqli_real_escape_string($con, $name);
    $sql = "insert into instructor values('$id','$password','$name','$dept_name');";
    try {
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo "<script>alert('Success!');setTimeout(()=>{window.location.replace('../../../html/admin/view_faculty/');},700);</script>";
        } else
            echo '<script>alert("There was some error deleting this record");setTimeout(()=>{window.location.replace("../../../html/admin/view_faculty/");},700);</script>';
    } catch (mysqli_sql_exception $e) {
        echo "<script>alert('Erroreneous entry of data!');setTimeout(()=>{window.location.replace('../../../html/admin/view_faculty/');},700);</script>";
    }
    ?>
</body>

</html>