<?php
	session_start();
	if(isset($_SESSION['user_id']) && $_SESSION['category_id'] && $_SESSION['user_type'] = "Student"){
        $user_id = $_SESSION['user_id'];
        $category_id = $_SESSION['category_id'];	
        }else{
            header('location:login.php');
        }
    include 'includes/connection.php';
   
?>
<?php
   
    include 'includes/header.php';
?>
    <!-- Main jumbotron for a primary marketing message or call to action -->
	<section class="inner-banner" style="background:#242c36 url(images/xxxx.jpg) no-repeat">
		<div class="container">
			<div class="caption">
				<h2>Get your jobs</h2>
				<p>Get your dream jobs <span>2021</span></p>
			</div>
		</div>
	</section>

	<section class="profile-detail">
		<div class="container">
		<?php
          $conn = mysqli_connect("localhost","root");
          $query = mysqli_select_db($conn, 'Students_Jobsite');
        ?>
        <?php
          if (isset ($_GET['id'])) {
            $_SESSION["jobno"] = $_GET['id'];
          }
          $jobno = $_SESSION["jobno"];
          $query = "SELECT * FROM job WHERE job_id=$jobno";
          $stid = mysqli_query($conn, $query);     
          $row = mysqli_fetch_assoc($stid);
        ?>
			<div class="col-md-12">
				<div class="row">
					<div class="basic-information">
						<div class="col-md-3 col-sm-3">
						 <img src="<?php echo $row['company_image']?>" alt="" class="img-responsive">
						 
						</div>
						<div class="col-md-9 col-sm-9">
							<div class="profile-content">
									<h2><?php echo $row['company_name']?><span><?php echo $row['job_name']?>&nbsp;&nbsp;(<?php echo $row['emp_status']?>)</span></h2>
									<p>Now Hiring(<?php echo $row['vacancy']?>)</p>
									<ul class="information">
									   
										<li><span>Address:</span><?php echo $row['job_location']?></li>
										<li><span>Salary:</span><?php echo $row['salary']?></li>
										<li><span>Apply before:</span><?php echo $row['job_deadline']?></li>
										
									</ul>
								</div>
							</div>
						<ul class="social" style="text-align: center; margin-left: 250px;">
						</ul>
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-user fa-fw"></i> About <?php echo $row['company_name']?>
							</div>							
							<div class="panel-body" style = "text-align: justify;">
							    <p><?php echo $row['job_description']?></p>	
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-graduation-cap fa-fw"></i> Education / Qualification:
							</div>								
							<div class="panel-body">
							<ul>
							    <?php echo $row['job_time']?>
							</ul>
							</div>
						</div>
						
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-leaf fa-fw"></i> Job Description:
							</div>
												
							<div class="panel-body" style = "text-align: justify;">
							<p>The job descriptions ares listed below:</p>	
							<ul>
								<li><?php echo $row['responsibilities']?></li>
								<li><?php echo $row['responsibilities1']?></li>
								<li><?php echo $row['responsibilities2']?></li>
								<li><?php echo $row['responsibilities3']?></li>
								<li><?php echo $row['responsibilities4']?></li>
								<li><?php echo $row['responsibilities5']?></li>							
							</ul>
							</div>
						</div>
						
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-coffee fa-fw"></i> Job Specifications/ Skills:
							</div>
											
							<div class="panel-body">
							<p>The job specifications are listed below:</p>	
							<ul>
							    <li><?php echo $row['education']?></li>
								<li><?php echo $row['education1']?></li>
								<li><?php echo $row['education2']?></li>
								<li><?php echo $row['education3']?></li>
								<li><?php echo $row['education4']?></li>
								<li><?php echo $row['education5']?></li>
							</ul>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-coffee fa-fw"></i> Other Benefits:
							</div>
												
							<div class="panel-body">
							<p>The benefits from this job are listed below:</p>	
							<ul>
							    <li><?php echo $row['benefits']?></li>
								<li><?php echo $row['benefits1']?></li>
								<li><?php echo $row['benefits2']?></li>
								<li><?php echo $row['benefits3']?></li>
								<li><?php echo $row['benefits4']?></li>
								<li><?php echo $row['benefits5']?></li>
							</ul>
							</div>
						</div>
						<ul class="social" style="text-align: center; margin-left: 150px;">
						<?php
						error_reporting(0); 
                        $query1 = mysqli_select_db($conn, 'Students_Jobsite');
                        $query1 = "SELECT * FROM resumes WHERE user_id=$user_id AND job_id = $jobno";
                        $stid2 = mysqli_query($conn, $query1);     
                        $row = mysqli_fetch_assoc($stid2);
							
						if($row['applied_no'] == '1') { 
							
						} 
						else{ ?>
						    <li><a href="#resume" data-toggle="modal" class="btn-primary" name ="resume" style="background-color:#26bd00; color:white">Apply Now</a></li>
                            <?php } ?>
                            <li><a href="#saveajob" data-toggle="modal" class="btn-primary" name ="saveajob" style="background-color:#b53aaf; color:white;">Save a job</a></li>
							<li><a href="#edit" data-toggle="modal" class="btn-primary" name ="edit" style="background-color:#4287f5; color:white">Message</a></li>
							
							
                        </ul>						
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php
	include 'includes/footer.php';
	include 'company_modal.php';
	include 'resume_modal.php';
	include 'saveajob.php';
	?>