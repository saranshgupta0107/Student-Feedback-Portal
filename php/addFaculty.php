<?php
$host = "localhost";
$user = "root";
$password = "12345";
$db_name = "feedback_management_grp1";

$con = mysqli_connect($host, $user, $password, $db_name);
$id = "maity@iiita.ac.in";
$password = "IamMaityrandomsalt";
$password = hash('ripemd128', $password);
$password = mysqli_real_escape_string($con, $password);
$sql = "insert into instructor values ('$id','$password','Maity','IT')";
$result = mysqli_query($con, $sql);
if (mysqli_connect_errno()) {
    die("Failed to connect");
}
