<?php
  include 'includes/header.php';
  include 'includes/sidebar.php';
  include ('../includes/connection.php');
?>
        
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-success color-white widget-stat">
                            <div class="ibox-body">
                                <?php              
                                    $conn = mysqli_connect("localhost","root");
                                    $detail = mysqli_select_db($conn, 'Students_Jobsite');                       
                                    $user_count =0;
                                    $detail="SELECT resumes.user_email, users.active, user_first_name, user_address, resumes.user_id, users.user_id, resumes.fk_user_id FROM users, resumes WHERE users.user_id = resumes.user_id AND fk_user_id =  $user_id";
                                    $detailqry = mysqli_query($conn, $detail);  
                                        while($row = mysqli_fetch_array($detailqry)){
                                            $user_count++;
                                        }
                                ?>
                                <h2 class="m-b-5 font-strong"><?php echo $user_count;?></h2>
                                <div class="m-b-5">TOTAL STUDENTS</div><i class="sidebar-item-icon fa fa-graduation-cap widget-stat-icon"></i>
                                <div><i class="fa fa-level-down m-r-5"></i><small>View More</small></div>
                            </div> 
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-info color-white widget-stat">
                            <div class="ibox-body">
                            <?php              
                                    $conn = mysqli_connect("localhost","root");
                                    $detail = mysqli_select_db($conn, 'Students_Jobsite');                       
                                    $employer_count =0;
                                    $detail="SELECT * FROM job where user_id = '$user_id'";
                                    $detailqry = mysqli_query($conn, $detail);  
                                        while($row = mysqli_fetch_array($detailqry)){
                                            $employer_count++;
                                        }
                            ?>
                                <h2 class="m-b-5 font-strong"><?php echo $employer_count;?></h2>
                                <div class="m-b-5">Total &nbsp; JOBS</div><i class="sidebar-item-icon ti-bookmark widget-stat-icon"></i>
                                <div><i class="fa fa-level-down m-r-5"></i><small>View More</small></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-warning color-white widget-stat">
                            <div class="ibox-body">
                            <?php              
                                    $conn = mysqli_connect("localhost","root");
                                    $detail = mysqli_select_db($conn, 'Students_Jobsite');                       
                                    $job_count =0;
                                    $detail="SELECT * FROM resumes where fk_user_id = '$user_id'";
                                    $detailqry = mysqli_query($conn, $detail);  
                                        while($row = mysqli_fetch_array($detailqry)){
                                            $job_count++;
                                        }
                            ?>
                                <h2 class="m-b-5 font-strong"><?php echo $job_count;?></h2>
                                <div class="m-b-5">JOB APPLICATIONS</div><i class="sidebar-item-icon fa fa-copy widget-stat-icon"></i>
                                <div><i class="fa fa-level-down m-r-5"></i><small>View More</small></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-danger color-white widget-stat">
                            <div class="ibox-body">
                            <?php              
                                    $conn = mysqli_connect("localhost","root");
                                    $detail = mysqli_select_db($conn, 'Students_Jobsite');                       
                                    $category_count =0;
                                    $detail="SELECT * FROM message where fk_user_id = '$user_id'";
                                    $detailqry = mysqli_query($conn, $detail);  
                                        while($row = mysqli_fetch_array($detailqry)){
                                            $category_count++;
                                        }
                            ?>
                                <h2 class="m-b-5 font-strong"><?php echo $category_count;?></h2>
                                <div class="m-b-5">TOTAL MESSAGES</div><i class="sidebar-item-icon fa fa-comment widget-stat-icon"></i>
                                <div><i class="fa fa-level-down m-r-5"></i><small>View More</small></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                        <div class="ibox-head">
                                <div class="ibox-title">Number of Applications per Job</div>
                            </div>
                            <div class="ibox-body">
                                <div class="flexbox mb-4">
                                </div>
                                <?php
                                $connect = mysqli_connect("localhost","root","","students_jobsite");
                                $query = "SELECT count(resume_id) as People, job_name as Country FROM job, resumes where job.job_id = resumes.job_id AND fk_user_id = $user_id GROUP by job_name";
                                $result = mysqli_query($connect , $query);
                                $resultCount=$result->num_rows;
                                $color = ['#bc5090','#bc5090','#bc5090','#bc5090','#bc5090', '#bc5090'];
                                $country = array();
                                $people = array();
                                foreach ($result as $peopleData) {
                                    $country[] = $peopleData['Country'];
                                    $people[] = $peopleData['People'];
                                }
                                ?>
                            <div>
                            <div id="column-chart" class="chart-div" style="height:340px; width:100%;"></div>
                            </div>
 
                        </div>
                    </div>
                </div>
                  
                    
                </div>
             
               
                <style>
                    .visitors-table tbody tr td:last-child {
                        display: flex;
                        align-items: center;
                    }

                    .visitors-table .progress {
                        flex: 1;
                    }

                    .visitors-table .progress-parcent {
                        text-align: right;
                        margin-left: 10px;
                    }
                </style>
              
            </div>
<?php
  include 'includes/footer.php';
?>
              








