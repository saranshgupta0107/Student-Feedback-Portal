<?php
session_start();
?>
    <?php
require_once '../../connection.php';
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
    echo "<script>
        function logout() {
            alert('You have been logged in for more than 30 minutes, Timeout!');
            window.location.replace('../../../');
        };
        logout();
        </script>
        ";
    return;
}
?>
    <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['userid'] != 'faculty') {
    echo "<script>alert('You are not authorised to this page'); window.location.replace('../../../')</script>";
}?>
    <?php
try {
    $id = $_SESSION['id'];
    $semester = $_POST['semester'];
    $course_id = $_POST['course_id'];
    $sec_id = $_POST['sec_id'];
    $semester = stripcslashes($semester);
    $course_id = stripcslashes($course_id);
    $sec_id = stripcslashes($sec_id);
    $id = stripcslashes($id);

    $course_id = mysqli_real_escape_string($con, $course_id);
    $semester = mysqli_real_escape_string($con, $semester);
    $sec_id = mysqli_real_escape_string($con, $sec_id);
    $id = mysqli_real_escape_string($con, $id);
    $semester = intval($semester);
    $sqlcheck = "select * from p1_teaches where id='$id' and course_id='$course_id' and semester=$semester and sec_id='$sec_id';";
    $result = mysqli_query($con, $sqlcheck);
    if (mysqli_num_rows($result) == 0) {
        echo "alert('No such course exists. Please try again');";
        return;
    }
    $sql = "update p1_teaches set freeze=1 where id='$id' and course_id='$course_id' and semester=$semester and sec_id='$sec_id';";
    try {
        $result = mysqli_query($con, $sql);
        if ($result) {
            $sql2 = "SELECT feedback_id FROM p1_feedback WHERE course_id='$course_id' AND semester=$semester AND sec_id='$sec_id';";
            try {
                $result2 = mysqli_query($con, $sql2);
                if ($result2) {
                    if (mysqli_num_rows($result2) > 0) {
                        while ($row = mysqli_fetch_assoc($result2)) {
                            $feedbackId = $row['feedback_id'];
                            try {
                                $sqll = "update p1_gives set freeze=1 where feedback_id='$feedbackId';";
                                $result3 = mysqli_query($con, $sqll);
                                if (!$result3) {
                                    echo '<script>alert("There was some error please try again");setTimeout(()=>{window.location.replace("../../../html/faculty/");},70);</script>';
                                    mysqli_rollback($con);
                                }
                            } catch (mysqli_sql_exception $e) {
                                echo "<script>alert('$e');</script>";
                                echo "<script>alert('There was some error! Please try again');setTimeout(()=>{window.location.replace('../../../html/faculty/');},70);</script>";
                                mysqli_rollback($con);
                            }
                        }
                    }
                    echo "<script>alert('Successfully frozen');setTimeout(()=>{window.location.replace('../../../html/faculty/');},70);</script>;";
                    mysqli_commit($con);
                } else {
                    echo '<script>alert("There was some error please try again");setTimeout(()=>{window.location.replace("../../../html/faculty/");},70);</script>';
                    mysqli_rollback($con);
                }
            } catch (mysqli_sql_exception $e) {
                echo "<script>alert('$e');</script>";
                echo "<script>alert('Erroreneous entry of data!');setTimeout(()=>{window.location.replace('../../../html/faculty/');},70);</script>";
                mysqli_rollback($con);
            }
        }
    } catch (mysqli_sql_exception $e) {
        echo "<script>alert('$e');</script>";
        echo "<script>alert('Erroreneous entry of data!');setTimeout(()=>{window.location.replace('../../../html/faculty/');},70);</script>";
        mysqli_rollback($con);
    }
} catch (Exception $e) {
    echo "<script>alert('There has been some error on this page, please contact administrator!');window.location.replace('../../../html/faculty/');</script>";
    mysqli_rollback($con);
}
?>