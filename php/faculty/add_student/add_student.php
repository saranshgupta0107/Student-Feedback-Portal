<?php
session_start();
?>
<!DOCTYPE html>
<html>

<body>
    <?php
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
    }
    ?>
    <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['userid'] != 'faculty') : echo "<script> alert('You are not authorised to this page'); window.location.replace('../../../')</script>";
    endif; ?>
    <?php
    require('../../connection.php');
    $sql = "insert into takes";
    if (isset($_POST['ID'])) {
        $id = $_POST['ID'];
        $course = $_POST['course'];
        $_sec = $_POST['sec'];
        $_semes = $_POST['semes'];
        $id = stripcslashes($id);
        $id = mysqli_real_escape_string($con, $id);
        $course = stripcslashes($course);
        $course = mysqli_real_escape_string($con, $course);
        $_sec = stripcslashes($_sec);
        $_sec = mysqli_real_escape_string($con, $_sec);
        $_semes = stripcslashes($_semes);
        $_semes = mysqli_real_escape_string($con, $_semes);
        $sqlchk1 = "select * from student where id='" . $id . "@iiita.ac.in';";
        $sqlchk2 = "select * from teaches where id='" . $_SESSION['id'] . "' and course_id='" . $course . "' and semester=" . (int)$_semes . " and sec_id='" . $_sec . "';";
        $resultchk1 = mysqli_query($con, $sqlchk1);
        if (mysqli_num_rows($resultchk1) == 0) {
            echo "<script>alert('The student with the name and id is not present in the database!');setTimeout(()=>{window.location.replace('../../../html/faculty/add_student/');},700);</script>";
            return;
        }
        $resultchk2 = mysqli_query($con, $sqlchk2);
        if (mysqli_num_rows($resultchk2) == 0) {
            echo "<script>alert('You dont currently teach this course!\nPlease check the semester or section');setTimeout(()=>{window.location.replace('../../../html/faculty/add_student/');},700);</script>";
            return;
        }
        $sql = $sql . " values ('" . $id . "@iiita.ac.in','" . $course . "','" . $_sec . "'," . (int)$_semes . ");";
        // echo($sql);
        try {
            $result = mysqli_query($con, $sql);
            if ($result) {
                mysqli_commit($con);
                echo "<script>alert('Success!');setTimeout(()=>{window.location.replace('../../../html/faculty/add_student/');},700);</script>";
            }
        } catch (mysqli_sql_exception $e) {
            // echo "<script>alert('Erroreneous operation!');setTimeout(()=>{window.location.replace('../../../html/faculty/add_student/');},700);</script>";
        }
    } else {
        $arr = json_decode($_POST['file_data']);
        $course = $_POST['course'];
        $_sec = $_POST['sec'];
        $_semes = $_POST['semes'];
        $course = stripcslashes($course);
        $course = mysqli_real_escape_string($con, $course);
        $_sec = stripcslashes($_sec);
        $_sec = mysqli_real_escape_string($con, $_sec);
        $_semes = stripcslashes($_semes);
        $_semes = mysqli_real_escape_string($con, $_semes);
        foreach ($arr as $row => $val) {
            $val = json_decode(json_encode($val), true);
            $id = $val['Roll Number'];
            $id = stripcslashes($id);
            $id = mysqli_real_escape_string($con, $id);
            $sqlchk1 = "select * from student where id='" . $id . "';";
            $sqlchk2 = "select * from teaches where id='" . $_SESSION['id'] . "' and course_id='" . $course . "' and semester=" . (int)$_semes . " and sec_id='" . $_sec . "';";
            $resultchk1 = mysqli_query($con, $sqlchk1);
            if (mysqli_num_rows($resultchk1) == 0) {
                echo "<script>alert('The student with the id:$id is not present in the database!');setTimeout(()=>{window.location.replace('../../../html/faculty/add_student/');},700);</script>";
                mysqli_rollback($con);
                return;
            }
            $resultchk2 = mysqli_query($con, $sqlchk2);
            if (mysqli_num_rows($resultchk2) == 0) {
                echo "<script>alert('You dont currently teach this course!\nPlease check the semester or section');setTimeout(()=>{window.location.replace('../../../html/faculty/add_student/');},700);</script>";
                mysqli_rollback($con);
                return;
            }
            $sql = $sql . " values ('" . $id . "','" . $course . "','" . $_sec . "'," . (int)$_semes . ");";
            try {
                $result = mysqli_query($con, $sql);
                if ($result) {
                    mysqli_commit($con);
                    echo "<script>alert('Success!');setTimeout(()=>{window.location.replace('../../../html/faculty/add_student/');},700);</script>";
                }
            } catch (mysqli_sql_exception $e) {
                mysqli_rollback($con);
                echo "<script>alert('Erroreneous operation!');window.location.replace('../../../html/faculty/add_student/');;</script>";
                return;
            }
        }
    }
    ?>
</body>

</html>