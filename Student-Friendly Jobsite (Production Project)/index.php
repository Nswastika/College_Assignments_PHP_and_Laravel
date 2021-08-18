<?php
    error_reporting(0);
	session_start();
	
	if(isset($_SESSION['user_id']) && $_SESSION['category_id'] && $_SESSION['user_type'] = "Student"){
        $user_id = $_SESSION['user_id'];		
		$category_id = $_SESSION['category_id'];	
        }
	else{
		
	}
    include 'includes/connection.php'; 
?>  
<?php
	include 'includes/header.php';
?>

		<section class="main-banner" style="background:#242c36 url(images/allll.png) no-repeat">
			<div class="container">
				<div class="caption">
					<h2 style="color:#ffffff; font-size: 35px;"><strong>The easiest way to get your dream job</strong></h2>
					<form form method="POST" action="search.php">
						<fieldset>
							<div class="col-md-4 col-sm-4 no-pad">
								<input name="keyword" type="text" class="form-control border-right" placeholder="Job Name" />
							</div>
							<div class="col-md-3 col-sm-3 no-pad">
								<input name="keyword1" type="text" class="form-control border-right" placeholder="Job Location" />
							</div>
							<div class="col-md-3 col-sm-3 no-pad">
								<input name="keyword2" type="text" class="form-control border-right" placeholder="Part-time/ Internship" />
							</div>						
							<div class="col-md-2 col-sm-2 no-pad">
								<input type="submit" class="btn seub-btn" style="background-color:#ff8f3e;" value="search" />							
							</div>
						</fieldset>
					</form>
		
				</div>
			</div>
		</section>
		
        <section class="membercard dark">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-4">
						<div class="left-widget-sidebar">
							<div class="card-widget bg-white user-card">
								<div class="u-img img-cover" style="background-image: url(images/account.png);background-size:cover;"></div>
								<div class="u-content">
									<br/><br/>
									<h5><a href="register_cat.php">Create An Account</a></h5>
									<p class="text-muted" style = "text-align: justify;">Register your account by filling up the registration form and login to get all the information related to jobs.</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="left-widget-sidebar">
							<div class="card-widget bg-white user-card">
								<div class="u-img img-cover" style="background-image: url(images/pp.jpg);background-size:cover;"></div>
								<div class="u-content">
									<br/><br/>
									<h5><a href = "index.php">Search Desired Job</a></h5>
									<p class="text-muted" style = "text-align: justify;">Search the job according to your requirements. After finding out the required job, apply fot the job.</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="left-widget-sidebar">
							<div class="card-widget bg-white user-card">
								<div class="u-img img-cover" style="background-image: url(images/search.jpg);background-size:cover;"></div>
								<div class="u-content">
									<br/><br/>
									<h5><a href="create_resume.php">Create Your Resume</a></h5>
									<p class="text-muted" style = "text-align: justify;">Fill in the form according to your details and then create and download your resume easily just in one click.</p>
								</div>
							</div>
						</div>
					</div>			
				</div>
			</div>
		</section>

		
		<section class="counter" style="background-color:#ff8f3e;">
			<div class="container">
				<div class="col-md-9 col-sm-6">
					<h2 style="color:#ffffff; font-size: 35px;"> Looking for a job? </h2>
					<p style="color:#ffffff; font-size: 20px;"> Signup to find the jobs that meets your requirements. </p>           
				</div>
                <div class="col-md-3 col-sm-6">
				    <a href="register_cat.php" style="background-color:#ffffff;" class="btn btn-dark btn-lg " role="button" aria-pressed="true">Sign Up</a>                  
				</div>
            </div>
		</section>
		
		<?php
        if(isset($_SESSION['user_id']) && $_SESSION['category_id'] && $_SESSION['user_type'] = "Student"){
		?>
		<section class="jobs">
			<div class="container">
				<div class="row heading">
					<h2>Recommended Jobs</h2>
				</div>
                <div class="companies">
	                <?php
                      if(isset($_GET['query'])){
                      echo "Showing Results for ".$_GET['query'];
                    }?>

                    <?php
                      $conn = mysqli_connect("localhost","root");
                      $qry = mysqli_select_db($conn, 'Students_Jobsite');
                      $qry = "SELECT * FROM job where category_id = $category_id AND is_activated = '1' ORDER BY company_name ASC LIMIT 5;";
                      $stid = mysqli_query($conn, $qry);
                      while (($row = mysqli_fetch_assoc($stid)) != false) {
                    ?>
                    
					<div class="company-list">
                        <div class="row">
                            <div class="col-md-2 col-sm-2">
                                <div class="company-logo">
                                   <img src="<?php echo $row['company_image']?>" class="img-responsive" alt="" />
                                </div>								
                            </div>
                            <div class="col-md-10 col-sm-10">
                                <div class="company-content">
                                   <h3><?php echo $row['company_name']?><span class="full-time"><?php echo $row['emp_status']?></span></h3>
                                   <p><span class="company-name"><i class="fa fa-briefcase"></i><?php echo $row['job_name']?></span><span class="company-location">
									   <i class="fa fa-map-marker"></i> <?php echo $row['job_location']?></span><span class="package"><i class="fa fa-money"></i>
									    <?php echo $row['salary']?></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
					
                </div>
				<div class="row">
				   <a  type="button" style="background-color:#ff8f3e; color:white;" class="btn brows-btn" href="sort_browse_job.php">Browse All Jobs</a>
				</div>
			</div>
		</section>
		<?php }  else {?>
			<section class="jobs">
			<div class="container">
				<div class="row heading">
					<h2>Featured Jobs</h2>
				</div>
                <div class="companies">
	                <?php
                      if(isset($_GET['query'])){
                      echo "Showing Results for ".$_GET['query'];
                    }?>

                    <?php
                      $conn = mysqli_connect("localhost","root");
                      $qry = mysqli_select_db($conn, 'Students_Jobsite');
                      $qry = "SELECT * FROM job WHERE is_activated = '1' ORDER BY job_name ASC LIMIT 5;";
                      $stid = mysqli_query($conn, $qry);
                      while (($row = mysqli_fetch_assoc($stid)) != false) {
                    ?>
                    
					<div class="company-list">
                        <div class="row">
                            <div class="col-md-2 col-sm-2">
                                <div class="company-logo">
                                   <img src="<?php echo $row['company_image']?>" class="img-responsive" alt="" />
                                </div>
                            </div>

                            <div class="col-md-10 col-sm-10">
                                <div class="company-content">
                                   <h3><?php echo $row['company_name']?><span class="full-time"><?php echo $row['emp_status']?></span></h3>
                                   <p><span class="company-name"><i class="fa fa-briefcase"></i><?php echo $row['job_name']?></span><span class="company-location"><i class="fa fa-map-marker"></i> <?php echo $row['job_location']?></span><span class="package"><i class="fa fa-money"></i><?php echo $row['salary']?></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
				<div class="row">
					<a  type="button" style="background-color:#ff8f3e; color:white;" class="btn brows-btn" href="sort_browse_job.php">Browse All Jobs</a>
				</div>
			</div>
		</section>
		<?php } ?>

		<section class="testimonials dark">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div id="testimonial-slider" class="owl-carousel" >
							<div class="testimonial">
								<div class="pic">
									<img src="images/person_3.jpg" alt="">
								</div>
								<p class="description">
									"I would like to thank N4S fot provding a platform to find a dream job as an student.  "
								</p>
								<h3 class="testimonial-title">Krishna</h3>
								<span class="post">Web Developer</span>
							</div>							
							<div class="testimonial">
								<div class="pic">
									<img src="images/person_6.jpg" alt="">
								</div>
								<p class="description">
									"Finding a job at an early age was difficult. But this platform helped me start my career easily. "
								</p>
								<h3 class="testimonial-title" >kristiana</h3>
								<span class="post">Web Designer</span>
							</div>						
						</div>
					</div>
				</div>
			</div>
		</section>
			
    <?php
	include "includes/footer.php";
	?>