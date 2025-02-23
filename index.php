<?php
error_reporting(0);
    session_start();
    include('includes/dbconnection.php');

    if(isset($_POST['login']))
    {
        $matricNo=$_POST['matricNo'];
        // $password=md5($_POST['password']);
        $password=$_POST['password'];
        $query = mysqli_query($con,"select * from tblstudent where matricNo='$matricNo' && password='$password'");
        $count = mysqli_num_rows($query);
        $row = mysqli_fetch_array($query);

        if($count > 0)
        {
            $_SESSION['matricNo']=$row['matricNo'];
            $_SESSION['firstName']=$row['firstName'];
            $_SESSION['lastName']=$row['lastName'];

            echo "<script type = \"text/javascript\">
                window.location = (\"student/index.php\")
               </script>";  

            if($row['roleId'] == 2){ //if user is Hod
                
                echo "<script type = \"text/javascript\">
               window.location = (\"hod/index.php\")
                 </script>";  
         }
             else if($row['roleId'] == 3){ //if user is Dean
                
               echo "<script type = \"text/javascript\">
             window.location = (\"dean/index.php\")
               </script>";  
             }
        }
        else
        {
            $errorMsg = "<div class='alert alert-danger' role='alert'>Invalid Username/Password!</div>";
        }
    }
  ?>


<!doctype html>
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>I.K.Gujral Punjab Technical University : Results</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/img/loog.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style2.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> 
</head>
<body class="bg-light" style="background-image:url(img/bg.jpg);">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">

        </div>
    </div>
    <div class="login-content">
                <div class="login-logo">
                    <a href="/">
                       <img class="align-content" src="img/logo.png" alt="">
                    </a>
                </div>
        <div class="login-form">
            <form method="Post" Action="">
                    <?php echo $errorMsg; ?>
                <strong><h2 align="center">Student Login</h2></strong><hr>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="matricNo" Required class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" Required class="form-control" placeholder="">
                </div>
                
                </div>
                <br><!-- Log on to codeastro.com for more projects! -->
                <button type="submit" name="login" class="btn btn-success btn-flat m-b-30 m-t-30">Log in</button>
                
            </form>
        </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>
