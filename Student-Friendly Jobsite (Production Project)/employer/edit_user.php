<?php

include 'includes/header.php';
include 'includes/sidebar.php';
include ('../includes/connection.php');
include ('imageupload.php');	
	
$txtPass="";
$conn = mysqli_connect("localhost","root");
$detail = mysqli_select_db($conn, 'Students_Jobsite');
	if(isset($_SESSION['user_id']) && $_SESSION['user_type'] = "Employer"){
		$USER_ID = $_SESSION['user_id'];
		$detail = "SELECT * FROM users WHERE user_id = $user_id";
		$detailqry = mysqli_query($conn, $detail);
		
		while($row = mysqli_fetch_assoc($detailqry)){
			$txtFirstName = $row['user_first_name'];
			$txtAddress = $row['user_address'];
			$txtEmail = $row['user_email'];

			$txtPass = $row['user_password'];	
            $pimagePath = $row['user_image'];
		}
	}else{
		header('location:../login.php');
	}
$date = date('m-d-Y');
if (isset($_POST['save'])){
	$fname=$_POST['fname'];

	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$address = $_POST['address'];

    $user_image = $_FILES['user_image']["name"];
	
    $maxsize = 2097152;
    $img_haystack = array('jpg', 'jpeg', 'png');
    $image_filter = array('images/jpeg', 'images/jpg', 'images/png');
    if (!empty($user_image)) {
		$target_dir = "../images/";
		$target_file = $target_dir . basename($_FILES["user_image"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
		if (!in_array($imageFileType, $img_haystack)) {
			$errors['invalid_img'] = "Invalid file type. Only JPG and PNG types are accepted.";
		} else {
			$flag = 1;
		}
		if ($flag) {
			$imgSize = $_FILES["user_image"]["size"];
			if ($imgSize > $maxsize) {
				$errors['max'] = 'File you\'re trying to upload is too large. File must be less than 2 megabytes.';
			}
		}
		$check = getimagesize($_FILES["user_image"]["tmp_name"]);
		if ($check !== false) {
			$uploadOk = 1;
			$imgPath = $target_dir . uniqid() . '.' . $imageFileType;
			if (move_uploaded_file($_FILES["user_image"]["tmp_name"], $imgPath)) {
			} else {
				$errors['fail'] = "Sorry, there was an error uploading your file.";
			}
		}		
		$imgPath = substr($imgPath,3,strlen($imgPath)-3);
	}else{
		$imgPath = $pimagePath;
	}


	if($txtPass == $pass){
		$sql = "UPDATE users SET user_first_name = '$fname',  user_address = '$address',  user_image = '$imgPath' WHERE user_id = '$user_id'";
	}else{
		$pass = md5($pass);
		$sql = "UPDATE users SET user_first_name = '$fname',  user_address = '$address',  user_password='$pass', , user_image = '$imgPath'  WHERE user_id = '$user_id'";
	}	
	
	$result = mysqli_query($conn, $sql);
	
  echo "<script>alert('You have sucessfully Edited Your Detail.');window.location.href='user.php';</script>";		
		
}
?>


 <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="page-heading">
                <h1 class="page-title">Edit Profile</h1>
                <ol class="breadcrumb">
                    <li><a href="../../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Edit Profile</li>
                </ol>
            </div>
            <br>
            <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Edit Profile</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form class="form-horizontal" id="form-sample-1" method="post" action="" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="email" required class="form-control" placeholder="Enter email"  name="email" value="<?php echo $txtEmail?>">			 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" required class="form-control" placeholder="Enter first name" name="fname" value="<?php echo $txtFirstName?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="password" required class="form-control" placeholder="Enter Password" name="pass" value="<?php echo $txtPass?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" required class="form-control" placeholder="Enter address" name="address" value="<?php echo $txtAddress?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    
                                    <input type="file" name="user_image"/> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10 ml-sm-auto">
                                    <button type="submit" name="save" class="btn btn-info" type="submit">Save Changes</button>
                                </div>
                            </div>
    
                        </form>
                    </div>
                </div>
  <?php include('includes/footer.php'); ?>

