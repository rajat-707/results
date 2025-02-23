<?php
// Start session to retrieve stored matric number
session_start();
include("db_connection.php"); // Ensure this file connects to your database

// Check if the matric number is set in session
if (isset($_SESSION['matricNo'])) {
    $matricNo = $_SESSION['matricNo'];
} else {
    die("Error: Matric Number not found. Please log in.");
}

// Fetch student data from the database
$query = mysqli_query($con, "SELECT * FROM tblstudent WHERE matricNo='$matricNo'");

// Ensure query is successful and has a result
if (!$query || mysqli_num_rows($query) == 0) {
    die("Error: No student found with the provided Matric Number.");
}

$row = mysqli_fetch_array($query);

// Ensure data is set before accessing it
$fullName = isset($row['firstName']) ? $row['firstName'] . ' ' . $row['lastName'] : "Unknown Student";
$departmentId = isset($row['departmentId']) ? $row['departmentId'] : null;
$facultyId = isset($row['facultyId']) ? $row['facultyId'] : null;
$levelId = isset($row['levelId']) ? $row['levelId'] : null;
?>
<title><?php echo htmlspecialchars($fullName); ?></title>
