<?php
session_start();
?>
<!DOCTYPE html>
<html>

<body>
    <?php
    require('../connection.php');
    $username = $_POST['email'];
    $password = $_POST['pass'];
    //to prevent from mysqli injection  
    $username = stripcslashes($username);
    $password = stripcslashes($password);
    $password = $password . "randomsalt";
    $password = hash('ripemd128', $password);
    $username = mysqli_real_escape_string($con, $username);
    $password = mysqli_real_escape_string($con, $password);
    $sql = "select *from instructor where id = '$username' and password = '$password'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        $_SESSION['loggedin'] = true;
        $_SESSION['userid'] = "faculty";
        $_SESSION['LAST_ACTIVITY'] = time();
        $_SESSION['id'] = $username;
        echo '<script>
                setTimeout(()=>{window.location.replace("../../html/faculty/");},1000);
                </script>';
        exit;
    } else
        echo '<script>alert("Username and password does not match");setTimeout(()=>{window.location.replace("../../");},700);</script>';
    ?>
</body>

</html>