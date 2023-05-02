<?php
session_start();
?>
<!DOCTYPE html>
<html>

<body>
    <?php
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
        return;
    }
    ?>
    <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['userid'] != 'admin') : echo "<script> alert('You are not authorised to this page'); window.location.replace('../../../')</script>";
    endif; ?>
    <?php
    require('../../connection.php');
    try{
        $sql = "delete from student";
        if (isset($_POST['ID'])) {
            $id = $_POST['ID'];
            $id = stripcslashes($id);
            $id = mysqli_real_escape_string($con, $id);
            $sql = $sql . " where id ='" . $id . "@iiita.ac.in'";
            try {
                $result = mysqli_query($con, $sql);
                if ($result) {
                    mysqli_commit($con);
                    echo "<script>alert('Success!');setTimeout(()=>{window.location.replace('../../../html/admin/drop_add_student/');},700);</script>";
                }
            } catch (mysqli_sql_exception $e) {
                echo "<script>alert('Erroreneous operation!');setTimeout(()=>{window.location.replace('../../../html/admin/drop_add_student/');},700);</script>";
            }
        } else if (isset($_POST['all'])) {
            try {
                $result = mysqli_query($con, $sql);
                if ($result) {
                    mysqli_commit($con);
                    echo "<script>alert('Success!');setTimeout(()=>{window.location.replace('../../../html/admin/drop_add_student/');},700);</script>";
                }
            } catch (mysqli_sql_exception $e) {
                echo "<script>alert('Erroreneous operation!');setTimeout(()=>{window.location.replace('../../../html/admin/drop_add_student//');},700);</script>";
            }
        } else {
            $arr = json_decode($_POST['file_data1']);
            mysqli_commit($con);
            foreach ($arr as $row => $val) {
                $val = json_decode(json_encode($val), true);
                $id = $val['Roll Number'] . "@iiita.ac.in";
                $id = stripcslashes($id);
                $id = mysqli_real_escape_string($con, $id);
                $sql1 = $sql . " where id ='" . $id . "'";
                try {
                    $result = mysqli_query($con, $sql1);
                    if ($result) {;
                    }
                } catch (mysqli_sql_exception $e) {
                    mysqli_rollback($con);
                    echo "<script>alert('Erroreneous operation!');window.location.replace('../../../html/admin/drop_add_student/');;</script>";
                }
            }
            mysqli_commit($con);
            echo "<script>alert('Success!');setTimeout(()=>{window.location.replace('../../../html/admin/drop_add_student/');},700);</script>";
        }
    }catch(Exception $e){
        echo "<script>alert('There has been some error on this page, please contact administrator!');window.location.replace('../../../html/admin/drop_add_student/');</script>";
    }
    ?>
</body>

</html>