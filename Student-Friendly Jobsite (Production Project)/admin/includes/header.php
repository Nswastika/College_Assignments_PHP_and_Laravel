<?php
session_start();
if(isset($_SESSION['user_id']) && $_SESSION['user_type'] = "Admin"){
  $user_id = $_SESSION['user_id'];    
}
else{
  header('location:../login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="./assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="./assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="./assets/vendors/DataTables/datatables.min.css" rel="stylesheet" />
    <link href="./assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="./assets/css/main.min.css" rel="stylesheet" />
    
    <!-- PAGE LEVEL STYLES-->
</head>
<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <header class="header">
            <div class="page-brand">
                <a class="link" href="index.html">
                    <span class="brand">Job4Students (<p>J<SUB>4</SUB>S</p>)
                        <span class="brand-tip"></span>
                    </span>
                   
                </a>
            </div>
            <div class="flexbox flex-1">
                <!-- START TOP-LEFT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li>
                        <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
                    </li>
                    <li>       
                    </li>
                </ul>
                <!-- END TOP-LEFT TOOLBAR-->
                <!-- START TOP-RIGHT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                   <li class="dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                        <?php
                            if(isset($_SESSION['user_id'])){
                                include 'connection.php';
                                $conn = mysqli_connect("localhost","root");
                                $qry = mysqli_select_db($conn, 'Students_Jobsite');
                                $user_id = $_SESSION['user_id'];
                                $qry = "SELECT * FROM users WHERE user_id=$user_id";
                                $stid = mysqli_query($conn, $qry);
                                $user = mysqli_fetch_assoc($stid);
                                $image = $user['user_image'];
                                echo '
                                    <img src="../'.$image.'"/>
                                ';
                            }
                        ?>
                        <span></span>Admin<i class="fa fa-angle-down m-l-5"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="user.php"><i class="fa fa-user"></i>Profile</a>
                            <li class="dropdown-divider"></li>
                            <a class="dropdown-item" href="destroy.php"><i class="fa fa-power-off"></i>Logout</a>
                        </ul>
                    </li>
                </ul>
                <!-- END TOP-RIGHT TOOLBAR-->
            </div>
        </header>