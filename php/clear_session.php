<?php 
session_start();
session_destroy();
$_SESSION = array();
$_SESSION['userid']=-1;
?>