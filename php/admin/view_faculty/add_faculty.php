<?php
session_start();
?>
<!DOCTYPE html>
<html>

<body>
    <?php
    session_start();
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        session_unset();
        session_destroy();
        echo "
        <script>
        function logout() {
            alert('You have been logged in for more than 30 minutes, Timeout!');
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
    require('../../connection.php');
    require('../../gen_id.php');
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
    $password = $password . "randomsalt";
    $password = hash('ripemd128', $password);
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