<?php
session_start();
?>
    <?php
require_once '../../connection.php';
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
    echo "
        function logout() {
            alert('You have been logged in for more than 30 minutes, Timeout!');
            window.location.replace('../../../');
        };
        logout();
        ";
    return;
}
?>
    <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['userid'] != 'student') {
    echo "alert('You are not authorised to this page'); window.location.replace('../../../')";
}?>
    <?php
try {
    $anon_id = $_SESSION['username'];
    $feedback_id = $_POST['feedbackId'];
    $anon_id = stripcslashes($anon_id);
    $feedback_id = stripcslashes($feedback_id);

    $anon_id = mysqli_real_escape_string($con, $anon_id);
    $feedback_id = mysqli_real_escape_string($con, $feedback_id);

    $sqlcheck = "select * from p1_gives where anon_id='$anon_id' and feedback_id='$feedback_id';";
    $result = mysqli_query($con, $sqlcheck);
    if (mysqli_num_rows($result) == 0) {
        echo "alert('No such feedback exists by you. Please try again');";
        return;
    }
    $sql = "update p1_gives set freeze=1 where feedback_id='$feedback_id' and anon_id='$anon_id';";
    try {
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo "document.getElementById('delete').disabled=true; document.getElementById('freeze').disabled=true;document.getElementById('freeze').textContent='Frozen';alert('Success');
";
        } else {
            echo 'alert("There was some error please try again");setTimeout(()=>{window.location.replace("../../../html/student/");},70);';
        }

    } catch (mysqli_sql_exception $e) {
        echo "alert('$e');";
        echo "alert('Erroreneous entry of data!');setTimeout(()=>{window.location.replace('../../../html/student/');},70);";
    }
} catch (Exception $e) {
    echo "alert('There has been some error on this page, please contact administrator!');window.location.replace('../../../html/student/');";
}
?>