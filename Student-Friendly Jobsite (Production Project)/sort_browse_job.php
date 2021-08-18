<?php
    session_start();
    error_reporting(E_ALL & ~E_NOTICE);
    header('Cache-Control: no-cache');
    if(isset($_SESSION['user_id']) && $_SESSION['category_id'] && $_SESSION['user_type'] = "Student"){
        $user_id = $_SESSION['user_id'];
        $category_id = $_SESSION['category_id'];	
        }else{
           
        }
    include 'includes/connection.php';
    include 'includes/header.php';
?>

<!-- Inner Banner -->
<section class="inner-banner" style="background:#242c36 url(images/xxxx.jpg) no-repeat">
	<div class="container">
		<div class="caption">
			<h2>Get your jobs</h2>
			<p>Get your dream jobs <span>2021</span></p>
		</div>
	</div>
</section>



<?php
    if(isset($_SESSION['user_id']) && $_SESSION['category_id'] && $_SESSION['user_type'] = "Student"){
?>
<section class="jobs">
	<div class="container">
		<div class="row heading">
		</div>
        <div class="companies">
            <?php
            if(isset($_GET['query'])){
                echo "Showing Results for ".$_GET['query'];
            }
            $conn = mysqli_connect("localhost","root");
            $qry = mysqli_select_db($conn, 'Students_Jobsite');
            if (!$qry) {
                error_log("Database selection failed: " . mysqli_error($connection));
                die('Internal server error');
            }

            $qry = "SELECT * FROM job where category_id = $category_id and is_activated = '1' ORDER BY job_name ASC";
            $stid = mysqli_query($conn, $qry);
            while (($row = mysqli_fetch_assoc($stid)) != false) {?>
            <div class="company-list">
                <div class="row">
                    <div class="col-md-2 col-sm-2">
                        <div class="company-logo">
                            <img src="<?php echo $row['company_image']?>" class="img-responsive" alt="" />
                        </div>
                    </div>

                    <div class="col-md-8 col-sm-8">
                        <div class="company-content">
                            <h3><?php echo $row['company_name']?></h3>
                            <p><span class="company-name"><i class="fa fa-briefcase"></i><?php echo $row['job_name']?></span><span class="company-location"><i class="fa fa-map-marker"></i> <?php echo $row['job_location']?></span><span class="package"><i class="fa fa-money"></i><?php echo $row['salary']?></span></p>
                        </div>
	                </div>

                    <div class="col-md-2 col-sm-2">
						<a style="color:white;" class="btn view-job" href="company-detail.php?id=<?php echo $row['job_id'];?>">View Job</a>
					</div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php }  else {?>
    <form form method="POST" action="sort.php">
	<fieldset>
        <div class="col-md-4 col-sm-4 no-pad">
		</div>
		<div class="col-md-4 col-sm-4 no-pad">
            <select class="form-control" name="keyword">								
				<?php
                $conn = mysqli_connect("localhost","root");
                $sql2 = mysqli_select_db($conn, 'Students_Jobsite');
				$sql2 = "SELECT * FROM category";
				$result2 = mysqli_query($conn,$sql2);
				while ($row = mysqli_fetch_assoc($result2)){?>
					<option value="<?php echo $row['categoryname']; ?>">
						<?php echo $row['categoryname']; ?>
					</option><?php
				    }?>
	        </select> 
		</div>
		<div class="col-md-2 col-sm-2 no-pad">
            <button style="background-color:#ff8f3e;" type="submit" name="submit" value="search" class="btn px-4 btn-primary text-white">Search</button>
		</div>
	</fieldset>
    </form>
    <section class="jobs">
	<div class="container">
		<div class="row heading">
			<h2>All Jobs</h2>
		</div>
        <div class="companies">
            <?php
            if(isset($_GET['query'])){
                echo "Showing Results for ".$_GET['query'];
            }
            $conn = mysqli_connect("localhost","root");
            $qry = mysqli_select_db($conn, 'Students_Jobsite');
            if (!$qry) {
                error_log("Database selection failed: " . mysqli_error($connection));
                die('Internal server error');
            }

            $qry = "SELECT * FROM job where is_activated = '1'";
            $stid = mysqli_query($conn, $qry);
            while (($row = mysqli_fetch_assoc($stid)) != false) {?>
            <div class="company-list">
                <div class="row">
                    <div class="col-md-2 col-sm-2">
                        <div class="company-logo">
                            <img src="<?php echo $row['company_image']?>" class="img-responsive" alt="" />
                        </div>
                    </div>

                    <div class="col-md-8 col-sm-8">
                        <div class="company-content">
                            <h3><?php echo $row['company_name']?></h3>
                            <p><span class="company-name"><i class="fa fa-briefcase"></i><?php echo $row['job_name']?></span><span class="company-location"><i class="fa fa-map-marker"></i> <?php echo $row['job_location']?></span><span class="package"><i class="fa fa-money"></i><?php echo $row['salary']?></span></p>
                        </div>
	                </div>

                    <div class="col-md-2 col-sm-2">
						<a style="color:white;" class="btn view-job" href="company-detail.php?id=<?php echo $row['job_id'];?>">View Job</a>
					</div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php } ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php
	include 'includes/footer.php';
?>