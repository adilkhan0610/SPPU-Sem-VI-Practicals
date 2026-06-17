<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employee_db";

$conn = new mysqli(
    $servername,
    $username,
    $password,
    $dbname
);

if ($conn->connect_error) {

    header('Content-Type: application/json');

    die(
        json_encode([
            'success' => false,
            'error' => 'Database connection failed: ' .
                       $conn->connect_error
        ])
    );
}

?>
