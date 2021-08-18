<?php include 'includes/connection.php'; ?>
<?php
    if(!isset($_GET['code'])){
		$output = '
			<div class="alert alert-danger">
                <h4><i class="icon fa fa-warning"></i> Error!</h4>
                Code to activate account not found.
            </div>
            <h4>You may <a href="register.php">Signup</a> or go back to <a href="index.php">Homepage</a>.</h4>
		'; 
	}
    else{
		$code = $_GET['code'];
		$user_email = $_GET['useremail'];

		$stmt = mysqli_select_db($conn, 'Students_Jobsite');
		if (!$stmt) {
			error_log("Database selection failed: " . mysqli_error($connection));
			die('Internal server error');
		}
		$stmt = "UPDATE users SET active='1', activate_code='$code' WHERE user_email='$user_email'";
		$result = mysqli_query($conn, $stmt);
        
		$output =   '<div class="col-md-10 col-sm-8 col-md-offset-3 col-sm-offset-2">
						<div class="alert alert-success">
			                <h4><i class="icon fa fa-check"></i> Success!</h4>
			                Account activated</b>.
			            </div>
			            <h4>You can <a href="login.php">Login</a> or back to <a href="index.php">Homepage</a>.</h4>
						</div>
					';

	}?>

    <?php include 'includes/header.php'; ?>
	<section class="inner-banner" style="background:#242c36 url(images/xxxx.jpg) no-repeat">
		<div class="container">
			<div class="caption">
				<h2>Activate Account</h2>
				<p>Get your dream jobs <span>2021</span></p>
			</div>
		</div>
	</section>
	<!-- Main content -->
	<section class="content">
	    <div class="row">
	        <div class="col-sm-9">
	        	<?php echo $output; ?>
	        </div>
	    
		    <div class="col-sm-3">
	        </div>
	    </div>
	</section>

<?php include 'includes/footer.php'; ?>


