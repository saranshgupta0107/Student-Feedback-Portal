<?php
session_start();
    require('../connection.php');
    $pass = $_POST['password'];
    $pass = stripcslashes($pass);
    $pass = $pass . "randomsalt";
    $pass = hash('ripemd160', $pass);
    $pass= mysqli_real_escape_string($con, $pass);
    $email=$_SESSION['email'];
    $sql = "UPDATE student SET password='$pass' WHERE id='$email'";
    if ($con->query($sql) == TRUE) {
        echo "<script>
                alert('PASSWORD HAS BEEN SUCCESSFULLY UPDATED');setTimeout(()=>{window.location.replace('../../');},1000);
                </script>";
        exit;
    } else
        echo '<script>alert("Email does not match");setTimeout(()=>{window.location.replace("../../");},700);</script>';
    ?>
</body>