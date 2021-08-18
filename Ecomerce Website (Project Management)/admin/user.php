<?php
	session_start();
	if(isset($_SESSION['USER_ID']) && $_SESSION['USER_TYPE'] = "Admin"){
		$USER_ID = $_SESSION['USER_ID'];	
	}else{
		header('location:../login.php');
	}
include ('../includes/connect.php');
// include ('../includes/imageupload.php');
	
	$fname = "Not Available";
	$lname = "Not Available";
	$email = "Not Available";
	$address = "Not Available";
  $dates = "Not Available";
	$created = "Not Available";		
  $image = "Not Available";
	

	$sql = "SELECT * FROM  USERS WHERE USER_ID= '$USER_ID'";
	
	$result = oci_parse($conn,$sql);
	
	oci_execute($result);		

	while($row = oci_fetch_assoc($result))
	{
		$userid = $row['USER_ID'];
		$fname = $row['USER_FIRST_NAME'];
		$lname = $row['USER_LAST_NAME'];
		$email = $row['USER_EMAIL'];
		$address = $row['USER_ADDRESS'];
    $dates = $row['DATE_OF_BIRTH'];
		$created = $row['USER_CREATED_AT'];
    $image = $row['USER_IMAGE'];
		
		if($fname == "")
		{
			$fname = "Not Available";
		}
		if($lname == "")
		{
			$lname = "Not Available";
		}
		if($email == "")
		{
			$email = "Not Available";
		}
		if($address == "")
		{
			$address = "Not Available";	
		}
    if($dates == "")
    {
      $dates = "Not Available";
    }

		if($created == "")
		{
			$created = "Not Available";
		}

    if($image == ""){
      $image  = "Not Available";
    }
		
	}



?>

<!DOCTYPE html>
<?php include('../includes/backend/head.php');?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <?php include('./includes/nav.php'); ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       	<strong>My Profile</strong>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">My Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          
          
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-gwhite">
                <!--  echo '<img src="image/'. $image. '"  width="50%"/>'   -->  
               <img src="<?php echo  $image. ''?>" alt="Add your image" width="70%">
              <div class="widget-user-image">
              
             
              </div>
              
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username"></h3>
              <h5 class="widget-user-desc"><strong></strong></h5>
              
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
               
                <li><a href=""><b><span>First Name:&nbsp;</span></b><?php echo $fname?></a></li>
                <li><a href=""><b><span>Last Name:&nbsp;</span></b><?php echo $lname?></a></li>
                <li><a href=""><b><span>Email:&nbsp;</span></b><?php echo $email?></a></li>
                <li><a href=""><b><span>Address:&nbsp;</span></b><?php echo $address?></a></li>	
                <li><a href=""><b><span>Date of Birth:&nbsp;</span></b><?php echo $dates?></a></li> 			
                <li><a href=""><b><span>Joined at:&nbsp;</span></b><?php echo $created?></a></li>
         
              </ul>
            </div>

          </div>
            <a href="edit_user.php" class="btn btn-warning">
                <i class="fa fa-edit"></i> Edit
              </a>
              
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
