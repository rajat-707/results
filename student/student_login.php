<?php
session_start();
include 'includes/db_connection.php';

if (isset($_POST['login'])) {
    $roll_number = $_POST['roll_number'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM results WHERE roll_number='$roll_number' AND password='$password'");

    if ($result->num_rows > 0) {
        $_SESSION['student'] = $roll_number;
        header("Location: student/student_result.php");
        exit();
    } else {
        echo "Invalid credentials";
    }
}

if (!isset($_SESSION['student'])) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>


    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>    .md\:w-1\/2 {
        width: 40%;
    }
    .shadow-lg{
        --tw-shadow: none!important; 
    --tw-shadow-colored: none!important; 
     box-shadow:none!important;

    }
    body.flex.flex-col.md\:flex-row.bg-white.shadow-lg.rounded-lg.overflow-hidden {
        height: 600px;
    }
    </style>
</head>

<body class="flex flex-col md:flex-row bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="md:w-1/2">
            <img alt="University building with students sitting on the lawn" class="w-full h-full object-cover"
                height="400"
                src="includes/images/bg.jpg"
                width="600" />
        </div>
        <div class="md:w-1/2 p-8">
            <div class="flex flex-col items-center">
                <img alt="University logo" class="w-24 h-24 mb-4" height="100"
                    src="includes/images/download.gif"
                    width="100" />
                <h2>Student Login</h2>
                <form class="w-full" action="" method="POST">
                    <div class="mb-4">
                       
                        <input
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                            type="text" name="roll_number" placeholder="Roll Number" required><br>
                    </div>
                    <div class="mb-4">
                        <input
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                            type="password" name="password" placeholder="Password" required><br>
</div>
                            <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700"
                                type="submit" name="login">SIGN IN</button>
                            <div class="flex justify-between items-center mb-4">
                                <a class="text-blue-600 hover:underline" href="#">
                                    Reset Password
                                </a>
                            </div>
                            <div class="flex justify-center">
                                <button class="bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700"
                                    type="button">
                                    ANNOUCEMENTS
                                </button>
                            </div>
                </form>
                <p class="text-gray-500 text-sm mt-6">
                    Copyright © IK Gujral Punjab Technical University 2025.
                </p>
            </div>
        </div>
</body>

</html>
<?php
    exit();
}
?>