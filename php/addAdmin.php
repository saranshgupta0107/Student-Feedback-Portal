<?php
$host = "localhost";
$user = "root";
$password = "ishaan930838";
$db_name = "feedback_management_grp1";

$con = mysqli_connect($host, $user, $password, $db_name);
$id = "admin@iiita.ac.in";
$password = "IamAdminrandomsalt";
$password = hash('ripemd128', $password);
$password = mysqli_real_escape_string($con, $password);
$sql = "insert into admin values ('$id','$password')";
$result = mysqli_query($con, $sql);
if (mysqli_connect_errno()) {
    die("Failed to connect");
}
