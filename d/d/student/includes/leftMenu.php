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

<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="menu-title"><?php echo htmlspecialchars($fullName); ?></li>
                
                <li class="<?php if(isset($page) && $page=='dashboard'){ echo 'active'; }?>">
                    <a href="index.php"><i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                </li>
                
                <li class="menu-item-has-children dropdown <?php if(isset($page) && $page=='courses'){ echo 'active'; }?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                        <i class="menu-icon fa fa-book"></i>Courses
                    </a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-eye"></i><a href="studentCourses.php">View Courses</a></li>
                    </ul>
                </li>

                <li class="menu-item-has-children dropdown <?php if(isset($page) && $page=='result'){ echo 'active'; }?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                        <i class="menu-icon fa fa-file"></i>Result
                    </a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-eye"></i> <a href="studentResult.php"> View Result</a></li>
                        <li><i class="fa fa-eye"></i> <a href="viewFinalResult.php"> Final Result</a></li>
                        <li><i class="fa fa-eye"></i> <a href="gradingCriteria.php"> Grading Criteria</a></li>
                    </ul>
                </li>

                <li class="menu-item-has-children dropdown <?php if(isset($page) && $page=='profile'){ echo 'active'; }?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                        <i class="menu-icon fa fa-user"></i>Profile
                    </a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-user-circle"></i><a href="updateProfile.php"> Update Profile</a></li>
                    </ul>
                </li>

                <li>
                    <a href="logout.php"> <i class="menu-icon fa fa-power-off"></i>Logout </a>
                </li>
                   <li><div> <img src="/img/Capture.PNG" style="border-radius:50%;"> </div>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
