<?php
$host = "localhost";
$user = "fcsldba";
$password = "Junaid_123";
$db_name = "fcsldb";
try{
    $con = mysqli_connect($host, $user, $password, $db_name);
    $id = "admin@iiita.ac.in";
    $password = "IamAdminrandomsalt";
    $password = hash('ripemd160', $password);
    $password = mysqli_real_escape_string($con, $password);
    $sql = "insert into p1_admin values ('$id','$password')";
    $result = mysqli_query($con, $sql);
}catch(Exception $e){
    echo "<script>alert('There has been some error on this page, please contact administrator!');window.location.replace('../');</script>";
}
if (mysqli_connect_errno()) {
    die("Failed to connect");
}
