<?php
$host = "localhost";
$user = "root";
$password = "12345";
$db_name = "feedback_management_grp1";
try{
    $con = mysqli_connect($host, $user, $password, $db_name);
    $id = "admin@iiita.ac.in";
    $password = "IamAdminrandomsalt";
    $password = hash('ripemd160', $password);
    $password = mysqli_real_escape_string($con, $password);
    $sql = "insert into admin values ('$id','$password')";
    $result = mysqli_query($con, $sql);
}catch(Exception $e){
    echo "<script>alert('There has been some error on this page, please contact administrator!');window.location.replace('../');</script>";
}
if (mysqli_connect_errno()) {
    die("Failed to connect");
}
