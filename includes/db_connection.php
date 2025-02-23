<?php
$host = 'localhost';
$user = 'u616690408_results1';
$password = 'Rrajat#1234';
$dbname = 'u616690408_results1';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>