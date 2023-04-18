<?php
session_start();
    $otp = $_POST['otp'];
    //to prevent from mysqli injection  
    $otp = stripcslashes($otp);
    $otptoverify=$_SESSION['otp'];
    if ($otp==$otptoverify) {
        $_SESSION['verified']=TRUE;
            echo "<script>alert('OTP Verfied');setTimeout(()=>{window.location.replace('../../html/faculty/new_password.php');},0);</script>";
            exit;
    }
     else
        echo '<script>alert("OTP does not match");setTimeout(()=>{window.location.replace("../../");},700);</script>';
