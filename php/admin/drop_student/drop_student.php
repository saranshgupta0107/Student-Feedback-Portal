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
    $sql = "delete from student";
    if (isset($_POST['ID'])) {
        $sql = $sql . $_POST['ID'];
        try {
            $result = mysqli_query($con, $sql);
            if ($result) {
                mysqli_commit($con);
                echo "<script>alert('Success!');setTimeout(()=>{window.location.replace('../../../html/admin/view_faculty/');},700);</script>";
            }
        } catch (mysqli_sql_exception $e) {
            echo "<script>alert('Erroreneous operation!');setTimeout(()=>{window.location.replace('../../../html/admin/view_faculty/');},700);</script>";
        }
    } else if (isset($_POST['all'])) {
    } else {
    }
    $sql = "delete from student where id =";

    ?>
</body>

</html>