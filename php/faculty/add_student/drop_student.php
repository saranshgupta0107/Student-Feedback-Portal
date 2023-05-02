<?php
session_start();
?>
<!DOCTYPE html>
<html>

<body>
    <?php
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800*2)) {
        session_unset();
        session_destroy();
        echo "
        <script>
        function logout() {
            alert('You have been logged in for more than 1 hours, Timeout!');
            window.location.replace('../../');
        };
        logout();
        </script>";
    }
    ?>
    <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['userid'] != 'faculty') : echo "<script> alert('You are not authorised to this page'); window.location.replace('../../../')</script>";
    endif; ?>
    <?php
    require('../../connection.php');
    $sql = "delete from takes";
    if (isset($_POST['ID2'])) {
        $id = $_POST['ID2'];
        $course = $_POST['course2'];
        $_sec = $_POST['sec2'];
        $_semes = $_POST['semes2'];
        $id = stripcslashes($id);
        $id = mysqli_real_escape_string($con, $id);
        $course = stripcslashes($course);
        $course = mysqli_real_escape_string($con, $course);
        $_sec = stripcslashes($_sec);
        $_sec = mysqli_real_escape_string($con, $_sec);
        $_semes = stripcslashes($_semes);
        $_semes = mysqli_real_escape_string($con, $_semes);
        $sqlchk1 = "select * from takes where id='" . $id . "@iiita.ac.in' and sec_id='$_sec' and course_id='$course' and semester=". (int)$_semes . ";";
        $sqlchk2 = "select * from teaches where id='" . $_SESSION['id'] . "' and course_id='" . $course . "' and semester=" . (int)$_semes . " and sec_id='" . $_sec . "';";
        $resultchk1 = mysqli_query($con, $sqlchk1);
        if (mysqli_num_rows($resultchk1) == 0) {
            echo "<script>alert('The student with the ID, course, section and semester is not alloted to your course! Please check again.');setTimeout(()=>{window.location.replace('../../../html/faculty/add_student/');},700);</script>";
            return;
        }
        $resultchk2 = mysqli_query($con, $sqlchk2);
        if (mysqli_num_rows($resultchk2) == 0) {
            echo "<script>alert('You dont currently teach this course!\\nPlease check the semester or section');setTimeout(()=>{window.location.replace('../../../html/faculty/add_student/');},700);</script>";
            return;
        }
        $sql = $sql . " where id='" . $id . "@iiita.ac.in' and course_id='" . $course . "' and sec_id='" . $_sec . "' and semester=" . (int)$_semes . ";";
        // echo($sql);
        if($con->query($sql)==TRUE) {
                mysqli_commit($con);
                echo "<script>alert('Success!');setTimeout(()=>{window.location.replace('../../../html/faculty/add_student/');},700);</script>";
        }
        else {
            echo "<script>alert('Erroreneous operation!');setTimeout(()=>{window.location.replace('../../../html/faculty/add_student/');},700);</script>";
        }
    } else {
        $arr = json_decode($_POST['file_data2']);
        $course = $_POST['course2'];
        $_sec = $_POST['sec2'];
        $_semes = $_POST['semes2'];
        $id = stripcslashes($id);
        $id = mysqli_real_escape_string($con, $id);
        $course = stripcslashes($course);
        $course = mysqli_real_escape_string($con, $course);
        $_sec = stripcslashes($_sec);
        $_sec = mysqli_real_escape_string($con, $_sec);
        $_semes = stripcslashes($_semes);
        $_semes = mysqli_real_escape_string($con, $_semes);
        $sqlchk2 = "select * from teaches where id='" . $_SESSION['id'] . "' and course_id='" . $course . "' and semester=" . (int)$_semes . " and sec_id='" . $_sec . "';";
        $resultchk2 = mysqli_query($con, $sqlchk2);
        if (mysqli_num_rows($resultchk2) == 0) {
            echo "<script>alert('You dont currently teach this course!\\nPlease check the semester or section and submit the sheet again');setTimeout(()=>{window.location.replace('../../../html/faculty/add_student/');},700);</script>";
            return;
        }
        foreach ($arr as $row => $val) {
            $val = json_decode(json_encode($val), true);
            $id = $val['Roll Number'] . '@iiita.ac.in';
            $id = stripcslashes($id);
            $id = mysqli_real_escape_string($con, $id);
            $sqlchk1 = "select * from takes where id='" . $id . "' and sec_id='$_sec' and course_id='$course' and semester=". (int)$_semes . ";";
            $resultchk1 = mysqli_query($con, $sqlchk1);
            if (mysqli_num_rows($resultchk1) == 0) {
                echo "<script>alert('The student with the ID:$id, course, section and semester is not alloted to your course! Please check and submit the sheet again.');setTimeout(()=>{window.location.replace('../../../html/faculty/add_student/');},700);</script>";
            mysqli_rollback($con);
                return;
            }
            $sql1 = $sql . " where id='" . $id . "' and course_id='" . $course . "' and sec_id='" . $_sec . "' and semester=" . (int)$_semes . ";";
            // $sql1 = $sql . " values ('" . $id . "','" . $course . "','" . $_sec . "'," . (int)$_semes . ");";
            if($con->query($sql1)==TRUE) {
                // mysqli_commit($con);
                // echo "<script>alert('Success!');setTimeout(()=>{window.location.replace('../../../html/faculty/add_student/');},700);</script>";
        }
        else {
            mysqli_rollback($con);
            echo "<script>alert('Erroreneous operation!');setTimeout(()=>{window.location.replace('../../../html/faculty/add_student/');},700);</script>";
        }
        }
        echo "<script>alert('Success!');window.location.replace('../../../html/faculty/add_student/');;</script>";
        mysqli_commit($con);
    }
    ?>
</body>

</html>