<?php
session_start();
?>
<!DOCTYPE html>
<html>

<body>
    <?php
require_once '../../connection.php';
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
    echo "
        <script>
        function logout() {
            alert('You have been logged in for more than 30 minutes, Timeout!');
            window.location.replace('../../../');
        };
        logout();
        </script>";
    return;
}
?>
    <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['userid'] != 'student') {
    echo "<script> alert('You are not authorised to this page'); window.location.replace('../../../')</script>";
}?>
    <?php
try {
    $anon_id = $_SESSION['username'];
    $feedback_id = $_POST['submit'];

    //to prevent from mysqli injection
    $anon_id = stripcslashes($anon_id);
    $feedback_id = stripcslashes($feedback_id);

    $anon_id = mysqli_real_escape_string($con, $anon_id);
    $feedback_id = mysqli_real_escape_string($con, $feedback_id);

    $sqlcheck = "select * from p1_gives where anon_id='$anon_id' and feedback_id='$feedback_id';";
    $result = mysqli_query($con, $sqlcheck);
    if (mysqli_num_rows($result) == 0) {
        echo "<script>alert('No such feedback exists by you');</script>";
        return;
    }
    try {
        $query = "select freeze from p1_gives where feedback_id='" . $_POST['feedback'] . "'";
        $res = mysqli_query($con, $query);
        $res = $res->fetch_assoc();
        if ($res['freeze'] == 1) {
            echo "<script>alert('Your feedback has already been frozen so it cannot be deleted!');setTimeout(()=>{window.location.replace('../../../html/student/');},70);</script>";
        }

    } catch (Exception $e) {
        echo "<script>alert('There has been some error on this page, please contact administrator!');window.location.replace('../');</script>";
    }

    $sql = "delete from p1_feedback where feedback_id='$feedback_id';";
    try {
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo "<script>alert('Success!');setTimeout(()=>{window.location.replace('../../../html/student/');},70);</script>";
        } else {
            echo '<script>alert("There was some error ");setTimeout(()=>{window.location.replace("../../../html/student/");},70);</script>';
        }

    } catch (mysqli_sql_exception $e) {
        echo "<script>alert('$e');</script>";
        echo "<script>alert('Erroreneous entry of data!');setTimeout(()=>{window.location.replace('../../../html/student/');},70);</script>";
    }
} catch (Exception $e) {
    echo "<script>alert('There has been some error on this page, please contact administrator!');window.location.replace('../../../html/student/');</script>";
}
?>
</body>

</html>