<?php
// Database credentials
$host = "localhost"; 
$user = "u616690408_results"; 
$password = "Rrajat@123"; 
$database = "u616690408_results";

// Establish connection
$con = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
} else {
    // echo "Database connected successfully"; // Uncomment for debugging
}
error_reporting(0);
ini_set('display_errors', 0);

?>
