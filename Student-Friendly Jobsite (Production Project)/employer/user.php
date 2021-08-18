<?php	
  include 'includes/header.php';
  include 'includes/sidebar.php';
  include ('../includes/connection.php');
  $conn = mysqli_connect("localhost","root");
  $sql = mysqli_select_db($conn, 'Students_Jobsite');
	
	$fname = "Not Available";
	$email = "Not Available";
	$address = "Not Available";
	$created = "Not Available";		
    $image = "Not Available";
	

	$sql = "SELECT * FROM  users WHERE user_id= '$user_id'";
	
	$result = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_assoc($result))
	{
		$userid = $row['user_id'];
		$fname = $row['user_first_name'];
		$email = $row['user_email'];
		$address = $row['user_address'];
		$created = $row['user_created_at'];	
        $url = "../".$row['user_image'];	
		
		if($fname == "")
		{
			$fname = "Not Available";
		}
		if($email == "")
		{
			$email = "Not Available";
		}
		if($address == "")
		{
			$address = "Not Available";	
		}


		if($created == "")
		{
			$created = "Not Available";
		}
		
	}
?>


<div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Profile</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item">Profile</li>
                </ol>
            </div>
            <div class="page-content fade-in-up">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">Profile</div>
                                <div class="ibox-tools">
                                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                                </div>
                            </div>
                            <div class="ibox-body">
                                <div class="card" style="width:300px;">
                                    <img src="<?php echo $url;?>" alt="Add your image" class="card-img-top" src="./assets/img/blog/storm.jpg" />
                                    <div class="box-footer no-padding">          
                                        <b><span>&nbsp;First Name:&nbsp;</span></b><?php echo $fname?><br>
                                        <b><span>&nbsp;Email:&nbsp;</span></b><?php echo $email?><br/>
                                        <b><span>&nbsp;Address:&nbsp;</span></b><?php echo $address?><br/>
                                        <b><span>&nbsp;Joined at:&nbsp;</span></b><?php echo $created?><br/>
                                </div>
                            </div><br>
                                <a href="edit_user.php" class="btn btn-warning">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                            </div>
                        </div>
                    </div>         
                </div>
        </div>
  <?php include('includes/footer.php'); ?>

