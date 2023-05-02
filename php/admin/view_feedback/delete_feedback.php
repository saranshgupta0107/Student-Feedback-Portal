<?php
session_start();
?>
<!DOCTYPE html>
<html>

<body>
    <?php
    require_once('../../connection.php');
    require('../../../php/gen_id.php');
    session_start();
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
    }
    ?>
    <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['userid'] != 'admin') {
        session_unset();
        session_destroy();
        echo "<script> alert('You are not authorised to this page'); window.location.replace('../../../')</script>";
    }
    ?>
    <?php
    $feedback_id = $_POST['submit'];
    //to prevent from mysqli injection  
    $feedback_id = stripcslashes($feedback_id);
    $feedback_id = mysqli_real_escape_string($con, $feedback_id);

    $sql = "delete from feedback where feedback_id='$feedback_id';";
    try {
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo "<script>alert('Success!');setTimeout(()=>{window.location.replace('../../../html/admin/');},70);</script>";
        } else
            echo '<script>alert("There was some error ");setTimeout(()=>{window.location.replace("../../../html/admin/");},70);</script>';
    } catch (mysqli_sql_exception $e) {
        echo "<script>alert('Erroreneous entry of data!');setTimeout(()=>{window.location.replace('../../../html/admin/');},70);</script>";
    }
    ?>
</body>

</html>