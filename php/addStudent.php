<?php
$host = "localhost";
$user = "root";
$password = "rajat397";
$db_name = "feedback_management_grp1";

$con = mysqli_connect($host, $user, $password, $db_name);
$id = "iit2021109@iiita.ac.in";
$password = "IamRajatrandomsalt";
$password = hash('ripemd128', $password);
$password = mysqli_real_escape_string($con, $password);
$sql = "insert into student values ('$id','$password','Rajat','IT')";
$result = mysqli_query($con, $sql);
if (mysqli_connect_errno()) {
    die("Failed to connect");
}
