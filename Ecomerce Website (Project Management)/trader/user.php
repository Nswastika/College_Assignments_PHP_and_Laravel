<?php
	session_start();
	if(isset($_SESSION['USER_ID']) && $_SESSION['USER_TYPE'] = "Trader"){
		$USER_ID = $_SESSION['USER_ID'];	
	}else{
		header('location:../login.php');
	}
include ('../includes/connect.php');
// include ('../includes/imageupload.php');
	
	$fname = "N/A";
	$lname = "N/A";
	$email = "N/A";
	$address = "N/A";
    $dates = "N/A";
	$created = "N/A";	
   $image = "Not Available";			

	$sql = "SELECT * FROM  USERS WHERE USER_ID= '$USER_ID'";	
	$result = oci_parse($conn,$sql);	
	oci_execute($result);
	while($row = oci_fetch_assoc($result)){
		$userid = $row['USER_ID'];
		$fname = $row['USER_FIRST_NAME'];
		$lname = $row['USER_LAST_NAME'];
		$email = $row['USER_EMAIL'];
		$address = $row['USER_ADDRESS'];
    $dates = $row['DATE_OF_BIRTH'];
		$image = $row['USER_IMAGE'];
		
		if($fname == ""){
			$fname = "Not Available";
		}
		if($lname == ""){
			$lname = "Not Available";
		}
		if($email == ""){
			$email = "Not Available";
		}
		if($address == ""){
			$address = "Not Available";	
		}
        if($dates == "")
        {
            $dates = "Not Available";
        }
		if($created == ""){
			$created = "Not Available";
		}
     if($image == ""){
      $image  = "Not Available";
    }
    
		
	}
	
	

?>
<?php include('../includes/backend/head.php');?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <?php include('./includes/nav.php'); ?>
    <!-- /.sidebar -->
  </aside>
  
  
   <div class="content-wrapper" >
    <section class="content-header">
      <h1>
        Trader Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Trader Profile</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content" >
      <div class="row">
        <!-- left column -->
        <div class="col-md-6" style="background-color:#ffffff;">
          <!-- general form elements -->
                      <div class="panel-heading p-h-md">
                <h3 class="page-header p-b-md m-b-xs">My Profile</h3>
            </div>
            <div class="panel-body" style="background-color:#ffffff;">
              <div class="widget-user-header bg-gwhite">
                <!-- <img src="<?php echo (!empty($image)) ? 'image/'.$image.'' : "image/profile.jpg"; ?>" width="60%"> -->
                <img src="<?php echo  $image. ''?>" alt="Add your image" width="70%">
              <div class="widget-user-image">
              
                <div class="row">

                    <div class="col-md-10">

                    <br>
                        <table class="table table-striped table-hover table-bordered">
                             
                            <tbody>
                                <tr>
                                    <td width="40%">First Name</td>
                                    <td><?php echo $fname; ?></td>
                                </tr>
                                <tr>
                                    <td>Last Name</td>
                                    <td><?php echo $lname; ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?php echo $email; ?></td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td><?php echo $fname; ?></td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td><?php echo $address; ?></td>
                                </tr>
                                <tr>
                                    <td>Date of Birth</td>
                                    <td><?php echo $dates; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>            
               
            </div>
			<div class="col-md-2 text-center">                        
					<div>
						<a href="edit_user.php" class="btn btn-warning m-t-md">
							<i class="fa fa-pencil fa-fw"></i> Edit Profile
						</a>
					</div>
			</div><br><br><br>
			<div class="col-md-2 text-center"></div>
          </div>
          </div>
	</section>
    <!-- /.content -->
  </div>

   <!-- /.content-wrapper -->
  <?php include('includes/footer.php'); ?>


<!-- ./wrapper -->
<?php include('./includes/script.php'); ?>
</body>
</html>
