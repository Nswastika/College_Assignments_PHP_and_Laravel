<!-- START SIDEBAR-->
<nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <div>
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
                                $name = $user['user_first_name'];?>
                                <img src="../<?php echo $image?>" width="45px" />                      
                    </div>
                    <div class="admin-info">
                        <div class="font-strong"><?php echo $name?></div><small>Employer</small></div>
                    </div>
                    <?php } ?>
                    <ul class="side-menu metismenu">
                        <li>
                            <a class="active" href="home.php"><i class="sidebar-item-icon fa fa-th-large"></i>
                                <span class="nav-label">Dashboard</span>
                            </a>
                        </li>
                        <li class="heading">FEATURES</li>
                        <li>
                            <a href="send_notifications.php"><i class="sidebar-item-icon fa fa-graduation-cap"></i></i></i>
                                <span class="nav-label">Students</span>
                            </a>
                        </li>
                        <li>
                            <a href="job.php"><i class="sidebar-item-icon ti-bookmark"></i>
                                <span class="nav-label">Jobs</span>
                            </a>
                        </li>
                        <li>
                            <a href="resume_manage.php"><i class="sidebar-item-icon fa fa-copy"></i>
                                <span class="nav-label">Applications</span>
                            </a>
                        </li>
                        <li>
                            <a href="message_manage.php"><i class="sidebar-item-icon fa fa-comment"></i>
                                <span class="nav-label">Messages</span>
                            </a>
                        </li>
                        <li>
                       
                    
                    </ul>
            </div>
            
        </nav>
        <!-- END SIDEBAR-->