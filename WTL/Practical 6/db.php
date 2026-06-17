<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'employee_crud';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_errno) {
    die('Database connection failed: ' . $mysqli->connect_error);
}

?>
