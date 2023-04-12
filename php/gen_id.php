<?php
function gen_id()
{
    $id = hash('sha512', "Salting randomly" . time() . "salting randomly" . time());
    $id = substr(base_convert($id, 16, 10), 0, 16);
    return $id;
}
function gen_pas()
{
    require('connection.php');
    $password = substr(bin2hex(random_bytes(64)), 0, 10);
    $password = stripcslashes($password);
    $password = mysqli_real_escape_string($con, $password);
    return $password;
}
function erase_cookies()
{
    if (isset($_COOKIE)) {
        foreach ($_COOKIE as $name => $value) {
            setcookie($name, '', 1);
            setcookie($name, '', 1, '/');
        }
    }
}
function gen_feedbackid()
{
    $id = hash('sha512', "Salting randomly" . time() . "salting randomly"  . time());
    $id = substr(base_convert($id, 16, 10), 0, 40);
    return $id;
}
