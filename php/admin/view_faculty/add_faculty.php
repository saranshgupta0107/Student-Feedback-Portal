<?php
session_start();
?>
<!DOCTYPE html>
<html>

<body>
    <?php
    require_once("../../connection.php");
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800*6)) {
        session_unset();
        session_destroy();
        echo "
        <script>
        function logout() {
            alert('You have been logged in for more than 3 hours, Timeout!');
            window.location.replace('../../../');
        };
        logout();
        </script>";
        return;
    }
    ?>
    <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['userid'] != 'admin') {
        echo "<script> alert('You are not authorised to this page'); window.location.replace('../../../')</script>";
    } ?>
    <?php

    require_once('../../gen_id.php');
    require_once('../../mailtesting.php');
    try{
        $id = $_POST['ID'];
        $password = gen_pas();
        $name = $_POST['name'];
        $dept_name = $_POST['dept_name'];
        //to prevent from mysqli injection  
        $id = stripcslashes($id);
        $password = stripcslashes($password);
        $name = stripcslashes($name);
        $dept_name = stripcslashes($dept_name);
        $id = mysqli_real_escape_string($con, $id);
        if (!sendPassword($id, $password)) {
            echo "<script>alert('some error occured while mailing');setTimeout(()=>{window.location.replace('../../../html/admin/view_faculty/');},700000);</script>";
            return;
        }
        $password = $password . "randomsalt";
        $password = hash('ripemd160', $password);
        $password = mysqli_real_escape_string($con, $password);
        $dept_name = mysqli_real_escape_string($con, $dept_name);
        $name = mysqli_real_escape_string($con, $name);
        $sql = "insert into p1_instructor values('$id','$password','$name','$dept_name');";
        try {
            $result = mysqli_query($con, $sql);
            if ($result) {
                mysqli_commit($con);
                echo "<script>alert('Success!');setTimeout(()=>{window.location.replace('../../../html/admin/view_faculty/');},700);</script>";
            } else
                echo '<script>alert("There was some error deleting this record");setTimeout(()=>{window.location.replace("../../../html/admin/view_faculty/");},700);</script>';
        } catch (mysqli_sql_exception $e) {
            echo "<script>alert('Erroreneous entry of data!');setTimeout(()=>{window.location.replace('../../../html/admin/view_faculty/');},700);</script>";
        }
    }catch(Exception $e){
        echo "<script>alert('There has been some error on this page, please contact administrator!');window.location.replace('../../../html/admin/view_faculty/');</script>";
    }
    ?>
</body>

</html>
