<?php
session_start();
?>
<!DOCTYPE html>
<html>

<body>
    <?php
//Connect to The Database
require '../../connection.php';

//The session has expired, more than 30 minutes spent by the student on the portal.
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    //Destroy the session, redirect to home page.
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
    //If the user does not have access to this page,redirect to home page.
    echo "<script> alert('You are not authorised to this page'); window.location.replace('../../../')</script>";
}?>
    <?php

//Get the option from the name.
function getoption($value)
{
    return (int) substr($value, 6);
}

require '../../gen_id.php';
try {
    $anon_id = $_SESSION['username'];
    $course_id = $_POST['course_id'];
    $sec_id = $_POST['sec_id'];
    $semester = $_POST['semester'];
    $rating = $_POST['rating'];
    $assignment = getoption($_POST['inlineRadioOptions1']);
    $evaluations = getoption($_POST['inlineRadioOptions2']);
    $exam = getoption($_POST['inlineRadioOptions3']);
    $comment = $_POST['comment'];

    //to prevent from mysqli injection, strip slasjes
    $anon_id = stripcslashes($anon_id);
    $sec_id = stripcslashes($sec_id);
    $course_id = stripcslashes($course_id);
    $semester = stripcslashes($semester);
    $rating = stripcslashes($rating);
    $assignment = stripcslashes($assignment);
    $evaluations = stripcslashes($evaluations);
    $exam = stripcslashes($exam);
    $comment = stripcslashes($comment);

    $anon_id = mysqli_real_escape_string($con, $anon_id);
    $sec_id = mysqli_real_escape_string($con, $sec_id);
    $semester = mysqli_real_escape_string($con, $semester);
    $course_id = mysqli_real_escape_string($con, $course_id);
    $rating = mysqli_real_escape_string($con, $rating);
    $assignment = mysqli_real_escape_string($con, $assignment);
    $evaluations = mysqli_real_escape_string($con, $evaluations);
    $exam = mysqli_real_escape_string($con, $exam);
    $comment = mysqli_real_escape_string($con, $comment);

    //Check if the user does not study this course.
    $sqlcheck = "select * from p1_takes where id='" . $_SESSION['id'] . "' and course_id='$course_id' and sec_id='$sec_id' and semester='$semester';";
    $result = mysqli_query($con, $sqlcheck);
    if (mysqli_num_rows($result) == 0) {
        echo "<script>alert('No such course exists for you');</script>";
        return;
    }

    //Check if student already gave feedback.
    $sqlcheck = "select * from (select * from p1_gives where anon_id='" . $anon_id . "')e1 natural join p1_feedback where course_id in ('" . $course_id . "')";
    $result = mysqli_query($con, $sqlcheck);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('You have Already given feedback for this course.');</script>";
        return;
    }

    //Generate uniqure feedbackID for every feedback.
    $feedback_id = gen_feedbackid();
    while (mysqli_num_rows(mysqli_query($con, "select * from p1_feedback where feedback_id='$feedback_id';"))) {
        $feedback_id = gen_feedbackid();
    }

    //Insert the values into feedback, then into gives table.
    $sql = "insert into p1_feedback values('$feedback_id','$course_id','$sec_id','$semester','$rating','$assignment','$evaluations','$exam','$comment');";
    try {
        $result = mysqli_query($con, $sql);
        if ($result) {
            $sql = "insert into p1_gives values('$anon_id','$feedback_id',0);";
            $result = mysqli_query($con, $sql);
            if ($result) {
                echo "<script>alert('Success!');setTimeout(()=>{window.location.replace('../../../html/student/');},70);</script>", mysqli_commit(($con));
            } else {
                //rollback on failure.
                mysqli_rollback($con);
                echo '<script>alert("There was some error ");setTimeout(()=>{window.location.replace("../../../html/student/");},70);</script>';
                return;
            }
        } else {
            echo '<script>alert("There was some error ");setTimeout(()=>{window.location.replace("../../../html/student/");},70);</script>';
        }

    } catch (mysqli_sql_exception $e) {
        mysqli_rollback($con);
        echo "<script>alert('$e');</script>";
        echo "<script>alert('Erroreneous entry of data!');setTimeout(()=>{window.location.replace('../../../html/student/');},70);</script>";
    }
} catch (Exception $e) {
    echo "<script>alert('There has been some error on this page, please contact administrator!');window.location.replace('../../../html/student/');</script>";
}
?>
</body>

</html>