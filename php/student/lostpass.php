<?php
session_start();
    require('../connection.php');
    require_once('../gen_id.php');
    require_once('../lostpass.php');
    $username = $_POST['email'];
    //to prevent from mysqli injection  
    $username = stripcslashes($username);
    $sql = "select * from student where id = '$username'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        $otp = gen_pas();
        if (!sendPassword($username, $otp)) {
            echo "<script>alert('some error occured while mailing');setTimeout(()=>{window.location.replace('../../');},0);</script>";
            exit;
        }
        $_SESSION['otp']=$otp;
        $_SESSION['email']=$username;
        $_SESSION['sentmail']=TRUE;
        echo "<script>
                alert('OTP has been sent to mail please verify the otp');setTimeout(()=>{window.location.replace('../../html/student/verifyotp.php');},1000);
                </script>";
        exit;
    } else
        echo '<script>alert("Email does not match");setTimeout(()=>{window.location.replace("../../");},700);</script>';
    ?>
</body>