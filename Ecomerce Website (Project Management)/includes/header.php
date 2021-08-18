<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Cleckhuddersfax E-Convenient Store</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="image/logo/favicon.png">
        <!-- all css here -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">          
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <link rel="stylesheet" href="assets/css/animate.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/themify-icons.css">
        <link rel="stylesheet" href="assets/css/pe-icon-7-stroke.css">
        <link rel="stylesheet" href="assets/css/icofont.css">
        <link rel="stylesheet" href="assets/css/meanmenu.min.css">
        <link rel="stylesheet" href="assets/css/bundle.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!-- header start -->
        <header>
            <div class="header-top-furniture wrapper-padding-2 res-header-sm">
                <div class="container-fluid">
                    <div class="header-bottom-wrapper">
                        <div class="logo-2 furniture-logo ptb-30">
                            <a href="index.php">
                                <img src="image/logo/logo.png" alt="" width="100%">
                            </a>
                        </div>
                        <div class="menu-style-2 furniture-menu menu-hover">
                            <nav>
                                <ul>
                                    <li><a href="index.php">home</a></li>
                                    <li><a href="shop.php">shop</a></li>
                                    <li><a href="cart_view.php">cart</a></li>
                                    <li><a href="about-us.php">About Us</a></li>
                                    <li><a href="contact.php">contact</a></li>
                                    <li><a href="faq.php">FAQ</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="header-cart">
                            <a class="icon-cart-furniture" href="cart_view.php">
                                <img src="image/misc/cart.png">
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mobile-menu-area d-md-block col-md-12 col-lg-12 col-12 d-lg-none d-xl-none" style="margin-top:-4%">
                            <div class="mobile-menu">
                                <nav id="mobile-menu-active">
                                    <ul>
                                        <li><a href="index.php">home</a></li>
                                        <li><a href="shop.php">shop</a></li>
                                        <li><a href="cart_view.php">cart</a></li>
                                        <li><a href="about-us.php">About Us</a></li>
                                        <li><a href="contact.php">contact</a></li>
                                        <li><a href="faq.php">FAQ</a></li>
                                    </ul>
                                </nav>                          
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom-furniture wrapper-padding-2 border-top-3">
                <div class="container-fluid">
                    <div class="furniture-bottom-wrapper">
                        <div class="furniture-login">
                            <?php
                            if(!isset($_SESSION['USER_ID'])){
                            ?>
                                <ul>
                                    <li>Get Access: <a href="login.php">Login </a></li>
                                    <li><a href="register.php">Register </a></li>
                                </ul>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="furniture-search">
                            <form action="shop.php" method="GET">
                                <input name="query" placeholder="I am Searching for . . ." type="text">
                                <button type="submit" value="search">
                                    <i class="ti-search"></i>
                                </button>
                            </form>
                        </div>
                        <div class="furniture-wishlist">
                            <ul>
                                <li>
                                    <?php
                                        if(isset($_SESSION['USER_ID'])){
                                            include 'includes/connect.php';
                                            $USERID = $_SESSION['USER_ID'];
                                            $qry = "SELECT * FROM USERS WHERE USER_ID=$USERID";
                                            $stid = oci_parse($conn, $qry);
                                            oci_execute($stid);
                                            $user = oci_fetch_assoc($stid);
                                            $image = $user['USER_IMAGE'];
                                            if ($image == 'image/') {
                                                
                                                $image = "images/profile.jpg";
                                            }
                                            else {
                                                $image = $user['USER_IMAGE'];
                                            }
                                            echo '
                                                <div class="header-cart">
                                                    <a>'.$user['USER_FIRST_NAME'].' '.$user['USER_LAST_NAME'].'</a>
                                                    <ul class="cart-dropdown">
                                                        <li class="single-product-cart">
                                                            <div class="cart-img">
                                                                <img src="'.$image.'" alt="" width="100%">
                                                            </div>
                                                            <div class="cart-title">
                                                                <h5>'.$user['USER_FIRST_NAME'].' '.$user['USER_LAST_NAME'].'</h5>
                                                                <h6>Member since '.date('M. Y', strtotime($user['USER_CREATED_AT'])).'</h6>
                                                            </div>
                                                        </li>
                                                        <li class="cart-btn-wrapper">
                                                            <a class="default-btn btn-hover cart-btn" value="Profile" href="profile.php">Profile</a>
                                                            <a class="default-btn btn-hover cart-btn" value="Logout" href="logout.php">Logout</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            ';
                                        }
                                        else{
                                            echo "<li><a href='login.php'>My Account</a></li>";
                                        }
                                    ?>
                                </li>
                            </ul>
                        </div>
                       
                    </div>
                </div>
            </div>
            <div class="header-bottom-furniture wrapper-padding-2 border-top-3"></div>
        </header>
        <!-- header end -->