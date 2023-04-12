<?php
require('gen_id.php');
session_start();
session_destroy();
$_SESSION = array();
header("location: ../");
erase_cookies();
