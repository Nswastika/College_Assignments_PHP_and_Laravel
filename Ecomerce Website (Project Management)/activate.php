<?php include 'includes/connect.php'; ?>
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


		$conn = oci_connect('example', 'example', '//localhost/xe');
		$stmt = oci_parse($conn, "UPDATE users SET active='1', activate_code='$code' WHERE user_email='$user_email'");
		oci_execute($stmt);

		$output = '
						<div class="alert alert-success">
			                <h4><i class="icon fa fa-check"></i> Success!</h4>
			                Account activated</b>.
			            </div>
			            <h4>You can <a href="login.php">Login</a> or back to <a href="index.php">Homepage</a>.</h4>
					';

	}

?>
<?php include 'includes/header.php'; ?>
<br>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	
	  <div class="content-wrapper">
	    <div class="container">

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
	     
	    </div>
	  </div>
  </div>
  	<?php include 'includes/footer.php'; ?>


