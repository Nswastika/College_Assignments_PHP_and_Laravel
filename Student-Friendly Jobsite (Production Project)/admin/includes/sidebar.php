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
                        <div class="font-strong"><?php echo $name?></div><small>Admin</small></div>
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
                            <a href="category.php"><i class="sidebar-item-icon fa fa-edit"></i>
                                <span class="nav-label">Job Category</span>
                            </a>
                        </li>
                        <li>
                            <a href="manage_students.php"><i class="sidebar-item-icon fa fa-graduation-cap"></i></i></i>
                                <span class="nav-label">Students</span>
                            </a>
                        </li>
                        <li>
                            <a href="manage_employers.php"><i class="sidebar-item-icon fa fa-building"></i>
                                <span class="nav-label">Employers</span>
                            </a>
                        </li>
                        <li>
                            <a href="job.php"><i class="sidebar-item-icon ti-bookmark"></i>
                                <span class="nav-label">Jobs</span>
                            </a>
                        </li>
                        <li>
                            <a href="applied_jobs.php"><i class="sidebar-item-icon fa fa-copy"></i>
                                <span class="nav-label">Applications</span>
                            </a>
                        </li>
                        <li>
                            <a href="advice.php"><i class="sidebar-item-icon ti-write"></i>
                                <span class="nav-label">Advices</span>
                            </a>
                        </li>
                        <li>
                            <a href="success_story.php"><i class="sidebar-item-icon fa fa-users"></i>
                                <span class="nav-label">Success Stories</span>
                            </a>
                        </li>    
                    </ul>
            </div>
            
        </nav>
        <!-- END SIDEBAR-->